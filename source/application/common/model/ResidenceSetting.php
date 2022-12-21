<?php

namespace app\common\model;

use app\common\enum\RefreshType as RefreshTypeEnum;
use think\Cache;

/**
 * 住宅设置模型
 */
class ResidenceSetting extends BaseModel
{
    protected $name = 'hs_residence_setting';
    protected $createTime = false;

    /**
     * 获取器: 转义数组格式
     * @param $value
     * @return mixed
     */
    public function getValuesAttr($value)
    {
        return json_decode($value, true);
    }

    /**
     * 修改器: 转义成json格式
     * @param $value
     * @return string
     */
    public function setValuesAttr($value)
    {
        return json_encode($value);
    }

    /**
     * 获取指定项设置
     * @param $key
     * @param $wxapp_id
     * @return array
     */
    public static function getItem($key, $wxapp_id = null)
    {
        $data = self::getAll($wxapp_id);
        return isset($data[$key]) ? $data[$key]['values'] : [];
    }

    /**
     * 获取设置项信息
     * @param $key
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function detail($key)
    {
        return self::get(compact('key'));
    }

    /**
     * 全局缓存: 系统设置
     * @param null $wxapp_id
     * @return array|mixed
     */
    public static function getAll($wxapp_id = null)
    {
        $static = new static;
        is_null($wxapp_id) && $wxapp_id = $static::$wxapp_id;
        if (!$data = Cache::get('residence_setting_' . $wxapp_id)) {
            $setting = $static::all(compact('wxapp_id'));
            $data = empty($setting) ? [] : array_column(collection($setting)->toArray(), null, 'key');
            Cache::tag('cache')->set('residence_setting_' . $wxapp_id, $data);
        }
        return $static->getMergeData($data);
    }

    /**
     * 合并用户设置与默认数据
     * @param $userData
     * @return array
     */
    private function getMergeData($userData)
    {
        $defaultData = $this->defaultData();
        // 商城设置：配送方式
        if (isset($userData['refresh']['values']['refresh_type'])) {
            unset($defaultData['refresh']['values']['refresh_type']);
        }
        return array_merge_multiple($defaultData, $userData);
    }

    /**
     * 默认配置
     * @param null|string $storeName
     * @return array
     */
    public function defaultData($storeName = null)
    {
        return [
            'refresh' => [
                'key' => 'refresh',
                'describe' => '刷新设置',
                'values' => [
                    // 刷新花费类型
                    'refresh_type' => array_keys(RefreshTypeEnum::data()),
                    // 选中的花费类型
                    'collectors_type' => [20],
                    // 积分花费
                    'integral_consume' => 0,
                    // 余额花费
                    'balance_consume' => 0,
                    // 积分可抵扣百分比
                    'integral_deduction' => 0,
                    // x积分抵扣一元
                    'integral_number' => 0,
                ],
            ],
            'topping' => [
                'key' => 'topping',
                'describe' => '置顶设置',
                'values' => [
                    'days' => 0,//置顶多少天
                    'money' => 0,//多少钱
                    'concessional' => 0,//优惠价
                    'integral_number' => 0,//x积分抵扣一元
                    'integral_deduction' => 0,//最多抵扣百分比
                ]
            ],
            'release' => [
                'key' => 'release',
                'describe' => '发布设置',
                'values' => [
                    //发布一条信息消耗多少积分
                    'consume' => 0,
                ]
            ],
        ];
    }

}
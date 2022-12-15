<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/9 11:23
 */


namespace app\common\model;

use app\common\model\Region as RegionModel;

/**
 * 区域&楼盘表模型
 * Class RegionalProperty
 * @package app\common\model
 */
class RegionalProperty extends BaseModel
{
    /**
     * 追加字段
     * @var array
     */
    protected $append = ['region'];

    /**
     * 关联文章封面图
     * @return \think\model\relation\HasOne
     */
    public function logo()
    {
        $module = self::getCalledModule() ?: 'common';
        return $this->hasOne("app\\{$module}\\model\\UploadFile", 'file_id', 'image_id');
    }

    /**
     * 地区名称
     * @param $value
     * @param $data
     * @return array
     */
    public function getRegionAttr($value, $data)
    {
        return [
            'province' => RegionModel::getNameById($data['province']),
            'city' => RegionModel::getNameById($data['city']),
            'region' => $data['region'] == 0 ? '' : RegionModel::getNameById($data['region']),
        ];
    }

    /**
     * 商圈
     * @param $value
     * @param $data
     * @return array
     */
    public function getAreaIdAttr($value)
    {
        $area = HsArea::detail($value);
        return ['text' => $area['name'], 'value' => $value];
    }

    /**
     * 详情
     * @param $shop_id
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail($id)
    {
        return static::get($id, ['logo']);
    }
}
<?php

namespace app\store\model;

use app\common\enum\ResidenceSetting as ResidenceSettingEnum;
use app\common\model\ResidenceSetting;
use think\Cache;

/**
 * 住宅设置模型
 */
class HsResidenceSetting extends ResidenceSetting
{
    /**
     * 更新系统设置
     * @param $key
     * @param $values
     * @return bool
     * @throws \think\exception\DbException
     */
    public function edit($key, $values)
    {
        $model = self::detail($key) ?: $this;
        // 数据验证
        if (!$this->validValues($key, $values)) {
            return false;
        }
        // 删除系统设置缓存
        Cache::rm('residence_setting_' . self::$wxapp_id);
        return $model->save([
                'key' => $key,
                'describe' => ResidenceSettingEnum::data()[$key]['describe'],
                'values' => $values,
                'wxapp_id' => self::$wxapp_id,
            ]) !== false;
    }

    /**
     * 数据验证
     * @param $key
     * @param $values
     * @return bool
     */
    private function validValues($key, $values)
    {
        $callback = [
            'refresh' => function ($values) {
                return $this->validStore($values);
            },
        ];
        // 验证商城设置
        return isset($callback[$key]) ? $callback[$key]($values) : true;
    }

    /**
     * 验证商城设置
     * @param $values
     * @return bool
     */
    private function validStore($values)
    {
        if (!isset($values['collectors_type']) || empty($values['collectors_type'])) {
            $this->error = '花费类型至少选择一个';
            return false;
        }
        return true;
    }

}
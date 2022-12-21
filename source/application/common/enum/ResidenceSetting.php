<?php

namespace app\common\enum;

/**
 * 商城设置枚举类
 * Class Setting
 * @package app\common\enum
 */
class ResidenceSetting extends EnumBasics
{
    // 刷新设置
    const REFRESH = 'refresh';

    // 发布设置
    const RELEASE = 'release';

    // 置顶设置
    const TOPPING = 'topping';

    /**
     * 获取订单类型值
     * @return array
     */
    public static function data()
    {
        return [
            self::REFRESH => [
                'value' => self::REFRESH,
                'describe' => '刷新设置',
            ],
            self::RELEASE => [
                'value' => self::RELEASE,
                'describe' => '发布设置',
            ],
            self::TOPPING => [
                'value' => self::TOPPING,
                'describe' => '短信通知',
            ],
        ];
    }

}
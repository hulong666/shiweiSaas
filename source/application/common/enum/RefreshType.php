<?php

namespace app\common\enum;

/**
 * 刷新花费类型枚举类
 * Class DeliveryType
 * @package app\common\enum
 */
class RefreshType extends EnumBasics
{
    // 积分刷新
    const EXPRESS = 10;

    // 余额刷新
    const EXTRACT = 20;

    /**
     * 获取枚举数据
     * @return array
     */
    public static function data()
    {
        return [
            self::EXPRESS => [
                'name' => '积分刷新',
                'value' => self::EXPRESS,
            ],
            self::EXTRACT => [
                'name' => '余额刷新',
                'value' => self::EXTRACT,
            ],
        ];
    }

}
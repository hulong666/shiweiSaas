<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/2 16:50
 */


namespace app\common\enum;

/**
 * 智能管理枚举
 * Class IntelligentType
 * @package app\common\enum
 */
class IntelligentType extends EnumBasics
{
    // 智能门锁
    const LOCK = 10;

    // 智能电表
    const ELECTRIC = 20;

    // 智能水表
    const WATER = 30;

    /**
     * 获取枚举数据
     * @return array
     */
    public static function data()
    {
        return [
            self::LOCK => [
                'name' => '智能门锁',
                'value' => self::LOCK,
            ],
            self::ELECTRIC => [
                'name' => '智能电表',
                'value' => self::ELECTRIC,
            ],
            self::WATER => [
                'name' => '智能水表',
                'value' => self::WATER,
            ],
        ];
    }
}
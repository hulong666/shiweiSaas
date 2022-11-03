<?php

namespace app\common\enum;

/**
 * 租客在线缴费枚举类
 * Class PaymentType
 * @package app\common\enum
 */
class PaymentType extends EnumBasics
{
    // 支付账单
    const PAYMENT = 10;

    // 交欠款
    const ARREARS = 20;

    // 其他账单
    const OTHER = 30;

    // 交水电费
    const HYDROPOWER = 40;
    /**
     * 获取枚举数据
     * @return array
     */
    public static function data()
    {
        return [
            self::PAYMENT => [
                'name' => '支付账单',
                'value' => self::PAYMENT,
            ],
            self::ARREARS => [
                'name' => '上门自提',
                'value' => self::ARREARS,
            ],
            self::OTHER => [
                'name' => '其他账单',
                'value' => self::OTHER,
            ],
            self::HYDROPOWER => [
                'name' => '交水电费',
                'value' => self::HYDROPOWER,
            ],
        ];
    }

}
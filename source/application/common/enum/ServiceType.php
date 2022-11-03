<?php

namespace app\common\enum;

/**
 * 租客在线服务枚举类
 * Class ServiceType
 * @package app\common\enum
 */
class ServiceType extends EnumBasics
{
    // 我的维修
    const REPAIR = 10;

    // 我的投诉
    const COMPLAINT = 20;

    // 退房/转租
    const SUBLEASE = 30;

    // 代金券
    const COUPON = 40;

    // 我的管家
    const HOUSEKEEPER = 50;

    // WIFI密码
    const WIFI = 60;

    // 支付记录
    const PAYMENT = 70;

    // 我的租约
    const LEASE = 80;

    // 我的保洁
    const CLEANING = 90;

    // 评价管理
    const EVALUATE = 100;
    /**
     * 获取枚举数据
     * @return array
     */
    public static function data()
    {
        return [
            self::REPAIR => [
                'name' => '我的维修',
                'value' => self::REPAIR,
            ],
            self::COMPLAINT => [
                'name' => '我的投诉',
                'value' => self::COMPLAINT,
            ],
            self::SUBLEASE => [
                'name' => '退房/转租',
                'value' => self::SUBLEASE,
            ],
            self::COUPON => [
                'name' => '代金券',
                'value' => self::COUPON,
            ],
            self::HOUSEKEEPER => [
                'name' => '我的管家',
                'value' => self::HOUSEKEEPER,
            ],
            self::WIFI => [
                'name' => 'WIFI密码',
                'value' => self::WIFI,
            ],
            self::PAYMENT => [
                'name' => '支付记录',
                'value' => self::PAYMENT,
            ],
            self::LEASE => [
                'name' => '我的租约',
                'value' => self::LEASE,
            ],
            self::CLEANING => [
                'name' => '我的保洁',
                'value' => self::CLEANING,
            ],
            self::EVALUATE => [
                'name' => '评价管理',
                'value' => self::EVALUATE,
            ],
        ];
    }

}
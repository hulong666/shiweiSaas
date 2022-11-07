<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/7 13:20
 */


namespace app\common\enum;

/**
 * 租客信息枚举类
 * Class OpenType
 * @package app\common\enum
 */
class OpenType extends EnumBasics
{
    // 租客姓名
    const NAME = 10;

    // 租客电话
    const PHONE = 20;

    // 租客年龄
    const AGE = 30;

    // 电子合同
    const CONTRACT = 40;

    // 房屋租金
    const RENT = 50;

    // 租金账单
    const RENTBILL = 60;

    // 免租期账单
    const RENTFREE = 70;

    // 租客证件号
    const CERTIFICATE = 80;

    // 租客性别
    const SEX = 90;

    // 证件照片
    const PHOTO = 100;

    // 合同期限
    const TERM = 110;

    // 房屋押金
    const DEPOSIT = 120;

    // 缴费方式
    const WAY = 130;


    /**
     * 获取订单类型值
     * @return array
     */
    public static function data()
    {
        return [
            self::NAME => [
                'name' => '租客姓名',
                'value' => self::NAME,
            ],
            self::PHONE => [
                'name' => '租客电话',
                'value' => self::PHONE,
            ],
            self::AGE => [
                'name' => '租客年龄',
                'value' => self::AGE,
            ],
            self::CONTRACT => [
                'name' => '电子合同',
                'value' => self::CONTRACT,
            ],
            self::RENT => [
                'name' => '房屋租金',
                'value' => self::RENT,
            ],
            self::RENTBILL => [
                'name' => '租金账单',
                'value' => self::RENTBILL,
            ],
            self::RENTFREE => [
                'name' => '免租期账单',
                'value' => self::RENTFREE,
            ],
            self::CERTIFICATE => [
                'name' => '租客证件号',
                'value' => self::CERTIFICATE,
            ],
            self::SEX => [
                'name' => '租客性别',
                'value' => self::SEX,
            ],
            self::PHOTO => [
                'name' => '证件照片',
                'value' => self::PHOTO,
            ],
            self::TERM => [
                'name' => '合同期限',
                'value' => self::TERM,
            ],
            self::DEPOSIT => [
                'name' => '房屋押金',
                'value' => self::DEPOSIT,
            ],
            self::WAY => [
                'name' => '缴费方式',
                'value' => self::WAY,
            ],
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/3 9:50
 */


namespace app\common\enum;

/**
 * 房东首页菜单枚举
 * Class HomeType
 * @package app\common\enum
 */
class HomeType extends EnumBasics
{
    // 我的租客
    const TENANT = 10;

    // 装修后照片
    const COMPLAINT = 20;

    // 维修信息
    const RENOVATION = 30;

    // 提醒交租
    const RENT = 40;

    // 变更电话
    const PHONE = 50;

    // 我要续约
    const RENEWAL = 60;

    // 我要解约
    const TERMINATION = 70;

    // 我的管家
    const HOUSEKEEPER = 80;

    public static function data()
    {
        return [
            self::TENANT => [
                'name' => '我的租客',
                'value' => self::TENANT,
            ],
            self::COMPLAINT => [
                'name' => '装修后照片',
                'value' => self::COMPLAINT,
            ],
            self::RENOVATION => [
                'name' => '维修信息',
                'value' => self::RENOVATION,
            ],
            self::RENT => [
                'name' => '提醒交租',
                'value' => self::RENT,
            ],
            self::PHONE => [
                'name' => '变更电话',
                'value' => self::PHONE,
            ],
            self::RENEWAL => [
                'name' => '我要续约',
                'value' => self::RENEWAL,
            ],
            self::TERMINATION => [
                'name' => '我要解约',
                'value' => self::TERMINATION,
            ],
            self::HOUSEKEEPER => [
                'name' => '我的管家',
                'value' => self::HOUSEKEEPER,
            ],
        ];
    }
}
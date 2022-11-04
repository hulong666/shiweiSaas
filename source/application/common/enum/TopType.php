<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/2 17:48
 */


namespace app\common\enum;

/**
 * 房东顶部菜单枚举类型
 * Class TopType
 * @package app\common\enum
 */
class TopType extends EnumBasics
{
    // 我的合同
    const CONTRACT = 10;

    // 我的投诉
    const COMPLAINT = 20;

    // 我的账单
    const BILL = 30;

    // 我的欠款
    const ARREARS = 40;

    public static function data()
    {
        return [
            self::CONTRACT => [
                'name' => '我的合同',
                'value' => self::CONTRACT,
            ],
            self::COMPLAINT => [
                'name' => '我的投诉',
                'value' => self::COMPLAINT,
            ],
            self::BILL => [
                'name' => '我的账单',
                'value' => self::BILL,
            ],
            self::ARREARS => [
                'name' => '我的欠款',
                'value' => self::ARREARS,
            ],
        ];
    }
}
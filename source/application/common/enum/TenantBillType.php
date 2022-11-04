<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/4 15:48
 */


namespace app\common\enum;


class TenantBillType
{
    // 电子合同未签约，不能在线支付
    const CONTRACT = 10;

    public static function data()
    {
        return [
            self::CONTRACT => [
                'name' => '电子合同未签约，不能在线支付',
                'value' => self::CONTRACT,
            ],
        ];
    }
}
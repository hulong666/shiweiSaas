<?php

namespace app\common\enum;

/**
 * 商城设置枚举类
 * Class Setting
 * @package app\common\enum
 */
class Setting extends EnumBasics
{
    // 商城设置
    const STORE = 'store';

    // 交易设置
    const TRADE = 'trade';

    // 短信通知
    const SMS = 'sms';

    // 模板消息
    const TPL_MSG = 'tplMsg';

    // 上传设置
    const STORAGE = 'storage';

    // 小票打印
    const PRINTER = 'printer';

    // 满额包邮设置
    const FULL_FREE = 'full_free';

    // 充值设置
    const RECHARGE = 'recharge';

    // 积分设置
    const POINTS = 'points';

    // 租客设置
    const TENANT = 'tenant';

    //房东设置
    const LANDLORD = 'landlord';

    //在线找房设置
    const FINDROOM = 'find_room';

    //在线收款设置
    const COLLECTION = 'collection';

    //租客/房东微信登录设置
    const WXLOGIN = 'wx_login';

    //给房东开发租客信息设置
    const OPENING = 'opening';

    //租客账单催收设置
    const COLLECTORS = 'collectors';

    /**
     * 获取订单类型值
     * @return array
     */
    public static function data()
    {
        return [
            self::STORE => [
                'value' => self::STORE,
                'describe' => '商城设置',
            ],
            self::TRADE => [
                'value' => self::TRADE,
                'describe' => '交易设置',
            ],
            self::SMS => [
                'value' => self::SMS,
                'describe' => '短信通知',
            ],
            self::TPL_MSG => [
                'value' => self::TPL_MSG,
                'describe' => '模板消息',
            ],
            self::STORAGE => [
                'value' => self::STORAGE,
                'describe' => '上传设置',
            ],
            self::PRINTER => [
                'value' => self::PRINTER,
                'describe' => '小票打印',
            ],
            self::FULL_FREE => [
                'value' => self::FULL_FREE,
                'describe' => '满额包邮设置',
            ],
            self::RECHARGE => [
                'value' => self::RECHARGE,
                'describe' => '充值设置',
            ],
            self::POINTS => [
                'value' => self::POINTS,
                'describe' => '积分设置',
            ],
            self::TENANT => [
                'value' => self::TENANT,
                'describe' => '租客设置',
            ],
            self::LANDLORD => [
                'value' => self::LANDLORD,
                'describe' => '房东设置',
            ],
            self::FINDROOM => [
                'value' => self::FINDROOM,
                'describe' => '在线找房设置',
            ],
            self::COLLECTION => [
                'value' => self::COLLECTION,
                'describe' => '在线收款设置',
            ],
            self::WXLOGIN => [
                'value' => self::WXLOGIN,
                'describe' => '租客/房东微信登录设置',
            ],
            self::OPENING => [
                'value' => self::OPENING,
                'describe' => '给房东开发租客信息设置',
            ],
            self::COLLECTORS => [
                'value' => self::COLLECTORS,
                'describe' => '租客账单催收设置',
            ],
        ];
    }

}
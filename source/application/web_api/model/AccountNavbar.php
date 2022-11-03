<?php

namespace app\web_api\model;

use app\common\model\AccountNavbar as AccountNavbarModel;

/**
 * 微信小程序导航栏模型
 * Class AccountNavbar
 * @package app\web_api\model
 */
class AccountNavbar extends AccountNavbarModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'create_time',
        'update_time'
    ];

}

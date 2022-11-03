<?php

namespace app\web_api\model;

use app\common\model\Account as AccountModel;

/**
 * 微信小程序模型
 * Class Account
 * @package app\web_api\model
 */
class Account extends AccountModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'app_name',
        'app_id',
        'app_secret',
        'mchid',
        'apikey',
        'create_time',
        'update_time'
    ];

}

<?php

namespace app\web_api\model;

use app\common\model\AccountHelp as AccountHelpModel;

/**
 * 小程序帮助中心
 * Class AccountHelp
 * @package app\web_api\model
 */
class AccountHelp extends AccountHelpModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'create_time',
        'update_time',
    ];
}

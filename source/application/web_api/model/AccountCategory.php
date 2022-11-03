<?php

namespace app\web_api\model;

use app\common\model\AccountCategory as AccountCategoryModel;

/**
 * 微信小程序分类页模板
 * Class AccountCategory
 * @package app\web_api\model
 */
class AccountCategory extends AccountCategoryModel
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
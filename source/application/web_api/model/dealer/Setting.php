<?php

namespace app\web_api\model\dealer;

use app\common\model\dealer\Setting as SettingModel;

/**
 * 分销商设置模型
 * Class Setting
 * @package app\web_api\model\dealer
 */
class Setting extends SettingModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'update_time',
    ];

}
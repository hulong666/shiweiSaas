<?php

namespace app\web_api\model\sharing;

use app\common\model\sharing\Setting as SettingModel;

/**
 * 拼团设置模型
 * Class Setting
 * @package app\web_api\model\sharing
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
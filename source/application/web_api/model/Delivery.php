<?php

namespace app\web_api\model;

use app\common\model\Delivery as DeliveryModel;

/**
 * 配送模板模型
 * Class Delivery
 * @package app\web_api\model
 */
class Delivery extends DeliveryModel
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

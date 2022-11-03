<?php

namespace app\web_api\model;

use app\common\model\OrderAddress as OrderAddressModel;

/**
 * 订单收货地址模型
 * Class OrderAddress
 * @package app\web_api\model
 */
class OrderAddress extends OrderAddressModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'create_time',
    ];

}

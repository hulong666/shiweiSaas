<?php

namespace app\web_api\model;

use app\common\model\OrderRefundAddress as OrderRefundAddressModel;

/**
 * 售后单退货地址模型
 * Class OrderRefundAddress
 * @package app\web_api\model
 */
class OrderRefundAddress extends OrderRefundAddressModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'create_time'
    ];

}
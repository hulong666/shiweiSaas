<?php

namespace app\web_api\model;

use app\common\model\GoodsSku as GoodsSkuModel;

/**
 * 商品规格模型
 * Class GoodsSku
 * @package app\web_api\model
 */
class GoodsSku extends GoodsSkuModel
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

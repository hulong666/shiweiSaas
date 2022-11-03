<?php

namespace app\web_api\model\sharing;

use app\common\model\sharing\GoodsSku as GoodsSkuModel;

/**
 * 拼团商品规格模型
 * Class GoodsSku
 * @package app\web_api\model\sharing
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

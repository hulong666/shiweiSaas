<?php

namespace app\common\model\water;

use app\common\model\BaseModel;

/**
 * 水的品牌模型
 */
class GoodsBrand extends BaseModel
{
    protected $name = 'water_goods_brand';

    public static function getBrandNameFormId($id)
    {
        return self::get($id)['name'];
    }
}
<?php

namespace app\common\model\water;

use app\common\model\BaseModel;

/**
 * 送水订单模型
 */
class Order extends BaseModel
{
    protected $name = 'water_order';

    public function getPaymentTimeAttr($value)
    {
        if($value != 0){
            return date('Y-m-d H:i:s',$value);
        }
        return 0;
    }

    public function getDispatchTimeAttr($value)
    {
        if($value != 0){
            return date('Y-m-d H:i:s',$value);
        }
        return 0;
    }

    public static function detail($goodsId)
    {
        /* @var $model self */
        self::$isBase = false;
        $model = (new static)
            ->where('id', '=', $goodsId)
            ->find();
        // 整理商品数据并返回
        return $model;
    }
}
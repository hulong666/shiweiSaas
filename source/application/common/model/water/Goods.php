<?php

namespace app\common\model\water;

use app\common\model\BaseModel;

/**
 * 送水商品模型
 */
class Goods extends BaseModel
{
    protected $name = 'water_goods';

    /**
     * 关联图片
     * @return \think\model\relation\HasOne
     */
    public function image()
    {
        return $this->hasOne('uploadFile', 'file_id', 'img');
    }

    public function brandMes()
    {
        $module = self::getCalledModule() ?: 'common';
        return $this->hasOne("app\\{$module}\\model\\water\\GoodsBrand",'id', 'brand')->field('name,id');
    }

    /**
     * 获取商品详情
     * @param $goodsId
     * @return static
     */
    public static function detail($goodsId)
    {
        /* @var $model self */
        self::$isBase = false;
        $model = (new static)->with([
            'image','brand_mes'
        ])->where('id', '=', $goodsId)
            ->find();
        // 整理商品数据并返回
        return $model;
    }
}
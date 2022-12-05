<?php

namespace app\common\model;
use app\common\model\Region as RegionModel;

/**
 * 标签模型
 * Class Label
 * @package app\common\model\store
 */
class Label extends BaseModel
{
    protected $name = 'hs_label';


    /**
     * 详情
     * @param $shop_id
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail($id)
    {
        return static::get($id);
    }

}
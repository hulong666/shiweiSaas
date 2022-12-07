<?php

namespace app\common\model;

/**
 * 标签模型
 * Class Subway
 * @package app\common\model\store
 */
class Subway extends BaseModel
{
    protected $name = 'hs_subwaylist';


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
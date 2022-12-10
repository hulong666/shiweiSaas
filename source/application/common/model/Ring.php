<?php

namespace app\common\model;

/**
 * 环数模型
 */
class Ring extends BaseModel
{
    protected $name = 'hs_ring';
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
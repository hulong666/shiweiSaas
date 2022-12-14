<?php

namespace app\common\model;

/**
 * 轮播图模型
 */
class Carousel extends BaseModel
{
    /**
     * 关联图片
     * @return \think\model\relation\HasOne
     */
    public function image()
    {
        return $this->hasOne('uploadFile', 'file_id', 'img');
    }

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
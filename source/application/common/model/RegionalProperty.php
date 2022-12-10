<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/9 11:23
 */


namespace app\common\model;

/**
 * 区域&楼盘表模型
 * Class RegionalProperty
 * @package app\common\model
 */
class RegionalProperty extends BaseModel
{
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
<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/12/1 15:40
 */


namespace app\common\model;

/**
 * 商圈模型
 * Class HsArea
 * @package app\common\model
 */
class HsOffice extends BaseModel
{
    protected $name = 'hs_office';



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
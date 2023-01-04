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

    //租售状态
    protected $lease_status = ['空置','已租','已售'];

    /**
     * 关联楼盘表
     * @return \think\model\relation\HasOne
     */
    public function property()
    {
        return $this->hasOne('RegionalProperty','id','property_id');
    }

    /**
     * 租售状态获取器
     * @param $value
     * @return array
     */
    public function getLeaseStatusAttr($value)
    {
        return ['text'=>$this->lease_status[$value],'value'=>$value];
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
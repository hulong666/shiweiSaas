<?php

namespace app\common\model;

/**
 * 住宅模型
 */
class Residence extends BaseModel
{
    protected $name = 'hs_residence';

    /**
     * 关联图片表
     * @return \think\model\relation\HasMany
     */
    public function images()
    {
        return $this->hasMany('app\\common\\model\\ResidenceImg','residence_id','id');
    }

    /**
     * 详情
     * @param $id
     * @return array|bool|\PDOStatement|string|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function detail($id)
    {
        return static::with(['images'])->where('id',$id)->find();
    }

}
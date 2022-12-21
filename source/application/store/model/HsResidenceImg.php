<?php

namespace app\store\model;

use app\common\model\ResidenceImg;

/**
 * 住宅图片模型
 */
class HsResidenceImg extends ResidenceImg
{
    /**
     * 根据residence_id获取要删除的id集合
     * @param $residence_id
     * @return bool|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getIdsFormResidenceId($residence_id,$other)
    {
        $ids = self::where('residence_id','=',$residence_id)->column('residence_id','id');
        $cha = array_diff(array_keys($ids),$other);
        $ids = implode(',',$cha);
        return $ids;
    }

    /**
     * 根据id集合删除图片
     * @param $ids
     * @return false|int
     */
    public static function delFormIds($ids)
    {
        return self::whereIn('id',$ids)->delete();
    }
}
<?php

namespace app\common\model\admin\role;

use app\common\model\BaseModel;

/**
 * 角色模型
 * 总后台管理商家账号
 * Class Role
 * @package app\common\model\admin
 */
class Role extends BaseModel
{
    protected $name = 'store_role';

    /**
     * 角色信息
     * @param $where
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function detail($where)
    {
        return self::get($where);
    }

}
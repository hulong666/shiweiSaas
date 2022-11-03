<?php

namespace app\common\model;

/**
 * 微信小程序分类页模板
 * Class AccountCategory
 * @package app\common\model
 */
class AccountCategory extends BaseModel
{
    protected $name = 'account_category';

    /**
     * 分类模板详情
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail()
    {
        return self::get([]);
    }

}
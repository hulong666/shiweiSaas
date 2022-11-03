<?php

namespace app\store\model;

use app\common\model\AccountCategory as AccountCategoryModel;

/**
 * 微信小程序分类页模板
 * Class AccountCategory
 * @package app\store\model
 */
class AccountCategory extends AccountCategoryModel
{
    /**
     * 编辑记录
     * @param $data
     * @return bool|int
     */
    public function edit($data)
    {
        return $this->allowField(true)->save($data) !== false;
    }

}
<?php

namespace app\store\model;

use app\common\model\AccountNavbar as AccountNavbarModel;

/**
 * 微信小程序导航栏模型
 * Class AccountNavbar
 * @package app\common\model
 */
class AccountNavbar extends AccountNavbarModel
{
    /**
     * 更新页面数据
     * @param $data
     * @return bool
     */
    public function edit($data)
    {
        // 删除wxapp缓存
        Account::deleteCache();
        return $this->save($data) !== false;
    }

}

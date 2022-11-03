<?php

namespace app\store\model;

use app\common\model\AccountHelp as AccountHelpModel;

/**
 * 小程序帮助中心
 * Class AccountHelp
 * @package app\store\model
 */
class AccountHelp extends AccountHelpModel
{
    /**
     * 新增记录
     * @param $data
     * @return false|int
     */
    public function add($data)
    {
        $data['wxapp_id'] = self::$wxapp_id;
        return $this->allowField(true)->save($data);
    }

    /**
     * 更新记录
     * @param $data
     * @return bool|int
     */
    public function edit($data)
    {
        return $this->allowField(true)->save($data) !== false;
    }

    /**
     * 删除记录
     * @return int
     */
    public function remove() {
        return $this->delete();
    }

}

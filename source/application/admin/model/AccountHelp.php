<?php

namespace app\admin\model;

use app\common\model\AccountHelp as AccountHelpModel;

/**
 * 公众号帮助中心
 * Class AccountHelp
 * @package app\admin\model
 */
class AccountHelp extends AccountHelpModel
{
    /**
     * 新增默认帮助
     * @param $wxapp_id
     * @return false|int
     */
    public function insertDefault($wxapp_id)
    {
        return $this->save([
            'title' => '关于公众号',
            'content' => '公众号本身无需下载，无需注册，不占用手机内存，可以跨平台使用，响应迅速，体验接近原生APP。',
            'sort' => 100,
            'wxapp_id' => $wxapp_id
        ]);
    }

}

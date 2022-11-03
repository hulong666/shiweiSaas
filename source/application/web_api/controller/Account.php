<?php

namespace app\web_api\controller;

use app\web_api\model\AccountHelp;

/**
 * 微信小程序
 * Class Account
 * @package app\web_api\controller
 */
class Account extends Controller
{
    /**
     * 小程序基础信息
     * @return array
     */
    public function base()
    {
//        $wxapp = WxappModel::getWxappCache();
        return $this->renderSuccess([]);
    }

    /**
     * 帮助中心
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function help()
    {
        $model = new AccountHelp;
        $list = $model->getList();
        return $this->renderSuccess(compact('list'));
    }

}

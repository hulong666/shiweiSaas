<?php

namespace app\store\controller\setting;

use app\store\model\Account as AccountModel;
use app\store\model\AccountNavbar as AccountNavbarModel;

use app\store\controller\Controller;
/**
 * 小程序管理
 * Class Account
 * @package app\store\controller
 */
class Account extends Controller
{
    /**
     * 小程序设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function setting()
    {
        // 当前小程序信息
        $model = AccountModel::detail();
        if (!$this->request->isAjax()) {
            return $this->fetch('setting', compact('model'));
        }
        // 更新小程序设置
        if ($model->edit($this->postData('wxapp'))) {
            return $this->renderSuccess('更新成功');
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 导航栏设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function tabbar()
    {
        $model = AccountNavbarModel::detail();
        if (!$this->request->isAjax()) {
            return $this->fetch('tabbar', compact('model'));
        }
        $data = $this->postData('tabbar');
        if (!$model->edit($data)) {
            return $this->renderError('更新失败');
        }
        return $this->renderSuccess('更新成功');
    }

}

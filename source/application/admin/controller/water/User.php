<?php

namespace app\admin\controller\water;

use app\admin\controller\Controller;
use app\admin\model\water\User as WUser;

/**
 * 送水用户控制器
 */
class User extends Controller
{
    /**
     * 用户列表
     * @return mixed
     */
    public function userList()
    {
        $model = new WUser;
        return $this->fetch('index', [
            'list' => $model->getList(),
        ]);
    }

    public function recovery($water_user_id)
    {
        // 小程序详情
        $model = WUser::detail($water_user_id);
        if (!$model->recycle()) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }

    public function add()
    {
        $model = new WUser;
        if (!$this->request->isAjax()) {
            return $this->fetch('add');
        }
        if ($model->add($this->request->post())) {
            return $this->renderSuccess('添加成功', url('water.user/userList'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }
}
<?php

namespace app\admin\controller;

use app\admin\model\Wxapp as WxappModel;
use app\admin\model\store\User as StoreUser;
use app\admin\model\admin\role\Role as RoleModel;
use app\admin\model\admin\role\Access as AccessModel;

/**
 * 角色管理
 * 新增商城时商家账号角色
 * Class Store
 * @package app\admin\controller
 */
class Role extends Controller
{
    /**
     * 角色列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $rm = new RoleModel();
        return $this->fetch('index', [
            'list' => $list = $rm->getList(),
        ]);
    }

    /**
     * 添加角色
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function add()
    {
        $model = new RoleModel;
        if (!$this->request->isAjax()) {
            // 权限列表
            $accessList = (new AccessModel)->getJsTree();
            // 角色列表
            $roleList = $model->getList();
            return $this->fetch('add', compact('accessList', 'roleList'));
        }
        // 新增记录
        if ($model->add($this->postData('role'))) {
            return $this->renderSuccess('添加成功', url('role/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 修改角色
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function edit($role_id)
    {
        // 角色详情
        $model = RoleModel::detail($role_id);
        if (!$this->request->isAjax()) {
            // 权限列表
            $accessList = (new AccessModel)->getJsTree($model['role_id']);
            // 角色列表
            $roleList = $model->getList();
            return $this->fetch('edit', compact('model', 'accessList', 'roleList'));
        }
        // 更新记录
        if ($model->edit($this->postData('role'))) {
            return $this->renderSuccess('更新成功', url('role/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除角色
     * @param $wxapp_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delete($role_id)
    {
        // 角色详情
        $model = RoleModel::detail($role_id);
        if (!$model->remove()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

}
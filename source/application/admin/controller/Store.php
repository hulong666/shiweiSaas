<?php

namespace app\admin\controller;

use app\admin\model\admin\role\Access as AccessModel;
use app\admin\model\Wxapp as WxappModel;
use app\admin\model\admin\role\User as StoreUser;
use app\admin\model\admin\role\Role as RoleModel;
use app\admin\model\admin\role\UserRole;
use app\admin\model\store\User as StoreUserModel;

/**
 * 小程序商城管理
 * Class Store
 * @package app\admin\controller
 */
class Store extends Controller
{
    /**
     * 小程序列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new WxappModel;
//        $list = $model->getList();
//        var_dump((new StoreUserModel)->getStoreInfo($list));die;
        return $this->fetch('index', [
            'list' => $list = $model->getList(),
            'names' => $model->getStoreName($list),
            'info' => (new StoreUserModel)->getStoreInfo($list),
            'user_id' => (new StoreUser)->getUid($list),
        ]);
    }

    /**
     * 进入商城
     * @param $wxapp_id
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function enter($wxapp_id)
    {
        $model = new StoreUserModel;
        $model->login($wxapp_id);
        $this->redirect('store/index/index');
    }

    /**
     * 回收站列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function recycle()
    {
        $model = new WxappModel;
        return $this->fetch('recycle', [
            'list' => $list = $model->getList(true),
            'names' => $model->getStoreName($list)
        ]);
    }

    /**
     * 添加小程序
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function add()
    {
        $model = new WxappModel;
        if (!$this->request->isAjax()) {
            $roleList = (new RoleModel)->getList();
            return $this->fetch('add', compact('roleList'));
        }
        // 新增记录
        $data = [
            'store'=>$this->postData('store'),
            'role_id'=>$this->postData('user'),
        ];
        if ($model->add($data)) {
            return $this->renderSuccess('添加成功', url('store/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 编辑小程序
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function edit()
    {
        $model = new WxappModel;
        if (!$this->request->isAjax()) {
            $roleList = (new RoleModel)->getList();
            return $this->fetch('edit', compact('roleList'));
        }
        // 新增记录
        $data = [
            'store'=>$this->postData('store'),
            'role_id'=>$this->postData('user'),
        ];
        if ($model->edit($data)) {
            return $this->renderSuccess('添加成功', url('store/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 回收小程序
     * @param $wxapp_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function recovery($wxapp_id)
    {
        // 小程序详情
        $model = WxappModel::detail($wxapp_id);
        if (!$model->recycle()) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }

    /**
     * 移出回收站
     * @param $wxapp_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function move($wxapp_id)
    {
        // 小程序详情
        $model = WxappModel::detail($wxapp_id);
        if (!$model->recycle(false)) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }

    /**
     * 删除小程序
     * @param $wxapp_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delete($wxapp_id)
    {
        // 小程序详情
        $model = WxappModel::detail($wxapp_id);
        if (!$model->setDelete()) {
            return $this->renderError('操作失败');
        }
        return $this->renderSuccess('操作成功');
    }

    /**
     * 商城角色列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function storeIndex($wxapp_id)
    {
        $rm = new RoleModel();
        $model = new WxappModel;
        return $this->fetch('storeIndex', [
            'list' => $list = $rm->getStoreList($wxapp_id),
            'name' => $model->getStoreName($list)[$wxapp_id],
            'wxapp_id' => $wxapp_id,
        ]);
    }

    /**
     * 添加角色
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function storeAdd($wxapp_id)
    {
        $model = new RoleModel;
        if (!$this->request->isAjax()) {
            // 权限列表
            $accessList = (new AccessModel)->getJsTree();
            // 角色列表
            $roleList = $model->getStoreList($wxapp_id);
            return $this->fetch('storeAdd', compact('accessList', 'roleList'));
        }
        // 新增记录
        if ($model->add($this->postData('role'),$wxapp_id,1)) {
            return $this->renderSuccess('添加成功', url('store/storeindex',['wxapp_id'=>$wxapp_id]));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 修改角色
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function storeEdit($role_id,$wxapp_id)
    {
        // 角色详情
        $model = RoleModel::detail($role_id);
        if (!$this->request->isAjax()) {
            // 权限列表
            $accessList = (new AccessModel)->getJsTree($model['role_id']);
            // 角色列表
            $roleList = $model->getStoreList($wxapp_id);
            return $this->fetch('storeEdit', compact('model', 'accessList', 'roleList'));
        }
        // 更新记录
        if ($model->edit($this->postData('role'),$wxapp_id)) {
            return $this->renderSuccess('更新成功', url('store/storeIndex',['wxapp_id'=>$wxapp_id]));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除角色
     * @param $wxapp_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function storeDelete($role_id)
    {
        // 角色详情
        $model = RoleModel::detail($role_id);
        if (!$model->remove()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

    /**
     * 管理员权限编辑
     * @param $user_id
     * @param $wxapp_id
     * @return array
     * @throws \think\exception\DbException
     */
    public function storeStaff($user_id,$wxapp_id)
    {
        // 管理员详情
        $model = StoreUser::detail($user_id);
        $model['roleIds'] = UserRole::getRoleIds($model['store_user_id']);
        if (!$this->request->isAjax()) {
            return $this->fetch('storeStaff', [
                'model' => $model,
                // 角色列表
                'roleList' => (new RoleModel)->getStoreList($wxapp_id),
                // 所有角色id
                'roleIds' => UserRole::getRoleIds($model['store_user_id']),
            ]);
        }
        // 更新记录
        if ($model->edit($this->postData('user'),$wxapp_id)) {
            return $this->renderSuccess('更新成功', url('store/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }
}
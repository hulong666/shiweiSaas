<?php

namespace app\store\controller\dictionaries\required;

use app\store\controller\Controller;
use app\store\model\Ring as RingModel;

/**
 * 环数控制器
 */
class Ring extends Controller
{
    /**
     * 环数列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new RingModel();
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    /**
     * 新增
     * @return array|bool|mixed
     */
    public function add()
    {
        $model = new RingModel;
        if (!$this->request->isAjax()) {
            return $this->fetch('add');
        }
        // 新增记录
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('dictionaries.required.ring/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 编辑
     * @param $id
     * @return array|bool|mixed
     * @throws \think\exception\DbException
     */
    public function edit($id)
    {
        // 标签详情
        $model = RingModel::detail($id);
        if (!$this->request->isAjax()) {
            return $this->fetch('edit', compact('model'));
        }
        // 新增记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('dictionaries.required.ring/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除
     * @param $id
     * @return array|bool
     * @throws \think\exception\DbException
     */
    public function delete($id)
    {
        // 标签详情
        $model = RingModel::detail($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
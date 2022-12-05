<?php


namespace app\store\controller\dictionaries\required;

use app\store\controller\Controller;
use app\store\model\Label as LabelModel;

/**
 * 标签管理
 * Class Label
 * @package app\store\controller\store
 */
class Label extends Controller
{
    /**
     * 标签列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new LabelModel;
        $list = $model->getList($this->request->param());
        return $this->fetch('index', compact('list'));
    }
    

    /**
     * 添加标签
     * @return array|bool|mixed
     * @throws \Exception
     */
    public function add()
    {
        $model = new LabelModel;
        if (!$this->request->isAjax()) {
            return $this->fetch('add');
        }
        // 新增记录
        if ($model->add($this->postData('label'))) {
            return $this->renderSuccess('添加成功', url('dictionaries.required.label/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 编辑标签
     * @param $id
     * @return array|bool|mixed
     * @throws \think\exception\DbException
     */
    public function edit($id)
    {
        // 标签详情
        $model = LabelModel::detail($id);
        if (!$this->request->isAjax()) {
            return $this->fetch('edit', compact('model'));
        }
        // 新增记录
        if ($model->edit($this->postData('label'))) {
            return $this->renderSuccess('更新成功', url('dictionaries.required.label/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除标签
     * @param $id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delete($id)
    {
        // 标签详情
        $model = LabelModel::detail($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

}
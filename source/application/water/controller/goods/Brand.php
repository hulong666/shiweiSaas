<?php

namespace app\water\controller\goods;

use app\water\controller\Controller;
use app\water\model\goods\GoodsBrand as GB;

/**
 * 商品品牌控制器
 */
class Brand extends Controller
{
    /**
     * 商品分类列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new GB;
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    public function add()
    {
        $model = new GB;
        if (!$this->request->isAjax()) {
            // 获取所有地区
            return $this->fetch('add');
        }
        // 新增记录
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('goods.brand/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    public function edit($id)
    {
        // 模板详情
        GB::$isBase = false;
        $model = GB::get($id);
        if (!$this->request->isAjax()) {
            return $this->fetch('edit', compact('model'));
        }
        // 更新记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('goods.brand/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    public function delete($id)
    {
        GB::$isBase = false;
        $model = GB::get($id);
        if (!$model->remove($id)) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

}
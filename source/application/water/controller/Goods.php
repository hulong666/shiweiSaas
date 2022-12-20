<?php

namespace app\water\controller;
use app\water\model\Goods as GoodsModel;
use app\water\model\goods\GoodsBrand;

/**
 * 商品控制器
 */
class Goods extends Controller
{
    /**
     * 商品列表(出售中)
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        // 获取全部商品列表
        $model = new GoodsModel;
        $list = $model->getList(array_merge(['status' => -1], $this->request->param()));
        return $this->fetch('index', compact('list'));
    }

    /**
     * 添加商品
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function add()
    {
        if (!$this->request->isAjax()) {
            $brandList = GoodsBrand::getAll();
            return $this->fetch('add', compact('brandList'));
        }
        $model = new GoodsModel;
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('goods/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 一键复制
     * @param $goods_id
     * @return array|mixed
     * @throws \think\exception\PDOException
     */
    public function copy($goods_id)
    {
        // 商品详情
        $model = GoodsModel::detail($goods_id);
        if (!$this->request->isAjax()) {
            $brandList = GoodsBrand::getAll();
            return $this->fetch(
                'edit',compact('model','brandList')
            );
        }
        $model = new GoodsModel;
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('goods/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 商品编辑
     * @param $goods_id
     * @return array|bool|mixed
     */
    public function edit($id)
    {
        // 商品详情
        $model = GoodsModel::detail($id);
        if (!$this->request->isAjax()) {
            $brandList = GoodsBrand::getAll();
            return $this->fetch(
                'edit',compact('model','brandList')
            );
        }
        // 更新记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('goods/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除商品
     * @param $goods_id
     * @return array
     */
    public function delete($goods_id)
    {
        // 商品详情
        $model = GoodsModel::detail($goods_id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
<?php

namespace app\store\controller\houses;

use app\store\controller\Controller;
use app\store\model\HsResidence;
use app\store\model\Label;
use app\store\model\RegionalProperty;

/**
 * 住宅控制器
 */
class Residence extends Controller
{
    protected $configure = ['电视机','冰箱','空调','洗衣机','天然气','热水器','网络','床','衣柜','桌椅','沙发','暖气'];
    /**
     * 列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new HsResidence();
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    /**
     * 添加写字楼
     * @return array|bool|mixed
     * @throws \Exception
     */
    public function add()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $model = new HsResidence;
        if (!$this->request->isAjax()) {
            $loupan = (new RegionalProperty)->select();
            $configure = $this->configure;
            $label = (new Label())->where(['type'=>2,'is_delete'=>0])->select();
            return $this->fetch('add',compact('loupan','configure','label'));
        }
        // 新增记录
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('houses.residence/index'));
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
        // 详情
        $model = HsResidence::detail($id);
        if (!$this->request->isAjax()) {
            $loupan = (new RegionalProperty)->select();
            $label = (new Label())->where(['type'=>2,'is_delete'=>0])->select();

            $configure = $this->configure;
            $model['configuration'] = explode(',',$model['configuration']);
            $model['house_type'] = explode(',',$model['house_type']);
            $model['label'] = explode(',',$model['label']);
            return $this->fetch(
                'edit',compact('model','loupan','configure','label')
            );
        }
        // 更新记录
        $model = HsResidence::get($id);
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('houses.residence/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 修改上下架状态
     * @return array|bool
     * @throws \think\exception\DbException
     */
    public function frame()
    {
        $data = $this->postData();
        // 标签详情
        $model = HsResidence::get($data['id']);
        if ($model->frame($data)) {
            return $this->renderSuccess('更新成功', url('houses.residence/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除
     * @param $id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delete($id)
    {
        // 标签详情
        $model = HsResidence::get($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
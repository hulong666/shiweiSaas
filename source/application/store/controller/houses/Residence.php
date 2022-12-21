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
    public function index()
    {
        $model = new HsResidence();
        $list = $model->getList();
//        $list = $list->toArray();
//        var_dump(empty($list['data'][1]['images']));
//        halt($list);
        return $this->fetch('index', compact('list'));
    }

    /**
     * 编辑
     * @param $id
     * @return array|bool|mixed
     * @throws \think\exception\DbException
     */
    public function edit($id)
    {
        // 商品详情
        $model = HsResidence::detail($id);
        if (!$this->request->isAjax()) {
            $loupan = (new RegionalProperty)->select();
            $label = (new Label())->where(['type'=>2,'is_delete'=>0])->select();

            $configure = ['电视机','冰箱','空调','洗衣机','天然气','热水器','网络','床','衣柜','桌椅','沙发','暖气'];
            $model['configure'] = explode(',',$model['configure']);
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
        $model = HsResidence::detail($data['id']);
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
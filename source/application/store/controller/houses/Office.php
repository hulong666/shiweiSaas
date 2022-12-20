<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/12/1 15:27
 */


namespace app\store\controller\houses;


use app\common\model\Region;
use app\store\controller\Controller;
use app\store\model\HsOffice;
use app\store\model\RegionalProperty;

/**
 * 写字楼控制器
 * Class Trading
 * @package app\store\controller\resources
 */
class Office extends Controller
{
    /**
     * 写字楼列表
     * @return mixed
     */
    public function index()
    {
        $model = new HsOffice();
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
        $model = new HsOffice;
        if (!$this->request->isAjax()) {
            $loupan = (new RegionalProperty)->select();
            return $this->fetch('add',compact('loupan'));
        }
        // 新增记录
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('houses.office/index'));
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
        $model = HsOffice::detail($id);
        if (!$this->request->isAjax()) {
            $loupan = (new RegionalProperty)->select();
            return $this->fetch('edit', compact('model','loupan'));
        }
        // 新增记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('houses.office/index'));
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
        $model = HsOffice::detail($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

    /**
     * 获取省市区
     * @return array
     */
    public function getRegionData()
    {
        $id = $this->request->param('id');
        $data = Region::getChildren($id);
        return $this->renderSuccess('获取成功','',$data);
    }
}
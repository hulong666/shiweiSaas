<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/12/1 15:27
 */


namespace app\store\controller\dictionaries\required;


use app\common\model\Region;
use app\store\controller\Controller;
use app\store\model\HsArea;

/**
 * 商圈控制器
 * Class Trading
 * @package app\store\controller\resources
 */
class Trading extends Controller
{
    /**
     * 商圈列表
     * @return mixed
     */
    public function index()
    {
        $model = new HsArea();
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    /**
     * 添加商圈
     * @return array|bool|mixed
     * @throws \Exception
     */
    public function add()
    {
        $model = new HsArea;
        if (!$this->request->isAjax()) {
            $province = Region::getCacheType('province');
            $city = [];
            $regin = [];
            return $this->fetch('add',compact('province','city','regin'));
        }
        // 新增记录
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('dictionaries.required.trading/index'));
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
        $model = HsArea::detail($id);
        if (!$this->request->isAjax()) {
            $province = Region::getCacheType('province');
            $city = Region::getChildren($model['province_id']);
            $regin = Region::getChildren($model['city_id']);
            return $this->fetch('edit', compact('model','province','city','regin'));
        }
        // 新增记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('dictionaries.required.trading/index'));
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
        $model = HsArea::detail($id);
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
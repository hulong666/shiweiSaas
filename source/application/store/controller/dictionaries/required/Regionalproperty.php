<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/9 10:32
 */


namespace app\store\controller\dictionaries\required;


use app\common\model\Region;
use app\store\controller\Controller;
use app\store\model\RegionalProperty as RegionalPropertyModel;

/**
 * 区域+楼盘地址控制器
 * Class Regionalproperty
 * @package app\store\controller\dictionaries\required
 */
class Regionalproperty extends Controller
{
    /**
     * 区域楼盘列表
     * @param int $city
     * @param int $region
     * @param null $property_address
     */
    public function index($city = -1 ,$region = -1 ,$property_address = null)
    {
        $model = new RegionalPropertyModel();
        $list = $model->getList($city, $region, $property_address);
        $cityList = $model->getCityList();
        $regionList = $model->getRegionList();
        return $this->fetch('index', compact('list', 'cityList','regionList'));
    }

    /**
     * 新增
     * @return array|bool|mixed
     */
    public function add()
    {
        $model = new RegionalPropertyModel;
        if (!$this->request->isAjax()) {
            $city = Region::getCacheType('city');
            $regin = [];
            return $this->fetch('add',compact('city','regin'));
        }
        // 新增记录
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('dictionaries.required.regionalproperty/index'));
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
        $model = RegionalPropertyModel::detail($id);
        if (!$this->request->isAjax()) {
            $city = Region::getCacheType('city');
            $regin = Region::getChildren($model['city']['id']);
            return $this->fetch('edit', compact('model','city','regin'));
        }
        // 新增记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('dictionaries.required.regionalproperty/index'));
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
        $model = RegionalPropertyModel::detail($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }
}
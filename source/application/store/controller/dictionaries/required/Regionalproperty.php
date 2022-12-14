<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/9 10:32
 */


namespace app\store\controller\dictionaries\required;


use app\common\model\Region;
use app\store\controller\Controller;
use app\store\model\HsArea;
use app\store\model\Ring;
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
    public function index($province = -1 ,$city = -1 ,$region = -1 ,$address = null)
    {
        $model = new RegionalPropertyModel();
        $list = $model->getList($province, $city, $region, $address);
//        var_dump($list->toArray());die;
        $provinceList = $model->getProvinceList();
        $cityList = $model->getCityList();
        $regionList = $model->getRegionList();
        return $this->fetch('index', compact('list', 'provinceList', 'cityList','regionList'));
    }

    /**
     * 新增
     * @return array|bool|mixed
     */
    public function add()
    {
        $model = new RegionalPropertyModel;
        if (!$this->request->isAjax()) {
            $area = HsArea::getAllList();
            $ring = Ring::getAllList();
            $subway = (new \app\store\model\Subway())->getAllList();
            return $this->fetch('add',compact('area', 'ring', 'subway'));
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
            $area = HsArea::getAllList();
            $ring = Ring::getAllList();
            $subway = (new \app\store\model\Subway())->getAllList();
            return $this->fetch('edit', compact('model','area', 'ring', 'subway'));
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

    /**
     * 获取省市区下的商圈
     * @return array
     */
    public function getAreaData()
    {
        $pid = $this->request->param('pid');
        $cid = $this->request->param('cid');
        $rid = $this->request->param('rid');
        $data = HsArea::getAllList($pid, $cid, $rid);
        return $this->renderSuccess('获取成功','',$data);
    }
}
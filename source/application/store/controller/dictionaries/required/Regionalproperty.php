<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/9 10:32
 */


namespace app\store\controller\dictionaries\required;


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
}
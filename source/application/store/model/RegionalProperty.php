<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/9 11:26
 */


namespace app\store\model;

use app\common\model\RegionalProperty as RegionalPropertyModel;

/**
 * 区域&楼盘表模型
 * Class RegionalProperty
 * @package app\store\model
 */
class RegionalProperty extends RegionalPropertyModel
{
    /**
     * 物业地址获取器
     * @param $value
     * @return array
     */
    public function getPropertyAddressAttr($value)
    {
        return ['text'=>$value,'value'=>explode(',',$value)];
    }

    /**
     * 城市获取器
     * @param $value
     * @return array
     */
    public function getCityAttr($value)
    {
        return ['id'=>$value,'name'=>Region::getNameById($value)];
    }

    /**
     * 区域获取器
     * @param $value
     * @return array
     */
    public function getRegionAttr($value)
    {
        return ['id'=>$value,'name'=>Region::getNameById($value)];
    }
    /**
     * 获取区域楼盘列表
     * @param int $city
     * @param int $region
     * @param string $address
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($city,$region,$address)
    {
        $city > 0 && $this->where('city', '=', (int)$city);
        $region > 0 && $this->where('region', '=', (int)$region);
        !empty($address) && $this->where('property_address','like','%'.$address.'%');
        return $this
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 获取城市选择列表
     * @return array
     */
    public function getCityList()
    {
        $cityIds = $this->column('*','city');
        $cityIds = array_keys($cityIds);
        foreach ($cityIds as &$cityId) {
            $cityId = [
                'city' => $cityId,
                'name' => Region::getNameById($cityId),
            ];
        }
        return $cityIds;
    }

    /**
     * 获取区域选择列表
     * @return array
     */
    public function getRegionList()
    {
        $cityIds = $this->column('*','region');
        $cityIds = array_keys($cityIds);
        foreach ($cityIds as &$cityId) {
            $cityId = [
                'region' => $cityId,
                'name' => Region::getNameById($cityId),
            ];
        }
        return $cityIds;
    }
}
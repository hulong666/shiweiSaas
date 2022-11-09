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
}
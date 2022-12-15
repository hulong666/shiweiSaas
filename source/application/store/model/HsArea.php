<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/12/1 15:50
 */


namespace app\store\model;

use app\common\model\HsArea as HsAreaModel;

/**
 * 商圈模型
 * Class HsArea
 * @package app\store\model
 */
class HsArea extends HsAreaModel
{
    public function getRegionAttr($value, $data)
    {
        return [
            'province' => Region::getNameById($data['province_id']),
            'city' => Region::getNameById($data['city_id']),
            'region' => Region::getNameById($data['region_id']),
        ];
    }
    /**
     * 获取列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList()
    {
        return $this
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ])
            ->append(['region']);
    }

    /**
     * 获取所有商圈列表
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getAllList($province = null, $city = null, $region = null)
    {
        !empty($province) && (new self)->where('province_id', '=', $province);
        !empty($city) && (new self)->where('city_id', '=', $city);
        !empty($region) && (new self)->where('region_id', '=', $region);
        return (new self)->order(['create_time' => 'desc'])
            ->select();
    }

    /**
     * 新增商圈
     * @param $data
     * @return false|int
     */
    public function add($data)
    {
        $data['wxapp_id'] = self::$wxapp_id;
        return $this->save($data);
    }

    /**
     * 编辑商圈
     * @param $data
     * @return HsArea
     */
    public function edit($data)
    {
        return $this->update($data,['id'=>$data['id']]);
    }

    public function setDelete()
    {
        return $this->delete();
    }
}
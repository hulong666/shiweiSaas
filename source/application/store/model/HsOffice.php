<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/12/1 15:50
 */


namespace app\store\model;

use app\common\model\HsOffice as HsOfficeModel;
use app\common\model\UploadFile;

/**
 * 写字楼模型
 * Class HsOffice
 * @package app\store\model
 */
class HsOffice extends HsOfficeModel
{
    //图片获取器
    public function getHousePicAttr($value)
    {
        if($value == ''){
            return [];
        }
        $ids = explode(',',$value);
        $images = [];
        foreach ($ids as $id) {
            $images[] = UploadFile::detail($id)['file_path'];
        }
        return $images;
    }

    /**
     * 获取列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList()
    {
        return $this
            ->with(['property'])
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 获取所有写字楼列表
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
     * 新增写字楼
     * @param $data
     * @return false|int
     */
    public function add($data)
    {
        $data['wxapp_id'] = self::$wxapp_id;
        $data['house_pic'] = implode(',', $data['house_pic']);
        $data['unoccupied_time'] = date('Y-m-d H:i:s');
        return $this->save($data);
    }

    /**
     * 编辑写字楼
     * @param $data
     * @return HsOffice
     */
    public function edit($data)
    {
        $data['house_pic'] = implode(',', $data['house_pic']);
        return $this->update($data,['id'=>$data['id']]);
    }

    public function setDelete()
    {
        return $this->delete();
    }
}
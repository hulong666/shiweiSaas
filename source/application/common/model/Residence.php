<?php

namespace app\common\model;

use think\Request;

/**
 * 住宅模型
 */
class Residence extends BaseModel
{
    protected $name = 'hs_residence';

    /**
     * 关联图片表
     * @return \think\model\relation\HasMany
     */
    public function images()
    {
        return $this->hasMany('app\\common\\model\\ResidenceImg','residence_id','id');
    }

    public function getHousePicAttr($value)
    {
        if($value == ''){
            return [];
        }
        $ids = explode(',',$value);
        $data = [];
        foreach ($ids as $id) {
            $res = \app\store\model\UploadFile::detail($id)->toArray();
            $data[] = [
                'file_id' => $res['file_id'],
                'file_path' => $res['file_path'],
            ];
        }
        return $data;
    }

    public function getHouseIconAttr($value)
    {
        if($value == ''){
            return '';
        }
        $res = \app\store\model\UploadFile::detail($value)->toArray()['file_path'];
        return $res;
    }

    public function getHouseVedioAttr($value)
    {
        if($value == ''){
            return '';
        }
        $model = Request::instance();

        $res = $model->domain() . '/uploads/' . $value;
        return $res;
    }

    /**
     * 详情
     * @param $id
     * @return array|bool|\PDOStatement|string|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function detail($id)
    {
        return self::with(['images'])->where('id',$id)->find()->toArray();
    }

}
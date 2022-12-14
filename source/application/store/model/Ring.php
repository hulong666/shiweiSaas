<?php

namespace app\store\model;
use app\common\model\Ring as RingModel;

/**
 * 环数模型
 */
class Ring extends RingModel
{
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
            ]);
    }
    /**
     * 获取所有列表
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getAllList()
    {
        return (new self)->order(['create_time' => 'desc'])
            ->select();
    }

    /**
     * 新增环数
     * @param $data
     * @return false|int
     */
    public function add($data)
    {
        $data['wxapp_id'] = self::$wxapp_id;
        return $this->save($data);
    }

    /**
     * 编辑环数
     * @param $data
     * @return Ring
     */
    public function edit($data)
    {
        return $this->update($data,['id'=>$data['id']]);
    }

    /**
     * 删除环数
     * @return false|int
     */
    public function setDelete()
    {
        return $this->delete();
    }
}
<?php

namespace app\store\model;

use app\common\model\Label as LabelModel;

/**
 * 标签模型
 * Class Label
 * @package app\store\model\store
 */
class Label extends LabelModel
{
    /**
     * 获取列表数据
     * @param null $status
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($query = [])
    {
        isset($query['type']) && $this->where('type', '=', (int)$query['type']);
        return $this->where('is_delete', '=', '0')
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 获取所有标签列表
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getAllList()
    {
        return (new self)->where('is_delete', '=', '0')
            ->order(['create_time' => 'desc'])
            ->select();
    }

    /**
     * 新增记录
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function add($data)
    {
        if (!$this->validateForm($data)) {
            return false;
        }
        return $this->allowField(true)->save($this->createData($data));
    }

    /**
     * 编辑记录
     * @param $data
     * @return false|int
     */
    public function edit($data)
    {
        if (!$this->validateForm($data)) {
            return false;
        }
        return $this->allowField(true)->save($this->createData($data)) !== false;
    }

    /**
     * 软删除
     * @return false|int
     */
    public function setDelete()
    {
        return $this->save(['is_delete' => 1]);
    }

    /**
     * 创建数据
     * @param array $data
     * @return array
     */
    private function createData($data)
    {
        $data['wxapp_id'] = self::$wxapp_id;
        return $data;
    }

    /**
     * 表单验证
     * @param $data
     * @return bool
     */
    private function validateForm($data)
    {
        if (!isset($data['labelname']) || empty($data['labelname'])) {
            $this->error = '请填写标签名称';
            return false;
        }
        return true;
    }

}
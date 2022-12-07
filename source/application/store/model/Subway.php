<?php

namespace app\store\model;

use app\common\model\Subway as SubwayModel;

/**
 * 地铁模型
 * Class Subway
 * @package app\store\model\store
 */
class Subway extends SubwayModel
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
        return $this->where('type', '=', '1')
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 获取地铁站点列表数据
     * @param null $status
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getSiteList($fid)
    {
        !empty($fid) && $this->where('fid', '=', (int)$fid);
        return $this->where('type', '=', '2')
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
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
     * 删除
     * @return false|int
     */
    public function setDelete()
    {
        return $this->delete();
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
        if (!isset($data['subwayname']) || empty($data['subwayname'])) {
            $this->error = '请填写标签名称';
            return false;
        }
        return true;
    }

}
<?php

namespace app\water\model;
use app\common\model\water\Goods as WGoods;

/**
 * 商品模型
 */
class Goods extends WGoods
{
    /**
     * 获取商品列表
     * @param $param
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function getList($param)
    {
        // 商品列表获取条件
        $params = array_merge([
            'search' => '',         // 搜索关键词
            'listRows' => 15,       // 每页数量
        ], $param);
        // 筛选条件
        $filter = [];
        !empty($params['search']) && $filter['name'] = ['like', '%' . trim($params['search']) . '%'];
        // 执行查询
        self::$isBase = false;
        $list = $this
            ->with(['image','brandMes'])
            ->field(['*'])
            ->where($filter)
            ->where('is_delete',0)
            ->order('id desc')
            ->paginate($params['listRows'], false, [
                'query' => \request()->request()
            ]);
        // 整理列表数据并返回
        return $list;
    }

    /**
     * 获取分类下有多少商品
     * @param $where
     * @return int|string
     * @throws \think\Exception
     */
    public function getGoodsTotal($where = [])
    {
        return $this->where($where)->count();
    }

    /**
     * 商品编辑
     * @param $data
     * @return false|mixed
     */
    public function edit($data)
    {
        if (!isset($data['img']) || empty($data['img'])) {
            $this->error = '请上传商品图片';
            return false;
        }
        $data['water_id'] = self::$water_id;
        return $this->transaction(function () use ($data) {
            // 保存商品
            $this->allowField(true)->save($data);
            return true;
        });
    }

    public function add(array $data)
    {
        if (!isset($data['img']) || empty($data['img'])) {
            $this->error = '请上传商品图片';
            return false;
        }
        $data['water_id'] = self::$water_id;

        // 开启事务
        $this->startTrans();
        try {
            // 添加商品
            $this->allowField(true)->save($data);
            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->rollback();
            return false;
        }
    }

    public function setDelete()
    {
        return $this->allowField(true)->save(['is_delete' => 1]);
    }
}
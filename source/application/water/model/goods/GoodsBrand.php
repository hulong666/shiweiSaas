<?php

namespace app\water\model\goods;
use app\common\model\water\GoodsBrand as GB;
use app\water\model\Goods;

class GoodsBrand extends GB
{
    /**
     * 获取品牌列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList()
    {
        self::$isBase = false;
        $list = $this
            ->field(['*'])
            ->order('id desc')
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
        // 整理列表数据并返回
        return $list;
    }

    public function add($data)
    {
        $data['water_id'] = self::$water_id;
        return $this->allowField(true)->save($data);
    }

    public function edit($data)
    {
        return $this->allowField(true)->save($data) !== false;
    }

    public function remove($categoryId)
    {
        // 判断是否存在商品
        self::$isBase = false;
        if ($goodsCount = (new Goods())->getGoodsTotal(['brand' => $categoryId,'is_delete'=>0])) {
            $this->error = '该分类下存在' . $goodsCount . '个商品，不允许删除';
            return false;
        }
        return $this->delete();
    }

    /**
     * 获取所有品牌列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getAll()
    {
        self::$isBase = false;
        $list = self::field(['*'])
            ->order('id desc')
            ->select()->toArray();
        // 整理列表数据并返回
        return $list;
    }
}
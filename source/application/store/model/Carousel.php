<?php

namespace app\store\model;
use app\common\model\Carousel as CarouselModel;

/**
 * 轮播图模型
 */
class Carousel extends CarouselModel
{
    public function getList()
    {
        return $this
            ->with(['image'])
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 新增
     * @param $data
     * @return false|int
     */
    public function add($data)
    {
        $data['wxapp_id'] = self::$wxapp_id;
        return $this->save($data);
    }

    /**
     * 编辑
     * @param $data
     * @return HsArea
     */
    public function edit($data)
    {
        return $this->update($data,['id'=>$data['id']]);
    }

    /**
     * 删除
     * @return false|int
     */
    public function setDelete()
    {
        return $this->delete();
    }
}
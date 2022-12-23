<?php

namespace app\store\model;

use app\common\model\Residence;
use think\Session;

/**
 * 住宅模型
 */
class HsResidence extends Residence
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
     * 新增住宅
     * @param $data
     * @return false|int
     */
    public function add($data)
    {
        $data['wxapp_id'] = self::$wxapp_id;
        $data['house_icon'] = isset($data['house_pic'][0]) ? $data['house_pic'][0] : '';
        $data['house_pic'] = implode(',', $data['house_pic']);
        $data['house_type'] = $data['room'].','.$data['hall'].','.$data['toilet'];
        $data['name'] = trim($data['name']);
        unset($data['room']);
        unset($data['hall']);
        unset($data['toilet']);
        return $this->save($data);
    }

    /**
     * 住宅编辑
     * @param $data
     * @return false|mixed
     */
    public function edit($data)
    {
        return $this->transaction(function () use ($data) {
//            $images = $data['images'];
//            unset($data['images']);
//            //获取删除图片的id集合
//            $delIDs = HsResidenceImg::getIdsFormResidenceId($data['id'],$images);
//            //删除图片
//            HsResidenceImg::delFormIds($delIDs);
            // 保存商品
            $data['house_pic'] = implode(',', $data['house_pic']);
            $this->allowField(true)->save($data);
            return true;
        });
    }

    /**
     * 更新上下架状态
     * @param $data
     * @return void
     */
    public function frame($data)
    {
        $session = Session::get('yoshop_store');
        $data['down_user'] = $session['user']['store_user_id'];
        $data['downtime'] = time();
        if($this->save($data)){
            return true;
        }
        return false;
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
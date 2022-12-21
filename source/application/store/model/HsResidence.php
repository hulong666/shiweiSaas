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
            ->with(['images'])
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 商品编辑
     * @param $data
     * @return false|mixed
     */
    public function edit($data)
    {
        return $this->transaction(function () use ($data) {
            $images = $data['images'];
            unset($data['images']);
            //获取删除图片的id集合
            $delIDs = HsResidenceImg::getIdsFormResidenceId($data['id'],$images);
            //删除图片
            HsResidenceImg::delFormIds($delIDs);
            // 保存商品
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
        $data['status_user'] = $session['user']['store_user_id'];
        $data['status_time'] = date('Y-m-d H:i:s');
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
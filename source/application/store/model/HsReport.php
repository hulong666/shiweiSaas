<?php

namespace app\store\model;

use app\common\model\Report;
use think\Session;

/**
 * 举报模型
 */
class HsReport extends Report
{
    /**
     * 获取列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList()
    {
        return $this
            ->with(['user'])
            ->order(['state' => 'asc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 更新上下架状态
     * @param $data
     * @return void
     */
    public function edit($data)
    {
        $session = Session::get('yoshop_store');
        $data['handle_user'] = $session['user']['store_user_id'];
        $data['handle_time'] = date('Y-m-d H:i:s');
        $data['state'] = 1;
        if($this->save($data)){
            return true;
        }
        return false;
    }
}
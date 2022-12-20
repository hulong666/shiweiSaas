<?php

namespace app\admin\model\water;
use app\common\model\water\Order as WOrder;

/**
 * 送水订单模型
 */
class Order extends WOrder
{
    public function waterUser()
    {
        return $this->hasOne('User','water_user_id','water_id');
    }

    public function goods()
    {
        return $this->hasOne('Goods','id','gid');
    }

    public function getList()
    {
        return $this
            ->with(['water_user','goods'])
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => request()->request()
            ]);
    }
}
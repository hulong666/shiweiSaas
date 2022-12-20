<?php

namespace app\admin\controller\water;

use app\admin\controller\Controller;
use app\admin\model\water\Order as WOrder;

/**
 * 订单控制器
 */
class Order extends Controller
{
    public function index()
    {
        $model = new WOrder;
        return $this->fetch('index', [
            'list' => $model->getList(),
        ]);
    }
}
<?php

namespace app\water\controller;
use app\water\model\Order as OrderModel;

/**
 * 订单控制器
 */
class Order extends Controller
{
    /**
     * 全部订单列表
     * @return mixed
     */
    public function all_list()
    {
        return $this->getList('全部订单列表', 'all');
    }

    /**
     * 待付款订单列表
     * @return mixed
     */
    public function pay_list()
    {
        return $this->getList('待付款订单列表', 'pay');
    }

    /**
     * 待发货订单列表
     * @return mixed
     */
    public function delivery_list()
    {
        return $this->getList('待发货订单列表', 'delivery');
    }

    /**
     * 待收货订单列表
     * @return mixed
     */
    public function receipt_list()
    {
        return $this->getList('待收货订单列表', 'receipt');
    }

    /**
     * 已完成订单列表
     * @return mixed
     */
    public function complete_list()
    {
        return $this->getList('已完成订单列表', 'complete');
    }

    public function edit($id)
    {
        // 商品详情
        $model = new OrderModel;
        if ($model->edit($id)) {
            return $this->renderSuccess('更新成功', url('order/all_list'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    private function getList($title, $dataType)
    {
        // 订单列表
        $model = new OrderModel;
        $list = $model->getList($dataType, $this->request->param());
        return $this->fetch('index', compact('title', 'dataType', 'list'));
    }
}
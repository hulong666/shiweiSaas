<?php

namespace app\web_api\controller\recharge;

use app\web_api\controller\Controller;
use app\web_api\model\recharge\Order as OrderModel;

/**
 * 充值记录
 * Class Order
 * @package app\web_api\controller\user\balance
 */
class Order extends Controller
{
    /**
     * 我的充值记录列表
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function lists()
    {
        $user = $this->getUser();
        $list = (new OrderModel)->getList($user['user_id']);
        return $this->renderSuccess(compact('list'));
    }

}
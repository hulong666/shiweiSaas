<?php

namespace app\web_api\controller\user\dealer;

use app\web_api\controller\Controller;
use app\web_api\model\dealer\Setting;
use app\web_api\model\dealer\User as DealerUserModel;
use app\web_api\model\dealer\Order as OrderModel;

/**
 * 分销商订单
 * Class Order
 * @package app\web_api\controller\user\dealer
 */
class Order extends Controller
{
    /* @var \app\web_api\model\User $user */
    private $user;

    private $dealer;
    private $setting;

    /**
     * 构造方法
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        parent::_initialize();
        // 用户信息
        $this->user = $this->getUser();
        // 分销商用户信息
        $this->dealer = DealerUserModel::detail($this->user['user_id']);
        // 分销商设置
        $this->setting = Setting::getAll();
    }

    /**
     * 分销商订单列表
     * @param int $settled
     * @return array
     * @throws \think\exception\DbException
     */
    public function lists($settled = -1)
    {
        $model = new OrderModel;
        return $this->renderSuccess([
            // 提现明细列表
            'list' => $model->getList($this->user['user_id'], (int)$settled),
            // 页面文字
            'words' => $this->setting['words']['values'],
        ]);
    }

}
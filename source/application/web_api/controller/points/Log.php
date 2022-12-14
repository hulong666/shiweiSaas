<?php

namespace app\web_api\controller\points;

use app\web_api\controller\Controller;
use app\web_api\model\user\PointsLog as PointsLogModel;

/**
 * 余额账单明细
 * Class Log
 * @package app\web_api\controller\balance
 */
class Log extends Controller
{
    /**
     * 积分明细列表
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $user = $this->getUser();
        $list = (new PointsLogModel)->getList($user['user_id']);
        return $this->renderSuccess(compact('list'));
    }

}
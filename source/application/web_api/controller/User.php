<?php

namespace app\web_api\controller;

use app\common\library\wechat\WxBase;
use app\web_api\model\User as UserModel;

/**
 * 用户管理
 * Class User
 * @package app\api
 */
class User extends Controller
{
    /**
     * 公众号登录
     * 用户自动登录
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $model = new UserModel;
        $get = $this->request->get();
        //没有code 获取网页授权地址
        if (!isset($get['code'])) {
            return $this->renderSuccess([
                'url' => $model->login($get, $this->wxapp_id),
            ]);
        }
        //有code 通过code换取网页授权access_token
        if (isset($get['code'])) {
            $model->login($get, $this->wxapp_id);
//            return $this->renderSuccess([
//                'user_id' => $model->login($get,$this->wxapp_id),
//                'token' => $model->getToken()
//            ]);
        }
    }

    /**
     * 当前用户详情
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function detail()
    {
        // 当前用户信息
        $userInfo = $this->getUser();
        return $this->renderSuccess(compact('userInfo'));
    }

    /**
     * 获取公众号配置信息：appId，timestamp，nonceStr，signature
     * @throws \app\common\exception\BaseException
     */
    public function getWxConfig()
    {
        $model = new UserModel;
        return $this->renderSuccess([
            'WxConfig' => $model->getWxConfig(),
        ]);
    }
}

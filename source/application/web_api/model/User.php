<?php

namespace app\web_api\model;

use app\common\library\wechat\WxBase;
use app\common\library\wechat\WxOauth;
use think\Cache;
use app\common\library\wechat\WxUser;
use app\common\exception\BaseException;
use app\common\model\User as UserModel;
use app\web_api\model\dealer\Referee as RefereeModel;
use app\web_api\model\dealer\Setting as DealerSettingModel;

/**
 * 用户模型类
 * Class User
 * @package app\web_api\model
 */
class User extends UserModel
{
    private $token;

    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'open_id',
        'is_delete',
        'wxapp_id',
        'create_time',
        'update_time'
    ];

    /**
     * 获取用户信息
     * @param $token
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function getUser($token)
    {
        $openId = Cache::get($token)['openid'];
        return self::detail(['open_id' => $openId], ['address', 'addressDefault', 'grade']);
    }

    /**
     * 公众号登录
     * 用户登录
     * @param array $get
     * @return string
     * @throws BaseException
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function login($get,$wxapp_id)
    {
        // 获取当前公众号信息
        $wxConfig = Account::getWxappCache();
        // 验证appid和appsecret是否填写
        if (empty($wxConfig['app_id']) || empty($wxConfig['app_secret'])) {
            throw new BaseException(['msg' => '请到 [后台-公众号设置] 填写appid 和 appsecret']);
        }
        $WxOauth = new WxOauth($wxConfig['app_id'],$wxConfig['app_secret']);
        //没有code 获取网页授权地址 referee_id推荐人id
        if(!isset($get['code'])){
            if(!$url = $WxOauth->getCodeUrl('http://cs.18my.net/index.php?s=/web_api/user/login&wxapp_id='.$wxapp_id,isset($get['referee_id'])?$get['referee_id']:0)){
                throw new BaseException(['msg' => $WxOauth->getError()]);
            }
            return $url;
        }

        //有code 通过code换取网页授权access_token
        if(isset($get['code'])){
            if(!$access_token = $WxOauth->getWebToken($get['code'])){
                throw new BaseException(['msg' => $WxOauth->getError()]);
            }
        }
        //获取用户信息
        if(!$user_info = $WxOauth->getUserInfo($access_token['openid'],$access_token['access_token'])){
            throw new BaseException(['msg' => $WxOauth->getError()]);
        }

        // 自动注册用户
        $refereeId = isset($get['state']) ? $get['state'] : null;
        $user_id = $this->register($user_info['openid'], $user_info, $refereeId);

        // 生成token (session3rd)
        $this->token = $this->token($user_info['openid']);
        // 记录缓存, 7天
        Cache::set($this->token, $user_info, 86400 * 7);

        //重定向发送给前端
        $url = 'http://cs.18my.net/dist/index.html#/login?token='.$this->token.'&user_id='.$user_id;
        header('Location: '.$url, true);
        exit();
    }

    /**
     * 获取token
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * 微信登录
     * @param $code
     * @return array|mixed
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    private function wxlogin($code)
    {
        // 获取当前公众号信息
        $wxConfig = Account::getWxappCache();
        // 验证appid和appsecret是否填写
        if (empty($wxConfig['app_id']) || empty($wxConfig['app_secret'])) {
            throw new BaseException(['msg' => '请到 [后台-公众号设置] 填写appid 和 appsecret']);
        }
        // 微信登录 (获取session_key)
        $WxUser = new WxUser($wxConfig['app_id'], $wxConfig['app_secret']);
        if (!$session = $WxUser->sessionKey($code)) {
            throw new BaseException(['msg' => $WxUser->getError()]);
        }
        return $session;
    }

    /**
     * 生成用户认证的token
     * @param $openid
     * @return string
     */
    private function token($openid)
    {
        $wxapp_id = self::$wxapp_id;
        // 生成一个不会重复的随机字符串
        $guid = \getGuidV4();
        // 当前时间戳 (精确到毫秒)
        $timeStamp = microtime(true);
        // 自定义一个盐
        $salt = 'token_salt';
        return md5("{$wxapp_id}_{$timeStamp}_{$openid}_{$guid}_{$salt}");
    }

    /**
     * 自动注册用户
     * @param $open_id
     * @param $data
     * @param int $refereeId
     * @return mixed
     * @throws \Exception
     * @throws \think\exception\DbException
     */
    private function register($open_id, $data, $refereeId = null)
    {
        // 查询用户是否已存在
        $user = self::detail(['open_id' => $open_id]);
        $model = $user ?: $this;
        $data['nickName'] = $data['nickname'];
        $data['avatarUrl'] = $data['headimgurl'];
        $data['gender'] = $data['sex'];
        $this->startTrans();
        try {
            // 保存/更新用户记录
            if (!$model->allowField(true)->save(array_merge($data, [
                'open_id' => $open_id,
                'wxapp_id' => self::$wxapp_id
            ]))) {
                throw new BaseException(['msg' => '用户注册失败']);
            }
            // 记录推荐人关系
            if (!$user && $refereeId > 0) {
                RefereeModel::createRelation($model['user_id'], $refereeId);
            }
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw new BaseException(['msg' => $e->getMessage()]);
        }
        return $model['user_id'];
    }

    /**
     * 个人中心菜单列表
     * @return array
     */
    public function getMenus()
    {
        $menus = [
            'address' => [
                'name' => '收货地址',
                'url' => '/addressList',
                'icon' => 'location-o'
            ],
            'coupon' => [
                'name' => '领券中心',
                'url' => '/couponList',
                'icon' => 'gift-o'
            ],
            'my_coupon' => [
                'name' => '我的优惠券',
                'url' => '/myCoupon',
                'icon' => 'coupon-o'
            ],
            'sharing_order' => [
                'name' => '拼团订单',
                'url' => '/shareOrder',
                'icon' => 'friends-o'
            ],
            'my_bargain' => [
                'name' => '我的砍价',
                'url' => 'pages/bargain/index/index?tab=1',
                'icon' => 'flag-o'
            ],
            'dealer' => [
                'name' => '分销中心',
                'url' => '/dealerIndex',
                'icon' => 'share-o'
            ],
            'help' => [
                'name' => '我的帮助',
                'url' => '/appHelp',
                'icon' => 'question-o'
            ],
        ];
        // 判断分销功能是否开启
        if (DealerSettingModel::isOpen()) {
            $menus['dealer']['name'] = DealerSettingModel::getDealerTitle();
        } else {
            unset($menus['dealer']);
        }
        return $menus;
    }

    /**
     * 获取微信jssdk使用配置信息
     * @return Account|array|mixed|null
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    public function getWxConfig()
    {
        // 获取当前公众号信息
        $wxConfig = Account::getWxappCache();
        // 验证appid和appsecret是否填写
        if (empty($wxConfig['app_id']) || empty($wxConfig['app_secret'])) {
            throw new BaseException(['msg' => '请到 [后台-公众号设置] 填写appid 和 appsecret']);
        }
        $model = new WxBase($wxConfig['app_id'],$wxConfig['app_secret']);
        //签名用的 url 必须是调用 JS 接口页面的完整URL
        return $model->getWxConfig('http://cs.18my.net/dist/index.html');
    }
}

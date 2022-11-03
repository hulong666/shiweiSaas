<?php
namespace app\common\library\wechat;

/**
 * 公众号登录
 * 使用：
 * 1.创建WxOauth类，初始化赋值appId，appSecret
 * 2.获取引导页地址，传给前端，引导用户同意授权。
 * 3.用户授权后会重定向到设置的回调地址。此时获取到code了。
 * 4.通过code换取网页授权access_token。
 * 5.通过网页授权access_token拉取用户信息。
 * Class WxOauth
 * @package app\common\library\wechat
 * @author zhangshuai 2022-07-13
 */
class WxOauth extends WxBase
{
//    private $appId = "";          // 微信公众号应用appId
//    private $appSecret = "";      // 微信公众号appSecret
    const GET_WEB_CODE = 'https://open.weixin.qq.com/connect/oauth2/authorize';  // 获取code(网页授权使用)
    const GET_WEB_TOKEN_URL = 'https://api.weixin.qq.com/sns/oauth2/access_token'; // 通过code获取网页授权access_token地址
    const GET_USER_INFO_URL = 'https://api.weixin.qq.com/sns/userinfo'; // 通过网页授权access_token拉取用户信息(需 scope 为 snsapi_userinfo)

    const GET_JC_TOKEN_URL = 'https://api.weixin.qq.com/cgi-bin/token'; // 获取基础应用access_token地址
    const GET_REFRESH_URL = 'https://api.weixin.qq.com/sns/oauth2/refresh_token'; //刷新网页授权access_token
    const GET_JsapiTicket_URL = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket'; // 判断token是否失效

    /**
     * 公众号登录入口
     * @param $code
     */
    public function wxLogin($code){

    }

    /**
     * 初始化
     * WxOauth constructor.
     * @param $appId
     * @param $appSecret
     */
//    public function __construct($appId = null, $appSecret = null)
//    {
//        parent::__construct();
//        $this->setConfig($appId, $appSecret);
//    }

    /**
     * 获取引导页地址
     * 引导用户同意授权获取code
     * @param  string $redirect_uri 授权后重定向的回调链接地址，需要urlEncode处理
     * @param  string $state 自定义参数最多128字节 - 重定向后会带上
     * @return string 引导授权网页url
     */
    public function getCodeUrl($redirect_uri,$state='STATE'){
        if(empty($redirect_uri)){
            $this->error = '重定向的回调地址未填写';
            return false;
        }
        $uri = $this->combineURL(self::GET_WEB_CODE, [
            'appId'         => $this->appId,
            'scope'         => 'snsapi_userinfo',
            'response_type' => 'code',
            'redirect_uri'  => urlEncode($redirect_uri),
            'state'         => $state.'#wechat_redirect'
        ]);
        return $uri;
    }

    /**
     * 获取网页授权access_token和openid
     * @param string $code 客户端传回的code
     * @return array
     */
    public function getWebToken($code){
        $get_token_url = $this->combineURL(self::GET_WEB_TOKEN_URL, [
            'appId'      => $this->appId,
            'secret'     => $this->appSecret,
            'code'       => $code,
            'grant_type' => 'authorization_code'
        ]);
        $token_info = json_decode($this->httpsRequest($get_token_url),true);
        if(isset($token_info['errcode'])){
            $this->error = $token_info['errmsg'];
            return false;
        }
        return $token_info;
    }

    /**
     * 获取用户信息
     * @param  string $openid       用户的标识
     * @param  string $access_token 调用接口凭证
     * @return array 用户信息
     */
    public function getUserInfo($openid, $access_token){
        $get_userinfo_url = $this->combineURL(self::GET_USER_INFO_URL, [
            'openid'          => $openid,
            'access_token'  => $access_token,
            'lang'             => 'zh_CN'
        ]);
        $user_info = json_decode($this->httpsRequest($get_userinfo_url),true);
        if(isset($user_info['errcode'])){
            $this->error = $user_info['errmsg'];
            return false;
        }
        return $user_info;
    }






    
    /**
     * 刷新网页授权access token并续期
     * @param  string $refresh_token 用户刷新access_token
     * @return array
     */
    public function refreshToken($refresh_token,$openid){
        $refresh_token_url = $this->combineURL(self::GET_REFRESH_URL, [
            'appId'         => $this->appId,
            'refresh_token' => $refresh_token,
            'grant_type'    => 'refresh_token'
        ]);
        $refresh_info = $this->httpsRequest($refresh_token_url);
        return $refresh_info;
//        $refresh_info = json_decode($refresh_info, true);
//        //获取jsapi_ticket
//        $ticket = $this->getJsapiTicket($refresh_info['access_token']);
//        //更新token
//        $uModel = new Users();
//        $data = ['access_token'=>$refresh_info['access_token'],'ticket'=>$ticket];
//        $uModel->where('openid','=',$openid)->update($data);
//        return $data;
    }

    /**
     * 获取基础应用token
     * @param  string $openid 用户刷新access_token
     * @return array
     */
    public function getBasicsAccessToken($openid){
        $refresh_token_url = $this->combineURL(self::GET_JC_TOKEN_URL, [
            'grant_type' => 'client_credential',
            'appId' => $this->appId,
            'secret' => $this->appSecret,
        ]);
        $token_info = $this->httpsRequest($refresh_token_url);
        $token_info = json_decode($token_info, true);
        if(isset($token_info['access_token'])){
            //获取jsapi_ticket
//            $ticket = $this->getJsapiTicket($token_info['access_token']);
            //更新token
//            $uModel = new Users();
//            $data = ['access_token'=>$token_info['access_token'],'ticket'=>$ticket,'token_end'=>date('Y-m-d H:i:s',time() + 7200)];
//            $uModel->where('openid','=',$openid)->update($data);
//            return $data;
        }
        return SKReturn($token_info['errmsg'],-1);
    }

    /**
     * 判断token过期以及是否有ticket
     * @param string $res  用户信息
     * @return mixed
     */
    public function checkToken($res)
    {
        $now = date('Y-m-d H:i:s');
        //token过期或不存在 或ticket不存在
        if($res['access_token'] == '' || $res['ticket'] == '' || $now > $res['token_end']){
            return $this->getAccessToken($res['openid']);
        }
        return $res;
    }

    /**
     * 拼接url
     * @param string $baseURL   请求的url
     * @param array  $keysArr   参数列表数组
     * @return string           返回拼接的url
     */
    public function combineURL($baseURL, $keysArr){
        $combined = $baseURL . "?";
        $valueArr = array();
        foreach($keysArr as $key => $val){
            $valueArr[] = "$key=$val";
        }
        $keyStr = implode("&", $valueArr);
        $combined .= ($keyStr);
        return $combined;
    }
    /**
     * 获取服务器数据
     * @param string $url  请求的url
     * @return  unknown    请求返回的内容
     */
    public function httpsRequest($url) {
        $curl = curl_init();
        $headerArray = [
            "Content-type:application/json;charset='utf-8'",
            "Accept:application/json",
            "User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36",
        ];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headerArray);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}
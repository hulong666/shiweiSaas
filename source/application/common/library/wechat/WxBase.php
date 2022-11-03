<?php

namespace app\common\library\wechat;

use think\Cache;
use app\common\exception\BaseException;

/**
 * 微信api基类
 * Class wechat
 * @package app\library
 */
class WxBase
{
    protected $appId;
    protected $appSecret;

    protected $error;

    /**
     * 构造函数
     * WxBase constructor.
     * @param $appId
     * @param $appSecret
     */
    public function __construct($appId = null, $appSecret = null)
    {
        $this->setConfig($appId, $appSecret);
    }

    protected function setConfig($appId = null, $appSecret = null)
    {
        !empty($appId) && $this->appId = $appId;
        !empty($appSecret) && $this->appSecret = $appSecret;
    }

    /**
     * 写入日志记录
     * @param $values
     * @return bool|int
     */
    protected function doLogs($values)
    {
        return log_write($values);
    }

    /**
     * 获取access_token
     * @return mixed
     * @throws BaseException
     */
    protected function getAccessToken()
    {
        $cacheKey = $this->appId . '@access_token';
        if (!Cache::get($cacheKey)) {
            // 请求API获取 access_token
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appId}&secret={$this->appSecret}";
            $result = $this->get($url);
            $data = $this->jsonDecode($result);
            if (array_key_exists('errcode', $data)) {
                throw new BaseException(['msg' => "access_token获取失败，错误信息：{$result}"]);
            }
            // 记录日志
            $this->doLogs([
                'describe' => '获取access_token',
                'url' => $url,
                'appId' => $this->appId,
                'result' => $result
            ]);
            // 写入缓存
            Cache::set($cacheKey, $data['access_token'], 6000);    // 7000
        }
        return Cache::get($cacheKey);
    }

    /**
     * 获取js_api_ticket
     * @return mixed
     * @throws BaseException
     */
    public function getJsApiTicket()
    {
        $token = $this->getAccessToken();
        $cacheKey = $this->appId . '@js_api_ticket';
        if (!Cache::get($cacheKey)) {
            // 请求API获取 js_api_ticket
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$token}&type=jsapi";
            $result = $this->get($url);
            $data = $this->jsonDecode($result);
            if($data['errcode'] != 0 || $data['errmsg'] != 'ok'){
                throw new BaseException(['msg' => "js_api_ticket获取失败，错误信息：{$result}"]);
            }
            // 记录日志
            $this->doLogs([
                'describe' => '获取js_api_ticket',
                'url' => $url,
                'appId' => $this->appId,
                'result' => $result
            ]);
            // 写入缓存
            Cache::set($cacheKey, $data['ticket'], 6000);    // 7000
        }
        return Cache::get($cacheKey);
    }

    /**
     * url:https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html#59
     * 微信JSSDK使用步骤
     * 通过 config 接口注入权限验证配置
     * 获取微信配置信息的签名
     * @param $url
     * @return string
     */
    public function getWxConfig($url)
    {
        $wxConfig = [
            'appid' => $this->appId,
            'timestamp' => time() + 1,
            'nonceStr' => getRandStr(32),
            'signature' => '',
            'jsApiList' => [],
        ];

        //微信配置签名
        $signature = 'jsapi_ticket=' . $this->getJsApiTicket() . '&noncestr=' . $wxConfig['nonceStr'] . '&timestamp=' . $wxConfig['timestamp'] . '&url=' . $url;
        $wxConfig['signature'] = sha1($signature);

        return $wxConfig;
    }

    /**
     * 模拟GET请求 HTTPS的页面
     * @param string $url 请求地址
     * @return string $result
     */
    protected function get($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    /**
     * 模拟POST请求
     * @param $url
     * @param array $data
     * @param bool $useCert
     * @param array $sslCert
     * @return mixed
     */
    protected function post($url, $data = [], $useCert = false, $sslCert = [])
    {
        $header = [
            'Content-type: application/json;'
        ];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        if ($useCert == true) {
            // 设置证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($curl, CURLOPT_SSLCERT, $sslCert['certPem']);
            curl_setopt($curl, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($curl, CURLOPT_SSLKEY, $sslCert['keyPem']);
        }
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    /**
     * 数组转json
     * @param $data
     * @return string
     */
    protected function jsonEncode($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * json转数组
     * @param $json
     * @return mixed
     */
    protected function jsonDecode($json)
    {
        return json_decode($json, true);
    }

    /**
     * 返回错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

}

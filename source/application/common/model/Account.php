<?php

namespace app\common\model;

use app\common\exception\BaseException;
use think\Cache;
use think\Db;

/**
 * 微信公众号模型
 * Class Account
 * @package app\common\model
 */
class Account extends BaseModel
{
    protected $name = 'account';

    /**
     * 公众号导航
     * @return \think\model\relation\HasOne
     */
    public function navbar()
    {
        return $this->hasOne('AccountNavbar');
    }

    /**
     * 公众号页面
     * @return \think\model\relation\HasOne
     */
    public function diyPage()
    {
        return $this->hasOne('AccountPage');
    }

    /**
     * 获取公众号信息
     * @param null $wxapp_id
     * @return static|null
     * @throws \think\exception\DbException
     */
    public static function detail($wxapp_id = null)
    {
        $a = self::get($wxapp_id ?: []);
        return self::get($wxapp_id ?: []);
    }

    /**
     * 从缓存中获取公众号信息
     * @param null $wxapp_id
     * @return mixed|null|static
     * @throws BaseException
     * @throws \think\exception\DbException
     */
    public static function getWxappCache($wxapp_id = null)
    {
        if (is_null($wxapp_id)) {
            $self = new static();
            $wxapp_id = $self::$wxapp_id;
        }
        if (!$data = Cache::get('account_' . $wxapp_id)) {
            $data = self::detail($wxapp_id);
            if (empty($data)) throw new BaseException(['msg' => '未找到当前公众号信息']);
            Cache::tag('cache')->set('account_' . $wxapp_id, $data);
        }
        return $data;
    }

}

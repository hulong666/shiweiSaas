<?php

namespace app\admin\model\store;

use app\common\model\store\User as StoreUserModel;

/**
 * 商家用户模型
 * Class StoreUser
 * @package app\admin\model
 */
class User extends StoreUserModel
{
    /**
     * 新增商家用户记录
     * @param $wxapp_id
     * @param $data
     * @return bool|false|int
     */
    public function add($wxapp_id, $data)
    {
        if (self::checkExist($data['user_name'])) {
            $this->error = '用户名已存在';
            return false;
        }
        return $this->save([
            'user_name' => $data['user_name'],
            'password' => yoshop_hash($data['password']),
            'wxapp_id' => $wxapp_id,
        ]);
    }

    /**
     * 商家用户登录
     * @param $wxapp_id
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function login($wxapp_id)
    {
        // 验证用户名密码是否正确
        $user = self::detail(['wxapp_id' => $wxapp_id], ['wxapp']);
        $this->loginState($user);
    }


    /**
     * 从缓存中获取商城名称
     * @param $data
     * @return array
     */
    public function getStoreInfo($data)
    {
        $infos = [];
        foreach ($data as $wxapp) {
            $infos[$wxapp['wxapp_id']] = self::detail(['wxapp_id' => $wxapp['wxapp_id']], ['wxapp'])->toArray();
        }
        foreach ($infos as &$v) {
            $v['expire_time'] = date('Y-m-d H:i:s', $v['expire_time']);
        }
        unset($v);
        return $infos;
    }

}

<?php

namespace app\admin\model;

use app\common\model\Account as AccountModel;
use app\admin\model\store\User as StoreUser;
use app\admin\model\admin\role\UserRole;

/**
 * 微信公众号模型
 * Class Account
 * @package app\admin\model
 */
class Account extends AccountModel
{
    /**
     * 获取公众号列表
     * @param boolean $is_recycle
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList($is_recycle = false)
    {
        return $this->where('is_recycle', '=', (int)$is_recycle)
            ->where('is_delete', '=', 0)
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => request()->request()
            ]);
    }

    /**
     * 从缓存中获取商城名称
     * @param $data
     * @return array
     */
    public function getStoreName($data)
    {
        $names = [];
        foreach ($data as $wxapp) {
            $names[$wxapp['wxapp_id']] = Setting::getItem('store', $wxapp['wxapp_id'])['name'];
        }
        return $names;
    }

    /**
     * 新增记录
     * @param $data
     * @return bool
     * @throws \think\exception\PDOException
     */
    public function add($data)
    {
        $roleId = $data['role_id'];
        $data = $data['store'];
        if ($data['password'] !== $data['password_confirm']) {
            $this->error = '确认密码不正确';
            return false;
        }
        if (empty($roleId)) {
            $this->error = '请选择所属角色';
            return false;
        }
        $this->startTrans();
        try {
            // 添加公众号记录
            $this->allowField(true)->save($data);
            // 添加公众号记录
            ## ----

            // 商城默认设置
            (new Setting)->insertDefault($this['wxapp_id'], $data['store_name']);
            // 新增商家用户信息
            $StoreUser = new StoreUser;
            if (!$StoreUser->add($this['wxapp_id'], $data)) {
                $this->error = $StoreUser->error;
                return false;
            }
            // 新增角色关系记录
            (new UserRole)->add($StoreUser['store_user_id'], $roleId,$this['wxapp_id']);
            // 新增公众号默认帮助
            (new WxappHelp)->insertDefault($this['wxapp_id']);
            // 新增公众号diy配置
            (new WxappPage)->insertDefault($this['wxapp_id']);
            // 新增公众号分类页模板
            (new WxappCategory)->insertDefault($this['wxapp_id']);


            // 新增公众号默认帮助
            (new AccountHelp)->insertDefault($this['wxapp_id']);
            // 新增公众号diy配置
            (new AccountPage)->insertDefault($this['wxapp_id']);
            // 新增公众号分类页模板
            (new AccountCategory)->insertDefault($this['wxapp_id']);
            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->rollback();
            return false;
        }
    }

    /**
     * 移入移出回收站
     * @param bool $is_recycle
     * @return false|int
     */
    public function recycle($is_recycle = true)
    {
        return $this->save(['is_recycle' => (int)$is_recycle]);
    }

    /**
     * 软删除
     * @return false|int
     */
    public function setDelete()
    {
        return $this->save(['is_delete' => 1]);
    }

}

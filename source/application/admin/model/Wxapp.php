<?php

namespace app\admin\model;

use app\admin\model\admin\role\Role;
use app\admin\model\admin\role\RoleAccess;
use app\common\model\Wxapp as WxappModel;
use app\admin\model\store\User as StoreUser;
use app\admin\model\admin\role\UserRole;

/**
 * 微信小程序模型
 * Class Account
 * @package app\admin\model
 */
class Wxapp extends WxappModel
{
    /**
     * 获取小程序列表
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
        // 角色id
        $roleId = $data['role_id']['role_id'];
        //获取角色id对应的信息
        $message = (new Role)->whereIn('role_id',implode(',',$roleId))->order('role_id','asc')->select()->toArray();
        //获取角色id对应的权限信息
        $power = (new RoleAccess)->whereIn('role_id',implode(',',$roleId))->order('role_id','asc')->column('role_id,access_id','id');

        // 添加小程序的信息
        $data = $data['store'];
        $data['expire_time'] = strtotime($data['expire_time']);
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
            // 添加小程序记录
            $this->allowField(true)->save($data);
            // 添加公众号记录
            (new Account)->allowField(true)->save($data);

            // 商城默认设置
            (new Setting)->insertDefault($this['wxapp_id'], $data['store_name']);

            // 新增商家用户信息
            $StoreUser = new StoreUser;
            $res = $StoreUser->add($this['wxapp_id'], $data);
            if (!$res) {
                $this->error = $StoreUser->error;
                return false;
            }

            //根据分配角色创建商场对应角色信息
//            var_dump($message);die;
            $rids=[];
            foreach ($message as $k => $item) {
                unset($item['role_id']);
                $item['wxapp_id'] = $this['wxapp_id'];
                $item['is_type'] = 1;
                if($item['parent_id'] != 0){
                    $item['parent_id'] = isset($rids[0])?$rids[0]:0;
                }
                $item['create_time'] = time();
                $item['update_time'] = time();
                $rid = (new Role)->insertGetId($item);
                $rids[] = $rid;
            }
            //根据分配角色的权限创建商城对应权限
            $xb = 0;
            $now = 0;
            $qt = [];
            foreach ($power as $p) {
                $ls = $p['role_id'];
                unset($p['id']);
                if($now == 0){
                    $p['role_id'] = $rids[$xb];
                    $p['wxapp_id']=$this['wxapp_id'];
                    $p['create_time']=time();
                }else{
                    if($now == $ls){
                        $p['role_id'] = $rids[$xb];
                        $p['wxapp_id']=$this['wxapp_id'];
                        $p['create_time']=time();
                    }else{
                        $xb+=1;
                        $p['role_id'] = $rids[$xb];
                        $p['wxapp_id']=$this['wxapp_id'];
                        $p['create_time']=time();
                    }
                }
                $qt[] = $p;
                $now = $ls;
            }
            (new RoleAccess)->saveAll($qt);
            // 新增角色关系记录
            (new UserRole)->add($StoreUser['store_user_id'], $rids,$this['wxapp_id']);

            // 新增小程序默认帮助
            (new WxappHelp)->insertDefault($this['wxapp_id']);
            // 新增小程序diy配置1
            (new WxappPage)->insertDefault($this['wxapp_id']);
            // 新增小程序分类页模板
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

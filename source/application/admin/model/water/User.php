<?php

namespace app\admin\model\water;
use app\common\model\water\User as WUser;

/**
 * 送水用户控制器
 */
class User extends WUser
{
    public function getList()
    {
        return $this
            ->where('is_delete', '=', 0)
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => request()->request()
            ]);
    }

    /**
     * 移入移出回收站
     * @return false|int
     */
    public function recycle()
    {
        return $this->save(['is_delete' => 1]);
    }


    /**
     * 新增记录
     * @param $data
     * @return bool
     * @throws \think\exception\PDOException
     */
    public function add($data)
    {
        // 添加小程序的信息
        if ($data['password'] !== $data['password_confirm']) {
            $this->error = '确认密码不正确';
            return false;
        }
        $this->startTrans();
        try {
            // 新增商家用户信息
            if (self::checkExist($data['user_name'])) {
                $this->error = '用户名已存在';
                return false;
            }
            $this->save([
                'user_name' => $data['user_name'],
                'password' => yoshop_hash($data['password']),
                'wxapp_id' => 1,
            ]);

            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->rollback();
            return false;
        }
    }

}
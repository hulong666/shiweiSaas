<?php

namespace app\common\model;

/**
 * 举报模型
 */
class Report extends BaseModel
{
    /**
     * 关联用户表
     * @return \think\model\relation\HasOne
     */
    public function user()
    {
        return $this->hasOne('User','user_id','uid');
    }
}
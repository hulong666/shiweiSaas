<?php

namespace app\web_api\model\bargain;

use app\common\model\bargain\TaskHelp as TaskHelpModel;

/**
 * 砍价任务助力记录模型
 * Class TaskHelp
 * @package app\web_api\model\bargain
 */
class TaskHelp extends TaskHelpModel
{
    /**
     * 隐藏的字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'create_time',
    ];

    /**
     * 获取助力列表记录
     * @param $taskId
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getListByTaskId($taskId)
    {
        // 获取列表数据
        $list = (new static)->with(['user'])
            ->where('task_id', '=', $taskId)
            ->order(['create_time' => 'desc'])
            ->select();
        // 隐藏会员昵称
        foreach ($list as &$item) {
            $item['user']['nickName'] = \substr_cut($item['user']['nickName']);
        }
        return $list;
    }

    /**
     * 新增记录
     * @param $task
     * @param $userId
     * @param $cutMoney
     * @param $isCreater
     * @return false|int
     */
    public function add($task, $userId, $cutMoney, $isCreater = false)
    {
        return $this->save([
            'task_id' => $task['task_id'],
            'active_id' => $task['active_id'],
            'user_id' => $userId,
            'cut_money' => $cutMoney,
            'is_creater' => $isCreater,
            'wxapp_id' => static::$wxapp_id,
        ]);
    }

    /**
     * 根据砍价活动id集获取正在砍价的助力信息
     * @param $activeIds
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUnderwayByActiveIds($activeIds)
    {
        return $this->with('user')
            ->alias('help')
            ->field('help.*')
            ->join('bargain_task task', 'task.task_id = help.task_id')
            ->where('help.active_id', 'in', $activeIds)
            ->where('task.status', '=', 1)
            ->where('task.is_delete', '=', 0)
            ->limit(5)
            ->select();
    }

}
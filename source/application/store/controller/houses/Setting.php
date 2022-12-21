<?php

namespace app\store\controller\houses;

use app\store\controller\Controller;
use app\store\model\HsResidenceSetting as SettingModel;

/**
 * 住宅设置控制器
 */
class Setting extends Controller
{
    /**
     * 刷新设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function refresh()
    {
        return $this->updateEvent('refresh');
    }

    /**
     * 发布设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function release()
    {
        return $this->updateEvent('release');
    }

    /**
     * 置顶设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function topping()
    {
        return $this->updateEvent('topping');
    }

    /**
     * 更新商城设置事件
     * @param $key
     * @param $vars
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    private function updateEvent($key, $vars = [])
    {
        if (!$this->request->isAjax()) {
            $vars['values'] = SettingModel::getItem($key);
            return $this->fetch($key, $vars);
        }
        $model = new SettingModel;
        if ($model->edit($key, $this->postData($key))) {
            return $this->renderSuccess('操作成功');
        }
        return $this->renderError($model->getError() ?: '操作失败');
    }
}
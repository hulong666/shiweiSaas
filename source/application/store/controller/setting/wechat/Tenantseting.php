<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/2 14:51
 */


namespace app\store\controller\setting\wechat;


use app\store\controller\Controller;
use app\store\model\Setting as SettingModel;

/**
 * 租客设置
 * Class Tenant
 * @package app\store\controller\setting\wechat
 */
class Tenantseting extends Controller
{
    /**
     * 租客界面设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function tenant()
    {
        return $this->updateEvent('tenant');
    }

    /**
     * 房东界面设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function landlord()
    {
        return $this->updateEvent('landlord');
    }

    /**
     * 在线找房设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function findRoom()
    {
        return $this->updateEvent('find_room');
    }

    /**
     * 在线收款设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function collection()
    {
        return $this->updateEvent('collection');
    }

    /**
     * 租客/房东微信登录设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function wxLogin()
    {
        return $this->updateEvent('wx_login');
    }

    /**
     * 给房东开发租客信息设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function opening()
    {
        return $this->updateEvent('opening');
    }

    /**
     * 租客账单催收设置
     * @return array|mixed
     * @throws \think\exception\DbException
     */
    public function collectors()
    {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        return $this->updateEvent('collectors');
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
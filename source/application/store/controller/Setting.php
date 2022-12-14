<?php

namespace app\store\controller;

use app\store\model\Carousel;
use app\store\model\Printer as PrinterModel;
use app\store\model\Setting as SettingModel;
use app\common\library\sms\Driver as SmsDriver;

/**
 * 系统设置
 * Class Setting
 * @package app\store\controller
 */
class Setting extends Controller
{
    /**
     * 商城设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function store()
    {
        return $this->updateEvent('store');
    }

    /**
     * 交易设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function trade()
    {
        return $this->updateEvent('trade');
    }

    /**
     * 短信通知
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function sms()
    {
        return $this->updateEvent('sms');
    }

    /**
     * 模板消息
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function tplMsg()
    {
        return $this->updateEvent('tplMsg');
    }

    /**
     * 发送短信通知测试
     * @param $AccessKeyId
     * @param $AccessKeySecret
     * @param $sign
     * @param $msg_type
     * @param $template_code
     * @param $accept_phone
     * @return array
     * @throws \think\Exception
     */
    public function smsTest($AccessKeyId, $AccessKeySecret, $sign, $msg_type, $template_code, $accept_phone)
    {
        $SmsDriver = new SmsDriver([
            'default' => 'aliyun',
            'engine' => [
                'aliyun' => [
                    'AccessKeyId' => $AccessKeyId,
                    'AccessKeySecret' => $AccessKeySecret,
                    'sign' => $sign,
                    $msg_type => compact('template_code', 'accept_phone'),
                ],
            ],
        ]);
        $templateParams = [];
        if ($msg_type === 'order_pay') {
            $templateParams = ['order_no' => '2018071200000000'];
        }
        if ($SmsDriver->sendSms($msg_type, $templateParams, true)) {
            return $this->renderSuccess('发送成功');
        }
        return $this->renderError('发送失败 ' . $SmsDriver->getError());
    }

    /**
     * 上传设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function storage()
    {
        return $this->updateEvent('storage');
    }

    /**
     * 小票打印设置
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function printer()
    {
        // 获取打印机列表
        $printerList = PrinterModel::getAll();
        return $this->updateEvent('printer', compact('printerList'));
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

    /**
     * 轮播图列表
     * @return mixed
     */
    public function carousel()
    {
        $model = new Carousel();
        $list = $model->getList();
        return $this->fetch('carousel', compact('list'));
    }

    /**
     * 新增
     * @return array|bool|mixed
     */
    public function carouselAdd()
    {
        $model = new Carousel;
        if (!$this->request->isAjax()) {
            return $this->fetch('carouseladd');
        }
        // 新增记录
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('setting/carousel'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 编辑
     * @param $id
     * @return array|bool|mixed
     * @throws \think\exception\DbException
     */
    public function carouseledit($id)
    {
        // 标签详情
        $model = Carousel::detail($id);
        if (!$this->request->isAjax()) {
            return $this->fetch('carouseledit', compact('model'));
        }
        // 新增记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('setting/carousel'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    public function carouseldelete($id)
    {
        // 标签详情
        $model = Carousel::detail($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

}

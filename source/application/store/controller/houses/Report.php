<?php

namespace app\store\controller\houses;

use app\store\controller\Controller;
use app\store\model\HsReport;

/**
 * 举报控制器
 */
class Report extends Controller
{
    public function index()
    {
        $model = new HsReport();
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    /**
     * 修改上下架状态
     * @return array|bool
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        $data = $this->postData();
        // 标签详情
        $model = HsReport::get($data['id']);
        if ($model->edit($data)) {
            return $this->renderSuccess('更新成功', url('houses.report/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }
}
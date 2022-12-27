<?php

namespace app\store\controller\contract;

use app\store\controller\Controller;
use app\store\model\ContractTemplate as ContractTemplateModel;

/**
 * 合同模板控制器
 */
class Contracttemplate extends Controller
{
    /**
     * 列表页
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new ContractTemplateModel();
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    /**
     * 编辑
     * @param $id
     * @return array|bool|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit($id)
    {
        $model = ContractTemplateModel::detail($id);
        $templateModel = new ContractTemplateModel();
        if (!$this->request->isAjax()) {
            $contract_type = $templateModel->contract_type;
            $business_type = $templateModel->business_type;
            $contract = $templateModel->contract;
            return $this->fetch('edit',compact('model','contract_type','business_type','contract'));
        }
        $model = ContractTemplateModel::get($id);
        // 更新记录
        if ($model->edit($this->postData())) {
            return $this->renderSuccess('更新成功', url('contract.contracttemplate/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 复制
     * @param $id
     * @return array|bool|mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function copy($id)
    {
        $model = ContractTemplateModel::detail($id);
        $templateModel = new ContractTemplateModel();
        if (!$this->request->isAjax()) {
            $contract_type = $templateModel->contract_type;
            $business_type = $templateModel->business_type;
            $contract = $templateModel->contract;
            return $this->fetch('edit',compact('model','contract_type','business_type','contract'));
        }
        $model = new ContractTemplateModel;
        if ($model->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('contract.contracttemplate/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 新增合同
     * @return array|bool|mixed
     */
    public function add()
    {
        $templateModel = new ContractTemplateModel();
        if (!$this->request->isAjax()) {
            $contract_type = $templateModel->contract_type;
            $business_type = $templateModel->business_type;
            $contract = $templateModel->contract;
            return $this->fetch('add',compact('contract_type','business_type','contract'));
        }
        if ($templateModel->add($this->postData())) {
            return $this->renderSuccess('添加成功', url('contract.contracttemplate/index'));
        }
        return $this->renderError($templateModel->getError() ?: '添加失败');
    }

    /**
     * 删除
     * @param $id
     * @return array|bool
     * @throws \think\exception\DbException
     */
    public function delete($id)
    {
        // 商品详情
        $model = ContractTemplateModel::get($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

    /**
     * 预览合同
     * @param $id
     * @return mixed
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function preview($id)
    {
        $model = ContractTemplateModel::detail($id);
        return $this->fetch('preview',compact('model'));
    }
}
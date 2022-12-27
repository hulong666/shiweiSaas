<?php

namespace app\store\controller\contract;

use app\store\controller\Controller;
use app\store\model\ContractList as ContractListModel;

/**
 * 合同列表控制器
 */
class Contractlist extends Controller
{
    /**
     * 列表页
     * @return mixed
     */
    public function index()
    {
        $model = new ContractListModel();
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }

    /**
     * 预览
     * @param $id
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function preview($id)
    {
        $model = ContractListModel::detail($id);
        return $this->fetch('preview',compact('model'));
    }
}
<?php

namespace app\store\model;
use app\common\model\ContractList as ContractListModel;

/**
 * 合同列表模型
 */
class ContractList extends ContractListModel
{
    public function getList()
    {
        return $this
            ->with(['user'])
            ->order(['id' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }
}
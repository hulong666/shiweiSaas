<?php

namespace app\store\model;
use app\common\model\ContractTemplate as ContractTemplateModel;

/**
 * 合同模板模型
 */
class ContractTemplate extends ContractTemplateModel
{
    /**
     * 合同类型获取器
     * @param $value
     * @return array
     */
    public function getContractTypeAttr($value)
    {
        return ['text'=>$this->contract_type[$value],'value'=>$value];
    }

    /**
     * 业务类型获取器
     * @param $value
     * @return array
     */
    public function getBusinessTypeAttr($value)
    {
        return ['text'=>$this->business_type[$value],'value'=>$value];
    }

    /**
     * 签约对象获取器
     * @param $value
     * @return array
     */
    public function getContractAttr($value)
    {
        return ['text'=>$this->contract[$value],'value'=>$value];
    }
    
    /**
     * 获取列表
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function getList()
    {
        return $this
            ->order(['id' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }

    /**
     * 编辑
     * @param $data
     * @return false|mixed
     */
    public function edit($data)
    {
        foreach ($data['title'] as $k => $datum) {
            $content[] = ['title'=>$datum,'content'=>$data['content'][$k]];
        }
        unset($data['title']);
        $data['content'] = json_encode($content,JSON_UNESCAPED_UNICODE);
        return $this->allowField(true)->save($data) !== false;
    }

    /**
     * 新增合同
     * @param array $data
     * @return bool
     * @throws \think\exception\PDOException
     */
    public function add(array $data)
    {
        foreach ($data['title'] as $k => $datum) {
            $content[] = ['title'=>$datum,'content'=>$data['content'][$k]];
        }
        unset($data['title']);
        $data['content'] = json_encode($content,JSON_UNESCAPED_UNICODE);
        $data['wxapp_id'] = self::$wxapp_id;
        // 开启事务
        $this->startTrans();
        try {
            // 添加商品
            $this->allowField(true)->save($data);
            $this->commit();
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->rollback();
            return false;
        }
    }

    /**
     * 删除合同
     * @return false|int
     */
    public function setDelete()
    {
        return $this->delete();
    }
}
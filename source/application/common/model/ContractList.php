<?php

namespace app\common\model;

/**
 * 合同列表模型
 */
class ContractList extends BaseModel
{
    protected $name = 'contract_list';

    public $ContractTemplateModel;

    public function initialize()
    {
        $this->ContractTemplateModel =  new ContractTemplate();
    }

    /**
     * 合同类型获取器
     * @param $value
     * @return array
     */
    public function getContractTypeAttr($value)
    {
        return ['text'=>$this->ContractTemplateModel->contract_type[$value],'value'=>$value];
    }

    /**
     * 业务类型获取器
     * @param $value
     * @return array
     */
    public function getBusinessTypeAttr($value)
    {
        return ['text'=>$this->ContractTemplateModel->business_type[$value],'value'=>$value];
    }

    /**
     * 签约对象获取器
     * @param $value
     * @return array
     */
    public function getContractAttr($value)
    {
        return ['text'=>$this->ContractTemplateModel->contract[$value],'value'=>$value];
    }


    /**
     * 内容获取器
     * @param $value
     * @param $data
     * @return array|mixed
     */
    public function getContentAttr($value,$data)
    {
        if($value == ''){
            return [];
        }
        $zhi = json_decode($data['value'],true);
        foreach ($zhi as $k => $item) {
            $value = str_replace($k, $item, $value);
        }
        return json_decode($value,true);
    }

    /**
     * 甲方获取器
     * @param $value
     * @param $data
     * @return array|mixed
     */
    public function getFirstPartyAttr($value,$data)
    {
        if($value == ''){
            return '';
        }
        $zhi = json_decode($data['value'],true);
        foreach ($zhi as $k => $item) {
            $value = str_replace($k, $item, $value);
        }
        return $value;
    }

    /**
     * 乙方获取器
     * @param $value
     * @param $data
     * @return array|mixed
     */
    public function getPartyBAttr($value,$data)
    {
        if($value == ''){
            return '';
        }
        $zhi = json_decode($data['value'],true);
        foreach ($zhi as $k => $item) {
            $value = str_replace($k, $item, $value);
        }
        return $value;
    }

    /**
     * 关联租户表
     * @return \think\model\relation\HasOne
     */
    public function user()
    {
        return $this->hasOne('User','user_id','uid');
    }

    /**
     * 详情
     * @param $id
     * @return array|bool|\PDOStatement|string|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function detail($id)
    {
        return self::with(['user'])->where('id',$id)->find()->toArray();
    }
}
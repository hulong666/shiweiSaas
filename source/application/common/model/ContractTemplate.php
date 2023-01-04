<?php

namespace app\common\model;

/**
 * 合同模板模型
 */
class ContractTemplate extends BaseModel
{
    protected $name = 'contract_template';

    //合同类型
    public $contract_type = [10=>'租赁合同','20'=>'非租赁合同'];

    //业务类型
    public $business_type = [10=>'整租','20'=>'合租','30'=>'出售'];

    //签约对象
    public $contract = [10=>'租户','20'=>'房东'];

    //字段代码
    public $filed = [
        '' => [],
        'landlord' => [

        ],
    ];

    /**
     * 内容获取器
     * @param $value
     * @return array|mixed
     */
    public function getContentAttr($value)
    {
        if($value == ''){
            return [];
        }
        return json_decode($value,true);
    }

    /**
     * 详情
     * @param $id
     * @return array
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function detail($id)
    {
        return self::where('id',$id)->find();
    }
}
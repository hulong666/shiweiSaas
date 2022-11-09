<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/8 11:51
 */


namespace app\store\model;

use app\common\model\Finance as FinanceModel;

/**
 * 财务模型
 * Class Finance
 * @package app\store\model
 */
class Finance extends FinanceModel
{
    /**
     * @param int $type 业务类型
     * @param string $region 区域地址
     * @param string $property_address 物业地址
     * @param string $start_time 开始时间
     * @param string $end_time 结束时间
     */
    public function getList($type, $region, $property_address,$start_time,$end_time)
    {
        $type > 0 && $this->where('type', '=', (int)$type);
        !empty($region) && $this->where('region', 'like', "%$region%");
        !empty($property_address) && $this->where('property_address', 'like', "%$property_address%");
        if(!empty($start_time) && !empty($end_time)){
            $this->where(['month'=>[['>=',strtotime($start_time)],['<',strtotime($end_time)],'and']]);
        }
        return $this
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }
}
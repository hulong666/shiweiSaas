<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/8 10:57
 */


namespace app\store\controller;

use app\store\model\Finance as FinanceModel;

/**
 * 财务管理控制器
 * Class Finance
 * @package app\store\controller
 */
class Finance extends Controller
{
    /**
     * 收入成本
     * @param int $type
     * @param string $region
     * @param string $property_address
     * @param string $start_time
     * @param string $end_time
     * @return mixed
     */
    public function index($type = -1, $region = '', $property_address = '',$start_time = '',$end_time = '')
    {
        $model = new FinanceModel;
        $list = $model->getList($type, $region, $property_address,$start_time,$end_time);
        return $this->fetch('index', compact('list'));
    }

    /**
     * 收入汇总
     * @param int $type
     * @param string $region
     * @param string $property_address
     * @param string $start_time
     * @param string $end_time
     * @return mixed
     */
    public function income($type = -1, $region = '', $property_address = '',$start_time = '',$end_time = '')
    {
        $model = new FinanceModel;
        $list = $model->getList($type, $region, $property_address,$start_time,$end_time);
        return $this->fetch('income', compact('list'));
    }

    /**
     * 成本汇总
     * @param int $type
     * @param string $region
     * @param string $property_address
     * @param string $start_time
     * @param string $end_time
     * @return mixed
     */
    public function cost($type = -1, $region = '', $property_address = '',$start_time = '',$end_time = '')
    {
        $model = new FinanceModel;
        $list = $model->getList($type, $region, $property_address,$start_time,$end_time);
        return $this->fetch('cost', compact('list'));
    }
}
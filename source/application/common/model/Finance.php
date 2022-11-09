<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/8 11:48
 */


namespace app\common\model;

/**
 * 财务模型
 * Class Finance
 * @package app\common\model
 */
class Finance extends BaseModel
{
    /**
     * 毛利设置器
     * @param $value
     * @param $data
     */
    public function setGrossProfitAttr($value,$data)
    {
        
    }

    /**
     * 毛利率设置器
     * @param $value
     * @param $data
     */
    public function setGrossProfitMarginAttr($value,$data)
    {

    }

    /**
     * 月份获取器
     * @param $value
     * @return false|string
     */
    public function getMonthAttr($value)
    {
        return date('Y-m',$value);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/12/1 15:27
 */


namespace app\store\controller\setting\resources;


use app\store\controller\Controller;
use app\store\model\HsArea;

/**
 * 商圈控制器
 * Class Trading
 * @package app\store\controller\resources
 */
class Trading extends Controller
{
    public function index()
    {
        $model = new HsArea();
        $list = $model->getList();
        return $this->fetch('index', compact('list'));
    }
}
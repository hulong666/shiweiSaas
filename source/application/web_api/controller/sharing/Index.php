<?php

namespace app\web_api\controller\sharing;

use app\web_api\controller\Controller;
use app\web_api\model\sharing\Category as CategoryModel;

/**
 * 拼团首页控制器
 * Class Active
 * @package app\web_api\controller\sharing
 */
class Index extends Controller
{
    /**
     * 拼团首页
     * @return array
     */
    public function index()
    {
        // 拼团分类列表
        $categoryList = CategoryModel::getCacheAll();
        return $this->renderSuccess(compact('categoryList'));
    }

}

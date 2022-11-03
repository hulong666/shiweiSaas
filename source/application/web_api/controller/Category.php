<?php

namespace app\web_api\controller;

use app\web_api\model\Category as CategoryModel;
use app\web_api\model\AccountCategory as AccountCategoryModel;

/**
 * 商品分类控制器
 * Class Goods
 * @package app\web_api\controller
 */
class Category extends Controller
{
    /**
     * 分类页面
     * @return array
     * @throws \think\exception\DbException
     */
    public function index()
    {
        // 分类模板
        $templet = AccountCategoryModel::detail();
        // 商品分类列表
        $list = array_values(CategoryModel::getCacheTree());
        return $this->renderSuccess(compact('templet', 'list'));
    }

}

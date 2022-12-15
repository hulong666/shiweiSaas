<?php
/**
 * 后台菜单配置
 *    'home' => [
 *       'name' => '首页',                // 菜单名称
 *       'icon' => 'icon-home',          // 图标 (class)
 *       'index' => 'index/index',         // 链接
 *     ],
 */
namespace app\water\extra;
use app\water\controller\Controller;
use think\Session;

class Menus extends Controller {
    /** @var array $store 商家登录信息 */
    protected $store;

    public function _initialize()
    {
        // 商家登录信息
        $this->store = Session::get('yoshop_store');
    }

    public function getMenu()
    {
        return [
            'index' => [
                'name' => '首页',
                'icon' => 'icon-home',
                'index' => 'index/index',
            ],
            'goods' => [
                'name' => '商品管理',
                'icon' => 'icon-goods',
                'index' => 'goods/index',
                'submenu' => [
                    [
                        'name' => '商品列表',
                        'index' => 'goods/index',
                        'uris' => [
                            'goods/index',
                            'goods/add',
                            'goods/edit',
                            'goods/copy'
                        ],
                    ],
                    [
                        'name' => '商品品牌',
                        'index' => 'goods.brand/index',
                        'uris' => [
                            'goods.brand/index',
                            'goods.brand/add',
                            'goods.brand/edit',
                        ],
                    ],
                ],
            ],
            'order' => [
                'name' => '订单管理',
                'icon' => 'icon-order',
                'index' => 'order/all_list',
                'submenu' => [
                    [
                        'name' => '全部订单',
                        'index' => 'order/all_list',
                    ],
                    [
                        'name' => '待付款',
                        'index' => 'order/pay_list',
                    ],
                    [
                        'name' => '待送水',
                        'index' => 'order/delivery_list',
                    ],
                    [
                        'name' => '待收货',
                        'index' => 'order/receipt_list',
                    ],
                    [
                        'name' => '已完成',
                        'index' => 'order/complete_list',
                    ],
                ]
            ],
        ];
    }
}

<?php
/**
 * 后台菜单配置
 *    'home' => [
 *       'name' => '首页',                // 菜单名称
 *       'icon' => 'icon-home',          // 图标 (class)
 *       'index' => 'index/index',         // 链接
 *     ],
 */
return [
    'store' => [
        'name' => 'SaaS系统',
        'icon' => 'icon-shangcheng',
        'submenu' => [
            [
                'name' => '角色管理',
                'index' => 'role/index',
                'uris' => [
                    'role/index',
                    'role/add',
                    'role/edit',
                    'role/del',
                ]
            ],
            [
                'name' => '用户列表',
                'index' => 'store/index',
                'uris' => [
                    'store/index',
                    'store/add',
                    'store/storeindex',
                    'store/storeadd',
                    'store/storestaff',
                    'store/storeedit',
                ]
            ],
            [
                'name' => '回收站',
                'index' => 'store/recycle'
            ],
            [
                'name' => '权限管理',
                'index' => 'store.access/index'
            ]
        ],
    ],
    'setting' => [
        'name' => '系统设置',
        'icon' => 'icon-shezhi',
        'submenu' => [
            [
                'name' => '清理缓存',
                'index' => 'setting.cache/clear'
            ],
            [
                'name' => '环境检测',
                'index' => 'setting.science/index'
            ],
        ],
    ],
    'water' => [
        'name' => '送水管理',
        'icon' => 'icon-shezhi',
        'submenu' => [
            [
                'name' => '账号列表',
                'index' => 'water.user/userList'
            ],
            [
                'name' => '订单列表',
                'index' => 'water.order/index'
            ],
        ]
    ]
];

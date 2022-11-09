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
    'index' => [
        'name' => '首页',
        'icon' => 'icon-home',
        'index' => 'index/index',
    ],
    'store' => [
        'name' => '管理员',
        'icon' => 'icon-guanliyuan',
        'index' => 'store.user/index',
        'submenu' => [
            [
                'name' => '管理员列表',
                'index' => 'store.user/index',
                'uris' => [
                    'store.user/index',
                    'store.user/add',
                    'store.user/edit',
                    'store.user/delete',
                ],
            ],
            [
                'name' => '角色管理',
                'index' => 'store.role/index',
                'uris' => [
                    'store.role/index',
                    'store.role/add',
                    'store.role/edit',
                    'store.role/delete',
                ],
            ],
        ]
    ],
    'user' => [
        'name' => '用户管理',
        'icon' => 'icon-user',
        'index' => 'user/index',
        'submenu' => [
            [
                'name' => '用户列表',
                'index' => 'user/index',
            ],
            [
                'name' => '会员等级',
                'active' => true,
                'submenu' => [
                    [
                        'name' => '等级管理',
                        'index' => 'user.grade/index',
                        'uris' => [
                            'user.grade/index',
                            'user.grade/add',
                            'user.grade/edit',
                            'user.grade/delete',
                        ]
                    ],
                ]
            ],
            [
                'name' => '余额记录',
                'active' => true,
                'submenu' => [
                    [
                        'name' => '充值记录',
                        'index' => 'user.recharge/order',
                    ],
                    [
                        'name' => '余额明细',
                        'index' => 'user.balance/log',
                    ],
                ]
            ],
        ]
    ],
    'finance' => [
        'name' => '财务管理',
        'icon' => 'icon-qiandai',
        'index' => 'finance/index',
        'submenu' => [
            [
                'name' => '收入成本',
                'index' => 'finance/index',
            ],
            [
                'name' => '收入汇总',
                'index' => 'finance/income',
            ],
            [
                'name' => '成本汇总',
                'index' => 'finance/cost',
            ],
        ]
    ],
    /*'wxapp' => [
        'name' => '小程序',
        'icon' => 'icon-wxapp',
        'color' => '#36b313',
        'index' => 'wxapp/setting',
        'submenu' => [
            [
                'name' => '小程序设置',
                'index' => 'wxapp/setting',
            ],
            [
                'name' => '页面管理',
                'active' => true,
                'submenu' => [
                    [
                        'name' => '页面设计',
                        'index' => 'wxapp.page/index',
                        'uris' => [
                            'wxapp.page/index',
                            'wxapp.page/add',
                            'wxapp.page/edit',
                            'wxapp.page/delete',
                        ]
                    ],
                    [
                        'name' => '分类模板',
                        'index' => 'wxapp.page/category'
                    ],
                    [
                        'name' => '页面链接',
                        'index' => 'wxapp.page/links'
                    ]
                ]
            ],
            [
                'name' => '帮助中心',
                'index' => 'wxapp.help/index',
                'uris' => [
                    'wxapp.help/index',
                    'wxapp.help/add',
                    'wxapp.help/edit'
                ]
            ],
        ],
    ],
    'account' => [
        'name' => '公众号',
        'icon' => 'icon-shop',
        'color' => '#36b313',
        'index' => 'account/setting',
        'submenu' => [
            [
                'name' => '公众号设置',
                'index' => 'account/setting',
            ],
            [
                'name' => '页面管理',
                'active' => true,
                'submenu' => [
                    [
                        'name' => '页面设计',
                        'index' => 'account.page/index',
                        'uris' => [
                            'account.page/index',
                            'account.page/add',
                            'account.page/edit',
                            'account.page/delete',
                        ]
                    ],
                    [
                        'name' => '分类模板',
                        'index' => 'account.page/category'
                    ],
                    [
                        'name' => '页面链接',
                        'index' => 'account.page/links'
                    ]
                ]
            ],
            [
                'name' => '帮助中心',
                'index' => 'account.help/index',
                'uris' => [
                    'account.help/index',
                    'account.help/add',
                    'account.help/edit'
                ]
            ],
        ],
    ],*/
    'setting' => [
        'name' => '设置',
        'icon' => 'icon-setting',
        'index' => 'setting/store',
        'submenu' => [
            [
                'name' => '商城设置',
                'index' => 'setting/store',
            ],
            [
                'name' => '短信通知',
                'index' => 'setting/sms'
            ],
            [
                'name' => '模板消息',
                'index' => 'setting/tplmsg',
                'uris' => [
                    'setting/tplmsg',
                    'setting.help/tplmsg'

                ],
            ],
            [
                'name' => '小程序',
                'submenu' => [
                    [
                        'name' => '小程序设置',
                        'index' => 'setting.wxapp/setting',
                    ],
                    [
                        'name' => '页面设计',
                        'index' => 'setting.wxapp.page/index',
                        'uris' => [
                            'setting.wxapp.page/index',
                            'setting.wxapp.page/add',
                            'setting.wxapp.page/edit',
                            'setting.wxapp.page/sethome',
                            'setting.wxapp.page/delete',
                        ]
                    ],
                    [
                        'name' => '分类模板',
                        'index' => 'setting.wxapp.page/category'
                    ],
                    [
                        'name' => '页面链接',
                        'index' => 'setting.wxapp.page/links'
                    ],
                    [
                        'name' => '帮助中心',
                        'index' => 'setting.wxapp.help/index',
                        'uris' => [
                            'setting.wxapp.help/index',
                            'setting.wxapp.help/add',
                            'setting.wxapp.help/edit',
                            'setting.wxapp.help/delete',
                        ]
                    ],
                ]
            ],
            [
                'name' => '公众号',
                'submenu' => [
                    [
                        'name' => '公众号设置',
                        'index' => 'setting.account/setting',
                    ],
                    [
                        'name' => '页面设计',
                        'index' => 'setting.account.page/index',
                        'uris' => [
                            'setting.account.page/index',
                            'setting.account.page/add',
                            'setting.account.page/edit',
                            'setting.account.page/sethome',
                            'setting.account.page/delete',
                        ]
                    ],
                    [
                        'name' => '分类模板',
                        'index' => 'setting.account.page/category'
                    ],
                    [
                        'name' => '页面链接',
                        'index' => 'setting.account.page/links'
                    ],
                    [
                        'name' => '帮助中心',
                        'index' => 'setting.account.help/index',
                        'uris' => [
                            'setting.account.help/index',
                            'setting.account.help/add',
                            'setting.account.help/edit',
                            'setting.account.help/delete',
                        ]
                    ],
                ]
            ],
            [
                'name' => '微信设置',
                'submenu' => [
                    [
                        'name' => '租客界面设置',
                        'index' => 'setting.wechat.tenantseting/tenant',
                    ],
                    [
                        'name' => '房东界面设置',
                        'index' => 'setting.wechat.tenantseting/landlord',
                    ],
                    [
                        'name' => '在线找房设置',
                        'index' => 'setting.wechat.tenantseting/findroom'
                    ],
                    [
                        'name' => '在线收款设置',
                        'index' => 'setting.wechat.tenantseting/collection'
                    ],
                    [
                        'name' => '微信登录设置',
                        'index' => 'setting.wechat.tenantseting/wxlogin'
                    ],
                    [
                        'name' => '租客信息设置',
                        'index' => 'setting.wechat.tenantseting/opening'
                    ],
                    [
                        'name' => '催收设置',
                        'index' => 'setting.wechat.tenantseting/collectors'
                    ],
                ]
            ],
            [
                'name' => '其他',
                'submenu' => [
                    [
                        'name' => '清理缓存',
                        'index' => 'setting.cache/clear'
                    ]
                ]
            ]
        ],
    ],
];

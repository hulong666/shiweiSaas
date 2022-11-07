<?php

namespace app\common\model;

use think\Cache;
use app\common\enum\DeliveryType as DeliveryTypeEnum;
use app\common\enum\PaymentType as PaymentTypeEnum;

/**
 * 系统设置模型
 * Class Setting
 * @package app\common\model
 */
class Setting extends BaseModel
{
    protected $name = 'setting';
    protected $createTime = false;

    /**
     * 获取器: 转义数组格式
     * @param $value
     * @return mixed
     */
    public function getValuesAttr($value)
    {
        return json_decode($value, true);
    }

    /**
     * 修改器: 转义成json格式
     * @param $value
     * @return string
     */
    public function setValuesAttr($value)
    {
        return json_encode($value);
    }

    /**
     * 获取指定项设置
     * @param $key
     * @param $wxapp_id
     * @return array
     */
    public static function getItem($key, $wxapp_id = null)
    {
        $data = self::getAll($wxapp_id);
        return isset($data[$key]) ? $data[$key]['values'] : [];
    }

    /**
     * 获取设置项信息
     * @param $key
     * @return null|static
     * @throws \think\exception\DbException
     */
    public static function detail($key)
    {
        return self::get(compact('key'));
    }

    /**
     * 全局缓存: 系统设置
     * @param null $wxapp_id
     * @return array|mixed
     */
    public static function getAll($wxapp_id = null)
    {
        $static = new static;
        is_null($wxapp_id) && $wxapp_id = $static::$wxapp_id;
        if (!$data = Cache::get('setting_' . $wxapp_id)) {
            $setting = $static::all(compact('wxapp_id'));
            $data = empty($setting) ? [] : array_column(collection($setting)->toArray(), null, 'key');
            Cache::tag('cache')->set('setting_' . $wxapp_id, $data);
        }
        return $static->getMergeData($data);
    }

    /**
     * 合并用户设置与默认数据
     * @param $userData
     * @return array
     */
    private function getMergeData($userData)
    {
        $defaultData = $this->defaultData();
        // 商城设置：配送方式
        if (isset($userData['store']['values']['delivery_type'])) {
            unset($defaultData['store']['values']['delivery_type']);
        }
        return array_merge_multiple($defaultData, $userData);
    }

    /**
     * 默认配置
     * @param null|string $storeName
     * @return array
     */
    public function defaultData($storeName = null)
    {
        return [
            'store' => [
                'key' => 'store',
                'describe' => '商城设置',
                'values' => [
                    // 商城名称
                    'name' => $storeName ?: '萤火小程序商城',
                    // 配送方式
                    'delivery_type' => array_keys(DeliveryTypeEnum::data()),
                    // 快递100
                    'kuaidi100' => [
                        'customer' => '',
                        'key' => '',
                    ]
                ],
            ],
            'trade' => [
                'key' => 'trade',
                'describe' => '交易设置',
                'values' => [
                    'order' => [
                        'close_days' => '3',
                        'receive_days' => '10',
                        'refund_days' => '7'
                    ],
                    'freight_rule' => '10',
                ]
            ],
            'storage' => [
                'key' => 'storage',
                'describe' => '上传设置',
                'values' => [
                    'default' => 'local',
                    'engine' => [
                        'local' => [],
                        'qiniu' => [
                            'bucket' => '',
                            'access_key' => '',
                            'secret_key' => '',
                            'domain' => 'http://'
                        ],
                        'aliyun' => [
                            'bucket' => '',
                            'access_key_id' => '',
                            'access_key_secret' => '',
                            'domain' => 'http://'
                        ],
                        'qcloud' => [
                            'bucket' => '',
                            'region' => '',
                            'secret_id' => '',
                            'secret_key' => '',
                            'domain' => 'http://'
                        ],
                    ]
                ],
            ],
            'sms' => [
                'key' => 'sms',
                'describe' => '短信通知',
                'values' => [
                    'default' => 'aliyun',
                    'engine' => [
                        'aliyun' => [
                            'AccessKeyId' => '',
                            'AccessKeySecret' => '',
                            'sign' => '萤火科技',
                            'order_pay' => [
                                'is_enable' => '0',
                                'template_code' => '',
                                'accept_phone' => '',
                            ],
                        ],
                    ],
                ],
            ],
            'tplMsg' => [
                'key' => 'tplMsg',
                'describe' => '模板消息',
                'values' => [
                    'payment' => [
                        'is_enable' => '0',
                        'template_id' => '',
                    ],
                    'delivery' => [
                        'is_enable' => '0',
                        'template_id' => '',
                    ],
                    'refund' => [
                        'is_enable' => '0',
                        'template_id' => '',
                    ],
                ],
            ],
            'printer' => [
                'key' => 'printer',
                'describe' => '小票打印机设置',
                'values' => [
                    'is_open' => '0',   // 是否开启打印
                    'printer_id' => '', // 打印机id
                    'order_status' => [], // 订单类型 10下单打印 20付款打印 30确认收货打印
                ],
            ],
            'full_free' => [
                'key' => 'full_free',
                'describe' => '满额包邮设置',
                'values' => [
                    'is_open' => '0',   // 是否开启满额包邮
                    'money' => '',      // 单笔订单额度
                    'notin_region' => [ // 不参与包邮的地区
                        'province' => [],
                        'citys' => [],
                        'treeData' => [],
                    ],
                    'notin_goods' => [],  // 不参与包邮的商品   (商品id集)
                ],
            ],
            'recharge' => [
                'key' => 'recharge',
                'describe' => '用户充值设置',
                'values' => [
                    'is_entrance' => '1',   // 是否允许用户充值
                    'is_custom' => '1',   // 是否允许自定义金额
                    'is_match_plan' => '1',   // 自定义金额是否自动匹配合适的套餐
                    'describe' => "1. 账户充值仅限微信在线方式支付，充值金额实时到账；\n" .
                        "2. 账户充值套餐赠送的金额即时到账；\n" .
                        "3. 账户余额有效期：自充值日起至用完即止；\n" .
                        "4. 若有其它疑问，可拨打客服电话400-000-1234",     // 充值说明
                ],
            ],
            'points' => [
                'key' => 'points',
                'describe' => '积分设置',
                'values' => [
                    'points_name' => '积分',         // 积分名称自定义
                    'is_shopping_gift' => '0',      // 是否开启购物送积分
                    'gift_ratio' => '100',            // 是否开启购物送积分
                    'is_shopping_discount' => '0',    // 是否允许下单使用积分抵扣
                    'discount' => [     // 积分抵扣
                        'discount_ratio' => '0.01',       // 积分抵扣比例
                        'full_order_price' => '100.00',       // 订单满[?]元
                        'max_money_ratio' => '10',             // 最高可抵扣订单额百分比
                    ],
                    // 充值说明
                    'describe' => "a) 积分不可兑现、不可转让,仅可在本平台使用;\n" .
                        "b) 您在本平台参加特定活动也可使用积分,详细使用规则以具体活动时的规则为准;\n" .
                        "c) 积分的数值精确到个位(小数点后全部舍弃,不进行四舍五入)\n" .
                        "d) 买家在完成该笔交易(订单状态为“已签收”)后才能得到此笔交易的相应积分,如购买商品参加店铺其他优惠,则优惠的金额部分不享受积分获取;",
                ],
            ],
            'tenant' => [
                'key' => 'tenant',
                'describe' => '租客设置',
                'values' => [
                    //租客在线缴费设置
                    'payment_type' => [10],
                    //租客在线服务设置
                    'service_type' => [10],
                    //租客智能管理设置
                    'intelligent_type' => [10,20,30],
                    //租客端水电单价的显示
                    'hydroelectricity_type' => 0,
                    //租客在线报修上传视频
                    'upload_video_type' => 0,
                    //租客管家显示设置
                    'housekeeper_type' => 0,
                    //给租客的提醒
                    'housekeeper_content' => '',
                ],
            ],
            'landlord' => [
                'key' => 'landlord',
                'describe' => '房东设置',
                'values' => [
                    'top' => [10],
                    'home' => [10],
                ]
            ],
            'find_room' => [
                'key' => 'find_room',
                'describe' => '在线找房设置',
                'values' => [
                    'roomnumber_hide' => '1',
                    'image_id' => '',
                ]
            ],
            'collection' => [
                'ket' => 'collection',
                'describe' => '在线收款设置',
                'values' => [
                    'rent_collection' => 1,//在线收租手续费
                    'arrears' => 1,
                    'order_payment' => 1,
                    'hydroelectricity' => 1,
                    'rent' => 1,
                    'tenant' => [10],
                    'autonomy' => 0,
                ]
            ],
            'wx_login' => [
                'ket' => 'wx_login',
                'describe' => '租客/房东微信登录设置',
                'values' => [
                    'tenant_login' => 1,//租客微信登录设置
                    'landlord_login' => 1,
                ]
            ],
            'opening' => [
                'ket' => 'opening',
                'describe' => '给房东开发租客信息设置',
                'values' => [
                    'message_type' => [10,20,30,40,50,60,70,80,90,100,110,120,130]
                ]
            ],
            'collectors' => [
                'ket' => 'collectors',
                'describe' => '租客账单催收设置',
                'values' => [
                    'collectors_type' => [10],
                    'repeat_type' => [],
                    'time' => 1,
                    'days' => 3,
                ]
            ],
        ];
    }

}

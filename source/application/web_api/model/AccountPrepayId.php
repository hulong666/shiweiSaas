<?php

namespace app\web_api\model;

use app\common\model\AccountPrepayId as AccountPrepayIdModel;
use app\common\enum\OrderType as OrderTypeEnum;

/**
 * 小程序prepay_id模型
 * Class AccountPrepayId
 * @package app\web_api\model
 */
class AccountPrepayId extends AccountPrepayIdModel
{
    /**
     * 新增记录
     * @param $prepayId
     * @param $orderId
     * @param $userId
     * @param int $orderType
     * @return false|int
     */
    public function add($prepayId, $orderId, $userId, $orderType = OrderTypeEnum::MASTER)
    {
        return $this->save([
            'prepay_id' => $prepayId,
            'order_id' => $orderId,
            'order_type' => $orderType,
            'user_id' => $userId,
            'can_use_times' => 0,
            'used_times' => 0,
            'expiry_time' => time() + (7 * 86400),
            'wxapp_id' => self::$wxapp_id,
        ]);
    }

}
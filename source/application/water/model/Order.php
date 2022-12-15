<?php

namespace app\water\model;
use app\common\model\water\Goods as WGoods;
use app\common\model\water\Order as WOrder;

/**
 * 订单模型
 */
class Order extends WOrder
{
    /**
     * 获取商品信息
     * @param $value
     * @param $data
     * @return array
     * @throws \think\Exception
     */
    public function getGoodsAttr($value, $data)
    {
        return WGoods::detail($data['gid'])->toArray();
    }

    public function getList($dataType, $query = [])
    {
        // 检索查询条件
        !empty($query) && $this->setWhere($query);
        // 获取数据列表
        return $this
            ->where($this->transferDataType($dataType))
            ->order(['create_time' => 'desc'])
            ->paginate(10, false, [
                'query' => \request()->request()
            ])
            ->append(['goods']);
    }

    /**
     * 根据查询类型返回条件
     * @param $dataType
     * @return array|int[]
     */
    private function transferDataType($dataType)
    {
        // 数据类型
        $filter = [];
        switch ($dataType) {
            case 'delivery':
                $filter = [
                    'is_payment' => 1,
                    'is_dispatch' => 0,
                ];
                break;
            case 'pay':
                $filter = ['is_payment' => 0];
                break;
            case 'receipt':
                $filter = [
                    'is_payment' => 1,
                    'is_dispatch' => 1,
                    'is_receipt' => 0,
                ];
                break;
            case 'complete':
                $filter = [
                    'is_payment' => 1,
                    'is_dispatch' => 1,
                    'is_receipt' => 1,
                ];
                break;
            case 'all':
                $filter = [];
                break;
        }
        return $filter;
    }

    public function edit($id)
    {
        return $this->where('id',$id)->update(['is_dispatch'=>1,'dispatch_time'=>time()]);
    }

    public function getUserTotal($day)
    {
        if (!is_null($day)) {
            $startTime = strtotime($day);
            $this->where('payment_time', '>=', $startTime)
                ->where('payment_time', '<', $startTime + 86400);
        }
        return $this->where('is_payment', '=', '1')->group('uid')->count();
    }

    /**
     * 获取已付款订单总数 (可指定某天)
     * @param null $day
     * @return int|string
     * @throws \think\Exception
     */
    public function getPayOrderTotal($day = null)
    {
        $filter = [
            'is_payment' => 1,
        ];
        if (!is_null($day)) {
            $startTime = strtotime($day);
            $filter['payment_time'] = [
                ['>=', $startTime],
                ['<', $startTime + 86400],
            ];
        }
        return $this->getOrderTotal($filter);
    }

    /**
     * 获取订单总数量
     * @param array $filter
     * @return int|string
     * @throws \think\Exception
     */
    public function getOrderTotal($filter = [])
    {
        return $this->where($filter)
            ->count();
    }

    /**
     * 获取某天的总销售额
     * @param $day
     * @return float|int
     */
    public function getOrderTotalPrice($day)
    {
        $startTime = strtotime($day);
        return $this->where('payment_time', '>=', $startTime)
            ->where('payment_time', '<', $startTime + 86400)
            ->where('is_payment', '=', 1)
            ->sum('total_price');
    }

    /**
     * 获取某天的下单用户数
     * @param $day
     * @return float|int
     */
    public function getPayOrderUserTotal($day)
    {
        $startTime = strtotime($day);
        $userIds = $this->distinct(true)
            ->where('payment_time', '>=', $startTime)
            ->where('payment_time', '<', $startTime + 86400)
            ->where('is_payment', '=', 1)
            ->column('uid');
        return count($userIds);
    }
}
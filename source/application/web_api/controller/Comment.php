<?php

namespace app\web_api\controller;

use app\web_api\model\Comment as CommentModel;

/**
 * 商品评价控制器
 * Class Comment
 * @package app\web_api\controller
 */
class Comment extends Controller
{
    /**
     * 商品评价列表
     * @param $goods_id
     * @param int $scoreType
     * @return array
     * @throws \think\exception\DbException
     */
    public function lists($goods_id, $scoreType = -1)
    {
        $model = new CommentModel;
        $list = $model->getGoodsCommentList($goods_id, $scoreType);
        $total = $model->getTotal($goods_id);
        return $this->renderSuccess(compact('list', 'total'));
    }

}
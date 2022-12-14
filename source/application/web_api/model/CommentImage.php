<?php

namespace app\web_api\model;

use app\common\model\CommentImage as CommentImageModel;

/**
 * 商品图片模型
 * Class GoodsImage
 * @package app\web_api\model
 */
class CommentImage extends CommentImageModel
{
    /**
     * 隐藏字段
     * @var array
     */
    protected $hidden = [
        'wxapp_id',
        'create_time',
    ];

}

<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/12/1 15:50
 */


namespace app\store\model;

use app\common\model\HsArea as HsAreaModel;

/**
 * 商圈模型
 * Class HsArea
 * @package app\store\model
 */
class HsArea extends HsAreaModel
{
    public function getList()
    {
        return $this
            ->order(['create_time' => 'desc'])
            ->paginate(15, false, [
                'query' => \request()->request()
            ]);
    }
}
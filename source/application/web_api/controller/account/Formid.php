<?php

namespace app\web_api\controller\account;

use app\web_api\controller\Controller;
use app\web_api\model\account\Formid as FormidModel;

/**
 * form_id 管理
 * Class Formid
 * @package app\web_api\controller\wxapp
 */
class Formid extends Controller
{
    /**
     * 新增form_id
     * @param $formId
     * @return array
     * @throws \app\common\exception\BaseException
     * @throws \think\exception\DbException
     */
    public function save($formId)
    {
        if (!$user = $this->getUser(false)) {
            return $this->renderSuccess();
        }
        if (FormidModel::add($user['user_id'], $formId)) {
            return $this->renderSuccess();
        }
        return $this->renderError();
    }

}
<?php


namespace app\store\controller\dictionaries\required;

use app\store\controller\Controller;
use app\store\model\Subway as SubwayModel;

/**
 * 地铁管理
 * Class Subway
 * @package app\store\controller\store
 */
class Subway extends Controller
{
    /**
     * 地铁列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $model = new SubwayModel;
        $list = $model->getList($this->request->param());
        if (!empty($list)) {
            foreach ($list as &$v) {
                $v['sitenum'] = $model->where(['fid' => $v['id']])->count();
            }
            unset($v);
        }
        return $this->fetch('index', compact('list'));
    }
    

    /**
     * 添加地铁
     * @return array|bool|mixed
     * @throws \Exception
     */
    public function add()
    {
        $model = new SubwayModel;
        if (!$this->request->isAjax()) {
            $fid = $this->request->param('fid') ? $this->request->param('fid') : '';
            if (!empty($fid)) {
                $parent = $model::detail($fid);
                return $this->fetch('add', compact('parent'));
            }
            return $this->fetch('add');
        }
        // 新增记录
        if ($model->add($this->postData('subway'))) {
            return $this->renderSuccess('添加成功', url('dictionaries.required.subway/index'));
        }
        return $this->renderError($model->getError() ?: '添加失败');
    }

    /**
     * 编辑地铁
     * @param $id
     * @return array|bool|mixed
     * @throws \think\exception\DbException
     */
    public function edit($id)
    {
        // 地铁详情
        $model = SubwayModel::detail($id);
        if (!$this->request->isAjax()) {
            $fid = $this->request->param('fid') ? $this->request->param('fid') : '';
            if (!empty($fid)) {
                $parent = $model::detail($fid);
                return $this->fetch('edit', compact('model', 'parent'));
            }
            return $this->fetch('edit', compact('model'));
        }
        // 新增记录
        if ($model->edit($this->postData('subway'))) {
            return $this->renderSuccess('更新成功', url('dictionaries.required.subway/index'));
        }
        return $this->renderError($model->getError() ?: '更新失败');
    }

    /**
     * 删除地铁
     * @param $id
     * @return array
     * @throws \think\exception\DbException
     */
    public function delete($id)
    {
        // 地铁详情
        $model = SubwayModel::detail($id);
        if (!$model->setDelete()) {
            return $this->renderError($model->getError() ?: '删除失败');
        }
        return $this->renderSuccess('删除成功');
    }

    /**
     * 地铁站点列表
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function sitelist($id)
    {
        $model = new SubwayModel;
        $list = $model->getSiteList($id);
        return $this->fetch('sitelist', compact('list'));
    }

}
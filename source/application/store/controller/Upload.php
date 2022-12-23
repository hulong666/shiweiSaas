<?php

namespace app\store\controller;

use app\store\model\UploadFile;
use app\common\library\storage\Driver as StorageDriver;
use app\store\model\Setting as SettingModel;

/**
 * 文件库管理
 * Class Upload
 * @package app\store\controller
 */
class Upload extends Controller
{
    private $config;

    /**
     * 构造方法
     * @throws \app\common\exception\BaseException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function _initialize()
    {
        parent::_initialize();
        // 存储配置信息
        $this->config = SettingModel::getItem('storage');
    }

    /**
     * 图片上传接口
     * @param int $group_id
     * @return array
     * @throws \think\Exception
     */
    public function image($group_id = -1)
    {
        // 实例化存储驱动
        $StorageDriver = new StorageDriver($this->config);
        // 设置上传文件的信息
        $StorageDriver->setUploadFile('iFile');
        // 上传图片
        if (!$StorageDriver->upload()) {
            return json(['code' => 0, 'msg' => '图片上传失败' . $StorageDriver->getError()]);
        }

        // 图片上传路径
        $fileName = $StorageDriver->getFileName();
        // 图片信息
        $fileInfo = $StorageDriver->getFileInfo();
        // 添加文件库记录
        $uploadFile = $this->addUploadFile($group_id, $fileName, $fileInfo, 'image');
        // 图片上传成功
        return json(['code' => 1, 'msg' => '图片上传成功', 'data' => $uploadFile]);
    }

    /**
     * 图片上传接口
     * @param int $group_id
     * @return \think\response\Json
     */
    public function video($group_id = -1)
    {
        set_time_limit(0);
        //获取上传文件
        $data = $this->request->file('video');
        //设置保存规则 - default(不需要时间文件夹，直接保存在uploads/video下面)
        $data->rule('default');
        $info = $data->move(WEB_PATH . 'uploads' . DS . 'video');
        if ($info) {
            // 成功上传后 获取上传信息
            // 输出42a79759f284b767dfcb2a0197904287.jpg
            $path = 'video/' . str_replace("\\", "/", $info->getSaveName());
            $arr = ['code' => 1, 'msg' => '文件上传成功', 'data' => ['src' => $path]];
            // 添加文件库记录
            $uploadFile = $this->addUploadFile($group_id, $path, $info->getInfo(), $info->getInfo()['type'],'video');
            return json($arr);
        } else {
            $arr = ['code' => -1, 'msg' => '文件上传失败'];
            return json($arr);
        }
    }

    /**
     * 添加文件库上传记录
     * @param $group_id
     * @param $fileName
     * @param $fileInfo
     * @param $fileType
     * @return UploadFile
     */
    private function addUploadFile($group_id, $fileName, $fileInfo, $fileType)
    {
        // 存储引擎
        $storage = $this->config['default'];
        // 存储域名
        $fileUrl = isset($this->config['engine'][$storage]['domain'])
            ? $this->config['engine'][$storage]['domain'] : '';
        // 添加文件库记录
        $model = new UploadFile;
        $model->add([
            'group_id' => $group_id > 0 ? (int)$group_id : 0,
            'storage' => $storage,
            'file_url' => $fileUrl,
            'file_name' => $fileName,
            'file_size' => $fileInfo['size'],
            'file_type' => $fileType,
            'extension' => pathinfo($fileInfo['name'], PATHINFO_EXTENSION),
        ]);
        return $model;
    }

}

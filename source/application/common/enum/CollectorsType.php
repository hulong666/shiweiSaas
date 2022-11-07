<?php
/**
 * Created by PhpStorm.
 * User: ZS
 * Date: 2022/11/7 13:50
 */


namespace app\common\enum;

/**
 * 催收渠道设置
 * Class CollectorsType
 * @package app\common\enum
 */
class CollectorsType extends EnumBasics
{
    // 短信催收
    const MESSAGE = 10;

    // 公众号催收
    const ACCOUNT = 20;

    // 小程序催收
    const APPLETS = 30;
    /**
     * 获取枚举数据
     * @return array
     */
    public static function data()
    {
        return [
            self::MESSAGE => [
                'name' => '短信催收',
                'value' => self::MESSAGE,
            ],
            self::ACCOUNT => [
                'name' => '公众号催收',
                'value' => self::ACCOUNT,
            ],
            self::APPLETS => [
                'name' => '小程序催收',
                'value' => self::APPLETS,
            ],
        ];
    }
}
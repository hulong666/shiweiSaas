<?php

use app\common\enum\TopType as TopTypeEnum;
use app\common\enum\HomeType as HomeTypeEnum;

?>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">房东界面设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 房东顶部菜单设置 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (TopTypeEnum::data() as $item): ?>
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="landlord[top][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['top']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                    <div class="help-block">
                                        <small>注：租客在线缴费至少选择一个</small>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 房东首页菜单设置 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (HomeTypeEnum::data() as $item): ?>
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="landlord[home][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['home']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                    <div class="help-block">
                                        <small>注：租客在线缴费至少选择一个</small>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
</script>

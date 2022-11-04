<?php

use app\common\enum\PaymentType as PaymentTypeEnum;
use app\common\enum\ServiceType as ServiceTypeEnum;
use app\common\enum\IntelligentType as IntelligentTypeEnum;

?>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">租客界面设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 租客在线缴费设置 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (PaymentTypeEnum::data() as $item): ?>
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="tenant[payment_type][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['payment_type']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                    <div class="help-block">
                                        <small>注：租客在线缴费至少选择一个</small>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 租客在线服务设置 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (ServiceTypeEnum::data() as $item): ?>
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="tenant[service_type][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['service_type']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 租客智能管理设置 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (IntelligentTypeEnum::data() as $item): ?>
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="tenant[intelligent_type][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['intelligent_type']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">
                                    租客端水电单价的显示
                                </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="tenant[hydroelectricity_type]" value="1"
                                               data-am-ucheck
                                            <?= $values['hydroelectricity_type'] == '1' ? 'checked' : '' ?>
                                               required>
                                        显示单价
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="tenant[hydroelectricity_type]" value="0"
                                               data-am-ucheck
                                            <?= $values['hydroelectricity_type'] == '0' ? 'checked' : '' ?>>
                                        不显示单价
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">
                                    租客在线报修上传视频
                                </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="tenant[upload_video_type]" value="1"
                                               data-am-ucheck
                                            <?= $values['upload_video_type'] == '1' ? 'checked' : '' ?>
                                               required>
                                        允许
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="tenant[upload_video_type]" value="0"
                                               data-am-ucheck
                                            <?= $values['upload_video_type'] == '0' ? 'checked' : '' ?>>
                                        不允许
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">
                                    租客管家显示设置
                                </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="tenant[upload_video_type]" value="1"
                                               data-am-ucheck
                                            <?= $values['upload_video_type'] == '1' ? 'checked' : '' ?>
                                               required>
                                        管家
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="tenant[upload_video_type]" value="0"
                                               data-am-ucheck
                                            <?= $values['upload_video_type'] == '0' ? 'checked' : '' ?>>
                                        出房业务员
                                    </label>
                                </div>
                                <label class="am-u-sm-3 am-form-label form-require">
                                    提醒
                                </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="tenant[housekeeper_content]" maxlength="40"
                                           value="<?= $values['housekeeper_content'] ?>">
                                    <small>可输入一些给租客的提醒，限制字数40字 如：管家服务时间9：00-18：00</small>
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

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
                                <div class="widget-title am-fl">租客/房东微信登录设置</div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">
                                    租客微信登录设置
                                </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="wx_login[tenant_login]" value="1"
                                               data-am-ucheck
                                            <?= $values['tenant_login'] == '1' ? 'checked' : '' ?>
                                               required>
                                        身份证后六位登录
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="wx_login[tenant_login]" value="0"
                                               data-am-ucheck
                                            <?= $values['tenant_login'] == '0' ? 'checked' : '' ?>>
                                        短信验证码登录
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require">
                                    房东微信登录设置
                                </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="wx_login[landlord_login]" value="1"
                                               data-am-ucheck
                                            <?= $values['landlord_login'] == '1' ? 'checked' : '' ?>
                                               required>
                                        身份证后六位登录
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="wx_login[landlord_login]" value="0"
                                               data-am-ucheck
                                            <?= $values['landlord_login'] == '0' ? 'checked' : '' ?>>
                                        短信验证码登录
                                    </label>
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

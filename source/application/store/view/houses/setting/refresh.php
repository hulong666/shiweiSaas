<?php

use app\common\enum\RefreshType as RefreshTypeEnum;

?>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">刷新设置</div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 花费类型 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (RefreshTypeEnum::data() as $item): ?>
                                        <label class="am-radio-inline">
                                            <input type="radio" name="refresh[collectors_type][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['collectors_type']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                    <div class="help-block">
                                        <small>注：花费类型至少选择一个</small>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group" id="type10"
                                 style="display: <?= in_array(10, $values['collectors_type']) ? 'block' : 'none' ?>">
                                <label class="am-u-sm-3 am-form-label form-require"> 花费积分 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="refresh[integral_consume]"
                                           value="<?= $values['integral_consume'] ?>" required>
                                </div>
                            </div>

                            <div id="type20"
                                 style="display: <?= in_array(20, $values['collectors_type']) ? 'block' : 'none' ?>">
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label form-require"> 花费余额 </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="refresh[balance_consume]"
                                               value="<?= $values['balance_consume'] ?>" required>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label form-require"> 积分可抵扣(%) </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="refresh[integral_deduction]"
                                               value="<?= $values['integral_deduction'] ?>" required>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label class="am-u-sm-3 am-form-label form-require"> x积分抵扣一元 </label>
                                    <div class="am-u-sm-9">
                                        <input type="text" class="tpl-form-input" name="refresh[integral_number]"
                                               value="<?= $values['integral_number'] ?>" required>
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

        $('input[type=radio][name="refresh[collectors_type][]"]').change(function () {
            if (this.value == '10') {
                $("#type20").hide(1000);
                $("#type10").show(1000);
            } else if (this.value == '20') {
                $("#type10").hide(1000);
                $("#type20").show(1000);
            }
        });
    });
</script>

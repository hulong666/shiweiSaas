<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">置顶设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 置顶多少天 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="topping[days]"
                                           value="<?= $values['days'] ?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 金额 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="topping[money]"
                                           value="<?= $values['money'] ?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 优惠价 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="topping[concessional]"
                                           value="<?= $values['concessional'] ?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> x积分抵扣一元 </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="topping[integral_number]"
                                           value="<?= $values['integral_number'] ?>" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 积分可抵扣(%) </label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" name="topping[integral_deduction]"
                                           value="<?= $values['integral_deduction'] ?>" required>
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

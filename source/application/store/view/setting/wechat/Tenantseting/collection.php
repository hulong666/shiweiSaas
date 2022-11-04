<?php

use app\common\enum\TenantBillType as TenantBillTypeEnum;

?>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">在线收款设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 在线收租手续费设置 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[rent_collection]" value="1"
                                               data-am-ucheck
                                            <?= $values['rent_collection'] == '1' ? 'checked' : '' ?>
                                               required>
                                        公司承担手续费
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[hydroelectricity_type]" value="0"
                                               data-am-ucheck
                                            <?= $values['rent_collection'] == '0' ? 'checked' : '' ?>>
                                        租客承担手续费
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 租客房租&欠费缴费设置 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[arrears]" value="1"
                                               data-am-ucheck
                                            <?= $values['arrears'] == '1' ? 'checked' : '' ?>
                                               required>
                                        单笔缴费【房租&欠款各缴各】
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[arrears]" value="0"
                                               data-am-ucheck
                                            <?= $values['arrears'] == '0' ? 'checked' : '' ?>>
                                        合并缴费【房租&欠款可同时缴】
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 租客房租押金支付顺序设置 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[order_payment]" value="1"
                                               data-am-ucheck
                                            <?= $values['order_payment'] == '1' ? 'checked' : '' ?>
                                               required>
                                        按账单顺序支付
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[arrears]" value="0"
                                               data-am-ucheck
                                            <?= $values['order_payment'] == '0' ? 'checked' : '' ?>>
                                        不按账单顺序支付
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-hydroelectricity"> 集中水电后付费收款方式 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[hydroelectricity]" value="1"
                                               data-am-ucheck
                                            <?= $values['order_payment'] == '1' ? 'checked' : '' ?>
                                               required>
                                        单笔缴费【水电&气费各缴各】
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[hydroelectricity]" value="0"
                                               data-am-ucheck
                                            <?= $values['hydroelectricity'] == '0' ? 'checked' : '' ?>>
                                        合并缴费【水电&气费同时缴费】
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-hydroelectricity"> 集中房租&水电费合并缴费设置 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[rent]" value="1"
                                               data-am-ucheck
                                            <?= $values['rent'] == '1' ? 'checked' : '' ?>
                                               required>
                                        单笔缴费【房租&水电各缴各】
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[rent]" value="0"
                                               data-am-ucheck
                                            <?= $values['rent'] == '0' ? 'checked' : '' ?>>
                                        合并缴费【房租&水电可同时缴】
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 租客账单支付设置 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (TenantBillTypeEnum::data() as $item): ?>
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="collection[tenant][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['tenant']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-hydroelectricity"> 租客支付账单缴费设置 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[autonomy]" value="1"
                                               data-am-ucheck
                                            <?= $values['autonomy'] == '1' ? 'checked' : '' ?>
                                               required>
                                        强制缴费【租客不可选缴费选项】
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collection[autonomy]" value="0"
                                               data-am-ucheck
                                            <?= $values['autonomy'] == '0' ? 'checked' : '' ?>>
                                        自主缴费【租客可选缴费选项】
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

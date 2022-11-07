<?php

use app\common\enum\CollectorsType as CollectorsTypeEnum;

?>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">给房东开发租客信息设置</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 催收渠道设置 </label>
                                <div class="am-u-sm-9">
                                    <?php foreach (CollectorsTypeEnum::data() as $item): ?>
                                        <label class="am-checkbox-inline">
                                            <input type="checkbox" name="collectors[collectors_type][]"
                                                   value="<?= $item['value'] ?>" data-am-ucheck
                                                <?= in_array($item['value'], $values['collectors_type']) ? 'checked' : '' ?>>
                                            <?= $item['name'] ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-form-label form-require"> 催收频率设置 </label>
                                <div class="am-u-sm-9">
                                    <label class="am-checkbox-inline">
                                        <input type="checkbox" name="collectors[repeat_type][]"
                                               value="10" data-am-ucheck
                                            <?= in_array(10, $values['repeat_type']) ? 'checked' : '' ?>>
                                        以下最后一次提醒后仍未完成，每日提醒1次
                                    </label>
                                    <br>
                                    <label class="am-radio-inline">
                                        应收时间
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collectors[time]" value="1"
                                               data-am-ucheck
                                            <?= $values['time'] == '1' ? 'checked' : '' ?>
                                               required>
                                        前
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="collectors[time]" value="0"
                                               data-am-ucheck
                                            <?= $values['time'] == '0' ? 'checked' : '' ?>
                                               required>
                                        后
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="text" name="collectors[days]"
                                               value="<?= $values['days'] ?>"
                                               data-am-ucheck
                                               required>
                                    </label>
                                    <label>
                                        天提醒1次
                                    </label>
                                    <div>
                                        <small>系统每日早9点依据设置规则向租客推送催收提醒</small>
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

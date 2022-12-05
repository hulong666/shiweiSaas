<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">编辑标签</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">标签名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="label[labelname]"
                                           value="<?= $model['labelname'] ?>" placeholder="请输入标签名称" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">标签类型 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="label[type]" data-am-selected="{btnSize: 'sm'}">
                                        <option value="1" <?= $model['type'] == 1 ? 'selected' : '' ?>> 写字楼</option>
                                        <option value="2" <?= $model['type'] == 2 ? 'selected' : '' ?>> 住宅</option>
                                    </select>
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

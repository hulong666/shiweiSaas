<div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <form id="my-form" class="am-form tpl-form-line-form" method="post">
                <div class="widget-body">
                    <fieldset>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">新增用户</div>
                        </div>
                        <div class="am-form-group am-padding-top-sm">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 用户账户名 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="text" class="tpl-form-input" name="user_name" value=""
                                       required>
                                <small>用户后台用户名</small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 用户账户密码 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="password" class="tpl-form-input" name="password" value=""
                                       required>
                                <small>用户后台用户密码</small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 确认密码 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="password" class="tpl-form-input" name="password_confirm" value=""
                                       required>
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
<script src="assets/common/plugins/laydate/laydate.js"></script>
<script src="assets/admin/js/select.region.js"></script>
<script>
    /**
     * 设置坐标
     */
    function setCoordinate(value) {
        var $coordinate = $('#coordinate');
        $coordinate.val(value);
        // 触发验证
        $coordinate.trigger('change');
    }
    // 日期选择器
    laydate.render({
        elem: '.j-laydate-start'
        , type: 'date'
    });
</script>
<script>
    $(function () {

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
</script>

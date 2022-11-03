<div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <form id="my-form" class="am-form tpl-form-line-form" method="post">
                <div class="widget-body">
                    <fieldset>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">新增用户</div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 用户名称 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="text" class="tpl-form-input" name="store[store_name]" value=""
                                       required>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">排序 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="number" min="0" class="tpl-form-input" name="store[sort]" value="100"
                                       required>
                                <small>数字越小越靠前</small>
                            </div>
                        </div>
                        <div class="am-form-group am-padding-top-sm">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 用户账户名 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="text" class="tpl-form-input" name="store[user_name]" value=""
                                       required>
                                <small>用户后台用户名</small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 用户账户密码 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="password" class="tpl-form-input" name="store[password]" value=""
                                       required>
                                <small>用户后台用户密码</small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 确认密码 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="password" class="tpl-form-input" name="store[password_confirm]" value=""
                                       required>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 联系方式 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="text" class="tpl-form-input" name="store[mobile]" value=""
                                       required>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 类型 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <label class="am-radio-inline">
                                    <input type="radio" name="store[house_type]" value="1" data-am-ucheck
                                           checked>
                                    写字楼
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="store[house_type]" value="2" data-am-ucheck>
                                    住宅
                                </label>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 区域 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <div class="x-region-select" data-region-selected>
                                    <select name="store[province_id]" data-province required>
                                        <option value="">请选择省份</option>
                                    </select>
                                    <select name="store[city_id]" data-city required>
                                        <option value="">请选择城市</option>
                                    </select>
                                    <select name="store[region_id]" data-region required>
                                        <option value="">请选择地区</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label"> 公司名称 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="text" class="tpl-form-input" name="store[company_name]" value="">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label"> 公司地址 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <input type="text" class="tpl-form-input" name="store[company_address]" value="">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 是否付费 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <label class="am-radio-inline">
                                    <input type="radio" name="store[is_pay]" value="0" data-am-ucheck
                                           checked>
                                    否
                                </label>
                                <label class="am-radio-inline">
                                    <input type="radio" name="store[is_pay]" value="1" data-am-ucheck>
                                    是
                                </label>
                            </div>
                        </div>
                        <div class="am-form-group am-padding-top">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 到期时间 </label>
                            <div class="am-u-sm-9 am-u-md-6 am-u-lg-5 am-u-end">
                                <input type="text" class="j-laydate-start am-form-field"
                                       name="store[expire_time]"
                                       value="<?= date('Y-m-d') ?>"
                                       placeholder="点击选择日期"
                                       required>
                                <div class="help-block">
                                    <small>注：到期后不能登录</small>
                                </div>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">所属角色 </label>
                            <div class="am-u-sm-9 am-u-end">
                                <select name="user[role_id][]" multiple data-am-selected="{btnSize: 'sm'}">
                                    <?php if (isset($roleList)): foreach ($roleList as $role): ?>
                                        <option value="<?= $role['role_id'] ?>"> <?= $role['role_name_h1'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <div class="help-block">
                                    <small>注：支持多选</small>
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

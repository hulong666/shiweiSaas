<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">收入成本</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form class="toolbar-form" action="">
                            <input type="hidden" name="s" value="/<?= $request->pathinfo() ?>">
                            <div class="am-u-sm-12 am-u-md-9 am-u-sm-push-3" style="width: 100%;left: 0">
                                <div class="am fr">
                                    <div class="am-form-group am-fl">
                                        <?php $city = $request->get('city'); ?>
                                        <select name="city"
                                                data-am-selected="{btnSize: 'sm', placeholder: '请选择城市'}">
                                            <option value=""></option>
                                            <option value="-1">全部</option>
                                            <?php foreach ($cityList as $item): ?>
                                                <option value="<?= $item['city'] ?>"
                                                    <?= $city == $item['city'] ? 'selected' : '' ?>><?= $item['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <?php $region = $request->get('region'); ?>
                                        <select name="region"
                                                data-am-selected="{btnSize: 'sm', placeholder: '请选择区域'}">
                                            <option value=""></option>
                                            <option value="-1">全部</option>
                                            <?php foreach ($regionList as $item): ?>
                                                <option value="<?= $item['region'] ?>"
                                                    <?= $region == $item['region'] ? 'selected' : '' ?>><?= $item['name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <?php $property_address = $request->get('property_address'); ?>
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" name="property_address"
                                                   placeholder="请输入物业地址"
                                                   value="<?= $property_address ?>">
                                            <div class="am-input-group-btn">
                                                <button class="am-btn am-btn-default am-icon-search"
                                                        type="submit"></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>城市</th>
                                <th>区域</th>
                                <th>物业地址</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['city']['name'] ?></td>
                                    <td class="am-text-middle"><?= $item['region']['name'] ?></td>
                                    <td class="am-text-middle" style="max-width: 200px">
                                        <div style="display: flex;flex-wrap: wrap">
                                            <?php foreach ($item['property_address']['value'] as $k => $r): ?>
                                                <span style="display: block;width: 80px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;margin: 2px 4px;"
                                                      class="layui-badge-rim"><?= $r ?></span>
                                            <?php endforeach;?>
                                        </div>
                                    </td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (checkPrivilege('dictionaries.required.regionalproperty/edit')): ?>
                                                <a class="j-recharge tpl-table-black-operation-default"
                                                   href="javascript:void(0);"
                                                   title="编辑"
                                                   data-id="<?= $item['id'] ?>"
                                                   data-city_id="<?= $item['city']['id'] ?>"
                                                   data-region_id="<?= $item['region']['id'] ?>"
                                                   data-address="<?= $item['property_address']['text'] ?>"
                                                >
                                                    <i class="iconfont icon-order-o"></i>
                                                    编辑
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="12" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"><?= $list->render() ?> </div>
                        <div class="am-fr pagination-total am-margin-right">
                            <div class="am-vertical-align-middle">总记录：<?= $list->total() ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/common/plugins/layui/layui.js" charset="utf-8"></script>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#test1' //指定元素
        });
    });
</script>
<script>
    $(function () {
        /**
         * 注册操作事件
         * @type {jQuery|HTMLElement}
         */
        var $dropdown = $('.j-opSelect');
        $dropdown.dropdown();
        $dropdown.on('click', 'li a', function () {
            var $this = $(this);
            var id = $this.parent().parent().data('id');
            var type = $this.data('type');
            if (type === 'delete') {
                layer.confirm('删除后不可恢复，确定要删除吗？', function (index) {
                    $.post("index.php?s=/store/apps.dealer.user/delete", {dealer_id: id}, function (result) {
                        result.code === 1 ? $.show_success(result.msg, result.url)
                            : $.show_error(result.msg);
                    });
                    layer.close(index);
                });
            }
            $dropdown.dropdown('close');
        });

        // 删除元素
        var url = "<?= url('user/delete') ?>";
        $('.j-delete').delete('user_id', url, '删除后不可恢复，确定要删除吗？');

    });

</script>


<div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-cf">用户列表</div>
            </div>
            <div class="widget-body am-fr">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                    <div class="am-form-group">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <!--<a class="am-btn am-btn-default am-btn-success am-radius"
                                   href="<?/*= url('water.user/add') */?>">
                                    <span class="am-icon-plus"></span> 新增
                                </a>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>订单号</th>
                            <th>商品</th>
                            <th>数量</th>
                            <th>单价</th>
                            <th>总价</th>
                            <th>创建时间</th>
                            <th>所属账号</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                            <tr>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $item['id'] ?></p>
                                </td>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $item['orderSn'] ?></p>
                                </td>
                                <td class="am-text-middle"><?= $item['goods']['name'] ?></td>
                                <td class="am-text-middle"><?= $item['number'] ?></td>
                                <td class="am-text-middle"><?= $item['price'] ?></td>
                                <td class="am-text-middle"><?= $item['total_price'] ?></td>
                                <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                <td class="am-text-middle"><?= $item['water_user']['user_name'] ?></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4" class="am-text-center">暂无记录</td>
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
<script>
    $(function () {

        // 删除元素
        var url = "<?= url('water.user/recovery') ?>";
        $('.j-delete').delete('water_user_id', url, '确定要删除吗？删除后不可恢复！');

    });
</script>


<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">出售中的商品</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form class="toolbar-form" action="">
                            <input type="hidden" name="s" value="/<?= $request->pathinfo() ?>">
                            <div class="am-u-sm-12 am-u-md-3">
                                <div class="am-form-group">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-success"
                                           href="<?= url('goods/add') ?>">
                                            <span class="am-icon-plus"></span> 新增
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-9">
                                <div class="am fr">
                                    <!--<div class="am-form-group am-fl">
                                        <?php /*$status = $request->get('status') ?: null; */ ?>
                                        <select name="status"
                                                data-am-selected="{btnSize: 'sm', placeholder: '商品状态'}">
                                            <option value=""></option>
                                            <option value="10"
                                                <? /*= $status == 10 ? 'selected' : '' */ ?>>上架
                                            </option>
                                            <option value="20"
                                                <? /*= $status == 20 ? 'selected' : '' */ ?>>下架
                                            </option>
                                        </select>
                                    </div>-->
                                    <div class="am-form-group am-fl">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" name="search"
                                                   placeholder="请输入商品名称"
                                                   value="<?= $request->get('search') ?>">
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
                                <th>订单id</th>
                                <th>订单号</th>
                                <th>下单用户</th>
                                <th>商品</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>总价</th>
                                <th>付款状态</th>
                                <th>付款时间</th>
                                <th>发货状态</th>
                                <th>发货时间</th>
                                <th>收货状态</th>
                                <th>下单时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle">
                                        <p class="item-title"><?= $item['orderSn'] ?></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <p class="item-title"><?= $item['uid'] ?></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <p class="item-title"><?= $item['goods']['name'] ?></p>
                                    </td>
                                    <td class="am-text-middle"><?= $item['price'] ?></td>
                                    <td class="am-text-middle"><?= $item['number'] ?></td>
                                    <td class="am-text-middle"><?= $item['total_price'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if ($item['is_payment'] == 0): ?>
                                            <span class="am-badge am-badge-danger am-radius">待付款</span>
                                        <?php else: ?>
                                            <span class="am-badge am-badge-success am-radius">已付款</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle"><?= $item['payment_time'] ?></td>

                                    <td class="am-text-middle">
                                        <?php if ($item['is_dispatch'] == 0): ?>
                                            <span class="am-badge am-badge-danger am-radius">待派送</span>
                                        <?php else: ?>
                                            <span class="am-badge am-badge-success am-radius">已派送</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle"><?= $item['dispatch_time'] ?></td>

                                    <td class="am-text-middle">
                                        <?php if ($item['is_receipt'] == 0): ?>
                                            <span class="am-badge am-badge-danger am-radius">待收货</span>
                                        <?php else: ?>
                                            <span class="am-badge am-badge-success am-radius">已收货</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>

                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if ($item['is_dispatch'] == 0): ?>
                                            <a href="javascript:void(0);" class="j-state"
                                               data-id="<?= $item['id'] ?>">
                                                <i class="am-icon-pencil"></i> 派送
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="9" class="am-text-center">暂无记录</td>
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
<script>
    $(function () {

        // 删除元素
        var url = "<?= url('goods/delete') ?>";
        $('.item-delete').delete('goods_id', url);

        // 评论显示状态
        $('.j-state').click(function () {
            var data = $(this).data();
            layer.confirm('确定改订单已派送吗？' , {title: '友情提示'}
                , function (index) {
                    $.post("<?= url('order/edit') ?>", {
                        id: data.id,
                    }, function (result) {
                        result.code === 1 ? $.show_success(result.msg, result.url)
                            : $.show_error(result.msg);
                    });
                    layer.close(index);
                });
        });
    });
</script>


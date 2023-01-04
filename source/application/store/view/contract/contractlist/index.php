<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">合同列表</div>
                </div>
                <div class="widget-body am-fr">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="am-form-group">

                        </div>
                    </div>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>签约租户</th>
                                <th>房源</th>
                                <th>合同种类</th>
                                <th>模板名称</th>
                                <th>业务类型</th>
                                <th>合同对象</th>
                                <th>合同状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['user']['realName'] ?></td>
                                    <td class="am-text-middle">
                                        <?= $item['type']['text'] ?>(id：<?= $item['fid'] ?>)
                                    </td>
                                    <td class="am-text-middle"><?= $item['contract_type']['text'] ?></td>
                                    <td class="am-text-middle"><?= $item['template_ame'] ?></td>
                                    <td class="am-text-middle"><?= $item['business_type']['text'] ?></td>
                                    <td class="am-text-middle"><?= $item['contract']['text'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if ($item['is_out'] == 1): ?>
                                            <span class="am-badge am-badge-danger"> 退租 </span>
                                        <?php elseif($item['expire'] == '到期'): ?>
                                            <span class="am-badge am-badge-secondary"><?= $item['expire'] ?></span>
                                        <?php else: ?>
                                            <span class="am-badge am-badge-success"><?= $item['expire'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (checkPrivilege('contract.contractlist/preview')): ?>
                                                <a href="<?= url('contract.contractlist/preview',
                                                    ['id' => $item['id']]) ?>">
                                                    <i class="am-icon-eye"></i> 预览
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="7" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {

        // 删除元素
        $('.item-delete').delete('id', "<?= url('houses.residence/delete') ?>");

        $('.item-frame').click(function () {
            var data = $(this).data();
            layer.confirm('确定要已处理该举报吗？', {title: '友情提示'}
                , function (index) {
                    $.post("<?= url('houses.report/edit') ?>", {
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


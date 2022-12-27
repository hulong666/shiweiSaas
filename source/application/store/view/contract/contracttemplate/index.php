<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">模板列表</div>
                </div>
                <div class="widget-body am-fr">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="am-form-group">
                            <div class="am-btn-toolbar">
                                <?php if (checkPrivilege('contract.contracttemplate/add')): ?>
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-success am-radius"
                                           href="<?= url('contract.contracttemplate/add')  ?>">
                                            <span class="am-icon-plus"></span> 新增
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>合同种类</th>
                                <th>模板名称</th>
                                <th>业务类型</th>
                                <th>合同对象</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['contract_type']['text'] ?></td>
                                    <td class="am-text-middle"><?= $item['template_ame'] ?></td>
                                    <td class="am-text-middle"><?= $item['business_type']['text'] ?></td>
                                    <td class="am-text-middle"><?= $item['contract']['text'] ?></td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (checkPrivilege('contract.contracttemplate/preview')): ?>
                                                <a href="<?= url('contract.contracttemplate/preview',
                                                    ['id' => $item['id']]) ?>">
                                                    <i class="am-icon-eye"></i> 预览
                                                </a>
                                            <?php endif; ?>
                                            <?php if (checkPrivilege('contract.contracttemplate/edit')): ?>
                                                <a href="<?= url('contract.contracttemplate/edit',
                                                    ['id' => $item['id']]) ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                            <?php endif; ?>
                                            <?php if (checkPrivilege('contract.contracttemplate/copy')): ?>
                                                <a href="<?= url('contract.contracttemplate/copy',
                                                    ['id' => $item['id']]) ?>">
                                                    <i class="am-icon-copy"></i> 复制
                                                </a>
                                            <?php endif; ?>
                                            <?php if (checkPrivilege('contract.contracttemplate/delete')): ?>
                                                <a href="javascript:;" class="item-delete tpl-table-black-operation-del"
                                                   data-id="<?= $item['id'] ?>">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6" class="am-text-center">暂无记录</td>
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
        $('.item-delete').delete('id', "<?= url('contract.contracttemplate/delete') ?>");

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


<div class="row">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
        <div class="widget am-cf">
            <div class="widget-head am-cf">
                <div class="widget-title am-cf"> <?= $name ?> 商城角色列表</div>
            </div>
            <div class="widget-body am-fr">
                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                    <div class="am-form-group">
                        <div class="am-btn-toolbar">
                            <div class="am-btn-group am-btn-group-xs">
                                <a class="am-btn am-btn-default am-btn-success am-radius"
                                   href="<?= url('store/storeadd',['wxapp_id'=>$wxapp_id]) ?>">
                                    <span class="am-icon-plus"></span> 新增
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                        <thead>
                        <tr>
                            <th>角色ID</th>
                            <th>角色名称</th>
                            <th>排序</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (!empty($list)): foreach ($list as $item): ?>
                            <tr>
                                <td class="am-text-middle"><?php echo $item['role_id'] ?></td>
                                <td class="am-text-middle"><?= $item['role_name_h1'] ?></td>
                                <td class="am-text-middle"><?= $item['sort'] ?></td>
                                <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                <td class="am-text-middle">
                                    <div class="tpl-table-black-operation">
                                        <a href="<?= url('store/storeedit', ['role_id' => $item['role_id'],'wxapp_id'=>$wxapp_id]) ?>">
                                            <i class="am-icon-pencil"></i> 编辑
                                        </a>
                                        <a href="javascript:void(0);"
                                           class="item-delete tpl-table-black-operation-del"
                                           data-id="<?= $item['role_id'] ?>">
                                            <i class="am-icon-trash"></i> 删除
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        // 删除元素
        var url = "<?= url('store/storeDelete') ?>";
        $('.item-delete').delete('role_id', url, '删除后不可恢复，确定要删除吗？');

    });
</script>


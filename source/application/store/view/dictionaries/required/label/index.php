<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title a m-cf">标签列表</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form class="toolbar-form" action="">
                            <input type="hidden" name="s" value="/<?= $request->pathinfo() ?>">
                            <div class="am-u-sm-12 am-u-md-3">
                                <div class="am-form-group">
                                    <?php if (checkPrivilege('dictionaries.required.label/add')): ?>
                                        <div class="am-btn-group am-btn-group-xs">
                                            <a class="am-btn am-btn-default am-btn-success"
                                               href="<?= url('dictionaries.required.label/add') ?>">
                                                <span class="am-icon-plus"></span> 新增
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="am-u-sm-12 am-u-md-9">
                                <div class="am fr">
                                    <div class="am-form-group am-fl">
                                        <?php $status = $request->get('type') ?: null; ?>
                                        <select name="type"
                                                data-am-selected="{btnSize: 'sm', placeholder: '标签类型'}">
                                            <option value=""></option>
                                            <option value="1"
                                                <?= $status == 1 ? 'selected' : '' ?>>写字楼
                                            </option>
                                            <option value="2"
                                                <?= $status == 2 ? 'selected' : '' ?>>住宅
                                            </option>
                                        </select>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
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
                                <th>标签ID</th>
                                <th>标签名称</th>
                                <th>标签类型</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($list)): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['labelname'] ?></td>
                                    <td class="am-text-middle">
                                            <span class="am-badge am-badge-<?= $item['type']==1 ? 'success' : 'warning' ?>">
                                               <?= $item['type']==1 ? '写字楼' : '住宅' ?>
                                           </span>
                                    </td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (checkPrivilege('dictionaries.required.label/edit')): ?>
                                                <a href="<?= url('dictionaries.required.label/edit', ['id' => $item['id']]) ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                            <?php endif; ?>
                                            <?php if (checkPrivilege('dictionaries.required.label/delete')): ?>
                                                <a href="javascript:void(0);"
                                                   class="item-delete tpl-table-black-operation-del"
                                                   data-id="<?= $item['id'] ?>">
                                                    <i class="am-icon-trash"></i> 删除
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="5" class="am-text-center">暂无记录</td>
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
        var url = "<?= url('dictionaries.required.label/delete') ?>";
        $('.item-delete').delete('id', url, '删除后不可恢复，确定要删除吗？');

    });
</script>


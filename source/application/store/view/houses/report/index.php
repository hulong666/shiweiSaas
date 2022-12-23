<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">住宅列表</div>
                </div>
                <div class="widget-body am-fr">
                    <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                        <div class="am-form-group">
                            <!--<div class="am-btn-toolbar">
                                <?php /*if (checkPrivilege('houses.office/add')): */ ?>
                                    <div class="am-btn-group am-btn-group-xs">
                                        <a class="am-btn am-btn-default am-btn-success am-radius"
                                           href="<? /*= url('houses.office/add') */ ?>">
                                            <span class="am-icon-plus"></span> 新增
                                        </a>
                                    </div>
                                <?php /*endif; */ ?>
                            </div>-->
                        </div>
                    </div>
                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th width="8%"></th>
                                <th>举报人</th>
                                <th>举报楼房</th>
                                <th>举报内容</th>
                                <th>举报时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle">
                                        <img src="<?= $item['user']['avatarUrl'] ?>" alt="" height="60px">
                                    </td>
                                    <td class="am-text-middle"><?= $item['user']['nickName'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if ($item['type'] == 1) : ?>
                                            <a href="<?= url('houses.office/index') ?>">【楼盘】</a>
                                        <?php else : ?>
                                            <a href="<?= url('houses.residence/index') ?>">【住宅】</a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle">
                                        <p><?= $item['content'] ?></p>
                                    </td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if ($item['state'] == 0) : ?>
                                            未处理
                                        <?php else : ?>
                                            <p>已处理</p>
                                            <p><?= $item['handle_time'] ?></p>
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (checkPrivilege('houses.report/edit')): ?>
                                                <?php if ($item['state'] == 0): ?>
                                                    <a href="javascript:void(0);"
                                                       data-id="<?= $item['id'] ?>"
                                                       class="item-frame"
                                                    >
                                                        已处理
                                                    </a>
                                                <?php endif; ?>
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


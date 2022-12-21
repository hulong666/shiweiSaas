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
                                <th width="15%">图片</th>
                                <th>标题</th>
                                <th>租金</th>
                                <th>房屋信息</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle">
                                        <?php if (count($item['images']) == 0) : ?>
                                            <img src="http://f.vx114.cn/uploads/nopic.png" alt="" height="60">
                                        <?php else : ?>
                                            <img src="<?= $item['images'][0]['url'] ?>" alt="" height="60">
                                        <?php endif; ?>
                                    </td>
                                    <td class="am-text-middle" style="width: 300px;">
                                        <p style="width: 240px;"><?= $item['title'] ?></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <p>租金：<?= $item['rent'] ?>/月</p>
                                        <p>支付方式：<?= $item['pay_type'] ?></p>
                                    </td>
                                    <td class="am-text-middle">
                                        <div style="display: flex">
                                            <div style="margin-right: 30px">
                                                <p>房型：<?= $item['room'] ?>，<?= $item['hall'] ?>
                                                    ，<?= $item['toilet'] ?> </p>
                                                <p>面积：<?= $item['area'] ?>/m²</p>
                                                <p>朝向：<?= $item['orientation'] ?> </p>
                                            </div>
                                            <div>
                                                <p>楼层：<?= $item['floor'] ?>层 </p>
                                                <p>装修：<?= $item['renovation'] ?></p>
                                                <p>物业费：<?= $item['wuye'] ?>/月 </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (checkPrivilege('houses.residence/frame')): ?>
                                                <?php if ($item['status'] == 0): ?>
                                                    <a href="javascript:void(0);"
                                                       data-id="<?= $item['id'] ?>"
                                                       data-status="1"
                                                       class="item-frame"
                                                    >
                                                        上架
                                                    </a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0);"
                                                       data-id="<?= $item['id'] ?>"
                                                       data-status="0"
                                                       class="item-frame tpl-table-black-operation-del">
                                                        下架
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (checkPrivilege('houses.residence/edit')): ?>
                                                <a href="<?= url('houses.residence/edit', ['id' => $item['id']]) ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                            <?php endif; ?>
                                            <?php if (checkPrivilege('houses.residence/delete')): ?>
                                                <a href="javascript:void(0);"
                                                   data-id="<?= $item['id'] ?>"
                                                   class="item-delete tpl-table-black-operation-del">
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
        $('.item-delete').delete('id', "<?= url('houses.residence/delete') ?>");

        $('.item-frame').click(function () {
            var data = $(this).data();
            layer.confirm('确定要' + (parseInt(data.status) == 1 ? '上架' : '下架') + '该条信息吗？', {title: '友情提示'}
                , function (index) {
                    $.post("<?= url('houses.residence/frame') ?>", {
                        id: data.id,
                        status: data.status,
                    }, function (result) {
                        result.code === 1 ? $.show_success(result.msg, result.url)
                            : $.show_error(result.msg);
                    });
                    layer.close(index);
                });
        });
    });
</script>


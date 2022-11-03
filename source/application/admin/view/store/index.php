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
                                <a class="am-btn am-btn-default am-btn-success am-radius"
                                   href="<?= url('store/add') ?>">
                                    <span class="am-icon-plus"></span> 新增
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12">
                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                        <thead>
                        <tr>
                            <th>用户ID</th>
                            <th>用户名称</th>
                            <th>电话</th>
                            <th>公司名称</th>
                            <th>公司地址</th>
                            <th>类型</th>
                            <th>是否购买完整版</th>
                            <th>过期时间</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                            <tr>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $item['wxapp_id'] ?></p>
                                </td>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $names[$item['wxapp_id']] ?></p>
                                </td>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $info[$item['wxapp_id']]['mobile'] ?></p>
                                </td>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $info[$item['wxapp_id']]['company_name'] ?></p>
                                </td>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $info[$item['wxapp_id']]['company_address'] ?></p>
                                </td>
                                <td class="am-text-middle">
                                    <span class="am-badge am-badge-<?= $info[$item['wxapp_id']]['house_type'] == 1 ? 'success' : 'warning' ?>">
                                       <?= $info[$item['wxapp_id']]['house_type'] == 1 ? '写字楼' : '住宅' ?>
                                    </span>
                                </td>
                                <td class="am-text-middle">
                                    <span class="am-badge am-badge-<?= $info[$item['wxapp_id']]['is_pay'] ? 'success' : 'warning' ?>">
                                       <?= $info[$item['wxapp_id']]['is_pay'] ? '是' : '否' ?>
                                    </span>
                                </td>
                                <td class="am-text-middle">
                                    <p class="item-title"><?= $info[$item['wxapp_id']]['expire_time'] ?></p>
                                </td>
                                <td class="am-text-middle"><?= $item['create_time'] ?></td>
                                <td class="am-text-middle">
                                    <div class="tpl-table-black-operation">
                                        <a href="<?= url('store/enter', ['wxapp_id' => $item['wxapp_id']]) ?>"
                                           class="j-move" data-id="<?= $item['wxapp_id'] ?>" target="_blank">
                                            <i class="am-icon-arrow-right"></i> 进入用户后台
                                        </a>
                                        <a href="<?= url('store/storeIndex', ['wxapp_id' => $item['wxapp_id']]) ?>">
                                            <i class="am-icon-pencil"></i> 角色管理
                                        </a>
                                        <a href="<?= url('store/storestaff', ['user_id' => $user_id[$item['wxapp_id']],'wxapp_id'=>$item['wxapp_id']]) ?>">
                                            <i class="am-icon-street-view"></i> 管理员权限
                                        </a>
                                        <a href="javascript:void(0);" class="j-delete tpl-table-black-operation-del"
                                           data-id="<?= $item['wxapp_id'] ?>">
                                            <i class="am-icon-trash"></i> 删除
                                        </a>
                                    </div>
                                </td>
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
        var url = "<?= url('store/recovery') ?>";
        $('.j-delete').delete('wxapp_id', url, '确定要删除吗？可在回收站中恢复');

    });
</script>


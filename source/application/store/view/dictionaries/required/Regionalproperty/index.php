<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">楼盘列表</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->
                    <div class="page_toolbar am-margin-bottom-xs am-cf">
                        <form class="toolbar-form" action="">
                            <input type="hidden" name="s" value="/<?= $request->pathinfo() ?>">
                            <div class="am-u-sm-12 am-u-md-9 am-u-sm-push-3" style="width: 100%;left: 0">
                                <div class="am fr">
                                    <div class="am-form-group am-fl">
                                        <?php if (checkPrivilege('dictionaries.required.regionalproperty/add')): ?>
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a class="am-btn am-btn-default am-btn-success am-radius"
                                                   href="<?= url('dictionaries.required.regionalproperty/add') ?>">
                                                    <span class="am-icon-plus"></span> 新增
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form" data-region-selected>
                                            <select name="province_id" id="province" data-province data-id="<?= $request->get('province_id'); ?>">
                                                <option value="">请选择省份</option>
                                            </select>
                                            <select name="city_id" id="city" data-city data-id="<?= $request->get('city_id') ?>">
                                                <option value="">请选择城市</option>
                                            </select>
                                            <select name="region_id" id="region" data-region data-id="<?= $request->get('region_id') ?>">
                                                <option value="">请选择地区</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="am-form-group am-fl">
                                        <?php $address = $request->get('address'); ?>
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form">
                                            <input type="text" class="am-form-field" name="address"
                                                   placeholder="请输入地址"
                                                   value="<?= $address ?>">
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
                                <th>名称</th>
                                <th>图片</th>
                                <th>区域</th>
                                <th>地址</th>
                                <th>商圈</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['title'] ?></td>
                                    <td class="am-text-middle"><a href="<?= $item['logo']['file_path'] ?>" title="点击查看大图" target="_blank">
                                            <img src="<?= $item['logo']['file_path'] ?>" width="72" height="72" alt="">
                                        </a></td>
                                    <td class="am-text-middle"><?= $item['region']['province'] ?><?= $item['region']['city'] ?><?= $item['region']['region'] ?></td>
                                    <td class="am-text-middle" style="max-width: 200px">
                                        <div style="display: flex;flex-wrap: wrap">
                                                <span style="display: block;width: 80px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;margin: 2px 4px;"
                                                      class="layui-badge-rim"><?= $item['address'] ?></span>
                                        </div>
                                    </td>
                                    <td class="am-text-middle"><?= $item['area_id']['text'] ?></td>
                                    <td class="am-text-middle">
                                        <div class="tpl-table-black-operation">
                                            <?php if (checkPrivilege('dictionaries.required.regionalproperty/edit')): ?>
                                                <a href="<?= url('dictionaries.required.regionalproperty/edit', ['id' => $item['id']]) ?>">
                                                    <i class="am-icon-pencil"></i> 编辑
                                                </a>
                                            <?php endif; ?>
                                            <?php if (checkPrivilege('dictionaries.required.regionalproperty/delete')): ?>
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
<script src="assets/store/js/select.region.js"></script>

<script>
        // 删除元素
        var url = "<?= url('dictionaries.required.regionalproperty/delete') ?>";
        $('.item-delete').delete('id', url, '删除后不可恢复，确定要删除吗？');

    });

</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<link rel="stylesheet" href="assets/common/plugins/umeditor/themes/default/css/umeditor.css">
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">添加写字楼</div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">房源类型 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="releasetype" value="1" data-am-ucheck
                                            <?= $model['releasetype'] == 1 ? 'checked' : '' ?>>
                                        出租
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="releasetype" value="0" data-am-ucheck <?= $model['releasetype'] == 0 ? 'checked' : '' ?>>
                                        出售
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">选择楼盘 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="property_id" id="property_id"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择楼盘',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($loupan as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= $model['property_id'] == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['title'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="property_name" name="property_name" value="">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">写字楼标题 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="title"
                                           value="<?= $model['title'] ?>" placeholder="请输入写字楼标题" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">图片 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <div class="am-form-file">
                                            <button type="button"
                                                    class="upload-file am-btn am-btn-secondary am-radius">
                                                <i class="am-icon-cloud-upload"></i> 选择图片
                                            </button>
                                            <div class="uploader-list am-cf">
                                            </div>
                                        </div>
                                        <div class="help-block am-margin-top-sm">
                                            <small>尺寸750x750像素以上，大小2M以下 (可拖拽图片调整显示顺序 )</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">房源详情 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <!-- 加载编辑器的容器 -->
                                    <textarea id="container" name="content" type="text/plain"><?= $model['content'] ?></textarea>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">面积 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="house_area"
                                           value="<?= $model['house_area'] ?>" placeholder="请输入面积" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">隔间 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="cubicle_num"
                                           value="<?= $model['cubicle_num'] ?>" placeholder="请输入隔间" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">工位 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="station"
                                           value="<?= $model['station'] ?>" placeholder="请输入工位" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">可增至工位 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="add_station"
                                           value="<?= $model['add_station'] ?>" placeholder="请输入可增至工位">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单价 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="singleprice"
                                           value="<?= $model['singleprice'] ?>" placeholder="请输入单价" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">租金 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="price"
                                           value="<?= $model['price'] ?>" placeholder="请输入租金" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">是否含税 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="checkbox" class="tpl-form-input" name="is_tax"
                                           value="1" <?= $model['is_tax'] == 1 ? 'checked' : '' ?>>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">是否含物业费 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="checkbox" class="tpl-form-input" name="is_wuye"
                                           value="1" <?= $model['is_wuye'] == 1 ? 'checked' : '' ?>>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">付款方式 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="payment_method"
                                           value="<?= $model['payment_method'] ?>" placeholder="请输入付款方式">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">客户确认方式及有效期 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="confirm"
                                           value="<?= $model['confirm'] ?>" placeholder="请输入客户确认方式及有效期">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">签约年限 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="sign_year"
                                           value="<?= $model['sign_year'] ?>" placeholder="请输入签约年限">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">递增方式 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="incremental"
                                           value="<?= $model['incremental'] ?>" placeholder="请输入递增方式">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">装修 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="finish" id="finish"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择装修',maxHeight: 100}">
                                        <option value=""></option>
                                        <option value="清水房" <?= $model['finish'] == '清水房' ? 'selected' : '' ?>>清水房</option>
                                        <option value="天地墙" <?= $model['finish'] == '天地墙' ? 'selected' : '' ?>>天地墙</option>
                                        <option value="简装" <?= $model['finish'] == '简装' ? 'selected' : '' ?>>简装</option>
                                        <option value="精装" <?= $model['finish'] == '精装' ? 'selected' : '' ?>>精装</option>
                                        <option value="豪装" <?= $model['finish'] == '豪装' ? 'selected' : '' ?>>豪装</option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">朝向 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="orientation" id="orientation"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择朝向',maxHeight: 100}">
                                        <option value=""></option>
                                        <option value="朝东" <?= $model['orientation'] == '朝东' ? 'selected' : '' ?>>朝东</option>
                                        <option value="朝南" <?= $model['orientation'] == '朝南' ? 'selected' : '' ?>>朝南</option>
                                        <option value="朝西" <?= $model['orientation'] == '朝西' ? 'selected' : '' ?>>朝西</option>
                                        <option value="朝北" <?= $model['orientation'] == '朝北' ? 'selected' : '' ?>>朝北</option>
                                        <option value="朝东北" <?= $model['orientation'] == '朝东北' ? 'selected' : '' ?>>朝东北</option>
                                        <option value="朝东南" <?= $model['orientation'] == '朝东南' ? 'selected' : '' ?>>朝东南</option>
                                        <option value="朝西北" <?= $model['orientation'] == '朝西北' ? 'selected' : '' ?>>朝西北</option>
                                        <option value="朝西南" <?= $model['orientation'] == '朝西南' ? 'selected' : '' ?>>朝西南</option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">栋数 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="build_number" id="build_number"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择栋数',maxHeight: 100}">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单元 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="unit" id="unit"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择单元',maxHeight: 100}">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">楼层 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="floor" id="floor"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择楼层',maxHeight: 100}">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">房号 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="room_number"
                                           value="<?= $model['room_number'] ?>" placeholder="请输入房号" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">联系人 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="admin"
                                           value="<?= $model['admin'] ?>" placeholder="请输入联系人" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">手机号 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="telephone"
                                           value="<?= $model['telephone'] ?>" placeholder="请输入手机号" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">如何看房 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="seehow"
                                           value="<?= $model['seehow'] ?>" placeholder="请输入如何看房">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">佣金政策 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="yjzc"
                                           value="<?= $model['yjzc'] ?>" placeholder="请输入佣金政策">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <input type="hidden" name="id" value="<?= $model['id'] ?>">
                                    <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 图片文件列表模板 -->
{{include file="layouts/_template/tpl_file_item" /}}

<!-- 文件库弹窗 -->
{{include file="layouts/_template/file_library" /}}
<script src="assets/common/js/vue.min.js"></script>
<script src="assets/common/js/ddsort.js"></script>
<script src="assets/common/plugins/umeditor/umeditor.config.js?v=<?= $version ?>"></script>
<script src="assets/common/plugins/umeditor/umeditor.min.js"></script>
<script>

    $(function () {

        // 富文本编辑器
        UM.getEditor('container', {
            initialFrameWidth: 500,
            initialFrameHeight: 400
        });

        // 选择图片
        $('.upload-file').selectImages({
            name: 'house_pic[]'
            , multiple: true
        });

        // 图片列表拖动
        $('.uploader-list').DDSort({
            target: '.file-item',
            delay: 100, // 延时处理，默认为 50 ms，防止手抖点击 A 链接无效
            floatStyle: {
                'border': '1px solid #ccc',
                'background-color': '#fff'
            }
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

        //监听省的选择
        $('#province_id').change(function (){
            var province_id = $('#province_id').val();
            $.post("<?= url('dictionaries.required.trading/getregiondata') ?>", {id: province_id}, function (result) {
                $('#city_id option').remove();
                var obj = result.data;
                for (var i in obj) {
                    $('#city_id').append("<option value='" + obj[i]['id'] + "'>" + obj[i]['name'] + "</option>");
                }
            });
        })

        //监听市的选择
        $('#city_id').change(function (){
            var city_id = $('#city_id').val();
            $.post("<?= url('dictionaries.required.trading/getregiondata') ?>", {id: city_id}, function (result) {
                $('#region_id option').remove();
                var obj = result.data;
                for (var i in obj) {
                    $('#region_id').append("<option value='" + obj[i]['id'] + "'>" + obj[i]['name'] + "</option>");
                }
            });
        })

    });
</script>

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
                                <div class="widget-title am-fl">编辑住宅信息</div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">选择楼盘 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="house_id" id="house_id"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择楼盘',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($loupan as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= $model['house_id'] == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['title'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="name" id="name" value="">
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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">面积 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="house_area"
                                           value="<?= $model['house_area'] ?>" placeholder="请输入面积" required>
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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">出租类型 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="rent_type" value="0" data-am-ucheck
                                            <?= $model['rent_type'] == 0 ? 'checked' : '' ?>>
                                        整租
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="rent_type" value="1" data-am-ucheck
                                            <?= $model['rent_type'] == 1 ? 'checked' : '' ?>>
                                        合租
                                    </label>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">户型 </label>
                                <div class="am-form-inline">
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-end">
                                            <select name="room" id="room"
                                                    data-am-selected="{btnSize: 'sm', placeholder: '请选择楼盘',searchBox: 1,maxHeight: 100}">
                                                <?php for ($i = 0; $i <= 10; $i++): ?>
                                                    <option value="<?= $i ?>" <?= $model['house_type'][0] == $i ? 'selected' : '' ?>>
                                                        <?= $i . '室' ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-end">
                                            <select name="hall" id="hall"
                                                    data-am-selected="{btnSize: 'sm', placeholder: '请选择楼盘',searchBox: 1,maxHeight: 100}">
                                                <?php for ($i = 0; $i <= 10; $i++): ?>
                                                    <option value="<?= $i ?>" <?= $model['house_type'][1] == $i ? 'selected' : '' ?>>
                                                        <?= $i . '厅' ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-end">
                                            <select name="toilet" id="toilet"
                                                    data-am-selected="{btnSize: 'sm', placeholder: '请选择楼盘',searchBox: 1,maxHeight: 100}">
                                                <?php for ($i = 0; $i <= 10; $i++): ?>
                                                    <option value="<?= $i ?>" <?= $model['house_type'][2] == $i ? 'selected' : '' ?>>
                                                        <?= $i . '卫' ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">物业费 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="property_fee"
                                           value="<?= $model['property_fee'] ?>" placeholder="请输入物业费" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">付款方式 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="pay_type"
                                           value="<?= $model['pay_type'] ?>" placeholder="请输入付款方式">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">签约年限 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="sign_year"
                                           value="<?= $model['sign_year'] ?>" placeholder="请输入签约年限">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">装修 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="finish" id="finish"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择装修',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <option value="简装" <?= $model['finish'] == '简装' ? 'selected' : '' ?>>
                                            简装
                                        </option>
                                        <option value="精装" <?= $model['finish'] == '精装' ? 'selected' : '' ?>>
                                            精装
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">朝向 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="orientation" id="orientation"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择朝向',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <option value="朝东" <?= $model['orientation'] == '朝东' ? 'selected' : '' ?>>
                                            朝东
                                        </option>
                                        <option value="朝南" <?= $model['orientation'] == '朝南' ? 'selected' : '' ?>>
                                            朝南
                                        </option>
                                        <option value="朝西" <?= $model['orientation'] == '朝西' ? 'selected' : '' ?>>
                                            朝西
                                        </option>
                                        <option value="朝北" <?= $model['orientation'] == '朝北' ? 'selected' : '' ?>>
                                            朝北
                                        </option>
                                        <option value="朝东北" <?= $model['orientation'] == '朝东北' ? 'selected' : '' ?>>
                                            朝东北
                                        </option>
                                        <option value="朝东南" <?= $model['orientation'] == '朝东南' ? 'selected' : '' ?>>
                                            朝东南
                                        </option>
                                        <option value="朝西北" <?= $model['orientation'] == '朝西北' ? 'selected' : '' ?>>
                                            朝西北
                                        </option>
                                        <option value="朝西南" <?= $model['orientation'] == '朝西南' ? 'selected' : '' ?>>
                                            朝西南
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">栋数 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="build_number" id="build_number"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择栋数',searchBox: 1,maxHeight: 100}">
                                        <?php for ($i = 1; $i <= 60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $model['build_number'] == $i ? 'selected' : '' ?>>
                                                <?= $i . '栋' ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单元 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="unit" id="unit"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择单元',searchBox: 1,maxHeight: 100}">
                                        <?php for ($i = 1; $i <= 60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $model['unit'] == $i ? 'selected' : '' ?>>
                                                <?= $i . '单元' ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">楼层 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="floor" id="floor"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择楼层',searchBox: 1,maxHeight: 100}">
                                        <?php for ($i = 1; $i <= 60; $i++): ?>
                                            <option value="<?= $i ?>" <?= $model['floor'] == $i ? 'selected' : '' ?>>
                                                <?= $i . '层' ?>
                                            </option>
                                        <?php endfor; ?>
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
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">房屋配置 </label>
                                <?php foreach ($configure as $k => $v): ?>
                                    <label class="am-checkbox-inline">
                                        <input type="checkbox" name="configuration" value="<?= $v ?>"> <?= $v ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">标签 </label>
                                <?php foreach ($label as $item): ?>
                                    <label class="am-checkbox-inline">
                                        <input type="checkbox" name="label"
                                               value="<?= $item['id'] ?>"> <?= $item['labelname'] ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">图片 </label>
                                <div class="am-u-sm-9 am-u-end">
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

                            <div class="am-form-group">

                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">视频 </label>
                                <div class="am-u-sm-9 am-u-end video_box">
                                    <div class="am-form-group am-form-file ttt">
                                        <button type="button" class="am-btn am-btn-default am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 选择要上传的文件
                                        </button>
                                        <input type="file" multiple>
                                    </div>
                                    <!-- 加载编辑器的容器 -->
                                    <input type="hidden" name="house_vedio" id="house_vedio">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">房源描述 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <!-- 加载编辑器的容器 -->
                                    <textarea id="container" name="content"
                                              type="text/plain"><?= $model['content'] ?></textarea>
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


        $('#house_id').change(() => {
            $('#name').val($('#house_id').find('option:selected').text())
        })

        $('input[type="file"]').on('change', function () {
                var file = this.files[0];
                var fileName = file.name;
                var fileType = fileName.substr(fileName.length - 4, fileName.length);
                if (fileType == '.mp4') {
                    var formData = new FormData()
                    formData.append("video", file);
                    $.ajax({
                        url: '<?= url('store/upload/video') ?>',
                        type: 'POST',
                        cache: false,
                        data: formData,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function (json) {
                            $('#house_vedio').val(json.data.src);
                        }
                    });
                    $('.videoobj').remove();
                    $('.video_box').append('<video class="videoobj" width="320" height="240" controls>' +
                        '<source src="' + window.URL.createObjectURL(this.files[0]) + '" type="video/mp4">' +
                        '<object data="" width="320" height="240">' +
                        '<embed id="video" src="' + window.URL.createObjectURL(this.files[0]) + '" width="320" height="240">' +
                        '</object>' +
                        '</video>')
                } else {
                    alert('文件类型不正确');
                }
            }
        )
        ;


        /*$('input[type="file"]').closest('div').hover(function(){
            if($(this).find('input[type="file"]').attr('src')){
                $('.ttt').append('<div class="imgView" ><img width="80" src="'+$(this).find('input[type="file"]').attr('src')+'"></div>')
            }
        },function(){
            $('.imgView').remove();
        });*/
    });
</script>

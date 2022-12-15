<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">编辑楼盘</div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">楼盘名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="title"
                                           value="<?= $model['title'] ?>" placeholder="请输入楼盘名称" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 楼盘logo </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="am-form-file">
                                        <div class="am-form-file">
                                            <button type="button"
                                                    class="upload-file am-btn am-btn-secondary am-radius">
                                                <i class="am-icon-cloud-upload"></i> 选择图片
                                            </button>
                                            <div class="uploader-list am-cf">
                                                <div class="file-item">
                                                    <a href="<?= $model['logo']['file_path'] ?>"
                                                       title="点击查看大图" target="_blank">
                                                        <img src="<?= $model['logo']['file_path'] ?>">
                                                    </a>
                                                    <input type="hidden" name="image_id"
                                                           value="<?= $model['image_id'] ?>">
                                                    <i class="iconfont icon-shanchu file-item-delete"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group am-padding-top">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require"> 楼盘区域 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <div class="x-region-select" data-region-selected>
                                        <select name="province" id="province" data-province data-id="<?= $model['province'] ?>" required>
                                            <option value="">请选择省份</option>
                                        </select>
                                        <select name="city" id="city" data-city data-id="<?= $model['city'] ?>" required>
                                            <option value="">请选择城市</option>
                                        </select>
                                        <select name="region" id="region" data-region data-id="<?= $model['region'] ?>" required>
                                            <option value="">请选择地区</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">详细地址 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="address"
                                           value="<?= $model['address'] ?>" placeholder="请输入详细地址" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">商圈 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="area_id" id="area_id"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择商圈',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($area as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= $model['area_id'] == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">环数 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="ring_id" id="ring_id"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择环数',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($ring as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= $model['ring_id'] == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">地铁 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <?php foreach ($subway as $item): ?>
                                        <div class="am-u-sm-9 am-u-end">
                                            <label class="am-checkbox-inline">
                                                <input type="checkbox" name="subway[] id="subway<?= $item['id'] ?>"><?= $item['subwayname'] ?>
                                            </label>
                                            <div class="am-u-end panel-dealer__content">
                                                <?php foreach ($item['child'] as $child): ?>
                                                    <label class="am-checkbox-inline">
                                                        <input type="checkbox" name="subway[] subway<?= $item['id'] ?>" value="<?= $child['id']?>"><?= $child['subwayname'] ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">栋数 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="build_numbers" id="build_numbers"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择栋数',maxHeight: 100}">
                                        <option value=""></option>
                                        <?php for ($i = 1; $i <= 15; $i++): ?>
                                            <option value="<?= $i ?>" <?= $model['build_numbers'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">单元数 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="units" id="units"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择单元数',maxHeight: 100}">
                                        <option value=""></option>
                                        <?php for ($i = 1; $i <= 4; $i++): ?>
                                            <option value="<?= $i ?>" <?= $model['units'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">楼层数 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="floors" id="floors"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择楼层数',maxHeight: 100}">
                                        <option value=""></option>
                                        <?php for ($i = 1; $i <= 32; $i++): ?>
                                            <option value="<?= $i ?>" <?= $model['floors'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">物业公司 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="pro_company"
                                           value="<?= $model['pro_company'] ?>" placeholder="请输入物业公司名称">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">物业费 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="property"
                                           value="<?= $model['property'] ?>" placeholder="请输入物业费">
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label">停车费 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="parking_rate"
                                           value="<?= $model['parking_rate'] ?>" placeholder="请输入停车费">
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
<script id="tpl-file-item" type="text/template">
    {{ each list }}
    <div class="file-item">
        <a href="{{ $value.file_path }}" title="点击查看大图" target="_blank">
            <img src="{{ $value.file_path }}">
        </a>
        <input type="hidden" name="{{ name }}" value="{{ $value.file_id }}">
        <i class="iconfont icon-shanchu file-item-delete"></i>
    </div>
    {{ /each }}
</script>
<!-- 文件库弹窗 -->
{{include file="layouts/_template/file_library" /}}
<script src="assets/store/js/select.region.js"></script>
<script>

    $(function () {

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

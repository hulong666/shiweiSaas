<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">编辑商圈</div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">市 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="city" id="city_id"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择城市',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($city as $item): ?>
                                            <option value="<?= $item['id'] ?>"
                                                <?= $model['city']['id'] == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">区 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="region" id="region_id"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择区域',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($regin as $item): ?>
                                            <option value="<?= $item['id'] ?>"
                                                <?= $model['region']['id'] == $item['id'] ? 'selected' : '' ?>>
                                                <?= $item['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">物业地址 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="property_address"
                                           value="<?= $model['property_address']['text'] ?>" placeholder="请输入物业地址" required>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<link rel="stylesheet" href="assets/common/plugins/umeditor/themes/default/css/umeditor.css">
<div class="row-content am-cf" id="app">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">

                <div class="widget-body">
                    <fieldset>
                        <div class="widget-head am-cf">
                            <div class="widget-title am-fl">预览合同模板</div>
                        </div>
                        <div style="display: flex;justify-content: center">
                            <div style="width: 700px;">
                                <p style="text-align: center;font-size: 25px"><b><?= $model['contract_name'] ?></b></p>
                                <p style="font-size: 16px;"><?= $model['first_party'] ?></p>
                                <br>
                                <p style="font-size: 16px;"><?= $model['party_b'] ?></p>
                                <?php foreach ($model['content'] as $k => $item): ?>
                                    <div>
                                        <p style="font-size: 16px;"><?= intTostr((string)($k+1)) ?>、<?= $item['title'] ?></p>
                                        <p style="font-size: 16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $item['content'] ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </fieldset>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="assets/common/js/vue.min.js"></script>
<script src="assets/common/js/ddsort.js"></script>
<script src="assets/common/plugins/umeditor/umeditor.config.js?v=<?= $version ?>"></script>
<script src="assets/common/plugins/umeditor/umeditor.min.js"></script>

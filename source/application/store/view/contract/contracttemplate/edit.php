<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<link rel="stylesheet" href="assets/common/plugins/umeditor/themes/default/css/umeditor.css">
<div class="row-content am-cf" id="app">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">编辑合同模板</div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">合同类型 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="contract_type" id="contract_type"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择合同类型',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($contract_type as $k => $item): ?>
                                            <option value="<?= $k ?>" <?= $model['contract_type']['value'] == $k ? 'selected' : '' ?>>
                                                <?= $item ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">模板名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="template_ame"
                                           value="<?= $model['template_ame'] ?>" placeholder="请输入模板名称" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">业务类型 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="business_type" id="business_type"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择业务类型',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($business_type as $k => $item): ?>
                                            <option value="<?= $k ?>" <?= $model['business_type']['value'] == $k ? 'selected' : '' ?>>
                                                <?= $item ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">合同对象 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <select name="contract" id="contract"
                                            data-am-selected="{btnSize: 'sm', placeholder: '请选择合同对象',searchBox: 1,maxHeight: 100}">
                                        <option value=""></option>
                                        <?php foreach ($contract as $k => $item): ?>
                                            <option value="<?= $k ?>" <?= $model['contract']['value'] == $k ? 'selected' : '' ?>>
                                                <?= $item ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">合同名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="contract_name"
                                           value="<?= $model['contract_name'] ?>" placeholder="请输入合同名称" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">甲方 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="first_party"
                                           value="<?= $model['first_party'] ?>" placeholder="请输入甲方信息" required>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">乙方 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="party_b"
                                           value="<?= $model['party_b'] ?>" placeholder="请输入乙方信息" required>
                                </div>
                            </div>

                            <div>
                                <table class="am-table">
                                    <thead>
                                    <tr>
                                        <th width="50">序号</th>
                                        <th width="15%">标题</th>
                                        <th>内容</th>
                                        <th width="150">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item,i) in list" :key="i">
                                        <td>{{i+1}}</td>
                                        <td>
                                            <textarea name="title[]" cols="5" rows="5">{{item.title}}</textarea>
                                        </td>
                                        <td>
                                            <textarea name="content[]" cols="10" rows="5">{{item.content}}</textarea>
                                        </td>
                                        <td>
                                            <div class="tpl-table-black-operation" style="display: flex;flex-wrap: wrap;justify-content: space-between">
                                                <a href="javascript:;" class="item-delete tpl-table-black-operation-del"
                                                   @click="deleteData(i)"
                                                   style="margin-bottom: 20px">
                                                    <i class="am-icon-trash"></i> 删除本条
                                                </a>
                                                <a href="javascript:0" @click="addDataTop(i)" style="margin-bottom: 20px">
                                                    <i class="am-icon-plus"></i> 往上添加一条
                                                </a>
                                                <a href="javascript:0" @click="addDataBelow(i)">
                                                    <i class="am-icon-plus"></i> 往下添加一条
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
<!--                                    <input type="hidden" name="id" value="--><?//= $model['id'] ?><!--">-->
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
    const myData = <?= $model ?>;
    var vm = new Vue({
        el: '#app',
        data:{
            list: myData.content
        },
        methods:{
            deleteData(index){
                if(this.list.length == 1){
                    alert('最少保留一条！');
                    return;
                }
                this.list.splice(index,1)
            },
            addDataTop(index){
                this.list.splice(index,0,{title:'',content:''})
            },
            addDataBelow(index){
                this.list.splice(index+1,0,{title:'',content:''})
            },
        }
    });

    $(function () {

        // 富文本编辑器
        UM.getEditor('container', {
            initialFrameWidth: 500,
            initialFrameHeight: 400
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();


    });
</script>

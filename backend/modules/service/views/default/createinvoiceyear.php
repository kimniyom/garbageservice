<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>
<?php
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
$this->title = "ใบวางบิล / ใบแจ้งยอด";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alert alert-warning">
    <p>*สัญญาที่มีการเหมาจ่ายเป็นรายปีเท่านั้น</p>
</div>
<div class="row">
<div class="col-lg-4 col-md-4">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
        <label>เลือกเลขที่สัญญา</label>
        <?php
$listPromise = ArrayHelper::map($promise, 'id', 'promisenumber');
echo Select2::widget([
	'name' => 'promise',
	'value' => '',
	'data' => $listPromise,
	'options' => [
		'multiple' => false,
		'placeholder' => 'Select Promise ...',
		'onchange' => 'getRound(this.value)',
	],
]);
?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
        <div id="round"></div>
        </div>
    </div>
</div>
<div class="col-lg-8 col-md-8">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div id="createbill"></div>
        </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    function getRound(promise){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getroundpromiseyear']) ?>";
        var data = {promiseid: promise};
        $.post(url,data,function(datas){
            $("#round").html(datas);
        });
    }

    function popupFormbill(promiseid){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createbillpopupyear']) ?>";
        var data = {
            promiseid: promiseid
            };
        $.post(url,data,function(datas){
            $("#createbill").html(datas);
        });
    }
</script>
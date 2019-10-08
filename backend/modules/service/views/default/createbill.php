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
<div class="row">
<div class="col-lg-4 col-md-4">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
        <label>เลือกลูกค้า</label>
        <?php
$listCustomer = ArrayHelper::map($customer, 'id', 'address');
echo Select2::widget([
	'name' => 'customer',
	'value' => '',
	'data' => $listCustomer,
	'options' => [
		'multiple' => false,
		'placeholder' => 'Select Customer ...',
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
    function getRound(customer){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getroundpromise']) ?>";
        var data = {customer_id: customer};
        $.post(url,data,function(datas){
            $("#round").html(datas);
        });
    }

    function popupFormbill(promiseid,months,round,id,type){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createbillpopup']) ?>";
        var data = {
            id: id,
            promiseid: promiseid,
            dateround: months,
            round: round,
            type: type
            };
        $.post(url,data,function(datas){
            $("#createbill").html(datas);
        });
    }
</script>
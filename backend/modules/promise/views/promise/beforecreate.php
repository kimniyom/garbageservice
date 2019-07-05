<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตรวจสอบการทำสัญญา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-index">
    <div class="row">
        <div class="col-md-12 col-md-6">
            <?php
echo Select2::widget([
	'name' => 'state_10',
	'data' => ArrayHelper::map($customer, "id", "company"),
	'options' => [
		'placeholder' => 'เลือกลูกค้า',
	],
	'pluginEvents' => [
		"select2:select" => "function(){setcustomerid(this.value)}",
	],
]);
?>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-md-4 col-md-4">
            <button type="button" class="btn btn-primary" onclick="check()">
                <i class="fa fa-search"></i> ค้นหา
            </button>
        </div>
    </div>
        <label id="loading"></label>
        <input type="hidden" id="customerid"/>
        <div class="row" id="next" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px;"><i class="fa fa-check text-success"></i> ลูกค้าท่านนี้สามารถทำสัญญาได้</p>
                <button type="button" class="btn btn-success" style="font-size: 20px;" onclick="createpromise()">ขั้นตอนต่อไป <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="row" id="nextfalse" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px; color:red;"><i class="fa fa-info text-danger"></i> ... ลูกค้าท่านนี้มีสัญญากับทางบริษัทอยู่ ไม่สามารถทำสัญญาได้</p>
            </div>
        </div>
</div>

<script type="text/javascript">
    function setcustomerid(id){
        $("#customerid").val(id);
        $("#next").hide();
        $("#nextfalse").hide();
    }

    function check(){
        $("#next").hide();
        $("#nextfalse").hide();
        var customerid = parseInt($("#customerid").val());
        if(customerid == ""){
            alert("ยังไม่ได้เลือกลูกค้า..!");
            return false;
        }
        else {
            var spinner = '<i class="fa fa-spinner fa-spin fa-2x"></i>';
            $("#loading").html(spinner + " กำลังตรวจสอบข้อมูลกรุณารอสักครู่...");
            var data = {customerid: customerid};
            var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/iscustomerexpired']) ?>";
            $.post(url,data,function(result){
                if(result == 0){
                    $("#loading").html("");
                    $("#next").show();
                    $("#nextfalse").hide();
                } else {
                    $("#nextfalse").show();
                    $("#next").hide();
                    $("#loading").html("");
                }
            })
        }
    }

    function createpromise(){
        var customerid = parseInt($("#customerid").val());
        var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/create']) ?>" + "&customerid=" + customerid ;
        window.location=url;
        //alert(url);
    }
</script>


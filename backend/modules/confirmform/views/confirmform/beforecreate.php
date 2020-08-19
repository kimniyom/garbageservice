<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\customerneed\models\customerneedsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'เลือกลูกค้าก่อนทำแบบฟอร์ม';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-index">
    <div class="row">
        <div class="col-md-12 col-md-6">
            <?php
echo Select2::widget([
	'name' => 'state_10',
	'data' => ArrayHelper::map($customerneed, "id", "customername"),
	'options' => [
		'placeholder' => 'เลือกลูกค้า',
	],
	'pluginEvents' => [
		"select2:select" => "function(){setcustomerneedid(this.value)}",
	],
]);
?>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-md-4 col-md-4">
            <button type="button" class="btn btn-primary" onclick="createconfirmform()">
                <i class="fa fa-arrow-right"></i> ถัดไป
            </button>
        </div>
    </div>
        <label id="loading"></label>
        <input type="hidden" id="customerneedid"/>
        <div class="row" id="next" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px;"><i class="fa fa-check text-success"></i> ลูกค้าท่านนี้สามารถทำสัญญาได้</p>
                <button type="button" class="btn btn-success" style="font-size: 20px;" onclick="createconfirmform()">ขั้นตอนต่อไป <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="row" id="nextfalse" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px; color:red;"><i class="fa fa-info text-danger"></i> ... ลูกค้าท่านนี้ยังไม่ได้รับการยืนยันจากบริษัท ไม่สามารถทำแบบยืนยันลูกค้าได้</p>
            </div>
        </div>
</div>

<script type="text/javascript">
    function setcustomerneedid(id){
        $("#customerneedid").val(id);
        $("#next").hide();
        $("#nextfalse").hide();
    }

    function createconfirmform(){
        var customerneedid = parseInt($("#customerneedid").val());
        console.log(customerneedid);
        if(!customerneedid){
            alert("ยังไม่ได้เลือกลูกค้า..!");
            return false;
        }
        var customerneedid = parseInt($("#customerneedid").val());
        var url = "<?php echo Yii::$app->urlManager->createUrl(['confirmform/confirmform/create']) ?>" + "&customerneedid=" + customerneedid ;
        window.location=url;
        //alert(url);
    }
</script>


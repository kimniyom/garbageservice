<?php

use kartik\date\DatePicker;
use kartik\form\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */
/* @var $form yii\widgets\ActiveForm */
$yearUnit = array();
$levy = array();
$monthunit = array();
$deposit = array();

for($i=1;$i<=36;$i++)
{
    if($i<=5){
        $yearUnit[$i] = $i;
    }
    if($i<=10){
        $levy[$i] = $i;
    }
    if($i >=12){
        $monthunit[$i] = $i;
    }
    if($i<=12){
        $deposit[$i] = $i;
    }
}
//echo print_r($levy);
?>

<div class="promise-form">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="box box-success">
                <div class="box-header">ข้อมูลลูกค้า</div>
    <div class="box-body">
        <div class="list-group">
            <div class="list-group-item">
                        รหัสลูกค้า <span class="badge"><?php echo $customer['taxnumber'] ?></span>
                    </div>
                    <div class="list-group-item">
                        ชื่อบริษัท <span class="badge"><?php echo $customer['company'] ?></span>
                    </div>
                    <div class="list-group-item">
                        เลขเสียภาษี <span class="badge"><?php echo $customer['taxnumber'] ?></span>
                    </div>
                    <div class="list-group-item">
                        เบอร์โทรศัพท์ <span class="badge"><?php echo $customer['tel'] ?>,<?php echo $customer['telephone'] ?></span>
                    </div>
                    <div class="list-group-item">
                        ผู้ติดต่อ <span class="badge"><?php echo $customer['manager'] ?></span>
                    </div>
                    <div class="list-group-item">
                        วันที่ลงทะเบียน <span class="badge"><?php echo $customer['create_date'] ?></span>
                    </div>
                    <hr/>
                    <div class="list-group-item">
                        User ผู้รับผิดชอบ <span class="badge"><?php echo $customer['username'] ?></span>
                    </div>
                </div>
                <div class="well text-danger">
                    *สัญญาจะมีผลก็ต่อเมื่อมีการอัพโหลดไฟล์สัญญาที่มีลายมือชื่อทั้ง 2 ฝ่ายเข้าสู่ระบบแล้วเท่านั้น
                </div>
    </div>
</div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="box box-success">
                <div class="box-header">ข้อมูลสัญญา</div>
    <div class="box-body">
     <div class="well">
    <?php
//$form = ActiveForm::begin();
$form = ActiveForm::begin([
	'type' => ActiveForm::TYPE_VERTICAL,
]);
?>

<!--
    <div class="row">
        <div class="col-md-12 col-lg-4">
            <?php //$form->field($model, 'promisenumber')->textInput(['maxlength' => true])?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?php //$form->field($model, 'active')->dropDownList([1 => 'ใช้งาน', 0 => 'ไม่ใช้งาน'], [], ['options' => ['onchange' => 'getrecivetype()']])?>
        </div>
    </div>
-->
    <div class="row">
        <div class="col-md-6 col-lg-5">
            <?=$form->field($model, 'promisedatebegin')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
	'autoclose' => true,
	'format' => 'yyyy-mm-dd',
	'todayHighlight' => true,
	'startDate' => "0d",
],

	'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);
?>
        </div>
        <div class="col-md-6 col-lg-5">
            <?=$form->field($model, 'promisedateend')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
	'autoclose' => true,
	'format' => 'yyyy-mm-dd',
	'todayHighlight' => true,
	'startDate' => "0d",
], 'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-5">
            <?=$form->field($model, 'garbageweight')->textInput()?>
        </div>

        <div class="col-md-6 col-lg-5">
            <?=$form->field($model, 'levy')->dropDownList($levy)?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-5">
            <?=$form->field($model, 'recivetype')->dropDownList([1 => 'รายเดือน', 0 => 'รายปี'],
                [
                    'onchange' => 'getrecivetype(this.value)',
                ]

            );
            ?>
        </div>
    </div>

    <div class="row" id="divmonth">
        <div class="col-md-8 col-lg-5">
            <?=$form->field($model, 'rate')->textInput()?>
        </div>
        <div class="col-md-5 col-lg-5">
            <?=$form->field($model, 'deposit')->dropDownList($deposit)?>
        </div>
    </div>
      
   
    <div class="row" id="divyear">
        <div class="col-md-3 col-lg-5">
            <?=$form->field($model, 'payperyear')->textInput()?>
        </div>
        <div class="col-md-4 col-lg-5">
            <?=$form->field($model, 'yearunit')->dropDownList($yearUnit)?>
        </div>
    </div>
    <div class="row">
        
    </div>

    <!-- <div class="row">
        <div class="col-md-12 col-lg-6">
            <?php //$form->field($model, 'status')->dropDownList(['0' => 'หมดสัญญา', '1' => 'รอยืนยัน', '2' => 'กำลังใช้งาน', '3' => 'กำลังต่อสัญญา'], ['prompt' => 'สถานะสัญญา'])?>
        </div>
        <div class="col-md-12 col-lg-6">
        <?php //$form->field($model, 'checkmoney')->dropDownList(['0' => 'ยังไม่ได้ชำระ', '1' => 'ชำระเงินแล้ว'], ['prompt' => 'สถานะการชำระเงิน'])?>
        </div>
    </div> -->
<hr/>
    <div class="form-group">
        <?=Html::submitButton('บันทึกข้อมูลสัญญา', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
if ($model->id == "") {
	$this->registerJs("getrecivetype(1);");
} else {
	$this->registerJs("getrecivetype(" . $model->recivetype . ");");
}
?>
<script>

function getrecivetype(type)
{
    if(type==1)
    {

        $("#divmonth").show();
        $("#divyear").hide();
    }
    else if(type==0)
    {
        $("#divmonth").hide();
        $("#divyear").show();
    }
}
</script>

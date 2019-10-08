<?php

//use yii\widgets\ActiveForm;
use app\models\Maspackage;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */
/* @var $form yii\widgets\ActiveForm */
$yearUnit = array();
$levy = array();
$monthunit = array();
$deposit = array();
$dayInweek = array(
	'0' => 'จันทร์',
	'1' => 'อังคาร',
	'2' => 'พุธ',
	'3' => 'พฤหัสบดี',
	'4' => 'วันศุกร์',
	'5' => 'วันเสาร์',
	'6' => 'วันอาทิตย์',
);
for ($i = 1; $i <= 36; $i++) {
	if ($i <= 5) {
		$yearUnit[$i] = $i;
	}
	if ($i <= 5) {
		$levy[$i] = $i;
	}
	if ($i >= 12) {
		$monthunit[$i] = $i;
	}
	if ($i <= 12) {
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
            <?=$form->field($model, 'createat')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
                    'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);
                ?>
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-5">
            <?=$form->field($model, 'promisedatebegin')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
                    'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);
                ?>
        </div>
        <div class="col-md-6 col-lg-5">
            <?=$form->field($model, 'promisedateend')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ], 'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-5">
        <?php
$listPackage = ArrayHelper::map(Maspackage::find()->all(), 'id', 'package');
?>
        <?=$form->field($model, 'recivetype')->dropDownList($listPackage,
	[
		'onchange' => 'getrecivetype(this.value)',
	]
);
?>
        </div>

        <?php $model->vat = 0;?>
        <div class="col-md-4 col-lg-5">
            <?=$form->field($model, 'vat')->dropDownList([
	1 => 'มี vat', 0 => 'ไม่มี vat',
], [
	'onchange' => 'calculation()',
])?>
        </div>

    </div>
 <div class="row">
            <div class="col-md-4 col-lg-5">
            <?=$form->field($model, 'payment')->dropDownList([
	0 => 'แบ่งจ่ายรายเดือน / รายครั้ง', 1 => 'เหมาจ่าย',
], [
	'onchange' => 'calculation()',
])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-5">
            <?=$form->field($model, 'yearunit')->hiddenInput(['value' => '1'])->label(false)?>
            <?php //$form->field($model, 'yearunit')->dropDownList($yearUnit)->label(false)?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?=$form->field($model, 'unitprice')->textInput(
	[
		'onkeyup' => 'calculation()',
	]
)?>
        </div>
        <div class="col-md-4 col-lg-4" id="garbageweight">
            <?=$form->field($model, 'garbageweight')->textInput(
	[
		'onkeyup' => 'calculation()',
	]
)?>
        </div>
        <div class="col-md-4 col-lg-4" id="divlevy">
            <?=$form->field($model, 'levy')->dropDownList(
	$levy,
	[
		'onchange' => 'calculation()',
	]
)?>
        </div>
    </div>

    <div class="row" id="divmonth">
        <div class="col-md-8 col-lg-5">
            <?=$form->field($model, 'rate')->textInput()?>
        </div>
        <div class="col-md-5 col-lg-5">
            <?=$form->field($model, 'deposit')->dropDownList($deposit, ['prompt' => 'ไม่มีมัดจำ'])?>
        </div>
    </div>
    <div class="fine">
        <h4>ค่าปรับ</h4>
        <hr style="margin-top:0px;"/>
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <?=$form->field($model, 'fine')->textInput()?>
            </div>
        </div>
    </div>

    <div class="distcount">
        <h4>ส่วนลด</h4>(*ถ้ามีการแก้ไขข้อมูลข้างบนส่วนลดจะต้องคำนวณใหม่ทุกครั้ง)
        <hr style="margin-top:0px;"/>
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <?=$form->field($model, 'distcountpercent')->textInput(
	[
		'onkeyup' => 'calculationPercent()',
	]
)?>
            </div>
            <div class="col-md-4 col-lg-4">
                <?=$form->field($model, 'distcountbath')->textInput(
	[
		'onkeyup' => 'calculationBath()',
	]
)?>
            </div>
        </div>
    </div>

    <div class="row" id="divyear">
        <div class="col-md-3 col-lg-5">
            <?=$form->field($model, 'payperyear')->textInput(['readonly' => 'readonly'])?>
        </div>
        <div class="col-md-3 col-lg-5">
            <?=$form->field($model, 'total')->textInput(['readonly' => 'readonly'])?>
        </div>
    </div>

    <div id="dateservice">
            <h4>วันที่จัดเก็บ</h4>
            <hr style="margin-top:0px;"/>
                    <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <?=$form->field($model, 'dayinweek')->dropDownList($dayInweek);?>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <?php
            echo $form->field($model, 'weekinmonth')->widget(Select2::classname(), [
                'data' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'],
                'options' => ['placeholder' => 'Select a week ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ]);
            ?>
        </div>
    </div>

    <div id="manager">
        <h4>ผู้ว่าจ้าง และพยาน</h4>
        <hr style="margin-top:0px;"/>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <?=$form->field($model, 'employer1')->textInput()?>
            </div>
            <div class="col-md-6 col-lg-6">
                <?=$form->field($model, 'employer2')->textInput()?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <?=$form->field($model, 'witness1')->textInput()?>
            </div>
            <div class="col-md-6 col-lg-6">
                <?=$form->field($model, 'witness2')->textInput()?>
            </div>
        </div>
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
    <?php if ($error) {?>
     <div class="alert alert-danger"><?php echo $error ?></div>
 <?php }?>
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

function getrecivetype(type){
    if(type==1){
		$("#garbageweight").show();
        $(".fine").show();
        $("#divmonth").show();
        $("#divyear").show();
        $(".distcount").show();
        $("#dateservice").show();
        //calculation();
    } else if(type==2) {
        $(".fine").hide();
        $("#divmonth").hide();
        $(".distcount").hide();
        $("#garbageweight").hide();
        $("#divyear").hide();
        $("#promise-rate").val(0);
        $("#promise-payperyear").val(0);
        $("#dateservice").hide();
    } else if(type==3){
		$("#garbageweight").hide();
        $(".distcount").show();
        $(".fine").hide();
		$(".distcount").show();
        $("#dateservice").show();
    }
}

function calculation(){
    var total = "";
    var totalSum= "";
    var vat = $("#promise-vat").val();
    var type = parseInt($("#promise-recivetype").val());
    var unit = parseInt($("#promise-unitprice").val());
    var garbageweight = parseInt($("#promise-garbageweight").val());
    var levy = parseInt($("#promise-levy").val());

    if(type == 1){
        total = (unit * levy);
        totalyear = (total * 12);
        let vatBath = (totalyear * 7) / 100;
        if(vat == 1){
            totalSum = (totalyear - vatBath);
        } else {
            totalSum = totalyear;
        }

        $("#promise-rate").val(total);
        $("#promise-payperyear").val(totalSum);
        $("#promise-total").val(totalSum);
        $("#promise-distcountpercent").val("");
        $("#promise-distcountbath").val("");
    } else if(type == 3){
			total = (unit * levy);
			totalyear = (total * 12);
			let vatBath = (totalyear * 7) / 100;
			if(vat == 1){
					totalSum = (totalyear - vatBath);
			} else {
					totalSum = totalyear;
			}
			$("#promise-rate").val(total);
			$("#promise-payperyear").val(parseInt(totalSum));
			$("#promise-total").val(parseInt(totalSum));
			$("#promise-distcountpercent").val("");
			$("#promise-distcountbath").val("");
		}
}

function calculationPercent(){
    var totalYear = parseInt($("#promise-payperyear").val());
    var percent = parseInt($("#promise-distcountpercent").val());
    var distCount = ((totalYear * percent) / 100);
    var totalAll = (totalYear - distCount);
    $("#promise-distcountbath").val(distCount);
    $("#promise-total").val(totalAll);
}

function calculationBath(){
    var totalYear = parseInt($("#promise-payperyear").val());
    $("#promise-distcountpercent").val(0);
    var distCount = $("#promise-distcountbath").val();
    var totalAll = (totalYear - distCount);
    //$("#promise-distcountbath").val(distCount);
    $("#promise-total").val(parseInt(totalAll));
}
</script>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Customers;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */
/* @var $form yii\widgets\ActiveForm */
$yearUnit = array();
$levy = array();
$monthunit = array();
$deposit = array(0);

for($i=1;$i<=36;$i++)
{
    if($i<=5){
        array_push($yearUnit,$i);
    }
    if($i<=10){
        array_push($levy,$i);
    }
    if($i >=12){
        array_push($monthunit,$i);
    }
    if($i<=12){
        array_push($deposit,$i);
    }
}
//echo print_r($yearUnit);
?>

<div class="promise-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
        </div>
        <!-- <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'active')->dropDownList([ 1 => 'ใช้งาน', 0 => 'ไม่ใช้งาน', ], [],['options'=>['onchange'=>'getrecivetype()']]) ?>
        </div> -->
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'promisedatebegin')->widget(DatePicker::classname(),['language'=>'th','type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight'=>true,
                    'startDate' => "0d"
                ],
              
                'options'=>['class'=>'form-control','autocomplete'=>'off']]); 
            ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'promisedateend')->widget(DatePicker::classname(),['language'=>'th','type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight'=>true,
                    'startDate' => "0d"
                ],'options'=>['class'=>'form-control','autocomplete'=>'off']]); ?> 
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'garbageweight')->textInput() ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'levy')->dropDownList($levy) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'recivetype')->dropDownList([ 1 => 'รายเดือน', 0 => 'รายปี', ], 
                [
                    'onchange'=>'getrecivetype(this.value)',
                ] 
               
                );
            ?>
        </div>
    </div>

    <div class="row" id="divmonth">
        <div class="col-md-12 col-lg-4">
            <?= $form->field($model, 'rate')->textInput() ?>
        </div>
        <div class="col-md-12 col-lg-4">
            <?= $form->field($model, 'monthunit')->dropDownList($monthunit) ?>
        </div>
        <div class="col-md-12 col-lg-4">
            <?= $form->field($model, 'deposit')->dropDownList($deposit) ?>
        </div>
    </div>

    <div class="row" id="divyear">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'payperyear')->textInput() ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'yearunit')->dropDownList($yearUnit) ?>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'status')->dropDownList([ '0'=>'หมดสัญญา', '1'=>'รอยืนยัน', '2'=>'กำลังใช้งาน', '3'=>'กำลังต่อสัญญา', ], ['prompt' => 'สถานะสัญญา']) ?>
        </div>
        <div class="col-md-12 col-lg-6">
        <?= $form->field($model, 'checkmoney')->dropDownList([ '0'=>'ยังไม่ได้ชำระ', '1'=>'ชำระเงินแล้ว', ], ['prompt' => 'สถานะการชำระเงิน']) ?>
        </div>
    </div> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
if($model->id==""){
    $this->registerJs("getrecivetype(1);");
}else{
    $this->registerJs("getrecivetype(".$model->recivetype.");");
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

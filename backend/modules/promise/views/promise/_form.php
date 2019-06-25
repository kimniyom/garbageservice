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
?>

<div class="promise-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'active')->dropDownList([ 1 => 'ใช้งาน', 0 => 'ไม่ใช้งาน', ], ['prompt' => ''],['options'=>['onchange'=>'getrecivetype()']]) ?>
        </div>
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
            <?= $form->field($model, 'levy')->dropDownList([ 1,2,4]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'recivetype')->dropDownList([ 1 => 'รายเดือน', 0 => 'รายปี', ], ['prompt' => ''],['options'=>['onchange'=>'getrecivetype()']]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'rate')->textInput() ?>
        </div>
        <div class="col-md-12 col-lg-6">
        <?= $form->field($model, 'monthunit')->dropDownList([ 3,6,12,24,36]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'payperyear')->textInput() ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'yearunit')->dropDownList([ 1 => 1, 2 => 2, 3=>3]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'status')->dropDownList([ '0'=>'หมดสัญญา', '1'=>'รอยืนยัน', '2'=>'กำลังใช้งาน', '3'=>'กำลังต่อสัญญา', ], ['prompt' => 'สถานะสัญญา']) ?>
        </div>
        <div class="col-md-12 col-lg-6">
        <?= $form->field($model, 'checkmoney')->dropDownList([ '0'=>'ยังไม่ได้ชำระ', '1'=>'ชำระเงินแล้ว', ], ['prompt' => 'สถานะการชำระเงิน']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
function getrecivetype()
{
    console.log(123);
}
</script>

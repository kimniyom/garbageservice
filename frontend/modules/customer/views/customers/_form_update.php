<style type="text/css">
    .customers-form input{
        font-size: 16px;
        color: #333333;
    }
</style>
<?php

use common\models\Ampur;
use common\models\Changwat;
use common\models\Tambon;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin();?>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?=$form->field($model, 'company')->textInput(['maxlength' => true])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?=$form->field($model, 'taxnumber')->textInput(['maxlength' => true])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?=$form->field($model, 'address')->textInput(['maxlength' => true])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php
$province = Changwat::find()->all();
echo $form->field($model, 'changwat')->widget(Select2::classname(), [
	'data' => ArrayHelper::map($province, "changwat_id", "changwat_name"),
	'language' => 'th',
	'options' => [
		'placeholder' => 'Select a state ...',
		'id' => 'changwat',
	],
	'pluginOptions' => [
		'allowClear' => true,
	],
]);
?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?=
$form->field($model, 'ampur')->widget(DepDrop::classname(), [
	'data' => ArrayHelper::map(common\models\Ampur::find()->where(['changwat_id' => $model->changwat])->all(), 'ampur_id', 'ampur_name'),
	'type' => DepDrop::TYPE_SELECT2,
	'options' => ['id' => 'ampur'],
	//'data' => [$model->truck1],
	'pluginOptions' => [
		'required' => 'required',
		'depends' => ['changwat'],
		'placeholder' => 'เลือกอำเภอ...',
		'url' => Url::to(['customers/getamphur']),
	],
]);
?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?=
$form->field($model, 'tambon')->widget(DepDrop::classname(), [
	'data' => ArrayHelper::map(common\models\Tambon::find()->where(['ampur_id' => $model->ampur])->all(), 'tambon_id', 'tambon_name'),
	'type' => DepDrop::TYPE_SELECT2,
	'options' => ['id' => 'tambon'],
	//'data' => [$model->truck1],
	'pluginOptions' => [
		'required' => 'required',
		'depends' => ['ampur'],
		'placeholder' => 'เลือกตำบล...',
		'url' => Url::to(['customers/gettambon']),
	],
]);
?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?=$form->field($model, 'zipcode')->textInput(['maxlength' => true])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-lg-6">
            <?=$form->field($model, 'manager')->textInput(['maxlength' => true])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <?=$form->field($model, 'tel')->textInput(['maxlength' => true])?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <?=$form->field($model, 'telephone')->textInput(['maxlength' => true])?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">

            <div class="form-group">
                <?=Html::submitButton('แก้ไขข้อมูล', ['class' => 'btn btn-success', 'style' => 'font-size:20px;'])?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end();?>

</div>

<?php

use app\models\Ampur;
use app\models\Changwat;
use app\models\Tambon;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin();?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <?=$form->field($model, 'CUSTOMERNAME')->textInput(['maxlength' => true])?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
         <?=$form->field($model, 'ADDRESS')->textInput(['maxlength' => true])?>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-lg-3">
        <?php
            $province = Changwat::find()->all();
            echo $form->field($model, 'CHANGWAT')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($province, "changwat_id", "changwat_name"),
                'language' => 'th',
                'options' => [
                    'placeholder' => 'Select a state ...',
                    'id' => 'CHANGWAT',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
?>
</div>
<div class="col-md-3 col-lg-3">
    <?=
        $form->field($model, 'AMPUR')->widget(DepDrop::classname(), [
            'data' => ArrayHelper::map(app\models\Ampur::find()->where(['changwat_id' => $model->CHANGWAT])->all(), 'ampur_id', 'ampur_name'),
            'type' => DepDrop::TYPE_SELECT2,
            'options' => ['id' => 'AMPUR'],
            //'data' => [$model->truck1],
            'pluginOptions' => [
                'required' => 'required',
                'depends' => ['CHANGWAT'],
                'placeholder' => 'เลือกอำเภอ...',
                'url' => Url::to(['customer/getamphur']),
            ],
        ]);
?>
</div>
<div class="col-md-3 col-lg-3">
    <?=
        $form->field($model, 'TAMBON')->widget(DepDrop::classname(), [
            'data' => ArrayHelper::map(app\models\Tambon::find()->where(['ampur_id' => $model->AMPUR])->all(), 'tambon_id', 'tambon_name'),
            'type' => DepDrop::TYPE_SELECT2,
            'options' => ['id' => 'TAMBON'],
            //'data' => [$model->truck1],
            'pluginOptions' => [
                'required' => 'required',
                'depends' => ['AMPUR'],
                'placeholder' => 'เลือกตำบล...',
                'url' => Url::to(['customer/gettambon']),
            ],
        ]);
?>
</div>
<div class="col-md-3 col-lg-3">
    <?=$form->field($model, 'ZIPCODE')->textInput(['maxlength' => true])?>

</div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6">
    <?=$form->field($model, 'OWNER')->textInput(['maxlength' => true])?>
</div>
</div>

<div class="row">
    <div class="col-md-4 col-lg-4">
    <?=$form->field($model, 'MOBILE')->textInput(['maxlength' => true])?>
</div>
<div class="col-md-4 col-lg-4">
    <?=$form->field($model, 'OFFICETEL')->textInput(['maxlength' => true])?>
</div>
</div>

<div class="row">
    <div class="col-md-5 col-lg-5">
    <?=$form->field($model, 'EMAIL')->textInput(['maxlength' => true])?>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <?=$form->field($model, 'STATUS')->radioList([1 => 'ใช้งาน', 0 => 'ไม่ใช้งาน'])?>
    </div>
</div>


<div class="row">
    <div class="col-md-3 col-lg-3">
        <?=$form->field($model, 'APPROVE')->radioList([1 => 'ยืนยัน', 0 => 'ไม่ยืนยัน'])?>
    </div>
</div>
<hr/>
    <div class="row">
    <div class="col-md-3 col-lg-3">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>
</div>

    <?php ActiveForm::end();?>

</div>

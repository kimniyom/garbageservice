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
            <?php
                $customer = Customers::find()->all();
                echo $form->field($model, 'customerid')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($customer, "id", "company"),
                    'language' => 'th',
                    'options' => [
                        'placeholder' => 'Select a customer ...',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'rate')->textInput() ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'ratetext')->textInput(['maxlength' => true]) ?>
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
            <?= $form->field($model, 'recivetype')->dropDownList([ 1 => 'รายเดือน', 0 => 'รายครั้ง', ], ['prompt' => '']) ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'levy')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'payperyear')->textInput() ?>
        </div>
        <div class="col-md-12 col-lg-6">
            <?= $form->field($model, 'payperyeartext')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

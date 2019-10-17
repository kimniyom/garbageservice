<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
use kartik\datetime\DateTimePicker;
use app\models\Bookbank;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Invoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-form">

    <?php
    $form = ActiveForm::begin();
    ?>
    <div class="row">
        <div class="col-md-6 col-lg-5">
            <?php
            echo $form->field($model, 'bank')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($bank, "id", "bname"),
                'language' => 'th',
                'options' => [
                    'placeholder' => 'Select a state ...',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-5">
            <?=
            $form->field($model, 'dateservice')->widget(DatePicker::classname(), [
                'language' => 'th',
                'removeButton' => false,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                ],
                'options' => [
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'value' => date("Y-m-d"),
                    'readonly' => true,
                ]
            ]);
            ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?php
            echo $form->field($model, 'timeservice')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'secondStep' => 5,
                    'readonly' => true,
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'total')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'comment')->textarea(['maxlength' => true, 'rows' => '5']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">

            <?php echo Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>

        </div>
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'slip')->fileInput() ?>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

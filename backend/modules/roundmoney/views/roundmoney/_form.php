<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\roundmoney\models\Roundmoney */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roundmoney-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
                $sql = "select * from promise
                        where 
                            NOW() between promisedatebegin
                        and
                            DATE_ADD(promisedateend,INTERVAL 1 DAY)";
                $promise = Promise::find()->where(['status' => '2', 'active'=>'1'])->All();
                echo $form->field($model, 'promiseid')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($promise, "id", "id"),
                    'language' => 'th',
                    'options' => [
                        'placeholder' => 'Select a promise ...',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
    ?>

    

    <?= $form->field($model, 'datekeep')->widget(DatePicker::classname(),['language'=>'th','type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ],'options'=>['class'=>'form-control','autocomplete'=>'off']]); ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'keepby')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 1 => 'เก็บเรียบร้อย', 0 => 'ยังไม่ได้เก็บ', ]) ?>

    <?= $form->field($model, 'receiptnumber')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

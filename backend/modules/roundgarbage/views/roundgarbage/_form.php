<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\modules\customer\models\Customer;
use app\modules\promise\models\Promise;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\Roundgarbage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roundgarbage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
                $customer = Customer::find()->all();
                echo $form->field($model, 'customerid')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($customer, "ID", "CUSTOMERNAME"),
                    'language' => 'th',
                    'options' => [
                        'placeholder' => 'Select a customer ...',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
    ?>

    <?php
                $sql = "select * from promise
                        where 
                            NOW() between promisedatebegin
                        and
                            DATE_ADD(promisedateend,INTERVAL 1 DAY)";
                $promise = Yii::$app->db->createCommand($sql)->queryAll();
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

    <?= $form->field($model, 'status')->dropDownList([ 1 => 'จัดเก็บแล้ว', 0 => 'ยังไม่ได้จัดเก็บ', ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

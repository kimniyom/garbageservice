<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Datekeep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="datekeep-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-6 col-lg-5">
            <?=
                $form->field($model, 'datekeep')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ],
                    'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);
            ?>
        </div>

        

        

            

    </div>

    

    <?//= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

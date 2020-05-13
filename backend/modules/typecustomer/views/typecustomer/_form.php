<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Typecustomer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="typecustomer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'typename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'typename_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

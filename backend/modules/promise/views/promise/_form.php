<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'promisid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'license')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promisedatebegin')->textInput() ?>

    <?= $form->field($model, 'promisedateend')->textInput() ?>

    <?= $form->field($model, 'recivetype')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'levy')->textInput() ?>

    <?= $form->field($model, 'homenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tambon')->textInput() ?>

    <?= $form->field($model, 'ampur')->textInput() ?>

    <?= $form->field($model, 'changwat')->textInput() ?>

    <?= $form->field($model, 'createat')->textInput() ?>

    <?= $form->field($model, 'employer')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

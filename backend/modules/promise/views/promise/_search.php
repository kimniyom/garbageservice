<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\PromiseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promise-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'promisid') ?>

    <?= $form->field($model, 'place') ?>

    <?= $form->field($model, 'license') ?>

    <?= $form->field($model, 'promisedatebegin') ?>

    <?= $form->field($model, 'promisedateend') ?>

    <?php // echo $form->field($model, 'recivetype') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'levy') ?>

    <?php // echo $form->field($model, 'homenumber') ?>

    <?php // echo $form->field($model, 'tambon') ?>

    <?php // echo $form->field($model, 'ampur') ?>

    <?php // echo $form->field($model, 'changwat') ?>

    <?php // echo $form->field($model, 'createat') ?>

    <?php // echo $form->field($model, 'employer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

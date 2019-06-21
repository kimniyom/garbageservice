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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customerid') ?>

    <?= $form->field($model, 'promisedatebegin') ?>

    <?= $form->field($model, 'promisedateend') ?>

    <?= $form->field($model, 'recivetype') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'ratetext') ?>

    <?php // echo $form->field($model, 'levy') ?>

    <?php // echo $form->field($model, 'payperyear') ?>

    <?php // echo $form->field($model, 'payperyeartext') ?>

    <?php // echo $form->field($model, 'createat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

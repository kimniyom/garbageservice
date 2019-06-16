<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\RoundgarbageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roundgarbage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customerid') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'datekeep') ?>

    <?= $form->field($model, 'round') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'keepby') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

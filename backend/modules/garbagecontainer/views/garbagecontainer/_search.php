<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\garbagecontainer\models\GarbagecontainerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="garbagecontainer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'garbagecontainer') ?>

    <?= $form->field($model, 'size') ?>

    <?= $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'contain') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'PRICE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\news\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'TITLE') ?>

    <?= $form->field($model, 'CONTENT') ?>

    <?= $form->field($model, 'CREATEAT') ?>

    <?= $form->field($model, 'UPDATEAT') ?>

    <?php // echo $form->field($model, 'CREATEBY') ?>

    <?php // echo $form->field($model, 'UPDATEBY') ?>

    <?php // echo $form->field($model, 'ISSHOW') ?>

    <?php // echo $form->field($model, 'CATEGORY') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

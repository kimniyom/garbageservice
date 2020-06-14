<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\CustomerneedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customerneed-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'customername') ?>

    <?= $form->field($model, 'customrttype') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'contact') ?>

    <?php // echo $form->field($model, 'dayopen') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'roundofweek') ?>

    <?php // echo $form->field($model, 'roundofmount') ?>

    <?php // echo $form->field($model, 'priceofmount') ?>

    <?php // echo $form->field($model, 'priceofyear') ?>

    <?php // echo $form->field($model, 'typebill') ?>

    <?php // echo $form->field($model, 'roundprice') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'd_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\CustomerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'manager') ?>

    <?= $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'OFFICETEL') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'APPROVE') ?>

    <?php // echo $form->field($model, 'CHANGWAT') ?>

    <?php // echo $form->field($model, 'AMPUR') ?>

    <?php // echo $form->field($model, 'TAMBON') ?>

    <?php // echo $form->field($model, 'ZIPCODE') ?>

    <?php // echo $form->field($model, 'CREATE_DATE') ?>

    <?php // echo $form->field($model, 'UPDATE_DATE') ?>

    <?php // echo $form->field($model, 'DATE_APPROVE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

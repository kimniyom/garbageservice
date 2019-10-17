<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\InvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'invoicenumber') ?>

    <?= $form->field($model, 'promise') ?>

    <?= $form->field($model, 'round') ?>

    <?= $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'month') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'd_update') ?>

    <?php // echo $form->field($model, 'timeservice') ?>

    <?php // echo $form->field($model, 'dateservice') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'dateinvoice') ?>

    <?php // echo $form->field($model, 'datebill') ?>

    <?php // echo $form->field($model, 'typeinvoice') ?>

    <?php // echo $form->field($model, 'slip') ?>

    <?php // echo $form->field($model, 'bank') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

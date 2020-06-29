<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConfirmformSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="confirmform-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'confirmformnumber') ?>

    <?= $form->field($model, 'customerid') ?>

    <?= $form->field($model, 'typeform') ?>

    <?= $form->field($model, 'roundkeep_sunday') ?>

    <?php // echo $form->field($model, 'roundkeep_monday') ?>

    <?php // echo $form->field($model, 'roundkeep_tueday') ?>

    <?php // echo $form->field($model, 'roundkeep_wednesday') ?>

    <?php // echo $form->field($model, 'roundkeep_thursday') ?>

    <?php // echo $form->field($model, 'roundkeep_friday') ?>

    <?php // echo $form->field($model, 'roundkeep_saturday') ?>

    <?php // echo $form->field($model, 'roundkeep_day') ?>

    <?php // echo $form->field($model, 'timeperiod') ?>

    <?php // echo $form->field($model, 'timeperiod_time') ?>

    <?php // echo $form->field($model, 'billdoc_originalinvoice') ?>

    <?php // echo $form->field($model, 'billdoc_copyofinvoice') ?>

    <?php // echo $form->field($model, 'billdoc_originalreceipt') ?>

    <?php // echo $form->field($model, 'billdoc_copyofreceipt') ?>

    <?php // echo $form->field($model, 'billdoc_copyofbank') ?>

    <?php // echo $form->field($model, 'billdoc_etc') ?>

    <?php // echo $form->field($model, 'billdoc_etctext') ?>

    <?php // echo $form->field($model, 'cyclekeepmoney') ?>

    <?php // echo $form->field($model, 'paymentschedule') ?>

    <?php // echo $form->field($model, 'methodpeyment') ?>

    <?php // echo $form->field($model, 'sendtype') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

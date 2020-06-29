<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Confirmform */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="confirmform-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'confirmformnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customerid')->textInput() ?>

    <?= $form->field($model, 'typeform')->textInput() ?>

    <?= $form->field($model, 'roundkeep_sunday')->checkBox() ?>

    <?= $form->field($model, 'roundkeep_monday')->checkBox() ?>

    <?= $form->field($model, 'roundkeep_tueday')->checkBox() ?>

    <?= $form->field($model, 'roundkeep_wednesday')->checkBox() ?>

    <?= $form->field($model, 'roundkeep_thursday')->checkBox() ?>

    <?= $form->field($model, 'roundkeep_friday')->checkBox() ?>

    <?= $form->field($model, 'roundkeep_saturday')->checkBox() ?>

    <?= $form->field($model, 'roundkeep_day')->checkBox() ?>

    <?= $form->field($model, 'timeperiod')->checkBox() ?>

    <?= $form->field($model, 'timeperiod_time')->checkBox() ?>

    <?= $form->field($model, 'billdoc_originalinvoice')->checkBox() ?>

    <?= $form->field($model, 'billdoc_copyofinvoice')->checkBox() ?>

    <?= $form->field($model, 'billdoc_originalreceipt')->checkBox() ?>

    <?= $form->field($model, 'billdoc_copyofreceipt')->checkBox() ?>

    <?= $form->field($model, 'billdoc_copyofbank')->checkBox() ?>

    <?= $form->field($model, 'billdoc_etc')->checkBox() ?>

    <?= $form->field($model, 'billdoc_etctext')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cyclekeepmoney')->textInput() ?>

    <?= $form->field($model, 'paymentschedule')->textInput() ?>

    <?= $form->field($model, 'methodpeyment')->textInput() ?>

    <?= $form->field($model, 'sendtype')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

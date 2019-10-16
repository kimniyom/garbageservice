<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Bank;
/* @var $this yii\web\View */
/* @var $model app\models\Bookbank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bookbank-form">
  <div class="row">
    <div class="col-md-6 col-lg-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bookbanknumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bookbankname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?>

    <?php
    $Bank = Bank::find()->all();
      echo $form->field($model, 'bank')->widget(Select2::classname(), [
      'data' => ArrayHelper::map($Bank, "id", "bankname"),
      'language' => 'th',
      'options' => [
      'placeholder' => 'Select a state ...',
      ],
      'pluginOptions' => [
      'allowClear' => true,
      ],
      ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>
</div>

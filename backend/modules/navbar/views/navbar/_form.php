<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\navbar\models\Navbar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="navbar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'navbar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'submenu')->textInput() ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

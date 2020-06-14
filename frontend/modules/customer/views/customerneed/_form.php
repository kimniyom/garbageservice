<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\customer\models\Typecustomer;
use app\modules\customer\models\Vattype;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customerneed */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customerneed-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customername')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'customrttype')->textInput() ?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?php
            $type = Typecustomer::find()->all();
            echo $form->field($model, 'customrttype')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($type, "id", "typename"),
                'language' => 'th',
                'options' => [
                    'placeholder' => 'Select a state ...',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
    </div>
    <?php //$form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?php // $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contact')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'dayopen')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'roundofweek')->textInput() ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'roundofmount')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'priceofmount')->textInput() ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'priceofyear')->textInput() ?>
        </div>
    </div>

    <?php //$form->field($model, 'typebill')->textInput() ?>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php
            $vattype = Vattype::find()->all();
            echo $form->field($model, 'typebill')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($vattype, "id", "vattype"),
                'language' => 'th',
                'options' => [
                    'placeholder' => 'Select a state ...',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
    </div>
    <?php // $form->field($model, 'roundprice')->textInput() ?>
    <?= $form->field($model, 'roundprice')->radioList(['1' => 'รายเดือน', '2' => 'รายปี']) ?>
    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?php
    /*
      echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
      'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
      ])
     *
     */
    ?>
    <hr/>
    <div class="form-group">
        <?= Html::submitButton('ส่งแบบฟอร์ม', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

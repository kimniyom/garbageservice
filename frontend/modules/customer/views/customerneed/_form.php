<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\customer\models\Typecustomer;
use app\modules\customer\models\Vattype;
use common\models\Changwat;
use common\models\Ampur;
use common\models\Tambon;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
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
    <?= $form->field($model, 'address')->textarea(['rows' => 1]) ?>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php
            $province = Changwat::find()->all();
            echo $form->field($model, 'changwat')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($province, "changwat_id", "changwat_name"),
                'language' => 'th',
                'options' => [
                    'placeholder' => 'Select a state ...',
                    'id' => 'CHANGWAT',
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?=
            $form->field($model, 'amphur')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(Ampur::find()->where(['changwat_id' => $model->changwat])->all(), 'ampur_id', 'ampur_name'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'AMPUR'],
                //'data' => [$model->truck1],
                'pluginOptions' => [
                    'required' => 'required',
                    'depends' => ['CHANGWAT'],
                    'placeholder' => 'เลือกอำเภอ...',
                    'url' => Url::to(['customerneed/getamphur']),
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?=
            $form->field($model, 'tambon')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(Tambon::find()->where(['ampur_id' => $model->amphur])->all(), 'tambon_id', 'tambon_name'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'TAMBON'],
                //'data' => [$model->truck1],
                'pluginOptions' => [
                    'required' => 'required',
                    'depends' => ['AMPUR'],
                    'placeholder' => 'เลือกตำบล...',
                    'url' => Url::to(['customerneed/gettambon']),
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
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
            <?= $form->field($model, 'priceofonetime')->textInput() ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'priceofmount')->textInput() ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'priceofyear')->textInput() ?>
        </div>
    </div>

    <?php //$form->field($model, 'typebill')->textInput() ?>
    <div class="row">
        <div class="col-md-5 col-lg-5">
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
    <?= $form->field($model, 'vat')->radioList(['0' => 'ไม่รวม vat', '1' => 'รวม vat']) ?>
    <?php // $form->field($model, 'roundprice')->textInput() ?>
    <?= $form->field($model, 'roundprice')->radioList(['1' => 'รายเดือน', '2' => 'รายปี']) ?>
    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?php
    echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ])
    ?>
    <hr/>
    <div class="form-group">
        <?= Html::submitButton('ส่งแบบฟอร์ม', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use app\models\Ampur;
use app\models\Changwat;
use app\models\Tambon;
use app\models\Typecustomer;
use app\models\Vattype;
use app\models\Businesstype;
use app\models\Grouptypecustomer;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php
            $type = Typecustomer::find()->all();
            echo $form->field($model, 'type')->widget(Select2::classname(), [
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
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php
            $vattype = Vattype::find()->all();
            echo $form->field($model, 'typeregister')->widget(Select2::classname(), [
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
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5 col-lg-5">
            <?= $form->field($model, 'taxnumber')->textInput(['maxlength' => true, 'value' => $taxnumber, 'readonly' => 'readonly']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-lg-10">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
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
            $form->field($model, 'ampur')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(app\models\Ampur::find()->where(['changwat_id' => $model->changwat])->all(), 'ampur_id', 'ampur_name'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'AMPUR'],
                //'data' => [$model->truck1],
                'pluginOptions' => [
                    'required' => 'required',
                    'depends' => ['CHANGWAT'],
                    'placeholder' => 'เลือกอำเภอ...',
                    'url' => Url::to(['customers/getamphur']),
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?=
            $form->field($model, 'tambon')->widget(DepDrop::classname(), [
                'data' => ArrayHelper::map(app\models\Tambon::find()->where(['ampur_id' => $model->ampur])->all(), 'tambon_id', 'tambon_name'),
                'type' => DepDrop::TYPE_SELECT2,
                'options' => ['id' => 'TAMBON'],
                //'data' => [$model->truck1],
                'pluginOptions' => [
                    'required' => 'required',
                    'depends' => ['AMPUR'],
                    'placeholder' => 'เลือกตำบล...',
                    'url' => Url::to(['customers/gettambon']),
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
            <?= $form->field($model, 'manager')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4">
            <?= $form->field($model, 'telephone')->textInput(['maxlength' => true, 'placeholder' => 'Ex.0800000000']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'remark')->textArea(['rows' => 5]) ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'timework')->textArea(['rows' => 1]) ?>
        </div>
    </div>



    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?= $form->field($location, 'lat')->textInput() ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?= $form->field($location, 'long')->textInput() ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'lineid')->textInput() ?>
        </div>
    </div>


    <!-- <div class="row">
        <div class="col-md-4 col-lg-4">
            <?//=$form->field($model, 'STATUS')->radioList([1 => 'ใช้งาน', 0 => 'ไม่ใช้งาน'])?>
        </div>
    </div> -->

    <!-- <div class="row">
        <div class="col-md-3 col-lg-3">
            <?php
            // $grouptype = Grouptypecustomer::find()->all();
            // echo $form->field($model, 'grouptype')->widget(Select2::classname(), [
            //     'data' => ArrayHelper::map($grouptype, "id", "groupname"),
            //     'language' => 'th',
            //     'options' => [
            //         'placeholder' => 'ประเภทกลุ่มลูกค้า ',
            //         'id' => 'grouptype',
            //     ],
            //     'pluginOptions' => [
            //         'allowClear' => true,
            //     ],
            // ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <?php
            // $businesstype = Businesstype::find()->all();
            // echo $form->field($model, 'businesstype')->widget(Select2::classname(), [
            //     'data' => ArrayHelper::map($businesstype, "id", "businesstype"),
            //     'language' => 'th',
            //     'options' => [
            //         'placeholder' => 'ประเภทธุรกิจ ',
            //         'id' => 'businesstype',
            //     ],
            //     'pluginOptions' => [
            //         'allowClear' => true,
            //     ],
            // ]);
            ?>
        </div>
    </div> -->


    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?= $form->field($model, 'approve')->radioList(['Y' => 'ยืนยัน', 'N' => 'ไม่ยืนยัน']) ?>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

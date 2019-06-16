<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Ampur;
use app\models\Changwat;
use app\models\Tambon;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promise-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'license')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promisedatebegin')->widget(DatePicker::classname(),['language'=>'th','type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ],'options'=>['class'=>'form-control','autocomplete'=>'off']]); ?>

    <?= $form->field($model, 'promisedateend')->widget(DatePicker::classname(),['language'=>'th','type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ],'options'=>['class'=>'form-control','autocomplete'=>'off']]); ?>

    <?=$form->field($model, 'recivetype')->radioList([1 => 'รายเดือน', 0 => 'รายครั้ง'], ['prompt' => ''])?>
   
    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'ratetext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'levy')->textInput() ?>

    <?= $form->field($model, 'employer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payperyear')->textInput() ?>

    <?= $form->field($model, 'payperyeartext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'homenumber')->textInput(['maxlength' => true]) ?>

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
                        'url' => Url::to(['promise/getamphur']),
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
                        'url' => Url::to(['promise/gettambon']),
                    ],
                ]);
        ?>
        </div>

    </div>

    <?= $form->field($model, 'createat')->widget(DatePicker::classname(),['language'=>'th','type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
    ],'options'=>['class'=>'form-control','autocomplete'=>'off']]); ?>

    <?= $form->field($model, 'contactname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contactphone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Tambon;
use common\models\Ampur;
use common\models\Changwat;

use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taxnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'changwat')->dropdownList(
            ArrayHelper::map(Changwat::find()->all(),
            'changwat_id',
            'changwat_name'),
            [
                'id'=>'ddl-changwat',
                'prompt'=>'เลือกจังหวัด'
    ]); ?>

    <?= $form->field($model, 'ampur')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-ampur'],
            'data'=> $ampur,
            'pluginOptions'=>[
                'depends'=>['ddl-changwat'],
                'placeholder'=>'เลือกอำเภอ...',
                'url'=>Url::to(['/customers/get-amphur'])
            ]
        ]); ?>

    <?= $form->field($model, 'tambon')->widget(DepDrop::classname(), [
           'data' =>$district,
           'pluginOptions'=>[
               'depends'=>['ddl-changwat', 'ddl-ampur'],
               'placeholder'=>'เลือกตำบล...',
               'url'=>Url::to(['/customers/get-district'])
           ]
    ]); ?>

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'approve')->dropDownList([ 'N' => 'N', 'Y' => 'Y', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

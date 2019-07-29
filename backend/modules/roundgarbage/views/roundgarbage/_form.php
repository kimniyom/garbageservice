<?php

use app\modules\promise\models\Promise;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\Roundgarbage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roundgarbage-form">

    <?php $form = ActiveForm::begin();?>

    <?php

        $promise = Promise::find()->where(['status' => '2', 'active' => '1'])->All();
        echo $form->field($model, 'promiseid')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($promise, "id", "promisenumber"),
            'language' => 'th',
            'options' => [
                'placeholder' => 'Select a promise ...',
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]);
    ?>

    <?=$form->field($model, 'datekeep')->widget(DatePicker::classname(), 
        ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
            ], 'options' => ['class' => 'form-control', 'autocomplete' => 'off']
        ]);
    ?>



    <?//=$form->field($model, 'amount')->textInput()?>

    <?//=$form->field($model, 'keepby')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'status')->dropDownList([0 => 'ยังไม่ได้จัดเก็บ',1 => 'จัดเก็บแล้ว'])?>

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>

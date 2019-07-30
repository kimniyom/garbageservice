<?php
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin();?>
    <div class="promise-form">
        <div class="row">
            <div class="col-md-5 col-lg-5">
                <?=$form->field($model, 'etc')->textInput(['id'=>'etc'])?>
            </div>
        </div>
        <div class="form-group">
            <?=Html::submitButton('ยกเลิกสัญญา', ['class' => 'btn btn-danger'])?>
        </div>
    </div>
<?php ActiveForm::end();?>
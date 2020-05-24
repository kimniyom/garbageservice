<?php

use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin(); ?>
<div class="promise-form">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'etc')->textarea(['id' => 'etc', 'class' => 'form-control', 'rows' => 5]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('ยกเลิกสัญญา', ['class' => 'btn btn-danger']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
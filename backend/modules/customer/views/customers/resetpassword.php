<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */
/* @var $form yii\widgets\ActiveForm */


$this->title = "$company";
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้าทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-3 col-lg-12"><h3>สร้างรหัสผ่านใหม่</h3></div>
    </div>
    <hr style="margin-top: 0px;"/>
        <div class="row">
            <div class="col-md-3 col-lg-4">
            
                <?= $form->field($model, 'password_hash')->passwordInput() ?>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-3 col-lg-3">
                <?= Html::submitButton('Reset', [
                    'class' => 'btn btn-warning',
                    'data-confirm' => 'ยืนยันการรีเซ็ตรหัสผ่าน'
                ]); ?>
               
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
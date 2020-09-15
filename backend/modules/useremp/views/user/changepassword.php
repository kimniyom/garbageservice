<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\useremp\models\User */

$this->title = 'เปลี่ยนรหัสผ่าน';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>
    <?php $form = ActiveForm::begin([
       
    ]); ?>
        <div class="row">
            <div class="col-md-5 col-lg-5">
                <?= $form->field($model, 'password_old')->passwordInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-lg-5">
                <?= $form->field($model, 'password_new')->passwordInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-lg-5">
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 col-lg-5">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    
</div>




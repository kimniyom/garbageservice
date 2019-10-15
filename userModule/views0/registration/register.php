<style type="text/css">
    body{
        background:#eeeeee;
    }


</style>
<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row justify-content-md-center">
    <div class="col col-lg-2">
    
    </div>
    <div class="col-md-4">
        <div class="card" style="">
                <div class="card-header" style="text-align: center;color:#ab8f52;"><h4><?= Html::encode($this->title) ?></h4>
            </div>
           <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

                <?php if ($module->enableGeneratingPassword == false): ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                <?php endif ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="card-footer">
                <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
            </div>
        </div>
        <p style="text-align:center;color: #ab8f52; margin-top:10px;">ไอซี ควอลิตี้ ซิสเท็ม จำกัด</p>
    </div>
        <div class="col col-lg-2">
    
    </div>
</div>

<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'ติดต่อเรา';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <br/>
    <h1 style="text-align: center; font-family: Th"><?= Html::encode($this->title) ?></h1>
<hr/>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'subject') ?>

            <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

            <?=
            $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ])
            ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-7">
            <table class="table" style=" font-family: Th; font-size: 24px;">
                <tr>
                    <td style=" border-top: 0px;">
                        <i class="fa fa-home fa-3x"></i>
                    </td>
                    <td style=" border-top: 0px;">
                        <b class="text-danger">ADDRESS</b><br/>
                        44/5 ม.2 ต.บ้านกลาง อ.เมือง จ.ปทุมธานี 12000
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="fa fa-phone fa-3x"></i>
                    </td>
                    <td>
                        <b class="text-danger">PHONE NUMBER</b><br/>
                        Tel : (02) 101-0325<br/>
                        Mobile #1: 096-878-1596<br/>
                        Mobile #2: 092-641-7564
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <i class="fa fa-envelope fa-3x"></i>
                    </td>
                    <td>
                        <b class="text-danger">EMAIL</b><br/>
                        icquality@icqs.net
                    </td>
                </tr>
                <tr>
                    <td>
                        <img src="<?php echo \yii\helpers\Url::to('../images/qrcodeline.PNG')?>" style="height: 80px;"/>
                    </td>
                    <td>
                        <b class="text-danger">Line Official</b><br/>
                        @icqualitysystem
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

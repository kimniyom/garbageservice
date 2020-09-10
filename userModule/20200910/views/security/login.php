<style type="text/css">
    body{
        background:#eeeeee;
    }


</style>

<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */
$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row justify-content-md-center" style=" margin: 0px;">
    <div class="col col-lg-2">

    </div>
    <div class="col-md-4">
        <div class="card" style=" margin-top: 100px; box-shadow: 0px 0px 30px #c1c2c2;">
            <div class="card-header" style="text-align: center; color: #660000; background: #ffffff;">
                <h4>Login</h4>
                IC QUALITY SYSTEM Co., Ltd.
            </div>
            <div class="card-body">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => false,
                            'validateOnBlur' => false,
                            'validateOnType' => false,
                            'validateOnChange' => false,
                        ])
                ?>

                <?php if ($module->debug): ?>
                    <?=
                    $form->field($model, 'login', [
                        'inputOptions' => [
                            'autofocus' => 'autofocus',
                            'class' => 'form-control',
                            'tabindex' => '1']])->dropDownList(LoginForm::loginList());
                    ?>

                <?php else: ?>

                    <?=
                    $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
                    );
                    ?>

                <?php endif ?>

                <?php if ($module->debug): ?>
                    <div class="alert alert-warning">
                        <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
                    </div>
                <?php else: ?>
                    <?=
                            $form->field(
                                    $model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                            ->passwordInput()
                            ->label(
                                    Yii::t('user', 'Password')
                            )
                    ?>
                <?php endif ?>



                <?=
                Html::submitButton(
                        Yii::t('user', 'Sign in'), ['class' => 'btn btn-secondary btn-block', 'tabindex' => '4']
                )
                ?>

                <?php ActiveForm::end(); ?>


            </div>
            <div class="card-footer" style=" background: #ffffff;">
                <p class="text-center">
                    <a href="<?php echo Yii::$app->urlManagerFrontend->createUrl('') ?>" style=" text-decoration: none;">กลับหน้าหลัก</a>
                </p>

            </div>
        </div>
        <p style="text-align:center;color: #ab8f52; margin-top:10px;">บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด</p>
    </div>
    <div class="col col-lg-2">

    </div>
</div>




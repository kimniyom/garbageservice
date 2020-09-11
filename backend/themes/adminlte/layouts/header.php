
<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header" style=" z-index: 10;">

    <?= Html::a('<span class="logo-mini" style=" z-index: 5;">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu" >

            <ul class="nav navbar-nav">
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">รายงาน <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['report/report/invoicehistory']) ?>"><i class="fa fa-chevron-right"></i> ประวัติการชำระเงิน</a></li>
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['report/report/roundhistory']) ?>"><i class="fa fa-chevron-right"></i> ประวัติการจัดเก็บขยะ</a></li>
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['report/report/reportworkingarbage']) ?>"><i class="fa fa-chevron-right"></i> รายงานการเข้าจัดเก็บขยะ</a></li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo Url::to('@web/web/images/Folders-OS-User-No-Frame-Metro-icon.png') ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php
                            if (!Yii::$app->user->isGuest) {
                                echo Yii::$app->user->identity->username;
                            }
                            ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo Url::to('@web/web/images/Folders-OS-User-No-Frame-Metro-icon.png') ?>" class="img-circle" alt="User Image"/>

                            <p>
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                    echo Yii::$app->user->identity->username;
                                }
                                ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['user/settings/account']) ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?=
                                Html::a(
                                        'Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!--
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                -->
            </ul>
        </div>
    </nav>
</header>

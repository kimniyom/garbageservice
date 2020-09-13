<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
            'main-login', ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags() ?>
            <link rel="shortcut icon" type="image/png" href="<?php echo Url::to('../images/logo-sm.png') ?>" />
            <link rel="stylesheet" href="<?php echo Url::to('@web/web/datatable/dataTables.bootstrap.min.css') ?>">
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
        </head>
        <body class="hold-transition skin-black sidebar-mini fixed">
            <?php $this->beginBody() ?>
            <div class="wrapper">

                <?=
                $this->render(
                        'header.php', ['directoryAsset' => $directoryAsset]
                )
                ?>

                <?=
                $this->render(
                        'left.php', ['directoryAsset' => $directoryAsset]
                )
                ?>

                <?=
                $this->render(
                        'content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]
                )
                ?>

            </div>
            <?php $this->endBody() ?>

            <script type="text/javascript">
                function checkActivie() {
                    var status = "<?php echo Yii::$app->user->isGuest ?>";
                    var url = "<?php echo Yii::$app->urlManager->createUrl(['site/logout']) ?>";
                    if (status == 1) {
                        window.location = url;
                    }
                }
            </script>
            <?php
            $this->registerJs('checkActivie()');
            ?>
        </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>

<script type="text/javascript" src="<?php echo Url::to('@web/web/uploadifive/jquery.uploadifive.min.js') ?>"></script>
<!--
<script type="text/javascript" src="https://adminlte.io/themes/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
-->

<script src="<?php echo Url::to('@web/web/js/jquery.slimscroll.min.js') ?>"></script>
<script src="<?php echo Url::to('@web/web/js/highcharts.src.js') ?>"></script>
<script src="<?php echo Url::to('@web/web/js/sweetalert2@9.js') ?>"></script>
<!-- DataTables -->
<script src="<?php echo Url::to('@web/web/datatable/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo Url::to('@web/web/datatable/dataTables.bootstrap.min.js') ?>"></script>



<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\PdkAsset;
use common\widgets\Alert;

PdkAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style type="text/css">
            html,
            body {
                height: 100%;
            }

            .carousel,
            .item,
            .active {
                height: 100%;
            }

            .carousel-inner {
                height: 100%;
                background: #000;
            }

            .carousel-caption{padding-bottom:80px;}

            h2{font-size: 60px;}
            p{padding:10px}

            /* Background images are set within the HTML using inline CSS, not here */

            .fill {
                width: 100%;
                height: 100%;
                background-position: center;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
                opacity:0.6;
            }




            /**
             * Button
             */
            .btn-transparent {
                background: transparent;
                color: #fff;
                border: 2px solid #fff;
            }
            .btn-transparent:hover {
                background-color: #fff;
            }

            .btn-rounded {
                border-radius: 70px;
            }

            .btn-large {
                padding: 11px 45px;
                font-size: 18px;
            }

            /**
             * Change animation duration
             */
            .animated {
                -webkit-animation-duration: 1.5s;
                animation-duration: 1.5s;
            }

            @-webkit-keyframes fadeInRight {
                from {
                    opacity: 0;
                    -webkit-transform: translate3d(100px, 0, 0);
                    transform: translate3d(100px, 0, 0);
                }

                to {
                    opacity: 1;
                    -webkit-transform: none;
                    transform: none;
                }
            }

            @keyframes fadeInRight {
                from {
                    opacity: 0;
                    -webkit-transform: translate3d(100px, 0, 0);
                    transform: translate3d(100px, 0, 0);
                }

                to {
                    opacity: 1;
                    -webkit-transform: none;
                    transform: none;
                }
            }

            .fadeInRight {
                -webkit-animation-name: fadeInRight;
                animation-name: fadeInRight;
            }

        </style>
    </head>
    <body>
        <?php $this->beginBody() ?>


        <?php
        /*
          NavBar::begin([
          'brandLabel' => Yii::$app->name,
          'brandUrl' => Yii::$app->homeUrl,
          'options' => [
          'class' => 'navbar-inverse navbar-fixed-top',
          ],
          ]);
          $menuItems = [
          ['label' => 'Home', 'url' => ['/site/index']],
          ['label' => 'About', 'url' => ['/site/about']],
          ['label' => 'Contact', 'url' => ['/site/contact']],
          ];
          if (Yii::$app->user->isGuest) {
          $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
          $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
          } else {
          $menuItems[] = '<li>'
          . Html::beginForm(['/site/logout'], 'post')
          . Html::submitButton(
          'Logout (' . Yii::$app->user->identity->username . ')',
          ['class' => 'btn btn-link logout']
          )
          . Html::endForm()
          . '</li>';
          }
          echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' => $menuItems,
          ]);
          NavBar::end();
         */
        ?>

        <iframe height="1000" width="100%" style="border:none; display:block" src="https://mobirise.com/bootstrap-carousel/"></iframe>


        <div class="container">
            <?php /*
              echo Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              ])
             */ ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>




        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

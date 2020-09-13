<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Config;
use app\modules\news\models\News;
use common\widgets\Alert;
use frontend\assets\AppAssetTheme;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

AppAssetTheme::register($this);

$Config = new Config();
$menu = $Config->getMenu();

//use yii\widgets\Breadcrumbs;

$newsModel = new News();

$sql = "SELECT g.*,i.image
                FROM garbagecontainer g
                INNER JOIN imgcontain i ON g.id = i.garbagecontainer_id";
$categorys = Yii::$app->db->createCommand($sql)->queryAll();

$sqlNews = "select * from news limit 3";
$news = Yii::$app->db->createCommand($sqlNews)->queryAll();
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
        <link rel="shortcut icon" type="image/png" href="<?php echo Url::to('../images/logo-sm.png') ?>" />
        <!--
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        -->
        <script src="<?php echo Url::to('@web/web/js/sweetalert2@9.js') ?>"></script>
        <?php $this->head() ?>
        <style type="text/css">
            .breadcrumb {
                padding: 8px 15px;
                margin-top: 20px;
                margin-bottom: 20px;
                list-style: none;
                background: none;
                border-radius: 4px;
                font-size: 20px;
                font-family: 'Th';
            }
            .breadcrumb > li {
                display: inline-block;
            }
            .breadcrumb > li + li:before {
                padding: 0 5px;
                color: #ccc;
                content: "/\00a0";
            }
            .breadcrumb > .active {
                color: #777777;
            }
            .footer_list li a {
                font-size: 12px;
                font-weight: 500;
                color: #eeeeee;
                -webkit-transition: all 200ms ease;
                -moz-transition: all 200ms ease;
                -ms-transition: all 200ms ease;
                -o-transition: all 200ms ease;
                transition: all 200ms ease;
            }

            .footer_list li a:hover {
                color: #0e8ce4;
            }

            .top_bar{
                background: #0074ff;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #0074ff, #00d3ff);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #0074ff, #00d3ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            }

        </style>
        <?php
        $this->registerJs('
                    $(document).ready(function(){
                        var btn = $("#button_top");
                      btn.on("click", function(e) {
                        e.preventDefault();
                        $("html, body").animate({scrollTop:0}, "300");
                      });

                        $(window).bind("scroll", function () {
                            if ($(window).scrollTop() > 55) {
                                $("#navbar").addClass("fixed-top");
                            } else {
                                $("#navbar").removeClass("fixed-top");
                            }
                        });

                        var w = $(window).width();

                        if(w < 991){
                            $(".top_bar_contact_item p").hide();
                            $(".top_bar").css({"height": "50px"});
                            $("#navbar").addClass("fixed-top");
                            $("#img-logo").css({"height": "50px"});
                            $(".navbar-brand").text("IC QUALITY SYSTEM");

                        } else {
                            $(".top_bar").css({"height": "70px"});
                            $("#img-logo").css({"height": "64px"});
                            $(".top_bar_contact_item p").show();
                        }

                        if(w < 768){
                            $(".banner").css({"margin-top": "20px"});
                        }
                    });
                ');
        ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="super_container">
            <!-- Header -->
            <header class="header">
                <!-- Top Bar -->
                <div class="top_bar">
                    <div class="container">
                        <div class="row">
                            <div class="col d-flex flex-row">
                                <div class="logo" style=" margin-right: 10px;">
                                    <a href="#"><img src="<?php echo Url::to('@web/web/images/logo-dark.png'); ?>" id="img-logo"/></a>
                                </div>
                                <div class="top_bar_contact_item" style="margin-right: 10px;">
                                    <p class="text-white" style="margin-bottom: 0px; margin-top:10px;">บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด</p>
                                    <p class="text-white" style="margin-bottom: 0px;">IC QUALITY SYSTEM Co., Ltd.</p>
                                </div>
                                <div class="top_bar_content ml-auto">
                                    <div class="top_bar_user">
                                        <?php //if (Yii::$app->user->isGuest) { ?>
                                        <!--
                                            <div class="user_icon">
                                                <img src="<?php //echo Url::to('@web/web/theme/images/user.svg')                                                         ?>" alt="">
                                            </div>
                                            <div><a href="<?php //echo Yii::$app->urlManager->createUrl(['user/registration/register'])                                                         ?>">Register</a></div>
                                        -->
                                        <?php //} ?>
                                        <div>
                                            <?php if (Yii::$app->user->isGuest) { ?>
                                                <a href="<?php echo Yii::$app->urlManager->createUrl(['user/security/login']) ?>"><i class="fa fa-lock"></i> Sign in</a>
                                            <?php } else { ?>

                                                <?php if (Yii::$app->user->identity->status == "U") { ?>
                                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers']) ?>">จัดการข้อมูล(<?php echo Yii::$app->user->identity->username ?>) <img src="<?php echo Url::to('../images/settings.png') ?>" width="32"/></a>
                                                <?php } else { ?>
                                                    <a href="<?php echo Yii::$app->urlManagerBackend->createUrl(['index.php?r=site']) ?>">จัดการข้อมูล(<?php echo Yii::$app->user->identity->username ?>) <img src="<?php echo Url::to('../images/settings.png') ?>" width="32"/></a>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Main -->
                <div class="header_main">
                    <div class="container">
                        <div class="row" style=" display: none;">
                            <!-- Search -->
                            <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right" style=" display: none;">
                                <div class="header_search" style=" display: none;">
                                    <div class="header_search_content" style=" display: none;">
                                        <div class="header_search_form_container">
                                            <form action="#" class="header_search_form clearfix" style=" display: none;">
                                                <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                                <div class="custom_dropdown">
                                                    <div class="custom_dropdown_list">
                                                        <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                        <i class="fas fa-chevron-down"></i>
                                                        <ul class="custom_list clc">
                                                            <li><a class="clc" href="#">All Categories</a></li>
                                                            <li><a class="clc" href="#">Computers</a></li>
                                                            <li><a class="clc" href="#">Laptops</a></li>
                                                            <li><a class="clc" href="#">Cameras</a></li>
                                                            <li><a class="clc" href="#">Hardware</a></li>
                                                            <li><a class="clc" href="#">Smartphones</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <button type="submit" class="header_search_button trans_300" value="Submit"><img src="<?php echo Url::to('@web/web/theme/images/search.png') ?>" alt=""></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Wishlist -->
                            <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                                <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                    <!-- Cart -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav id="navbar" class="navbar navbar-expand-lg navbar-light" style="background: #FFFFFF; box-shadow: #666666 0px 0px 30px 0px;">
                    <div class="container">
                        <a class="navbar-brand text-info" href="#">Menu</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                                <li class="nav-item active">
                                    <a class="nav-link" href="<?php echo Yii::$app->urlManager->createUrl(['site']) ?>"><i class="fa fa-home"></i> หน้าแรก</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo Yii::$app->urlManager->createUrl(['news/news/all']) ?>">ข่าว</a>
                                </li>
                                <?php
                                foreach ($menu as $menus):
                                    if ($menus['submenu'] == "1") {
                                        $Smenu = $Config->getSubMenu($menus['id']);
                                        ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php echo $menus['navbar'] ?>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <?php foreach ($Smenu as $Smenus) { ?>
                                                    <a class="dropdown-item" href="<?php echo Yii::$app->urlManager->createUrl(['site/submenu', 'id' => $Smenus['id']]) ?>"><?php echo $Smenus['subnavbar'] ?></a>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    <?php } else { ?>
                                        <li><a class="nav-link" href="<?php echo Yii::$app->urlManager->createUrl(['site/navbar']) ?>"><?php echo $menus['navbar'] ?></a></li>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </ul>
                            <!--
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                            -->
                        </div>
                    </div>
                </nav>


            </header>


            <!-- Banner -->
            <!--
            style="background-image:url(<?php //echo Url::to('@web/web/theme/images/banner_background.jpg')                                         ?>)"
            -->
            <div class="banner" style="display: none;">
                <div class="banner_background" style="background-image:url(<?php echo Url::to('@web/web/theme/images/banner_background.jpg') ?>)"></div>
                <div class="container fill_height">
                    <div class="row fill_height">
                        <div class="banner_product_image"><img src="<?php echo Url::to('@web/web/theme/images/banner_product_ic.png') ?>" alt=""></div>
                        <div class="col-lg-5 offset-lg-12 fill_height">
                            <div class="banner_content">
                                <h2 class="banner_text">บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด</h2>
                                <h2 class="banner_text">IC QUALITY SYSTEM Co., Ltd.</h2>
                                <div class="banner_product_name" style="margin-top: 30px;">
                                    &nbsp; &nbsp; &nbsp; &nbsp;เราเป็นผู้ให้บริการขนส่งและกำจัดขยะมูลฝอยติดเชื้อ
                                    โดยยึดหลักธรรมาภิบาลเพื่อความปลอดภัยของประชาชน
                                    และเป็นมิตรกับสิ่งแวดล้อม ขนส่ง ปลอดภัย ฉับไว ได้มาตรฐาน
                                </div>
                                <div class="button banner_button"><a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customerneed/create']) ?>">ขอใบเสนอราคา</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="mainbody" style=" display: none;">
                <div class="container">
                    <div class="row" style="margin-top: 35px; padding-bottom:30px;margin-bottom:0px;">
                        <!-- Char. Item -->
                        <div class="col-lg-4 col-md-6 char_col">
                            <div class="char_item d-flex flex-row align-items-center justify-content-start" style="background: #ffffff;  /* fallback for old browsers */
                                 background: -webkit-linear-gradient(to right, #ffffff, #00c6ff);  /* Chrome 10-25, Safari 5.1-6 */
                                 background: linear-gradient(to right, #ffffff, #00c6ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                                 ">
                                <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_1.png') ?>" alt=""></div>
                                <div class="char_content">
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['site/transport']) ?>">
                                        <div class="char_title">ระบบการจัดเก็บและขนส่ง</div></a>
                                </div>
                            </div>
                        </div>
                        <!-- Char. Item -->
                        <div class="col-lg-4 col-md-6 char_col">

                            <div class="char_item d-flex flex-row align-items-center justify-content-start" style="background: #ffffff;  /* fallback for old browsers */
                                 background: -webkit-linear-gradient(to right, #ffffff, #ADD100);  /* Chrome 10-25, Safari 5.1-6 */
                                 background: linear-gradient(to right, #ffffff, #ADD100); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_2.png') ?>" alt=""></div>
                                <div class="char_content">
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['site/service']) ?>">
                                        <div class="char_title">ทำไมถึงเลือกใช้บริการของเรา?</div></a>
                                </div>
                            </div>
                        </div>
                        <!-- Char. Item -->
                        <div class="col-lg-4 col-md-12 char_col">
                            <div class="char_item d-flex flex-row align-items-center justify-content-start" style="background: #ffffff;  /* fallback for old browsers */
                                 background: -webkit-linear-gradient(to right, #ffffff, #9D50BB);  /* Chrome 10-25, Safari 5.1-6 */
                                 background: linear-gradient(to right, #ffffff, #9D50BB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_3.png') ?>" alt=""></div>
                                <div class="char_content">
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(['site/step']) ?>">
                                        <div class="char_title">ขั้นตอนการกำจัดขยะมูลฝอยติดเชื้อ</div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adverts -->
                <div class="adverts" style="margin-top:0px; padding-top:30px;background: #eff6fa;">
                    <div class="container" >
                        <div class="reviews_title_container">
                            <h3 class="reviews_title">ข่าวล่าสุด</h3>
                            <div class="reviews_all ml-auto">
                                <a href="<?php echo Url::to(['news/news/all']) ?>">view all </a>
                            </div>
                        </div>
                        <br/>
                        <div class="row">

                            <?php
                            foreach ($news as $new):
                                $img = $newsModel->getAlbum($new['ID']);
                                $fImg = Url::to('../uploads/news/gallery/200-' . $img);
                                ?>
                                <div class="col-lg-4 advert_col">
                                    <!-- Advert Item -->
                                    <div class="advert d-flex flex-row align-items-center justify-content-start" style="background: #FFFFFF;box-shadow: none;">
                                        <div class="advert_content">
                                            <div class="advert_subtitle"><?php echo $new['CREATEAT'] ?></div>
                                            <div class="advert_text">
                                                <a href="<?php echo Url::to(['news/news/view', 'id' => $new['ID']]) ?>">
                                                    <?php echo $new['TITLE'] ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ml-auto"><div class="advert_image"><img src="<?php echo $fImg ?>" alt=""></div></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>


                <!-- Popular Categories -->
                <div class="popular_categories" style="margin-bottom:0px; margin-top:0px;  padding-bottom:30px; ">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="popular_categories_content" style="text-align: center;">
                                    <div class="popular_categories_title">ภาชนะที่ใช้จัดเก็บ</div>
                                    <div class="popular_categories_slider_nav">
                                        <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                                        <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Popular Categories Slider -->
                            <div class="col-lg-8">
                                <div class="popular_categories_slider_container">
                                    <div class="owl-carousel owl-theme popular_categories_slider">
                                        <?php foreach ($categorys as $rsCat): ?>
                                            <!-- Popular Categories Item -->
                                            <div class="owl-item">
                                                <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                                    <div class="popular_category_image">
                                                        <img src="<?php echo Url::to('../uploads/containner/gallerry/' . $rsCat['image']) ?>" alt=""></div>
                                                    <div class="popular_category_text"><?php echo $rsCat['garbagecontainer'] ?></div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Characteristics -->
            <div class="characteristics" style="padding-top: 0px;">
                <div class="container">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
            <!-- Newsletter -->
            <!--
                        <div class="newsletter bg-secondary" style="padding-bottom:0px; padding-top:25px;">
                            <div class="container" style="padding-bottom:20px;">
                                <div class="row">
                                    <div class="col">
                                        <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                                            <div class="newsletter_title_container">
                                                <div class="newsletter_icon"><img src="<?php //echo Url::to('@web/web/theme/images/send.png')                                                         ?>" alt=""></div>
                                                <div class="newsletter_title text-white">ลงทะเบียนรับข่าวสาร</div>
                                            </div>
                                            <div class="newsletter_content clearfix">
                                                <form action="#" class="newsletter_form">
                                                    <input type="email" class="newsletter_input" placeholder="Enter your email address">
                                                    <button class="newsletter_button">Subscribe</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            -->
            <!-- Footer -->
            <footer class="footer bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 footer_col">
                            <div class="footer_column footer_contact">
                                <div class="logo_container">
                                    <div class="logo"><img src="<?php echo Url::to('@web/web/images/logo-dark.png'); ?>" alt=""></div>
                                </div>
                                <div class="footer_title text-white">บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด</div>
                                <div class="footer_contact_text text-white">
                                    <p>50/19 หมู่ 6 ต.บางหลวง</p>
                                    <p>อ.เมืองปทุมธานี จ.ปทุมธานี 12000</p>
                                </div>
                                <div class="footer_phone">โทร : (02) 1010325</div>
                                <div class="footer_phone">Facebook : ไอซี ควอลิตี้ ซิสเท็ม จำกัด</div>
                                <div class="footer_phone">id line : @icqualitysystem</div>

                            </div>
                        </div>


                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title text-warning">ข่าวสาร</div>
                                <ul class="footer_list">
                                    <li><a href="<?php echo Yii::$app->urlManager->createUrl(['news/news/all']) ?>">ข่าวสารและกิจกรรม</a></li>
                                </ul>
                            </div>
                        </div>


                        <?php
                        foreach ($menu as $menus):
                            if ($menus['submenu'] == "1") {
                                $Smenu = $Config->getSubMenu($menus['id']);
                                ?>
                                <div class="col-lg-2">
                                    <div class="footer_column">
                                        <div class="footer_title text-warning"><?php echo $menus['navbar'] ?></div>
                                        <ul class="footer_list">
                                            <?php foreach ($Smenu as $Smenus) { ?>
                                                <li><a href="<?php echo Yii::$app->urlManager->createUrl(['site/submenu', 'id' => $Smenus['id']]) ?>"><?php echo $Smenus['subnavbar'] ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-lg-2">
                                    <div class="footer_column">
                                        <div class="footer_title">
                                            <a href="<?php echo Yii::$app->urlManager->createUrl(['site/navbar']) ?>"><?php echo $menus['navbar'] ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endforeach; ?>


                    </div>
                </div>
            </footer>
        </div>
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-10 col-md-10">
                        <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                            <div class="copyright_content text-info"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> IC QUALITY SYSTEM Co., Ltd.
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>

                        </div>
                    </div>
                    <div class="col col-lg-2 col-md-2">
                        <button type="button" class="btn btn-light pull-right text-info" id="button_top" style="margin-top:10px; float: right;"><i class="fa fa-arrow-up"></i> TOP</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



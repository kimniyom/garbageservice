<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAssetTheme;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAssetTheme::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags()?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head()?>
    </head>
    <body>
        <?php $this->beginBody()?>

        <div class="super_container">
            <!-- Header -->
            <header class="header">
                <!-- Top Bar -->
                <div class="top_bar" >
                    <div class="container">
                        <div class="row">
                            <div class="col d-flex flex-row">
                                <div class="logo" style=" margin-right: 10px;">
                                    <a href="#"><img src="<?php echo Url::to('@web/web/images/logo-dark.png'); ?>" style=" height: 48px;"/></a>
                                </div>
                                <div class="top_bar_contact_item" style=" margin-right: 10px;">
                                    <div class="top_bar_icon">
                                        <img src="<?php echo Url::to('@web/web/theme/images/phone.png') ?>" alt="">
                                    </div>(02) 101-0325
                                </div>
                                <div class="top_bar_contact_item">
                                    <div class="top_bar_icon">
                                        <img src="<?php echo Url::to('@web/web/theme/images/mail.png') ?>" alt="">
                                    </div>iccleanup@gmail.com
                                </div>
                                <div class="top_bar_content ml-auto">
                                    <div class="top_bar_user">
                                        <?php if (Yii::$app->user->isGuest) {?>
                                        <div class="user_icon">
                                            <img src="<?php echo Url::to('@web/web/theme/images/user.svg') ?>" alt="">
                                        </div>
                                        <div><a href="<?php echo Yii::$app->urlManager->createUrl(['user/registration/register']) ?>">Register</a></div>
                                        <?php }?>
                                        <div>
                                        <?php if (Yii::$app->user->isGuest) {?>
                                            <a href="<?php echo Yii::$app->urlManager->createUrl(['user/security/login']) ?>">Sign in</a>
                                        <?php } else {?>

                                            <?php if (Yii::$app->user->identity->status == "U") {?>
                                                <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers']) ?>">จัดการข้อมูล(<?php echo Yii::$app->user->identity->username ?>)</a>
                                            <?php } else {?>

                                                <a href="<?php echo Yii::$app->urlManagerBackend->createUrl(['index.php?r=site']) ?>">จัดการข้อมูล(<?php echo Yii::$app->user->identity->username ?>)</a>

                                            <?php }?>
                                        <?php }?>
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

                <!-- Main Navigation -->

                <nav class="main_nav">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="main_nav_content d-flex flex-row">
                                    <!-- Main Nav Menu -->

                                    <div class="main_nav_menu ml-auto">
                                        <ul class="standard_dropdown main_nav_dropdown">
                                            <li><a href="#">หน้าแรก</a></li>
                                            <li class="hassubs">
                                                <a href="#">ข่าว<i class="fas fa-chevron-down"></i></a>
                                                <ul>
                                                    <li><a href="#">ข่าวสารและกิจกรรม</a></li>
                                                </ul>
                                            </li>
                                            <li class="hassubs">
                                                <a href="#">ช่วยเหลือ<i class="fas fa-chevron-down"></i></a>
                                                <ul>
                                                    <li><a href="shop.html">คู่มือการขอใช้บริการ</a></li>
                                                    <li><a href="product.html">วิธีการชำระเงิน</a></li>
                                                    <li><a href="blog.html">แจ้งชำระเงิน</a></li>
                                                </ul>
                                            </li>
                                            <li class="hassubs">
                                                <a href="#">ติดต่อเรา<i class="fas fa-chevron-down"></i></a>
                                                <ul>
                                                    <li><a href="shop.html">เกี่ยวกับเรา</a></li>
                                                    <li><a href="product.html">นโยบายและข้อตกลง</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Menu Trigger -->

                                    <div class="menu_trigger_container ml-auto">
                                        <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                                            <div class="menu_burger">
                                                <div class="menu_trigger_text">menu</div>
                                                <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Menu -->
                <div class="page_menu">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="page_menu_content">
                                    <div class="page_menu_search">
                                        <form action="#">
                                            <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                                        </form>
                                    </div>
                                    <ul class="page_menu_nav">
                                        <li class="page_menu_item has-children">
                                            <a href="#">Language<i class="fa fa-angle-down"></i></a>
                                            <ul class="page_menu_selection">
                                                <li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="page_menu_item has-children">
                                            <a href="#">Currency<i class="fa fa-angle-down"></i></a>
                                            <ul class="page_menu_selection">
                                                <li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="page_menu_item">
                                            <a href="#">Home<i class="fa fa-angle-down"></i></a>
                                        </li>
                                        <li class="page_menu_item has-children">
                                            <a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
                                            <ul class="page_menu_selection">
                                                <li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
                                                <li class="page_menu_item has-children">
                                                    <a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
                                                    <ul class="page_menu_selection">
                                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                        <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="page_menu_item has-children">
                                            <a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
                                            <ul class="page_menu_selection">
                                                <li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="page_menu_item has-children">
                                            <a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
                                            <ul class="page_menu_selection">
                                                <li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                                <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                            </ul>
                                        </li>
                                        <li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
                                        <li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
                                    </ul>
                                    <div class="menu_contact">
                                        <div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo Url::to('@web/web/theme/images/phone_white.png') ?>" alt=""></div>+38 068 005 3570</div>
                                        <div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo Url::to('@web/web/theme/images/mail_white.png') ?>" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Banner -->

            <div class="banner" style="display: none;">
                <div class="banner_background" style="background-image:url(<?php echo Url::to('@web/web/theme/images/banner_background.jpg') ?>)"></div>
                <div class="container fill_height">
                    <div class="row fill_height">
                        <div class="banner_product_image"><img src="<?php echo Url::to('@web/web/theme/images/banner_product_ic.png') ?>" alt=""></div>
                        <div class="col-lg-5 offset-lg-12 fill_height">
                            <div class="banner_content">
                                <h2 class="banner_text">ไอซี ควอลิตี้ ซิสเท็ม จำกัด</h2>
                                <h2 class="banner_text">IC QUALITY SYSTEM Co., Ltd.</h2>
                                <div class="banner_product_name" style="margin-top: 30px;">
                                    &nbsp; &nbsp; &nbsp; &nbsp;เราเป็นผู้ให้บริการขนส่งและกำจัดขยะมูลฝอยติดเชื้อ
                                    โดยยึดหลักธรรมาภิบาลเพื่อความปลอดของประชาชน
                                    และเป็นมิตรกับสิ่งแวดล้อม ขนส่ง ปลอดภัย ฉับไว ได้มาตรฐาน
                                </div>
                                <div class="button banner_button"><a href="#">เพิ่มเติม</a></div>
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
                    <?=Alert::widget()?>
                    <?=$content?>
                </div>
            </div>
            <!-- Newsletter -->
        </div>
        <div class="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                            <div class="newsletter_title_container">
                                <div class="newsletter_icon"><img src="<?php echo Url::to('@web/web/theme/images/send.png') ?>" alt=""></div>
                                <div class="newsletter_title">ลงทะเบียนรับข่าวสาร</div>
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

            <!-- Footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 footer_col">
                            <div class="footer_column footer_contact">
                                <div class="logo_container">
                                    <div class="logo"><img src="<?php echo Url::to('@web/web/images/logo-dark.png'); ?>" alt=""></div>
                                </div>
                                <div class="footer_title">ไอซี ควอลิตี้ ซิสเท็ม จำกัด</div>
                                <div class="footer_contact_text">
                                    <p>50/19 หมู่ 6 ต.บางหลวง</p>
                                    <p>อ.เมืองปทุมธานี จ.ปทุมธานี 12000</p>
                                </div>
                                <div class="footer_phone">โทร : (02) 1010325</div>
                                <div class="footer_phone">Fax : (02) 581-1245</div>

                            </div>
                        </div>

                        <div class="col-lg-2 offset-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">ข่าวสาร</div>
                                <ul class="footer_list">
                                    <li><a href="#">ข่าวสารและกิจกรรม</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">ช่วยเหลือ</div>
                                <ul class="footer_list">
                                    <li><a href="#">คู่มือการขอใช้บริการ</a></li>
                                    <li><a href="#">วิธีการชำระเงิน</a></li>
                                    <li><a href="#">แจ้งชำระเงิน</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">ติดต่อเรา</div>
                                <ul class="footer_list">
                                    <li><a href="#">เกี่ยวกับเรา</a></li>
                                    <li><a href="#">นโยบายและข้อตกลง</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>
        </div>
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                            <div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> IC QUALITY SYSTEM Co., Ltd.
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody()?>
    </body>
</html>
<?php $this->endPage()?>

<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAssetTheme extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web/web/theme';
    public $css = [
        //'css/site.css',
        //'styles/bootstrap4/bootstrap.css',
        'plugins/fontawesome-free-5.0.1/css/fontawesome-all.css',
        'styles/main_styles.css',
        'plugins/OwlCarousel2-2.2.1/owl.carousel.css',
        'plugins/OwlCarousel2-2.2.1/owl.theme.default.css',
        'plugins/OwlCarousel2-2.2.1/animate.css',
        'plugins/slick-1.8.0/slick.css',
        'styles/responsive.css',
        'styles/blog_single_styles.css',
        'styles/blog_single_responsive.css',
        'fancyBox2.1.5/source/jquery.fancybox.css',
        'gallery_img/dist/magnific-popup.css',
        'styles/blog_styles.css',
        'styles/blog_responsive.css',
    ];
    public $js = [
        //'js/jquery-3.3.1.min.js',
        //'styles/bootstrap4/popper.js',
        //'styles/bootstrap4/bootstrap.min.js',
        'plugins/greensock/TweenMax.min.js',
        'plugins/greensock/TimelineMax.min.js',
        'plugins/scrollmagic/ScrollMagic.min.js',
        'plugins/greensock/animation.gsap.min.js',
        'plugins/greensock/ScrollToPlugin.min.js',
        'plugins/OwlCarousel2-2.2.1/owl.carousel.js',
        'plugins/slick-1.8.0/slick.js',
        'plugins/easing/easing.js',
        'js/custom.js',
        'fancyBox2.1.5/source/jquery.fancybox.js',
        'gallery_img/dist/jquery.magnific-popup.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];

}

<style type="text/css">
    .advert_text a{
        color: #999999;
    }

    .advert_text a:hover{
        color: #0066cc;
    }
</style>

<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use app\modules\news\models\News;

$newsModel = new News();
$this->title = 'IC';
?>
<div class="row" style="margin-top: 50px;">
    <!-- Char. Item -->
    <div class="col-lg-4 col-md-6 char_col">
        <div class="char_item d-flex flex-row align-items-center justify-content-start">
            <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_1.png') ?>" alt=""></div>
            <div class="char_content">
                <div class="char_title">ระบบการจัดเก็บและขนส่ง</div>
            </div>
        </div>
    </div>

    <!-- Char. Item -->
    <div class="col-lg-4 col-md-6 char_col">

        <div class="char_item d-flex flex-row align-items-center justify-content-start">
            <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_2.png') ?>" alt=""></div>
            <div class="char_content">
                <div class="char_title">ทำไมถึงเลือกใช้บริการของเรา?</div>
            </div>
        </div>
    </div>

    <!-- Char. Item -->
    <div class="col-lg-4 col-md-6 char_col">
        <div class="char_item d-flex flex-row align-items-center justify-content-start">
            <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_3.png') ?>" alt=""></div>
            <div class="char_content">
                <div class="char_title">ขั้นตอนการกำจัดขยะมูลฝอยติดเชื้อ</div>
            </div>
        </div>
    </div>

</div>
</div>



<!-- Popular Categories -->

<div class="popular_categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="popular_categories_content" style="text-align: center;">
                    <div class="popular_categories_title">ภาชนะที่ใช้จัดเก็บ</div>
                    <div class="popular_categories_slider_nav">
                        <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>

            <!-- Popular Categories Slider -->

            <div class="col-lg-9">
                <div class="popular_categories_slider_container">
                    <div class="owl-carousel owl-theme popular_categories_slider">

                        <!-- Popular Categories Item -->
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image"><img src="<?php echo Url::to('@web/web/theme/images/popular_1.png') ?>" alt=""></div>
                                <div class="popular_category_text">Smartphones & Tablets</div>
                            </div>
                        </div>

                        <!-- Popular Categories Item -->
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image"><img src="<?php echo Url::to('@web/web/theme/images/popular_2.png') ?>" alt=""></div>
                                <div class="popular_category_text">Computers & Laptops</div>
                            </div>
                        </div>

                        <!-- Popular Categories Item -->
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image"><img src="<?php echo Url::to('@web/web/theme/images/popular_3.png') ?>" alt=""></div>
                                <div class="popular_category_text">Gadgets</div>
                            </div>
                        </div>

                        <!-- Popular Categories Item -->
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image"><img src="<?php echo Url::to('@web/web/theme/images/popular_4.png') ?>" alt=""></div>
                                <div class="popular_category_text">Video Games & Consoles</div>
                            </div>
                        </div>

                        <!-- Popular Categories Item -->
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image"><img src="<?php echo Url::to('@web/web/theme/images/popular_5.png') ?>" alt=""></div>
                                <div class="popular_category_text">Accessories</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Adverts -->
<div class="adverts">
    <div class="container">
        <div class="reviews_title_container">
            <h3 class="reviews_title">ข่าวล่าสุด</h3>
            <div class="reviews_all ml-auto"><a href="#">view all </a></div>
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
                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_subtitle"><?php echo $new['CREATEAT'] ?></div>
                            <div class="advert_text">
                                <a href="<?php echo Url::to(['news/news/view','id' => $new['ID']]) ?>">
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


<!-- Reviews -->

<div class="reviews">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="reviews_title_container">
                    <h3 class="reviews_title">Latest Reviews</h3>
                    <div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
                </div>

                <div class="reviews_slider_container">

                    <!-- Reviews Slider -->
                    <div class="owl-carousel owl-theme reviews_slider">

                        <!-- Reviews Slider Item -->
                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div><div class="review_image"><img src="<?php echo Url::to('@web/web/theme/images/review_1.jpg') ?>" alt=""></div></div>
                                <div class="review_content">
                                    <div class="review_name">Roberto Sanchez</div>
                                    <div class="review_rating_container">
                                        <div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                        <div class="review_time">2 day ago</div>
                                    </div>
                                    <div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Slider Item -->
                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div><div class="review_image"><img src="<?php echo Url::to('@web/web/theme/images/review_2.jpg') ?>" alt=""></div></div>
                                <div class="review_content">
                                    <div class="review_name">Brandon Flowers</div>
                                    <div class="review_rating_container">
                                        <div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                        <div class="review_time">2 day ago</div>
                                    </div>
                                    <div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Slider Item -->
                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div><div class="review_image"><img src="<?php echo Url::to('@web/web/theme/images/review_3.jpg') ?>" alt=""></div></div>
                                <div class="review_content">
                                    <div class="review_name">Emilia Clarke</div>
                                    <div class="review_rating_container">
                                        <div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                        <div class="review_time">2 day ago</div>
                                    </div>
                                    <div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Slider Item -->
                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div><div class="review_image"><img src="<?php echo Url::to('@web/web/theme/images/review_1.jpg') ?>" alt=""></div></div>
                                <div class="review_content">
                                    <div class="review_name">Roberto Sanchez</div>
                                    <div class="review_rating_container">
                                        <div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                        <div class="review_time">2 day ago</div>
                                    </div>
                                    <div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Slider Item -->
                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div><div class="review_image"><img src="<?php echo Url::to('@web/web/theme/images/review_2.jpg') ?>" alt=""></div></div>
                                <div class="review_content">
                                    <div class="review_name">Brandon Flowers</div>
                                    <div class="review_rating_container">
                                        <div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                        <div class="review_time">2 day ago</div>
                                    </div>
                                    <div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Slider Item -->
                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div><div class="review_image"><img src="<?php echo Url::to('@web/web/theme/images/review_3.jpg') ?>" alt=""></div></div>
                                <div class="review_content">
                                    <div class="review_name">Emilia Clarke</div>
                                    <div class="review_rating_container">
                                        <div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                        <div class="review_time">2 day ago</div>
                                    </div>
                                    <div class="review_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</p></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="reviews_dots"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">

                    <!-- Brands Slider -->

                    <div class="owl-carousel owl-theme brands_slider">

                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_1.jpg') ?>" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_2.jpg') ?>" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_3.jpg') ?>" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_4.jpg') ?>" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_5.jpg') ?>" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_6.jpg') ?>" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_7.jpg') ?>" alt=""></div></div>
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="<?php echo Url::to('@web/web/theme/images/brands_8.jpg') ?>" alt=""></div></div>

                    </div>

                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="<?php echo Url::to('@web/web/theme/images/send.png') ?>" alt=""></div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="#" class="newsletter_form">
                            <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                            <button class="newsletter_button">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        $this->registerJs('
        $(document).ready(function(){;
            $(".banner").show();
        })');
    ?>

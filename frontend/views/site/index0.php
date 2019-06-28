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

use app\modules\news\models\News;
use yii\helpers\Url;

$newsModel = new News();
$this->title = 'IC';
?>
<div class="row" style="margin-top: 50px; padding-bottom:30px;margin-bottom:0px;">
    <!-- Char. Item -->
    <div class="col-lg-4 col-md-6 char_col">
        <div class="char_item d-flex flex-row align-items-center justify-content-start">
            <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_1.png') ?>" alt=""></div>
            <div class="char_content">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['site/transport']) ?>">
                    <div class="char_title">ระบบการจัดเก็บและขนส่ง</div></a>
            </div>
        </div>
    </div>

    <!-- Char. Item -->
    <div class="col-lg-4 col-md-6 char_col">

        <div class="char_item d-flex flex-row align-items-center justify-content-start">
            <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_2.png') ?>" alt=""></div>
            <div class="char_content">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['site/service']) ?>">
                    <div class="char_title">ทำไมถึงเลือกใช้บริการของเรา?</div></a>
            </div>
        </div>
    </div>

    <!-- Char. Item -->
    <div class="col-lg-4 col-md-6 char_col">
        <div class="char_item d-flex flex-row align-items-center justify-content-start">
            <div class="char_icon"><img src="<?php echo Url::to('@web/web/theme/images/char_3.png') ?>" alt=""></div>
            <div class="char_content">
                <a href="<?php echo Yii::$app->urlManager->createUrl(['site/service']) ?>">
                    <div class="char_title">ขั้นตอนการกำจัดขยะมูลฝอยติดเชื้อ</div></a>
            </div>
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
<!-- Adverts -->
<div class="adverts" style="margin-top:0px; padding-top:30px;">
    <div class="container">
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
                    <div class="advert d-flex flex-row align-items-center justify-content-start">
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



<?php
$this->registerJs('
        $(document).ready(function(){;
            $(".banner").show();
        })');
?>

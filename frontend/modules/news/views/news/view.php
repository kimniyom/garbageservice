
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\news\models\News;

$this->title = $datas['TITLE'];
$this->params['breadcrumbs'][] = $this->title;

$newsModel = new News();
?>
<!-- Single Blog Post -->
<div class="single_post" style="margin-top:0px; padding-top:10px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single_post_title"><?php echo $this->title ?></div>
                <p><i class="fa fa-calendar-alt"></i> <?php echo $datas['CREATEAT'] ?></p>
                <div class="single_post_text" id="box-article">
                    <?php
                    echo $datas['CONTENT'];
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <i class="fa fa-images"></i> Gallery
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="img_zoom">
                    <?php foreach ($gallery as $gallerys): ?>
                        <a class="image-link" href="<?php echo Url::to('../uploads/news/gallery/' . $gallerys['images']) ?>">
                            <img src="<?php echo Url::to('../uploads/news/gallery/200-' . $gallerys['images']) ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Posts -->

    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog_posts d-flex flex-row align-items-start justify-content-between">
                        <?php
                        foreach ($news as $new):
                            $img = $newsModel->getAlbum($new['ID']);
                            $fImg = Url::to('../uploads/news/gallery/360-' . $img);
                            ?>
                            <!-- Blog post -->
                            <div class="blog_post">
                                <div class="blog_image" style="background:url('<?php echo $fImg ?>') top"></div>
                                <div class="blog_text">
                                    <div style="height:200px;">
                                        <a href="<?php echo Url::to(['news/view', 'id' => $new['ID']]) ?>">
                                            <?php echo $new['TITLE'] ?>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs('
			$(document).ready(function () {
		        var style = {"height": "auto"};
		        $("#box-article img").addClass("img-responsive");
		        $("#box-article img").css(style);

	        	var bcontent = $("#box-article").width();
	        	var iframe = $("#box-article iframe").width();

	        	if(iframe >= bcontent){;
	            	$("#box-article iframe").css({"width":"100% "});
	        	}

	        	$(".img_zoom").magnificPopup({
					delegate: "a",
					type: "image",
					gallery: {
						enabled: true
					}
	           });
	    	});
    ')
?>

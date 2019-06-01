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
				<div class="col-lg-8 offset-lg-2">
					<div class="single_post_title"><?php echo $this->title ?></div>
					<p><i class="fa fa-calendar-alt"></i> <?php echo $datas['CREATEAT'] ?></p>
					<div class="single_post_text">
						<?php 
							echo $datas['CONTENT'];
						?>
					</div>
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
						<?php foreach($news as $new): 
							$img = $newsModel->getAlbum($new['ID']);
                			$fImg = Url::to('../uploads/news/gallery/360-' . $img);
							?>
						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background:url('<?php echo $fImg ?>') top"></div>
							<div class="blog_text"><?php echo $new['TITLE'] ?></div>
							<div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
						</div>

						<?php endforeach; ?>

					</div>
				</div>	
			</div>
		</div>
	</div>

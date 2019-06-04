<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\news\models\News;
use yii\widgets\LinkPager;

$this->title = $category;
$this->params['breadcrumbs'][] = $this->title;

$newsModel = new News(); 
?>

	<!-- Blog -->

	<div class="blog">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
						<?php foreach($news as $rs): 
							$img = $newsModel->getAlbum($rs['ID']);
                			$fImg = Url::to('../uploads/news/gallery/360-' . $img);
							?>
						<!-- Blog post -->
						<div class="blog_post">
							<div class="blog_image" style="background-image:url('<?php echo $fImg ?>')"></div>
							<div class="blog_text"><?php echo $rs['TITLE'] ?></div>
							<div class="blog_button"><a href="<?php echo Url::to(['news/view','id' => $rs['ID']]) ?>">อ่าน ...</a></div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
					
			</div>
			<?php
				echo LinkPager::widget([
				    'pagination' => $pages,
				]);
			?>
		</div>
	</div>

	


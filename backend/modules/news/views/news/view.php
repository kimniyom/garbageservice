<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\news\models\News */

$this->title = $datas['TITLE'];
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<link rel="stylesheet" type="text/css" href="<?php echo Url::to('@web/web/uploadifive/uploadifive.css') ?>">

<div class="news-view">
    <p>
        <?=Html::a('Update', ['update', 'id' => $datas['ID']], ['class' => 'btn btn-primary'])?>
        <?=Html::a('Delete', ['delete', 'id' => $datas['ID']], [
	'class' => 'btn btn-danger',
	'data' => [
		'confirm' => 'Are you sure you want to delete this item?',
		'method' => 'post',
	],
])?>
    </p>
    <h3><?php echo $datas['TITLE'] ?></h3>
    <hr/>
<?php echo $datas['CONTENT'] ?>
<hr/>
<p>ประเภท <?php echo ($datas['CATEGORY']) == 0 ? "ข่าว" : "โปรโมชั่น"; ?></p>
<p>
    โดย:<?php echo $datas['usercreate'] ?>
    วันที่:<?php echo $datas['CREATEAT'] ?>
    แก้ไขล่าสุด: <?php echo $datas['UPDATEAT'] ?>
</p>
    <h4>Gallery</h4>
    <input type="file" name="file_upload" id="file_upload" />
    (ไฟล์นามสกุล jpg ไม่เกิน 2MB)
    <div id="gallery"></div>
</div>

<?php
$fileType = array("image/jpeg", "image/jpg", "image/JPG", "image/JPEG");
$linkUplodas = Url::to(['news/gallery', 'id' => $datas['ID']]);
//"fileSizeLimit": "2MB",
$this->registerJs('
    loadgallery();
       $(function() {
            $("#file_upload").uploadifive({
            "buttonText": "เลือกไฟล์ ...",
            "uploadScript":"' . $linkUplodas . '",
            "auto": true,
            "removeCompleted": true,
            "fileType":["image/jpeg", "image/jpg", "image/JPG", "image/JPEG"] ,
            "queueSizeLimit": 5, //อัพโหลดได้ครั้งละ 5 ไฟล์
            "onError": function (errorType) {
                alert("The error was: " + errorType);
            },
            "onUploadComplete": function (file, data, response) {
                loadgallery();
            }
            });
        })
    ');
?>

<script type="text/javascript">
    function loadgallery(){
        var url = "<?php echo Url::to(['news/getgallery']) ?>";
        var newId = "<?php echo $datas['ID'] ?>";
        var data = {new_id: newId}
        $.post(url,data,function(datas){
            $("#gallery").html(datas);
        });
    }
</script>



<style type="text/css">
    ul li{
        font-size: 18px;
    }

    .img_zoom{
        float: left;
        height: 100px;
    }
</style>
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'ทำไมถึงเลือกใช้บริการของเรา?';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="service-about">
    <h1 style=" font-family: Th; font-size: 34px;"><?= Html::encode($this->title) ?></h1>
    <hr/>
    <br/>
    <ul>
        <li style=" font-family: Th; font-size: 24px; text-align:  center;">
            บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด เราเป็นผู้ให้บริการขนส่งและกำจัดขยะมูลฝอยติดเชื้อ ตามมาตรฐานสากล โดยยึดหลักธรรมาภิบาลเพื่อความปลอดภัยของประชาชน และเป็นมิตรกับสิ่งแวดล้อม สโลแแกน " ขนส่ง ปลอดภัย ฉับไว ได้มาตรฐาน "
        </li>
    </ul>
</div>
<br/><br/>
<div class="row">
    <div class="col" style=" text-align: center;">
        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/001-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/001-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/002-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/002-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/003-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/003-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/004-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/004-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/005-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/005-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/006-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/006-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/007-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/007-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/008-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/008-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/009-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/009-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>

        <div class="img_zoom">
            <a class="image-link" href="<?php echo Url::to('../images/010-img.jpg') ?>">
                <img src="<?php echo Url::to('../images/010-100.jpg') ?>" alt="" class="img-thumbnail" style="max-height: 100px; float: left; margin-right: 10px; margin-bottom: 10px;"></a>
        </div>
    </div>
</div>

<?php
$this->registerJs('
            $(document).ready(function () {
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

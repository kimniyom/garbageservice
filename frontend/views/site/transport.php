<style type="text/css">
    ul li{
        font-size: 18px;
    }
</style>
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'ระบบจัดเก็บและขนส่ง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1 style=" font-family: Th; font-size: 34px;"><?= Html::encode($this->title) ?></h1>
    <hr/>
    <ul>
        <li style=" font-family: Th; font-size: 24px;">- ชุดปฏิบัติงานที่ปลอดภัยได้มาตรฐาน</li>
        <li style=" font-family: Th; font-size: 24px;">- การจัดเก็บจะเน้นความปลอดภัยต่อผู้ปฏิบัติงาน บุคคลทั่วไปและสิ่งแวดล้อม</Li>
        <li style=" font-family: Th; font-size: 24px;">- รถขนส่งมีการควบคุมอุณภูมิอยู่ที่ 7 องศาเซลเซียส หรือต่ำกว่า</li>
        <li style=" font-family: Th; font-size: 24px;">- ขยะมูลฝอยติดเชื้อ ไม่มีการพักค้าง โดยจะขนส่งไปที่เตาเผาทันที</li>
    </ul>
    <br/> <br/>
    <div class="row">
        <div class="col" style=" margin-left: 0px;">
            <img src="<?php echo Url::to('../images/t1.png') ?>" alt=""  style="max-height: 200px; float: left; margin-right: 10px; margin-bottom: 10px;">
            <img src="<?php echo Url::to('../images//t2.png') ?>" alt=""  style="max-height: 200px; float: left; margin-right: 10px; margin-bottom: 10px;">
            <img src="<?php echo Url::to('../images/t3.png') ?>" alt=""  style="max-height: 200px; float: left; margin-right: 10px; margin-bottom: 10px;">
        </div>
    </div>
</div>

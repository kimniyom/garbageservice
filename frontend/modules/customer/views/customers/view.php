<?php

use app\models\Config;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customers */

$this->title = $model['company'];
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

use yii\helpers\Html;

$urlMap = new Config();
?>
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {

        width: 100%;
    }
</style>
<script src="<?php echo $urlMap->Urlmap() ?>"></script>
<script>
    var map;
    //var marker = new longdo.Marker({lon: 100.604274, lat: 13.847860});
    function init() {

        map = new longdo.Map({
            placeholder: document.getElementById('map'),
            language: 'th'
        });
        map.Overlays.add(new longdo.Marker(
                {lon: <?php echo ($location['long']) ? $location['long'] : "0" ?>, lat: <?php echo ($location['lat']) ? $location['lat'] : "0" ?>},
                {
                    title: "<?php echo $model['company'] ?>",
                    detail: "<?php echo $model['company'] ?>"
                }
        ));
        map.zoom(15);
        map.location({lon: <?php echo ($location['long']) ? $location['long'] : "0" ?>, lat: <?php echo ($location['lat']) ? $location['lat'] : "0" ?>});
    }
</script>
<div class="customers-view">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php if ($model['approve'] == "N") {
        ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model['id']], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
            <font style="color:red;">*เมื่อมีการยืนยันข้อมูลจากระบบจะไม่สามารถแก้ไขข้อมูลบางส่วนได้</font>
        <div class="alert alert-warning" role="alert">
            <strong>แจ้งเตือน!</strong> รอผู้ดูแลยืนยันข้อมูลและติดต่อกลับ
        </div>
    <?php } ?>

    <?php if (!$location['customer_id']) { ?>
        <div class="alert alert-danger" role="alert">
            <strong>แจ้งเตือน!</strong> ยังไม่ได้กำหนดจุดพิกัดสถานบริการหรือบริษัท
            <hr/>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/map', 'id' => $model['id']]) ?>">
                <button type="button" class="btn btn-light"><i class="fa fa-map-marker"></i> กำหนดพิกัด</button></a>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <ul class="list-group" id="leftBox">
                <li class="list-group-item"><img src="<?php echo Url::to('../images/company.png') ?>" width="32"/> <?php echo $model['company'] ?></li>
                <li class="list-group-item"><img src="<?php echo Url::to('../images/card-security-code.png') ?>" width="32"/> CustomerId: <?php echo $model['customercode'] ?></li>
                <li class="list-group-item">
                    <img src="<?php echo Url::to('../images/address.png') ?>" width="32"/>
                    ที่อยู่: <?php echo $model['address'] ?>
                    จังหวัด: <?php echo $model['changwat_name'] ?>
                    อำเภอ: <?php echo $model['ampur_name'] ?>
                    ตำบล: <?php echo $model['tambon_name'] ?>
                    <?php echo $model['zipcode'] ?>
                </li>
                <li class="list-group-item"><img src="<?php echo Url::to('../images/gender-neutral-user.png') ?>" width="32"/> ผู้รับผิดชอบ: <?php echo $model['manager'] ?></li>
                <li class="list-group-item"><img src="<?php echo Url::to('../images/phone-office--v1.png') ?>" width="32"/> Tel. <?php echo $model['tel'] ?></li>
                <li class="list-group-item"><img src="<?php echo Url::to('../images/hand-with-smartphone.png') ?>" width="32"/> โทรศัพท์มือถือ: <?php echo $model['telephone'] ?></li>
                <li class="list-group-item"><img src="<?php echo Url::to('../images/calendar--v2.png') ?>" width="32"/> วันที่ลงทะเบียน: <?php echo $model['create_date'] ?></li>
            </ul>
        </div>
        <div class="col-md-6 col-lg-6">
            <?php if ($location['customer_id']) { ?>
                <div id="map"></div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
if ($location['customer_id']) {
    $this->registerJs('
        getHeightBox();
          init();
          ');
}
?>

<script>
    function getHeightBox() {
        var h = $("#leftBox").height();
        $("#map").css({"height": h});
    }
</script>




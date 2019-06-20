<?php

use app\models\Config;
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
        height: 300px;
        width: 100%;
      }
    </style>
<script src="<?php echo $urlMap->Urlmap() ?>"></script>
<script>
      function initMap() {
        var mapOptions = {
          center: {lat: <?php echo ($location['lat']) ? $location['lat'] : "0" ?>, lng: <?php echo ($location['long']) ? $location['long'] : "0" ?>},
          zoom: <?php echo ($location['zoom']) ? $location['zoom'] : "13" ?>,
        }

        var maps = new google.maps.Map(document.getElementById("map"),mapOptions);

        var marker = new google.maps.Marker({
           position: new google.maps.LatLng(<?php echo ($location['lat']) ? $location['lat'] : "0" ?>, <?php echo ($location['long']) ? $location['long'] : "0" ?>),
           map: maps,
           title: "<?php echo $model['company'] ?>"
        });

        var info = new google.maps.InfoWindow({
            content : "<div style='font-size: 18px;color: red'>"+ "<?php echo $model['company'] ?><br/><?php echo $model['address'] ?> จ.<?php echo $model['changwat_name'] ?> อ.<?php echo $model['ampur_name'] ?> ต.<?php echo $model['tambon_name'] ?> <?php echo $model['zipcode'] ?>" +"</div>"
        });

            google.maps.event.addListener(marker, 'click', function() {
                info.open(maps, marker);
            });
      }
    </script>
<div class="customers-view">
    <h3><?=Html::encode($this->title)?></h3>



    </p>
    <?php if ($model['approve'] == "N") {
	?>
        <p>
        <?=Html::a('Update', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary'])?>
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
    <?php }?>

    <?php if (!$location['customer_id']) {?>
        <div class="alert alert-danger" role="alert">
          <strong>แจ้งเตือน!</strong> ยังไม่ได้กำหนดจุดพิกัดสถานบริการหรือบริษัท
          <hr/>
          <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/map', 'id' => $model['id']]) ?>">
              <button type="button" class="btn btn-default"><i class="fa fa-map-marker"></i> กำหนดพิกัด</button></a>
        </div>
    <?php }?>
    <ul class="list-group">
        <li class="list-group-item">ชื่อ: <?php echo $model['company'] ?></li>
        <li class="list-group-item">รหัส: <?php echo $model['taxnumber'] ?></li>
        <li class="list-group-item">
            ที่อยู่: <?php echo $model['address'] ?>
            จังหวัด: <?php echo $model['changwat_name'] ?>
            อำเภอ: <?php echo $model['ampur_name'] ?>
            ตำบล: <?php echo $model['tambon_name'] ?>
        </li>
        <li class="list-group-item">รหัสไปรษณีย์: <?php echo $model['zipcode'] ?></li>
        <li class="list-group-item">ผู้รับผิดชอบ: <?php echo $model['manager'] ?></li>
        <li class="list-group-item">Tel. <?php echo $model['tel'] ?></li>
        <li class="list-group-item">โทรศัพท์มือถือ: <?php echo $model['telephone'] ?></li>
        <li class="list-group-item">วันที่ลงทะเบียน: <?php echo $model['create_date'] ?></li>
    </ul>
    <?php if ($location['customer_id']) {?>
        <div id="map"></div>
    <?php }?>
</div>

<?php
$this->registerJs('
        initMap();
        ');
?>




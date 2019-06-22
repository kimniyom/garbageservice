<?php
use app\models\Config;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = $model->company;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้าทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$urlMap = new Config();

$changwat = \app\models\Changwat::find()->where(['changwat_id' => $model->changwat])->one()['changwat_name'];
$ampur = \app\models\Ampur::find()->where(['ampur_id' => $model->ampur])->one()['ampur_name'];
$tambon = \app\models\Tambon::find()->where(['tambon_id' => $model->tambon])->one()['tambon_name'];
?>
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 420px;
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
            content : "<div style='font-size: 18px;color: red'>"+ "<?php echo $model['company'] ?><br/><?php echo $model['address'] ?> จ.<?php echo $changwat ?> อ.<?php echo $ampur ?> ต.<?php echo $tambon ?> <?php echo $model['zipcode'] ?>" +"</div>"
        });

            google.maps.event.addListener(marker, 'click', function() {
                info.open(maps, marker);
            });
      }
    </script>
<div class="customer-view">
	<div class="row">
    <div class="col col-md-6 col-lg-6">
	<div class="box">
	<div class="box-header" style=" padding-bottom: 0px;">
	<?php if ($model->approve == 'N') {?>
		<label class="alert alert-warning" style="width: 100%;">
			<i class="fa fa-info"></i> รอยืนยันข้อมูลแล้ว
		</label>
	<?php } else {?>
		<label class="alert alert-success" style="width: 100%;"><i class="fa fa-check"></i> ยืนยันข้อมูลแล้ว

		</label>
	<?php }?>
	</div>
            <!-- /.box-header -->
            <div class="box-body" style="padding-top:0px;">

    <p>
        <?=Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?=Html::a('Delete', ['delete', 'id' => $model->id], [
	'class' => 'btn btn-danger',
	'data' => [
		'confirm' => 'Are you sure you want to delete this item?',
		'method' => 'post',
	],
])?>
<?php if ($model->approve == 'N') {?>
	<button type="button" class="btn btn-default pull-right" onclick="Confirmcustomer()">ยืนยันข้อมูล</button>
    <?php }?>
    </p>

	
    <?=DetailView::widget([
	'model' => $model,
	'attributes' => [
		'company',
		'taxnumber',
		[
			'label' => 'ที่อยู่',
			'value' => $model->address . " จ." . $changwat . " อ." . $ampur . " ต." . $tambon,
		],
		'zipcode',
		'manager',
		'tel',
		'telephone',
		'create_date',
		'update_date',
	],
])?>
</div>
</div>
</div>
<div class="col col-md-6 col-lg-6">
<div class="box">
	<div class="box-header" style=" padding-bottom: 0px;">
		<i class="fa fa-map"></i> แผนที่ลูกค้า
	</div>
	<div class="box-body">
<?php if ($location['customer_id']) {?>
        <div id="map"></div>
    <?php } else { ?>
		<div style="text-align:center">== ไม่ได้กำหนด ==</div>
	<?php } ?>
</div>
</div>
</div>
</div>

<script type="text/javascript">
	function Confirmcustomer(){
		var r = confirm("กรุณาตรวจสอบความถูกต้องก่อนยืนยันข้อมูล ...");
		if(r == true){
			var id = "<?php echo $model->id ?>";
			var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customer/confirmcustomer']) ?>";
			var data = {id: id};
			$.post(url,data,function(datas){
				window.location.reload();
			})
		}
	}

</script>

<?php
$this->registerJs('
        initMap();
        ');
?>

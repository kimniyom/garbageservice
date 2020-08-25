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

<script src="<?php echo $urlMap->Urlmap() ?>"></script>
<script>
    //function initMap() {
    /*
     var mapOptions = {
     center: {lat: <?php //echo ($location['lat']) ? $location['lat'] : "0"                            ?>, lng: <?php //echo ($location['long']) ? $location['long'] : "0"                            ?>},
     zoom: <?php //echo ($location['zoom']) ? $location['zoom'] : "13"                            ?>,
     }
     
     var maps = new google.maps.Map(document.getElementById("map"), mapOptions);
     
     var marker = new google.maps.Marker({
     position: new google.maps.LatLng(<?php //echo ($location['lat']) ? $location['lat'] : "0"                            ?>, <?php //echo ($location['long']) ? $location['long'] : "0"                        ?>),
     map: maps,
     title: "<?php //echo $model['company']                            ?>"
     });
     
     var info = new google.maps.InfoWindow({
     content: "<div style='font-size: 18px;color: red'>" + "<?php //echo $model['company']                            ?><br/><?php //echo $model['address']                            ?> จ.<?php //echo $changwat                            ?> อ.<?php //echo $ampur                            ?> ต.<?php //echo $tambon                            ?> <?php //echo $model['zipcode']                            ?>" + "</div>"
     });
     
     google.maps.event.addListener(marker, 'click', function() {
     info.open(maps, marker);
     });
     }
     */

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
<div class="customer-view">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="nav-tabs-custom" style=" margin-bottom: 0px;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#detail" data-toggle="tab"> ข้อมูลลูกค้า</a></li>
            <li><a href="#promisehistory" onclick="getHistoryPromise()" data-toggle="tab"> ประวัติการทำสัญญา</a></li>
            <li><a href="#workinggarbage" onclick="getHistoryWorking()" data-toggle="tab"> ประวัติการเข้าจักเก็บ</a></li>
            <li><a href="#paymenthistory" onclick="getHistoryInvoice()" data-toggle="tab"> ประวัติการชำระเงิน</a></li>

        </ul>
        <div class="tab-content padding" id="box-content">
            <div class="chart tab-pane active" id="detail">
                <div class="row">
                    <div class="col col-md-6 col-lg-6">
                        <div class="box" id="box-detail">
                            <div class="box-header" style=" padding-bottom: 0px;">
                                <?php if ($model->flag == 1) { ?>
                                <?php if ($model->approve == 'N') { ?>
                                    <label class="alert alert-warning" style="width: 100%;">
                                        <i class="fa fa-info"></i> รอยืนยันข้อมูลแล้ว
                                    </label>
                                <?php } else { ?>
                                    <label class="alert alert-success" style="width: 100%;"><i class="fa fa-check"></i> ยืนยันข้อมูลแล้ว</label>
                                <?php } ?>
                                <?php } ?>
                                <?php if ($model->flag == 0) { ?>
                                    <label class="alert alert-danger" style="width: 100%;">
                                        <i class="fa fa-info"></i> ลูกค้าถูกปิดการทำงานไว้
                                    </label> 
                                <?php } ?>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="padding-top:0px;">
                                <?php if ($model->flag == 1) { ?>
                                    <p>
                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                        <?=
                                        Html::a('Delete', ['delete', 'id' => $model->id], [
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this item?',
                                                'method' => 'post',
                                            ],
                                        ])
                                        ?>
                                        <?php if ($model->approve == 'N') { ?>
                                            <button type="button" class="btn btn-default pull-right" onclick="Confirmcustomer()">ยืนยันข้อมูล</button>
                                        <?php } ?>
                                    </p>
                                <?php } ?>
                                <?=
                                DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        'company',
                                        'taxnumber',
                                        [
                                            'label' => 'ที่อยู่',
                                            'value' => $model->address . " ต." . $tambon . "  อ." . $ampur . " จ." . $changwat . " " . $model->zipcode,
                                        ],
                                        'manager',
                                        'timework',
                                        'tel',
                                        'telephone',
                                        'lineid',
                                        [
                                            'label' => 'พิกัด',
                                            'value' => "N." . $location['lat'] . "," . "E." . $location['long'],
                                        ],
                                        [
                                            'label' => 'วันที่ลงทะเบียน',
                                            'value' => $urlMap->thaidate($model->create_date),
                                        ],
                                        [
                                            'label' => 'แก้ไขข้อมูลล่าสุด',
                                            'value' => $urlMap->thaidate($model->update_date),
                                        ],
                                    ],
                                ])
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6 col-lg-6">
                        <div class="box" id="box-map">
                            <div class="box-header" style=" padding-bottom: 0px;">
                                <i class="fa fa-map"></i> แผนที่ลูกค้า
                            </div>
                            <div class="box-body">
                                <?php if ($location['customer_id']) { ?>
                                    <div id="map"></div>
                                <?php } else { ?>
                                    <div style="text-align:center">== ไม่ได้กำหนด ==</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($img): ?>
                    <div class="row">
                        <div class="col col-md-6 col-lg-6">
                            <div class="box" id="box-map">
                                <div class="box-header" style=" padding-bottom: 0px;">
                                    <i class="fa fa-map"></i> รูปภาพลูกค้า
                                </div>
                                <div class="box-body">
                                    <img src="../uploads/customers/gallerry/<?php echo $img->filename; ?>" class="img-fluid" width="100%"/>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="tab-pane" id="promisehistory">
                <div id="historypromise"></div>
            </div>
            <div class="tab-pane" id="workinggarbage">
                <div id="historyworking"></div>
            </div>
            <div class="tab-pane" id="paymenthistory">
                <div id="historyinvoice"></div>
            </div>
        </div>
    </div>
    <!-- /.nav-tabs-custom -->

</div>

<script type="text/javascript">
    function Confirmcustomer() {
        var r = confirm("กรุณาตรวจสอบความถูกต้องก่อนยืนยันข้อมูล ...");
        if (r == true) {
            var id = "<?php echo $model->id ?>";
            var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customer/confirmcustomer']) ?>";
            var data = {id: id};
            $.post(url, data, function (datas) {
                window.location.reload();
            })
        }
    }

    function setBox() {
        var h = window.innerHeight;
        var boxmap = $("#box-detail").innerHeight();
        $("#box-map").css({'height': boxmap});
        $("#map").css({'height': boxmap - 50, 'widht': '100%'});
        $("#box-content").css({'height': h - 165, "overflow-y": "auto"});
    }

    function getHistoryInvoice() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customers/gethistoryinvoice']) ?>";
        var id = "<?php echo $model->id ?>";
        var data = {customerid: id};
        $.post(url, data, function (res) {
            $("#historyinvoice").html(res);
        });
    }

    function getHistoryWorking() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customers/gethistoryworking']) ?>";
        var id = "<?php echo $model->id ?>";
        var data = {customerid: id};
        $.post(url, data, function (res) {
            $("#historyworking").html(res);
        });
    }

    function getHistoryPromise() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customers/gethistorypromise']) ?>";
        var id = "<?php echo $model->id ?>";
        var data = {customerid: id};
        $.post(url, data, function (res) {
            $("#historypromise").html(res);
        });
    }

</script>

<?php
$this->registerJs('
        setBox();
        init();
        //initMap();
        ');
?>



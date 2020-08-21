<?php

use app\models\Config;

/* @var $this yii\web\View */

$this->title = Yii::$app->name . ' backend';
$urlMap = new Config();
?>
<script src="<?php echo $urlMap->Urlmap() ?>"></script>
<div class="site-index" style=" margin-bottom: 0px;">
    <div class="body-content" style=" margin-bottom: 0px;">
        <!-- Info boxes -->
        <div class="row" style=" margin-bottom: 0px;">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="text-align:center">ลูกค้าใหม่รอการยืนยัน</span><br/>
                        <div style="text-align:center">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/customernonapprove']) ?>">
                                <button style="text-align:center;" class="btn btn-danger"><?php echo $customernonapprove ?></button></a>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="text-align:center">แจ้งชำระเงิน(ผ่านระบบ)</span><br/>
                        <div style="text-align:center">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['promise/promise/promisepay']) ?>">
                                <button style="text-align:center;" class="btn btn-danger"><?php echo $promisepay; ?></button></a>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="text-align:center">สัญญาใกล้หมด</span><br/>
                        <div style="text-align:center">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['promise/promise/promisenearexpire']) ?>">
                                <button style="text-align:center;" class="btn btn-danger"><?php echo $promisenearexpire; ?></button></a>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <!-- /.col -->

            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="text-align:center">สัญญารอการยืนยัน</span><br/>
                        <div style="text-align:center">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['promise/promise/promisewaitapprove']) ?>">
                                <button style="text-align:center;" class="btn btn-danger"><?php echo $promisewaitapprove ?></button></a>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>

    <div class="row">

        <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">ความหนาแน่นของลูกค้า</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="pad">
                                <!-- Map will be created here -->
                                <div id="map"></div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">
            <div id="chartgroup" style=" padding-top:0px;"></div><br/>
            <div class="row" style="margin-bottom:15px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['service']) ?>">
                        <button class="btn btn-primary btn btn-block btn-lg"><i class="fa fa-save"></i> บันทึกรายการจัดเก็บ</button></a>
                </div>
            </div>
            <div class="row" style="margin-bottom:15px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <a href="<?php echo Yii::$app->urlManager->createUrl(['service/default/confirmorder']) ?>">
                        <button class="btn btn-primary btn btn-block btn-lg"><i class="fa fa-check"></i> ตรวจสอบการชำระเงิน</button></a>
                </div>
            </div>
            <!-- Info Boxes Style 2 -->
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">จำนวนลูกค้า</span>
                    <span class="info-box-number"><?php echo $customerbetweenpromise; ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        จำนวนลูกค้าที่ลงทะเบียนกับบริษัทอยู่ระหว่างสัญญา
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-file-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">จำนวนสัญญา(ทั้งหมด)</span>
                    <span class="info-box-number"><?php echo $promiseall; ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        สัญญาที่ลูกค้าเคยทำกับบริษัททั้งหมด
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-file-pdf-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">จำนวนสัญญา(ที่ใช้งาน)</span>
                    <span class="info-box-number"><?php echo $promiseusing; ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        สัญญาที่ลูกค้าเคยทำกับบริษัทที่อยู่ระหว่างดำเนินการ
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <!--
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Direct Messages</span>
                <span class="info-box-number">163,921</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 40%"></div>
                </div>
                <span class="progress-description">
                      40% Increase in 30 Days
                  </span>
              </div>
            </div>
            -->
            <!-- /.info-box -->

        </div>
    </div>
</div>
<script>
    var map;
    //var marker = new longdo.Marker({lon: 100.604274, lat: 13.847860});
    function init() {
        map = new longdo.Map({
            placeholder: document.getElementById('map'),
            language: 'th'
        });
        map.zoom(7);
        map.location({lon: 100.604274, lat: 13.847860});
        //map.Overlays.add(marker);
        $.getJSON("<?php echo Yii::$app->urlManager->createUrl(['site/getlocation']) ?>", function(jsonObj) {
            $.each(JSON.parse(jsonObj), function(i, item) {
                //console.log({lon: item.long, lat: item.lat});
                //marker = new google.maps.Marker({
                //position: new google.maps.LatLng(item.lat, item.long),
                //map: maps,
                //title: item.name
                //locationList.push({
                //lon: item.long,
                //lat: item.lat
                //});

                map.Overlays.add(new longdo.Marker(
                        {lon: item.long, lat: item.lat},
                        {
                            title: item.name,
                            detail: item.address
                        },
                        ));
            });
        });
        //map.Tags.add(function(tile, zoom) {
        //var bound = longdo.Util.boundOfTile(map.projection(), tile);
        //mockAjaxFromServer(function(locationList) {
        //for (var i = 0; i < locationList.length; ++i) {
        //map.Overlays.add(new longdo.Marker(locationList[i], {visibleRange: {min: zoom, max: zoom}}));
        //}
        //});
        //});
    }

    function mockAjaxFromServer(callback) {
        var locationList = [];

        $.getJSON("<?php echo Yii::$app->urlManager->createUrl(['site/getlocation']) ?>", function(jsonObj) {
            $.each(JSON.parse(jsonObj), function(i, item) {
                console.log({lon: item.long, lat: item.lat});
                //marker = new google.maps.Marker({
                //position: new google.maps.LatLng(item.lat, item.long),
                //map: maps,
                //title: item.name
                //locationList.push({
                //lon: item.long,
                //lat: item.lat
                //});
            });
        });



        //var count = Math.random() * 5;
        //for (var i = 0; i < 3; ++i) {
        //locationList.push({lon: bound.minLon + (Math.random() * (bound.maxLon - bound.minLon)),
        //lat: bound.minLat + (Math.random() * (bound.maxLat - bound.minLat))});
        //}
        //console.log(locationList);
        //callback(locationList);
    }
    /*
     function initMap() {
     var mapOptions = {
     center: {lat: 13.847860, lng: 100.604274},
     zoom: 5,
     }

     var maps = new google.maps.Map(document.getElementById("map"), mapOptions);

     var marker, info;

     $.getJSON("<?php //echo Yii::$app->urlManager->createUrl(['site/getlocation'])                                                                                                          ?>", function(jsonObj) {
     $.each(JSON.parse(jsonObj), function(i, item) {
     marker = new google.maps.Marker({
     position: new google.maps.LatLng(item.lat, item.long),
     map: maps,
     title: item.name
     });

     info = new google.maps.InfoWindow();

     google.maps.event.addListener(marker, 'click', (function(marker, i) {
     return function() {
     info.setContent(item.name);
     info.open(maps, marker);
     }
     })(marker, i));

     });

     });

     }
     */

    function setPage() {
        var h = window.innerHeight;
        $("#map").css({"height": h});

        Highcharts.chart('chartgroup', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'กลุ่มลูกค้า',
                align: 'center',
                verticalAlign: 'middle',
                y: 60
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%'],
                    size: '110%'
                }
            },
            series: [{
                    type: 'pie',
                    name: 'จำนวน',
                    innerSize: '50%',
                    data: [<?php echo $chartgroup ?>,
                        {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    ]
                }]
        });
    }

</script>

<?php
$this->registerJs('
    setPage();
    init();
        //initMap();
        ');
?>
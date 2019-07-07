<?php
use app\models\Config;
/* @var $this yii\web\View */

$this->title = Yii::$app->name . ' backend';
$urlMap = new Config();
?>
<script src="<?php echo $urlMap->Urlmap() ?>"></script>
<div class="site-index">
    <div class="body-content">
    <!-- Info boxes -->
        <div class="row">
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
                        <a href="#">
                            <button style="text-align:center;" class="btn btn-danger">0</button></a>
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
                        <a href="#">
                            <button style="text-align:center;" class="btn btn-danger">0</button></a>
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
                        <a href="#">
                            <button style="text-align:center;" class="btn btn-danger">0</button></a>
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
                    <div id="map" style="height: 325px;"></div>
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
            <div class="row" style="margin-bottom:15px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <a href="">
                        <button class="btn btn-primary btn btn-block btn-lg"><i class="fa fa-save"></i> บันทึกรายการจัดเก็บ</button></a>
                </div>
            </div>

          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">จำนวนลูกค้า</span>
              <span class="info-box-number">5,200</span>
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
              <span class="info-box-number">92,050</span>
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
              <span class="info-box-number">114,381</span>
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
      function initMap() {
            var mapOptions = {
              center: {lat: 13.847860, lng: 100.604274},
              zoom: 5,
            }
                
            var maps = new google.maps.Map(document.getElementById("map"),mapOptions);

            var marker, info;

            $.getJSON("<?php echo Yii::$app->urlManager->createUrl(['site/getlocation']) ?>", function( jsonObj ) {
                    //*** loop
                    $.each(JSON.parse(jsonObj), function(i, item){
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

                    }); // loop

             });

        }
    </script>

    <?php
$this->registerJs('
        initMap();
        ');
?>
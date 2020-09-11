<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Config;
use yii\helpers\Url;

$Config = new Config();

$this->title = "ค้างจ่ายค่าบริการ";
$this->params['breadcrumbs'][] = $this->title;

/*
  if (!$month) {
  $monthNow = date("m");
  if (strlen($monthNow) < 2) {
  $m = "0" . $monthNow;
  } else {
  $m = $monthNow;
  }
  } else {
  $m = $month;
  }

  $yearNow = date("Y");
 *
 */
$yearNow = date("Y");
?>

<div class="row" style=" margin-bottom: 20px;">
    <div class="col-lg-3 col-md-4">
        <label>พ.ศ.</label>
        <select id="year" class="form-control">
            <option value="">== ทั้งหมด ==</option>
            <option value="<?php echo $yearNow ?>" <?php echo ($year == $yearNow) ? "selected" : ""; ?>><?php echo ($yearNow + 543) ?></option>
            <option value="<?php echo ($yearNow - 1) ?>" <?php echo ($year == ($yearNow - 1)) ? "selected" : ""; ?>><?php echo (($yearNow + 543) - 1) ?></option>
        </select>
    </div>
    <div class="col-lg-3 col-md-4">
        <label>ประจำเดือน</label>
        <select id="month" class="form-control">
            <option value="">== ทั้งหมด ==</option>
            <option value="01" <?php echo ($m == '01') ? "selected" : ""; ?>>มกราคม</option>
            <option value="02" <?php echo ($m == '02') ? "selected" : ""; ?>>กุมภาพันธ์</option>
            <option value="03" <?php echo ($m == '03') ? "selected" : ""; ?>>มีนาคม</option>
            <option value="04" <?php echo ($m == '04') ? "selected" : ""; ?>>เมษายน</option>
            <option value="05" <?php echo ($m == '05') ? "selected" : ""; ?>>พฤษภาคม</option>
            <option value="06" <?php echo ($m == '06') ? "selected" : ""; ?>>มิถุนายน</option>
            <option value="07" <?php echo ($m == '07') ? "selected" : ""; ?>>กรกฏาคม</option>
            <option value="08" <?php echo ($m == '08') ? "selected" : ""; ?>>สิงหาคม</option>
            <option value="09" <?php echo ($m == '09') ? "selected" : ""; ?>>กันยายน</option>
            <option value="10" <?php echo ($m == '10') ? "selected" : ""; ?>>ตุลาคม</option>
            <option value="11" <?php echo ($m == '11') ? "selected" : ""; ?>>พฤศจิกายน</option>
            <option value="12" <?php echo ($m == '12') ? "selected" : ""; ?>>ธันวาคม</option>
        </select>
    </div>

    <div class="col-lg-2 col-md-2">
        <button type="button" class="btn btn-danger btn-block" style=" margin-top: 25px;" onclick="getData()">ดูข้อมูล</button>
    </div>
</div>


<div class="row" style=" margin-bottom: 0px;">
    <div class="col-lg-12 col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">ลูกค้างจ่ายค่าบริการ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="boxreportmonth" style=" overflow-x: hidden;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-hover" id="history">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Inv</th>
                                    <th>ลูกค้า</th>
                                    <th style=" text-align: center;">จำนวน</th>
                                    <th style=" text-align: center;">วันที่ออกใบวางบิล</th>
                                    <th style=" text-align: center;">เครดิต</th>
                                    <th style=" text-align: center;">วันที่ครบชำระเงิน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($invoice as $rs):
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $rs['invoicenumber'] ?></td>
                                        <td><?php echo $rs['company'] ?></td>
                                        <td style=" text-align: right;"><?php echo number_format($rs['total']) ?></td>
                                        <td style=" text-align: center;" ><?php echo $Config->thaidate($rs['dateinvoice']) ?></td>
                                        <th style=" text-align: center;"><?php echo ($rs['credit']) ? $rs['credit'] . " วัน" : "-"; ?></th>
                                        <td style=" text-align: center;" >
                                            <?php
                                            if ($rs['credit']) {
                                                $credit = $rs['credit'];
                                                $dateInvoice = $rs['dateinvoice'];
                                                $sql = "SELECT DATE_ADD('".$dateInvoice."', INTERVAL $credit DAY) AS datecreate";
                                                $createDate = Yii::$app->db->createCommand($sql)->queryOne()['datecreate'];
                                                echo $Config->thaidate($createDate);
                                            } else {
                                                echo $Config->thaidate($rs['dateinvoice']);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
</div>

<?php
$this->registerJs("
        setBox();
         $('#history').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false
              })
        ");
?>
<script type="text/javascript">
    function setBox() {
        var h = window.innerHeight;
        $("#boxreportmonth").css({"height": h - 265});
        //$("#paper").css({"height": h - 260});
        //$("#createbill").css({"height": h - 200, "overflow-x": "hidden"});
    }

    function getData() {
        var month = $("#month").val();
        var year = $("#year").val();
        if (year == "" && month == "") {
            var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/outstandingpaymenall']) ?>";
        } else {
            var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/outstandingpaymen']) ?>" + "&year=" + year + "&month=" + month;
        }

        window.location = url;
    }
</script>
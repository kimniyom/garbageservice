<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Config;
use yii\helpers\Url;

$Config = new Config();
$this->title = 'ประวัติการจัดเก็บขยะ';
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['/report/report/monthservicefee']];
$this->params['breadcrumbs'][] = $this->title;
$yearNow = date("Y");
?>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>ปี พ.ศ.</label>
        <select id="year" name="year" class="form-control" onchange="getData()">
            <?php for ($i = $yearNow - 1; $i <= $yearNow; $i++): ?>
                <option value="<?php echo $i ?>" <?php echo($yearNow == $years) ? "selected" : ""; ?>><?php echo ($i + 543) ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>
<br/>
<div class="row" style=" margin-bottom: 0px;">
    <div class="col-lg-12 col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ประวัติการจัดเก็บขยะ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="boxreportmonth" style=" overflow-x: hidden;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-hover" id="history">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>วันที่</th>
                                    <th style=" text-align: center;">เลขที่สัญญา</th>
                                    <th>ลูกค้า</th>
                                    <th style=" text-align: center;">จำนวนขยะ(กิโลกรัม)</th>
                                    <th style=" text-align: center;">จำนวนขยะเกิน(กิโลกรัม)</th>
                                    <th style=" text-align: center;">ทะเบียนรถ</th>
                                    <th style=" text-align: center;">เวลาเข้า - ออก</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $sumAmount = 0;
                                $sumOver = 0;
                                foreach ($history as $rs):
                                    $i++;
                                $sumAmount = ($sumAmount + $rs['amount']);
                                $sumOver = ($sumOver + $rs['garbageover'])
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $Config->thaidate($rs['datekeep']) ?></td>
                                        <td><?php echo $rs['promisenumber'] ?></td>
                                        <td><?php echo $rs['company'] ?></td>
                                        <td style=" text-align: right;"><?php echo $rs['amount'] ?></td>
                                        <td style=" text-align: right;" ><?php echo $rs['garbageover'] ?></td>
                                        <td style=" text-align: center;"><?php echo $rs['car'] ?></td>
                                        <td style=" text-align: center;" ><?php echo $rs['timekeepin']." - ".$rs['timekeepout'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style=" text-align: center;">รวม</th>
                                    <th style=" text-align: right;"><?php echo $sumAmount ?></th>
                                    <th style=" text-align: right;"><?php echo $sumOver ?></th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
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
        var h2 = (h - 265);
        var hmonth = (h2 / 2);
        $("#boxreportmonth").css({"height": h - 265, "overflow-y": "auto"});
        $("#chartMonth").css({"height": hmonth});
        $("#chartMonthkilo").css({"height": hmonth});
    }

    function getData() {
        var year = $("#year").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl(['report/report/roundhistory']) ?>" + "&year=" + year;
        window.location = url;
    }

</script>
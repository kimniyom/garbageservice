<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Config;
use yii\helpers\Url;

$this->title = 'รายงานการเข้าจัดเก็บขยะ';
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['/report/report/monthservicefee']];
$this->params['breadcrumbs'][] = $this->title;
$yearNow = date("Y");
?>

<div class="row">
    <div class="col-md-4 col-lg-4">
        <label>ปี พ.ศ.</label>
        <select id="year" name="year" class="form-control" onchange="getReportMonth()">
            <?php for ($i = $yearNow - 1; $i <= $yearNow; $i++): ?>
                <option value="<?php echo $i ?>" <?php echo($yearNow == $years) ? "selected" : ""; ?>><?php echo ($i + 543) ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>
<br/>
<div class="row" style=" margin-bottom: 0px;">
    <div class="col-lg-5 col-md-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">รายงานการเข้าจัดเก็บขยะรายเดือน</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="boxreportmonth" style=" overflow-x: hidden;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>เดือน</th>
                                    <th style=" text-align: center;">จำนวน(ครั้ง)</th>
                                    <th style=" text-align: center;">จำนวน(กิโลกรัม)</th>
                                    <th style=" text-align: center;">ขยะเกิน(กิโลกรัม)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sum = 0;
                                $sumkilo = 0;
                                $sumover = 0;
                                foreach ($reportmonth as $rs):
                                    $sum = $sum + $rs['total'];
                                    $sumkilo = $sumkilo + $rs['kilo'];
                                    $sumover = $sumover + $rs['kiloover'];
                                    ?>
                                    <tr>
                                        <td><?php echo $rs['month_th'] ?></td>
                                        <td style=" text-align: right;"><?php echo number_format($rs['total']) ?></td>
                                        <td style=" text-align: right;"><?php echo number_format($rs['kilo']) ?></td>
                                        <td style=" text-align: right;" ><?php echo number_format($rs['kiloover']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style=" text-align: center;">รวม</th>
                                    <th style=" text-align: right;"><?php echo number_format($sum) ?></th>
                                    <th style=" text-align: right;"><?php echo number_format($sumkilo) ?></th>
                                    <th style=" text-align: right;"><?php echo number_format($sumover) ?></th>
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
    <div class="col-lg-7 col-md-7">
        <div id="chartMonth"></div>
        <div id="chartMonthkilo" style=" margin-top: 45px;"></div>
    </div>
</div>

<?php
$this->registerJs('
        setBox();
        chartReportMonth();
        chartReportMonthAll();
            ');
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
    function getReportMonth() {
        var year = $("#year").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl(['report/report/reportworkingarbage']) ?>" + "&year=" + year;
        window.location = url;
    }

    function chartReportMonth() {
        Highcharts.chart('chartMonth', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'จำนวนการเข้าจัดเก็บขยะแยกรายเดือน(ครั้ง)'
            },
            subtitle: {
                text: 'ปี พ.ศ. <?php echo ($years + 543) ?>'
            },
            xAxis: {
                categories: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
            },
            yAxis: {
                title: {
                    text: 'จำนวนครั้งที่เข้าจัดเก็บ'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },

            series: [{
                    name: 'เดือน',
                    data: [<?php echo $chartgarbage ?>]
                }]
        });
    }

    function chartReportMonthAll() {
        Highcharts.chart('chartMonthkilo', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'จำนวนการเข้าจัดเก็บขยะแยกรายเดือน(กิโลกรัม)'
            },
            subtitle: {
                text: 'ปี พ.ศ. <?php echo ($years + 543) ?>'
            },
            xAxis: {
                categories: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
            },
            yAxis: {
                title: {
                    text: 'จำนวนกิโลกรัมที่เข้าจัดเก็บ'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                    name: 'เดือน',
                    colorByPoint: true,
                    data: [<?php echo $chartgarbagekilo ?>]
                }]
        });
    }
</script>
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Config;
use yii\helpers\Url;

$Config = new Config();
?>

<div class="row" style=" margin-bottom: 0px;">
    <div class="col-lg-12 col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">ประวัติการเข้าจัดเก็บ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="boxreportmonth" style=" overflow-x: hidden;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-hover" id="historyworkin">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="text-align: center;">วันที่</th>
                                    <th style=" text-align: center;">สัญญาเลขที่</th>
                                    <th style=" text-align: center;">จำนวนขยะ(กิโลกรัม)</th>
                                    <th style=" text-align: center;">จำนวนขยะเกิน(กิโลกรัม)</th>
                                    <th style=" text-align: center;">ทะเบียนรถ</th>
                                    <th style=" text-align: center;">เวลา เข้า - ออก</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($history as $rs):
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $Config->thaidate($rs['datekeep']) ?></td>
                                        <td style=" text-align: center;"><?php echo $rs['promisenumber'] ?></td>
                                        <td style=" text-align: center;"><?php echo $rs['amount'] ?></td>
                                        <td style=" text-align: center;" ><?php echo $rs['garbageover'] ?></td>
                                        <td style=" text-align: center;" ><?php echo $rs['car'] ?></td>
                                        <td style=" text-align: center;"><?php echo $rs['timekeepin']." - ".$rs['timekeepout']?></td>
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

<script>
    $(document).ready(function () {
        $('#historyworkin').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    });
</script>

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
                <h3 class="box-title">ประวัติการชำระเงิน</h3>
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
                                    <th style=" text-align: center;">จำนวน</th>
                                    <th style=" text-align: center;">วันที่ออกใบวางบิล</th>
                                    <th style=" text-align: center;">วันที่ชำระเงิน</th>
                                    <th style=" text-align: center;">วิธีแจ้งชำระเงิน</th>
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
                                        <td><?php echo $rs['invoicenumber'] ?></td>
                                        <td style=" text-align: right;"><?php echo number_format($rs['total']) ?></td>
                                        <td style=" text-align: center;" ><?php echo $Config->thaidate($rs['dateinvoice']) ?></td>
                                        <td style=" text-align: center;" ><?php echo $Config->thaidate($rs['dateservice']) ?></td>
                                        <th style=" text-align: center;"><?php echo ($rs['typepayment'] == 1) ? "ผ่านระบบ" : "ผ่านช่องทางการติดต่อ"; ?></th>
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
        $('#history').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    });
</script>

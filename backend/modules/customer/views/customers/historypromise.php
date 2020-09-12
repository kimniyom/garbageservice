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
                <h3 class="box-title">ประวัติการทำสัญญาข้อตกลง</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding" id="boxreportmonth" style=" overflow-x: hidden;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table table-bordered table-striped table-hover" id="historypromises">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th style=" text-align: center;">สัญญาเลขที่</th>
                                    <th style="text-align: center;">วันที่ทำสัญา</th>
                                    <th style=" text-align: center;">วันที่เริ่มสัญญา</th>
                                    <th style=" text-align: center;">สัญญาสิ้นสุดวันที่</th>
                                    <th style=" text-align: center;">สถานะ</th>
                                    <th></th>
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
                                        <td style=" text-align: center;"><?php echo $rs['promisenumber'] ?></td>
                                        <td><?php echo $Config->thaidate($rs['createat']) ?></td>
                                        <td style=" text-align: center;"><?php echo $rs['promisedatebegin'] ?></td>
                                        <td style=" text-align: center;" ><?php echo $rs['promisedateend'] ?></td>
                                        <td style=" text-align: center;" >
                                            <?php echo $Config->getStatusPromise($rs['status']) ?>
                                        </td>
                                        <td><a href="<?php echo Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $rs['id']]) ?>" target="_blank">ดูรายละเอียดสัญญา</a></td>
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
    $(document).ready(function() {
        $('#historypromises').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    });
</script>

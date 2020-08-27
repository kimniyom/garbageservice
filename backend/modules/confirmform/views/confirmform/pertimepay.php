<?php
$this->title = 'ยืนยันการชำระเงิน(ผ่านช่องทาง อื่น ๆ)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promise-nearexpire">
    <div style=" border-radius: 10px; width: 400px; height: auto; border: solid 2px #002a80; padding: 10px; margin-bottom: 10px; background: #ffffff;">
        <i class="fa fa-info-circle"></i> ยืนยันการชำระเงินค่าบริการกำจัดขยะติดเชื้อ โดยลูกค้าแจ้งการโอนเงินผ่านช่องทางอื่น เช่น Line,FaceBook,โทร เป็นต้น
    </div>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body" id="boxreportmonth" style=" overflow-x: hidden;">
            <table class="table" id="history">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>เลขที่ใบยืนยันเข้าจัดเก็บ</th>
                        <th>รายการ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($pertime as $rs): $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?> </td>
                            <td><?php echo $rs['confirmformnumber'] ?></td>
                            <td><?php echo $rs['orders'] ?></td>
                            <td>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['confirmform/confirmform/confirminvoice', 'id' => $rs['id']]) ?>">
                                    ยืนยันการชำระเงิน</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
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
        $("#boxreportmonth").css({"height": h - 220, "overflow-y": "auto"});
    }


</script>


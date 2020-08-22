<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>
<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
use kartik\datetime\DateTimePicker;
use backend\model\Bookbank;

$this->title = "ยืนยันการชำระเงิน";
$this->params['breadcrumbs'][] = ['label' => 'ยืนยันการชำระเงิน', 'url' => ['promisepay']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h4>
    แจ้งชำระค่าบริการ Invoice #<?php echo $order['invoicenumber'] ?><br/>
    <?php echo ($order['typeinvoice'] == 0) ? "ค่าบริการกำจัดขยะติดเชื้อ" : "ค่าบริการขยะเกิน"; ?>
</h4>
<div style=" border-radius: 10px; width: 400px; height: auto; border: solid 2px #002a80; padding: 10px; margin-bottom: 10px; background: #ffffff;">
    <i class="fa fa-info-circle"></i> ยืนยันการชำระเงินค่าบริการกำจัดขยะติดเชื้อ โดยลูกค้าแจ้งการโอนเงินผ่านช่องทางอื่น เช่น Line,FaceBook,โทร เป็นต้น
</div>
<hr/>
<form id="form">
    <input type="hidden" id="id" name="id" value="<?php echo $id ?>"/>
    <label>ธนาคารที่ชำระเข้ามา</label>
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <?php
            echo Select2::widget([
                'name' => 'bank',
                'value' => '',
                'id' => 'bank',
                'data' => ArrayHelper::map($bank, "id", "bname"),
                'options' => [
                    'multiple' => false,
                    'placeholder' => 'Select Bank ...',
                //'required' => true,
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <label>วันที่ชำระ</label>
            <?php
            echo DatePicker::widget([
                'name' => 'dateservice',
                'value' => date('Y-m-d'),
                'id' => 'dateservice',
                'language' => 'th',
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);
            ?>
        </div>
    </div>

    <label>เวลาที่ชำระ</label>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <?php
            echo TimePicker::widget([
                'name' => 'timeservice',
                'id' => 'timeservice',
                'pluginOptions' => [
                    'autoclose' => true,
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'secondStep' => 5,
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <label>จำนวนเงิน</label>
            <input class="form-control" id="total" required="required" name="total" value="<?php echo number_format($order['total'], 2) ?>" readonly="readonly"/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <label>รายละเอียดเพิ่มเติม</label>
            <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <label>หลักฐานการโอน(* ถ้ามี)</label><br/>
            <input type="file" id="inputFile" name="inputFile"/>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
        </div>
    </div>
</form>
<?php
$url = Yii::$app->urlManager->createUrl(['promise/promise/saveconfirmorder']);
$this->registerJs('$(document).ready(function () {
            $("#form").on("submit", function (event) {
                event.preventDefault(); //prevent default submitting

                var formData = new FormData($(this)[0]);
                var bank = formData.get("bank");
                var dateservice = formData.get("dateservice");
                var timeservice = formData.get("timeservice");
                var comment = formData.get("comment");
                var inputFile = formData.get("inputFile");
                if (dateservice == "" || timeservice == "" || bank == "") {
                        Swal.fire(
                            "Alert?",
                            "กรอกข้อมูลไม่ครบ?",
                            "warning"
                        );
                return false;
                }
                $.ajax({
                    url: "' . $url . '",
                    type: "post",
                    data: formData,
                    processData: false, //Not to process data
                    contentType: false, //Not to set contentType
                    success: function (data) {
                        if(data == "success"){
                            Success();
                        }
                    }
                });
            });
        });')
?>

<script type="text/javascript">
    function Success() {
        Swal.fire({
            title: 'Success',
            text: "ยืนยันรายการสำเร็จ",
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                window.location = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/promisepay']) ?>";
            }
        });
    }


</script>

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

$this->title = "แจ้งชำระเงิน";
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'รายการที่ต้องชำระ', 'url' => ['invoice']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h4>
    แจ้งชำระค่าบริการ Invoice #<?php echo $order['invoicenumber'] ?><br/>
    <?php echo ($order['typeinvoice'] == 0) ? "ค่าบริการกำจัดขยะติดเชื้อ" : "ค่าบริการขยะเกิน"; ?>
</h4>
<hr/>

<label>ธนาคารที่ท่านชำระ</label>
<div class="row">
    <div class="col-md-6 col-lg-6">
        <?php
        echo Select2::widget([
            'name' => 'bank',
            'value' => '',
            'data' => ArrayHelper::map($bank, "id", "bname"),
            'options' => ['multiple' => false, 'placeholder' => 'Select Bank ...']
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
        <input class="form-control" id="total" value="<?php echo number_format($order['total'], 2) ?>" readonly="readonly"/>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-6">
        <label>รายละเอียดเพิ่มเติม</label>
        <textarea class="form-control" id="comment" rows="5"></textarea>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <button class="btn btn-success" onclick="confirmOrder()">บันทึกข้อมูล</button>
    </div>
</div>


<script type="text/javascript">
    function confirmOrder() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/saveconfirmorder']) ?>";
        var id = $("#orders").val();
        var dateservice = $("#dateservice").val();
        var timeservice = $("#timeservice").val();
        var comment = $("#comment").val();
        if (id == "" || dateservice == "" || timeservice == "") {
            alert("กรอกข้อมูลไม่ครบ...");
            return false;
        }
        var data = {
            id: id,
            dateservice: dateservice,
            timeservice: timeservice,
            comment: comment
        };
        //console.log(data);

        $.post(url, data, function(datas) {
            alert("ยืนยันรายการสำเร็จ...");
            window.location.reload();
        });
    }


</script>

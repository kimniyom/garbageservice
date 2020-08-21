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

$this->title = "ตรวจสอบการชำระเงิน";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <label>เลือกรายการแจ้งชำระเงิน</label>
                <?php
                $listOrders = ArrayHelper::map($order, 'id', 'orders');
                echo Select2::widget([
                    'name' => 'orders',
                    'id' => 'orders',
                    'value' => '',
                    'data' => $listOrders,
                    'options' => [
                        'multiple' => false,
                        'placeholder' => 'Select Order ...',
                    //'onchange' => 'getRound(this.value)',
                    ],
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
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


        <div class="row">
            <div class="col-md-12 col-lg-12">
                <label>เวลาที่ชำระ</label>
                <?php
                echo TimePicker::widget([
                    'name' => 'timeservice',
                    'id' => 'timeservice',
                    'pluginOptions' => [
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
            <div class="col-md-12 col-lg-12">
                <label>รายละเอียดเพิ่มเติม</label>
                <textarea class="form-control" id="comment" rows="5"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <button class="btn btn-success" onclick="confirmOrder()">บันทึกข้อมูล</button>
            </div>
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

            $.post(url, data, function (datas) {
                alert("ยืนยันรายการสำเร็จ...");
                window.location.reload();
            });
        }


    </script>
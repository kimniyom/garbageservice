<?php

use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = $customer['company'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="service-default-formsaveround">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h5>บันทึรายการเก็บขยะ (ลูกค้า <?php echo $customer['company'] ?>)</h5>
            <h5>เลขที่สัญญา (<?php echo $promise['promisenumber'] ?>) ปริมาณขยะต่อรอบ (<?php echo ($promise['recivetype'] == 1) ? $promise['garbageweight'] : "-" ?>)</h5>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12">
            <label>ปริมาณขยะ / กก.</label>
            <input type="text" id="amount" class="form-control" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..." />
        </div>

        <div class="col-md-4 col-lg-4 col-sm-12">
            <label>ปริมาณขยะเกิน / กก.</label>
            <input type="text" id="garbageover" class="form-control" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..."/>
        </div>

        <div class="col-md-4 col-lg-4">
            <label>วันที่</label>
            <?php
            echo DatePicker::widget([
                'name' => 'datekeep',
                'value' => date('Y-m-d'),
                'language' => 'th',
                'id' => 'datekeep',
                'readonly' => true,
                'removeButton' => false,
                'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'autoclose' => true
                ]
            ]);
            ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">
            <label>ทะเบียนรถเข้าจัดเก็บ</label>
            <?php
            $listCar = ArrayHelper::map($carlist, 'carnumber', 'carnumber');
            echo Select2::widget([
                'name' => 'car',
                'id' => 'car',
                'value' => '',
                'data' => $listCar,
                'options' => [
                    'multiple' => false,
                    'placeholder' => 'Select Car ...',
                //'onchange' => 'getRound()',
                ],
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <label>เวลาเข้า</label>
            <?php
            echo TimePicker::widget([
                'name' => 'timekeepin',
                'id' => 'timekeepin',
                'readonly' => true,
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'secondStep' => 5,
                ]
            ]);
            ?>
        </div>
        <div class="col-md-3 col-lg-3">
            <label>เวลาออก</label>
            <?php
            echo TimePicker::widget([
                'name' => 'timekeepout',
                'id' => 'timekeepout',
                'readonly' => true,
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 1,
                    'secondStep' => 5,
                ]
            ]);
            ?>
        </div>

        <div class="col-md-2 col-lg-2 col-sm-12">
            <button class="btn btn-success btn-flat" type="button" onclick="Save()" style="margin-top:25px;"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>

<div id="result"></div>

<?php
$this->registerJs('
    getRound();
    ');
?>
<script type="text/javascript">

    function Save() {
        var amount = $("#amount").val();
        var garbageover = $("#garbageover").val();
        //var id = "<?php //echo $id    ?>";
        var datekeep = $("#datekeep").val();
        var promiseid = "<?php echo $promise['id'] ?>";
        var timekeepin = $("#timekeepin").val();
        var timekeepout = $("#timekeepout").val();
        var car = $("#car").val();
        if (amount == "" || datekeep == "" || timekeepin == "" || car == "") {
            alert("กรอกข้อมูลไม่ครบ...!");
            return false;
        }
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/save']) ?>";
        var data = {
            amount: amount,
            garbageover: garbageover,
            //id: id,
            datekeep: datekeep,
            promiseid: promiseid,
            timekeepin: timekeepin,
            timekeepout: timekeepout,
            car: car
        };
        $.post(url, data, function (datas) {
            //window.location="<?php //echo Yii::$app->urlManager->createUrl(['service'])    ?>";
            //window.location.reload();
            getRound();
        });
    }

    function bannedKey(evt)
    {
        var allowedEng = false; //อนุญาตให้คีย์อังกฤษ
        var allowedThai = false; //อนุญาตให้คีย์ไทย
        var allowedNum = true; //อนุญาตให้คีย์ตัวเลข
        var k = event.keyCode;/* เช็คตัวเลข 0-9 */
        if (k >= 48 && k <= 57) {
            return allowedNum;
        }

        /* เช็คคีย์อังกฤษ a-z, A-Z */
        if ((k >= 65 && k <= 90) || (k >= 97 && k <= 122)) {
            return allowedEng;
        }

        /* เช็คคีย์ไทย ทั้งแบบ non-unicode และ unicode */
        if ((k >= 161 && k <= 255) || (k >= 3585 && k <= 3675)) {
            return allowedThai;
        }
    }

    function getRound() {
        var promiseid = "<?php echo $promise['id'] ?>";
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getroundlist']) ?>";
        var data = {promiseid: promiseid};
        $.post(url, data, function (datas) {
            $("#result").html(datas);
            $("#amount").val("");
            $("#garbageover").val("");
        });
    }

    function deleteRound(id) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/deleteround']) ?>";
        var data = {id: id};
        $.post(url, data, function (datas) {
            getRound();
        });
    }
</script>



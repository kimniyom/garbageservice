<?php

use kartik\date\DatePicker;
use kartik\widgets\TimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Config;

$Config = new Config();
$this->title = $customer['company'];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .service-default-formsaveround label{
        margin-top: 5px;
    }

    #box-left{
        background-color: #FFFFFF;
    }
</style>

<div class="service-default-formsaveround">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h5>บันทึรายการเก็บขยะ (ลูกค้า <?php echo $customer['company'] ?>)</h5>
            <h5>เลขที่สัญญา (<?php echo $promise['promisenumber'] ?>) ปริมาณขยะต่อครั้ง(<?php echo ($promise['recivetype'] == 1) ? $promise['garbageweight'] . " กก. " : "-" ?>)</h5>
            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <div id="box-left" style=" padding: 10px;">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label><i class="fa fa-car text-success"></i> ทะเบียนรถเข้าจัดเก็บ *</label>
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

                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <label><i class="fa fa-archive text-danger"></i> ปริมาณขยะ / กก. *</label>
                        <input type="text" id="amount" class="form-control" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..." />
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <label><i class="fa fa-archive text-danger"></i> ปริมาณขยะเกิน / กก.</label>
                        <input type="text" id="garbageover" class="form-control" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..."/>
                    </div>

                    <div class="col-md-12 col-lg-12">
                        <label><i class="fa fa-calendar-check-o text-warning"></i> วันที่ *</label>
                        <select id="datekeep" class="form-control">
                            <option value="">== วันที่เข้าจัดเก็บ ==</option>
                            <?php foreach($dateround as $r): ?>
                            <option value="<?php echo $r['datekeep'] ?>"><?php echo $Config->thaidate($r['datekeep']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        /*
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
                         * 
                         */
                        ?>
                    </div>


                    <div class="col-md-12 col-lg-12">
                        <label><i class="fa fa-clock-o text-info"></i> เวลาเข้า *</label>
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
                    <div class="col-md-12 col-lg-12">
                        <label><label><i class="fa fa-clock-o text-info"></i> เวลาออก *</label>
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
                    <div class="col-md-12 col-lg-12">
                        <label>หมายเหตุ</label>
                        <textarea class="form-control" id="comment"></textarea>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <button class="btn btn-success btn-flat" type="button" onclick="Save()" style="margin-top:25px;"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-9">
            <div id="result" style=" background: #FFFFFF; padding: 10px;">Loading...</div>
        </div>
    </div>
</div>

<?php
$this->registerJs('
    setBoxs();
    getRound();
    ');
?>
<script type="text/javascript">
    function setBoxs() {
        var h = window.innerHeight;
        $("#box-left").css({"height": h - 220, "overflow-x": "hidden"});
        $("#result").css({"height": h - 220, "overflow-x": "hidden"});
    }
    function Save() {
        var amount = $("#amount").val();
        var garbageover = $("#garbageover").val();
        //var id = "<?php //echo $id                                                       ?>";
        var datekeep = $("#datekeep").val();
        var promiseid = "<?php echo $promise['id'] ?>";
        var timekeepin = $("#timekeepin").val();
        var timekeepout = $("#timekeepout").val();
        var car = $("#car").val();
        var comment = $("#comment").val();
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
            car: car,
            comment: comment
        };
        $.post(url, data, function(datas) {
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
        $.post(url, data, function(datas) {
            $("#result").html(datas);
            $("#amount").val("");
            $("#garbageover").val("");
        });
    }

    function deleteRound(id) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/deleteround']) ?>";
        var data = {id: id};
        $.post(url, data, function(datas) {
            getRound();
        });
    }
</script>



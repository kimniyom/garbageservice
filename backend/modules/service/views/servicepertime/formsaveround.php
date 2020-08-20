<?php
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\widgets\TimePicker;
use yii\helpers\ArrayHelper;

$this->title = $customerneed['customername'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="service-default-formsaveround">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h4>บันทึรายการเก็บขยะ (ลูกค้า <?php echo $customerneed['customername'] ?>)</h4>
            <h4>เลขที่แบบยืนยันลูกค้า (<?php echo $confirm['confirmformnumber'] ?>)</h4>
            <h4>จำนวนครั้งที่เข้าจัดเก็บ (<?php echo $confirm['amount'] ?>)</h4>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
        <label>ปริมาณขยะ / กก.</label>
        <input type="text" id="amount" class="form-control" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..." />
        </div>
   
        <div class="col-md-6 col-lg-6 col-sm-12">
        <label>ปริมาณขยะเกิน / กก.</label>
        <input type="text" id="garbageover" class="form-control" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..."/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3">
        <label>วันที่</label>
        <?php 
                    echo DatePicker::widget([
                        'name' => 'datekeep', 
                        'value' => date('Y-m-d'),
                        'language' => 'th',
                        'id' => 'datekeep',
                        'options' => ['placeholder' => 'Select issue date ...'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
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

        <div class="col-md-6 col-lg-7 col-sm-12">
            <button class="btn btn-success btn-flat" type="button" onclick="Save()" style="margin-top:25px;"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>
<div id="warning"></div>
<div id="result"></div>

<?php
    $this->registerJs('
    getRound();
    ');
?>
<script type="text/javascript">

    function Save(){
        var amount = $("#amount").val();
        var garbageover = $("#garbageover").val();
        var datekeep = $("#datekeep").val();
        var confirmid = "<?php echo $confirm['id'] ?>";
        var count = "<?php echo $confirm['amount'] ?>";
        var customerneedid = "<?php echo $customerneed['id'] ?>";
        var timekeepin = $("#timekeepin").val();
        var timekeepout = $("#timekeepout").val();
        var car = $("#car").val();

        if(amount == "" || datekeep == ""){
            alert("กรอกข้อมูลไม่ครบ...!");
            return false;
        }
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/servicepertime/save']) ?>";
        var data = {
            amount: amount,
            garbageover: garbageover,
            customerneedid: customerneedid,
            datekeep: datekeep,
            confirmid: confirmid,
            count: count,
            timekeepin: timekeepin,
            timekeepout: timekeepout,
            car: car
            };
            console.log(data);
        $.post(url,data,function(datas){
            console.log(datas);
            if(datas == 1)
            {
                $("#warning").html("<br><b>ครบตามจำนวนครั้งที่จัดเก็บแล้ว</b>");
            }
            else{
                $("#warning").html("");
                getRound();
            }
           
        });
    }

    function bannedKey(evt)
    {
        var allowedEng = false; //อนุญาตให้คีย์อังกฤษ
        var allowedThai = false; //อนุญาตให้คีย์ไทย
        var allowedNum = true; //อนุญาตให้คีย์ตัวเลข
        var k = event.keyCode;/* เช็คตัวเลข 0-9 */
        if (k>=48 && k<=57) { return allowedNum; }

        /* เช็คคีย์อังกฤษ a-z, A-Z */
        if ((k>=65 && k<=90) || (k>=97 && k<=122)) { return allowedEng; }

        /* เช็คคีย์ไทย ทั้งแบบ non-unicode และ unicode */
        if ((k>=161 && k<=255) || (k>=3585 && k<=3675)) { return allowedThai; }
    }

    function getRound(){
        var confirmid = "<?php echo $confirm['id'] ?>";
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/servicepertime/getroundlist']) ?>";
        var data = {confirmid: confirmid};
        $.post(url,data,function(datas){
            
            $("#result").html(datas);
            $("#amount").val("");
            $("#garbageover").val("");
        });
    }

    function deleteRound(id){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/servicepertime/deleteround']) ?>";
        var data = {id: id};
        $.post(url,data,function(datas){
            getRound();
        });
    }
</script>



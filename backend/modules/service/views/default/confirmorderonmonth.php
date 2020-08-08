<style type="text/css">
    .row{
        margin-bottom: 10px;
    }

    #text-list{
        background: #ffffff;
    }

    #round{
        overflow: auto;
        background: #ffffff;
    }

    #paper{
        overflow: auto;
        background: #ffffff;
    }
</style>
<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

$this->title = "ใบส่งมอบงาน";
$this->params['breadcrumbs'][] = $this->title;

if (!$month) {
    $monthNow = date("m");
    if (strlen($monthNow) < 2) {
        $m = "0" . $monthNow;
    } else {
        $m = $monthNow;
    }
} else {
    $m = $month;
}

$yearNow = date("Y");
?>
<div class="row" style=" margin-bottom: 0px;">
    <div class="col-lg-4 col-md-4">
        <label>กลุ่มลูกค้า</label>
        <?php
        $listCustomergroup = ArrayHelper::map($groupcustomer, 'id', 'groupcustomer');
        echo Select2::widget([
            'name' => 'groupcustomer',
            'id' => 'groupcustomer',
            'value' => $groupId,
            'data' => $listCustomergroup,
            'options' => [
                'multiple' => false,
                'placeholder' => 'Select Customer ...',
                'onchange' => 'getRound()',
            ],
        ]);
        ?>
    </div>
    <div class="col-lg-8 col-md-8">
        <label>ลูกค้า</label>
        <?php
        $listCustomer = ArrayHelper::map($customer, 'id', 'address');
        echo Select2::widget([
            'name' => 'promise',
            'id' => 'promise',
            'value' => '',
            'data' => $listCustomer,
            'options' => [
                'multiple' => false,
                'placeholder' => 'Select Customer ...',
                'onchange' => 'getData()',
            ],
        ]);
        ?>
    </div>
</div>

<div class="row" style=" margin-bottom: 20px;">
    <div class="col-lg-4 col-md-4">
        <label>ประจำเดือน</label>
        <select id="month" class="form-control" onchange="getData()">
            <option value="01" <?php echo ($m == '01') ? "selected" : ""; ?>>มกราคม</option>
            <option value="02" <?php echo ($m == '02') ? "selected" : ""; ?>>กุมภาพันธ์</option>
            <option value="03" <?php echo ($m == '03') ? "selected" : ""; ?>>มีนาคม</option>
            <option value="04" <?php echo ($m == '04') ? "selected" : ""; ?>>เมษายน</option>
            <option value="05" <?php echo ($m == '05') ? "selected" : ""; ?>>พฤษภาคม</option>
            <option value="06" <?php echo ($m == '06') ? "selected" : ""; ?>>มิถุนายน</option>
            <option value="07" <?php echo ($m == '07') ? "selected" : ""; ?>>กรกฏาคม</option>
            <option value="08" <?php echo ($m == '08') ? "selected" : ""; ?>>สิงหาคม</option>
            <option value="09" <?php echo ($m == '09') ? "selected" : ""; ?>>กันยายน</option>
            <option value="10" <?php echo ($m == '10') ? "selected" : ""; ?>>ตุลาคม</option>
            <option value="11" <?php echo ($m == '11') ? "selected" : ""; ?>>พฤศจิกายน</option>
            <option value="12" <?php echo ($m == '12') ? "selected" : ""; ?>>ธันวาคม</option>
        </select>
    </div>
    <div class="col-lg-4 col-md-4">
        <label>พ.ศ.</label>
        <select id="year" class="form-control" onchange="getData()">
            <option value="<?php echo $yearNow ?>" <?php echo ($year == $yearNow) ? "selected" : ""; ?>><?php echo ($yearNow + 543) ?></option>
            <option value="<?php echo ($yearNow - 1) ?>" <?php echo ($year == ($yearNow - 1)) ? "selected" : ""; ?>><?php echo (($yearNow + 543) - 1) ?></option>
        </select>
    </div>
    <div class="col-lg-2 col-md-2">
        <button type="button" class="btn btn-success btn-block" style=" margin-top: 25px;" onclick="getData()">ใบส่งมอบงาน</button>
    </div>
</div>


<div class="row" style=" margin-bottom: 0px;">
    <div class="col-md-3 col-lg-3">
        <div id="round"></div>
    </div>
    <div class="col-md-9 col-lg-9 col-sm-12">
        <div id="paper"></div>
    </div>
</div>

<?php
$this->registerJs('setBox()');
?>
<script type="text/javascript">
    function setBox() {
        var h = window.innerHeight;
        $("#round").css({"height": h - 260});
        $("#paper").css({"height": h - 260});
        //$("#createbill").css({"height": h - 200, "overflow-x": "hidden"});
    }
    function getRound() {
        var groupid = $("#groupcustomer").val();
        //var customerid = $("#customer").val();
        var month = $("#month").val();
        var year = $("#year").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/confirmorderonmonth']) ?>" + "&groupid=" + groupid + "&year=" + year + "&month=" + month;
        window.location = url;
    }

    function getform(id) {
        $("#paper").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>Loading...');
        var groupid = $("#groupcustomer").val();
        var promise = $("#promise").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createformsendwork']) ?>";
        var data = {
            id: id,
            promiseid: promise,
            groupcustomer: groupid
        };
        $.post(url, data, function(datas) {
            $("#paper").html(datas);
        });
    }

    function getformsubpromise(datekeep) {
        $("#paper").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>Loading...');
        //var groupid = $("#groupcustomer").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createformsendworksubpromise']) ?>";
        var promise = $("#promise").val();
        var data = {
            promiseid: promise,
            datekeep: datekeep
        };
        $.post(url, data, function(datas) {
            $("#paper").html(datas);
        });
    }

    function getData() {
        //var groupid = $("#groupcustomer").val();
        var promise = $("#promise").val();
        var month = $("#month").val();
        var year = $("#year").val();
        var data = {
            //groupid: groupid,
            promise: promise,
            year: year,
            month: month
        };
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getroudinmonth']) ?>";
        if (promise == "") {
            $("#round").html("<br/><br/><center>เลือกเงื่อนไขไม่ครบ ...</center>");
            return false;
        }

        $("#round").html("<br/><br/><center>กำลังประมวลผล ...</center>");

        $.post(url, data, function(res) {
            $("#round").html(res);
        });
    }
</script>


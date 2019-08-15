<?php

$this->title = $customer['company'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="service-default-formsaveround">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h4>บันทึรายการเก็บขยะ (ลูกค้า <?php echo $customer['company'] ?>)</h4>
            <h4>เลขที่สัญญา (<?php echo $promise['promisenumber'] ?>) รอบที่ <?php echo $round ?></h4>
            <h4>ปริมาณขยะต่อรอบ (<?php echo ($promise['recivetype'] == 1) ? $promise['garbageweight'] : "-"?>)</h4>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
        <label>ปริมาณขยะ / กก.</label>
        <input type="text" id="amount" class="form-control input-lg" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..." />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
        <label>ปริมาณขยะเกิน / กก.</label>
        <input type="text" id="garbageover" class="form-control input-lg" onkeypress="return bannedKey()" placeholder="กรอกเฉพาะตัวเลข..."/>
        </div>
    </div>

    <br/>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <button class="btn btn-success btn-flat btn-block btn-lg" type="button" onclick="Save()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    function Save(){
        var amount = $("#amount").val();
        var garbageover = $("#garbageover").val();
        var id = "<?php echo $id ?>";
        var promiseid = "<?php echo $promise['id'] ?>";
        if(amount == ""){
            $("#amount").focus();
            return false;
        }
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/save']) ?>";
        var data = {
            amount: amount,
            garbageover: garbageover,
            id: id,
            promiseid: promiseid
            };
        $.post(url,data,function(datas){
            window.location="<?php echo Yii::$app->urlManager->createUrl(['service']) ?>";
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
</script>

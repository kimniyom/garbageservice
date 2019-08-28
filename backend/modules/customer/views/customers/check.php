<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตรวจสอบการลงทะเบียน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-index">
    <div class="row">
        <div class="col-md-4 col-md-4">
            เลขที่ใบอนุญาติ<br/>
            <input type="search" required="required" class="form-control" id="taxnumber" placeholder="กรอกข้อมูล..." maxlength="13" onkeypress="return bannedKey()">
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-4 col-md-4">
            <button type="button" class="btn btn-primary" onclick="check()">
                <i class="fa fa-search"></i> ค้นหา
            </button>
        </div>
    </div>                 
        <label id="loading"></label>
        <div class="row" id="next" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px;"><i class="fa fa-check text-success"></i> ยังไม่มีการลงทะเบียนด้วยเลขนี้</p>
                <button type="button" class="btn btn-success" style="font-size: 20px;" onclick="regiscustomer()">ขั้นตอนต่อไป <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="row" id="nextfalse" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px; color:red;"><i class="fa fa-info text-danger"></i> ... มีการลงทะเบียนแล้วไม่สามารถลงทะเบียนซ้ำได้ กรณีที่ท่านลืมรหัสเข้าใช้งานกรุณาติดต่อสอบถามกับทางบริษัทโดยตรง</p>
            </div>
        </div>
</div>

<script type="text/javascript">
   
    function check(){
        $("#next").hide();
        $("#nextfalse").hide();
        var taxnumber = $("#taxnumber").val();
        if(taxnumber == ""){
            alert("กรอกข้อมูลไม่ครบ..!");
            return false;
        }
        var description = "ข้อมูลไม่ตรงกับที่ระบบต้องการกรุณาตรวจสอบ ..!";
        if(taxnumber.length != 13){
            alert(description);
            return false;
        } else {
            var spinner = '<i class="fa fa-spinner fa-spin fa-2x"></i>';
            $("#loading").html(spinner + " กำลังตรวจสอบข้อมูลกรุณารอสักครู่...");
            var data = {taxnumber: taxnumber};
            var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customers/checking']) ?>";
            $.post(url,data,function(datas){
                if(datas == 0){
                    $("#loading").html("");
                    $("#next").show();
                    $("#nextfalse").hide();
                } else {
                    $("#nextfalse").show();
                    $("#next").hide();
                }
            })
        }
    }

    function regiscustomer(){
        var type = $("#type").val();
        var taxnumber = $("#taxnumber").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customers/create']) ?>" + "&taxnumber=" + taxnumber;
        window.location=url;
        //alert(url);
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


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
        <div class="col-md-12 col-md-12">
                        เลือกประเภท<br/>
        <div class="btn-group">
            <button type="button" class="btn btn-default" id="typetext">== เลือกประเภท ==</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only" >Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php foreach ($type as $rs): ?>
                    <li><a href="#" onclick="changetype('<?php echo $rs['id'] ?>','<?php echo $rs['codenumber'] ?>','<?php echo $rs['description'] ?>','<?php echo $rs['typename'] ?>')"><?php echo $rs['typename'] ?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-4">
            รหัส<br/>
            <input type="search" required="required" class="form-control" id="taxnumber" placeholder="กรอกข้อมูล...">
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
        <input type="hidden" id="codenumber"/>
        <input type="hidden" id="type"/>
        <input type="hidden" id="typename"/>
        <div class="row" id="next" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px;"><i class="fa fa-check text-success"></i> ยังไม่มีการลงทะเบียนด้วยรหัสนี้</p>
                <button type="button" class="btn btn-success" style="font-size: 20px;" onclick="regiscustomer()">ขั้นตอนต่อไป <i class="fa fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="row" id="nextfalse" style="display: none;">
            <div class="col col-md-4 col-lg-4">
                <p style="font-size: 18px; color:red;"><i class="fa fa-info text-danger"></i> ... มีการลงทะเบียนด้วยรหัสนี้แล้วไม่สามารถลงทะเบียนซ้ำได้ กรณีที่ท่านลืมรหัสเข้าใช้งานกรุณาติดต่อสอบถามกับทางบริษัทโดยตรง</p>
            </div>
        </div>
</div>

<script type="text/javascript">
    function changetype(type,codenumber,description,typename){
        $("#typetext").text(typename);
        $("#next").hide();
        $("#nextfalse").hide();
        $("#taxnumber").val("");
        $("#type").val(type);
        $("#typename").val(typename);
        $("#taxnumber").attr("placeholder", description + "...");
        $("#taxnumber").attr('maxlength',codenumber);
        $("#description").text(description);
        $("#codenumber").val(codenumber);
    }

    function check(){
        $("#next").hide();
        $("#nextfalse").hide();
        var codenumber = parseInt($("#codenumber").val());
        var taxnumber = $("#taxnumber").val();
        if(codenumber == "" || taxnumber == ""){
            alert("กรอกข้อมูลไม่ครบ..!");
            return false;
        }
        var description = "ข้อมูลไม่ตรงกับที่ระบบต้องการกรุณาตรวจสอบ ..!";
        if(taxnumber.length != codenumber){
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
        var typename = $("#typename").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customers/create']) ?>" + "&type=" + type + "&taxnumber=" + taxnumber + "&typename=" + typename;
        window.location=url;
        //alert(url);
    }
</script>


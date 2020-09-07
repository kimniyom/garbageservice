<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = 'เลือกสัญญาก่อนลงวันที่จัดเก็บ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-index">
    <div class="row">
        <div class="col-md-12 col-md-6">
            <?php
                echo Select2::widget([
                    'name' => 'state_10',
                    'data' => ArrayHelper::map($promise, "id", "promisenumber"),
                    'options' => [
                        'placeholder' => 'เลือกสัญญา',
                    ],
                    'pluginEvents' => [
                        "select2:select" => "function(){setpromiseid(this.value)}",
                    ],
                ]);
            ?>
        </div>
    </div>
   
    <br/>
    <div class="row">
        <div class="col-md-4 col-md-4">
            <button type="button" class="btn btn-primary" onclick="createdatekeep()">
                <i class="fa fa-arrow-right"></i> ถัดไป
            </button>
        </div>
    </div>
    <label id="loading"></label>
    <input type="hidden" id="promiseid"/>
    <div class="row" id="next" style="display: none;">
        <div class="col col-md-4 col-lg-4">
            <p style="font-size: 18px;"><i class="fa fa-check text-success"></i> ลูกค้าท่านนี้สามารถทำสัญญาได้</p>
            <button type="button" class="btn btn-success" style="font-size: 20px;" onclick="createconfirmform()">ขั้นตอนต่อไป <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>

    <div class="row" id="nextfalse" style="display: none;">
        <div class="col col-md-4 col-lg-4">
            <p style="font-size: 18px; color:red;"><i class="fa fa-info text-danger"></i> ... ลูกค้าท่านนี้ยังไม่ได้รับการยืนยันจากบริษัท ไม่สามารถทำแบบยืนยันลูกค้าได้</p>
        </div>
    </div>
        
</div>

<script type="text/javascript">
    function setpromiseid(id){
        $("#promiseid").val(id);
        $("#next").hide();
        $("#nextfalse").hide();
    }

    function createdatekeep(){
        var promiseid = parseInt($("#promiseid").val());
        console.log(promiseid);
        if(!promiseid){
            alert("ยังไม่ได้เลือกสัญญา..!");
            return false;
        }
        var promiseid = parseInt($("#promiseid").val());
        var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/index']) ?>" + "&promiseid=" + promiseid ;
        window.location=url;
        //alert(url);
    }
</script>


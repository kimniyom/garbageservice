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
    <h3><?=Html::encode($this->title)?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <div class="row" style="margin-top: 30px;">
        <div class="col-lg-12 col-12 order-lg-2 order-3 text-lg-left text-right">
            <div class="header_searchs">
                <div class="header_search_content">
                    <div class="header_search_form_container">
                        <div class="header_search_form clearfix">
                            <input type="search" required="required" class="header_search_input" id="taxnumber" placeholder="กรอกข้อมูล...">
                                <div class="custom_dropdown">
                                    <div class="custom_dropdown_list">
                                        <span class="custom_dropdown_placeholder clc">เลือกประเภท</span>
                                            <i class="fas fa-chevron-down"></i>
                                            <ul class="custom_list clc">
                                                <?php foreach ($type as $rs): ?>
                                                    <li><a href="javascript:0" class="clc" onclick="changetype('<?php echo $rs['codenumber'] ?>','<?php echo $rs['description'] ?>')"><?php echo $rs['typename'] ?></a></li>
                                                <?php endforeach;?>
                                            </ul>
                                    </div>
                                </div>
                            <button type="button" class="header_search_button trans_300" onclick="check()">
                                <img src="<?php echo Url::to('@web/web/theme/images/search.png') ?>" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<label id="loading"></label>
<input type="hidden" id="codenumber"/>


<script type="text/javascript">
    function changetype(codenumber,description){
        $("#taxnumber").val("");
        $("#taxnumber").attr("placeholder", description + "...");
        $("#description").text(description);
        $("#codenumber").val(codenumber);
    }

    function check(){
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
            $("#loading").text("กำลังตรวจสอบข้อมูลกรุณารอสักครู่...");
            alert("Success...");
        }
    }
</script>


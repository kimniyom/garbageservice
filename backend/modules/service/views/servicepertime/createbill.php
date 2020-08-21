<style type="text/css">
    .row{
        margin-bottom: 10px;
    }

    #text-list{
        background: #ffffff;
    }
</style>
<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

$this->title = "ใบวางบิล / ใบแจ้งยอด รายครั้ง";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <label>เลือกลูกค้า</label>
                <?php
                $listCustomer = ArrayHelper::map($customer, 'id', 'address');
                echo Select2::widget([
                    'name' => 'customer',
                    'value' => $customerneedid,
                    'data' => $listCustomer,
                    'options' => [
                        'multiple' => false,
                        'placeholder' => 'Select Customer ...',
                        'onchange' => 'getTime(this.value)',
                    ],
                ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
               <?php echo $roundpertime;?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div id="round"><?php //echo $round ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <label>วันที่ออกใบแจ้งหนี้</label>
                <?php
                echo DatePicker::widget([
                    'name' => 'dateinvoice',
                    'value' => date('Y-m-d'),
                    'language' => 'th',
                    'id' => 'dateinvoice',
                    'options' => ['placeholder' => 'วันที่ออกใบแจ้งหนี้ ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
                ?>
            </div>
            <div class="col-md-6 col-lg-6">
                <label>วันที่ออกใบเสร็จ</label>
                <?php
                echo DatePicker::widget([
                    'name' => 'datebill',
                    'value' => date('Y-m-d'),
                    'language' => 'th',
                    'id' => 'datebill',
                    'options' => ['placeholder' => 'วันที่ออกใบเสร็จ ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">

                <div id="createbill">
                        
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if($invoice){
    $this->registerJs("popupFormbill({$confirmid})");
}
?>
<script type="text/javascript">
    function getTime(customer) {
        //var url = "<?php //echo Yii::$app->urlManager->createUrl(['service/default/getroundpromise'])   ?>" + "&type=1&customer=" + customer;
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/servicepertime/createbill']) ?>" + "&customerneedid=" + customer;
        window.location = url;
        /*
         var data = {customer_id: customer};
         $.post(url,data,function(datas){
         $("#round").html(datas);
         });
         */
    }

    function popupFormbill(confirmid) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/servicepertime/createbillpopup']) ?>";
        var money = $("#money").val();
        var invoice = "<?php echo $invoice['id'];?>";
        if(money || invoice != "")
        {
            var data = {
                confirmid:confirmid,
                money: money
            };
            $.post(url, data, function(datas) {
                $("#createbill").html(datas);
            });
        }
        else{
            alert("กรุณากรอกจำนวนเงินก่อน");
            $("#money").focus();
        } 
    }
</script>

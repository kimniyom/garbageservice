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
</style>
<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

$this->title = "ใบวางบิล / ใบแจ้งยอด";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style=" margin-bottom: 0px;">
    <div class="col-lg-4 col-md-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <label>เลือกลูกค้า</label>
                <?php
                $listCustomer = ArrayHelper::map($customer, 'id', 'address');
                echo Select2::widget([
                    'name' => 'customer',
                    'value' => $customerId,
                    'data' => $listCustomer,
                    'options' => [
                        'multiple' => false,
                        'placeholder' => 'Select Customer ...',
                        'onchange' => 'getRound(this.value)',
                    ],
                ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div id="round"><?php echo $round ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <label>
                    วันที่ออกใบแจ้งหนี้
                    
                </label>
                <input type="checkbox" name="checkdateInvoice" id="checkdateInvoice" onclick="setDate()"/> เอาวันที่ใบแจ้งหนี้
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
                <label>วันที่ออกใบเสร็จ
                    <input type="checkbox" name="checkdateBill" id="checkdateBill" onclick="setDate()"/> เอาวันที่ใบเสร็จ
                </label>
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
                    <span style="text-align: center; width: 100%; margin-top: 100px; padding-top: 100px;"><i class="fa fa-arrow-left"></i> เลือกรอบเดือนที่ต้องการออกหรือพิมพ์ ใบวางบิล ใบเสร็จ</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs('setBox()');
?>
<script type="text/javascript">
    function setBox() {
        var h = window.innerHeight;
        $("#round").css({"height": h - 200});
        //$("#createbill").css({"height": h - 200, "overflow-x": "hidden"});
    }
    function getRound(customer) {
        //var url = "<?php //echo Yii::$app->urlManager->createUrl(['service/default/getroundpromise'])                                 ?>" + "&type=1&customer=" + customer;
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createbill']) ?>" + "&type=1&customerId=" + customer;
        window.location = url;
        /*
         var data = {customer_id: customer};
         $.post(url,data,function(datas){
         $("#round").html(datas);
         });
         */
    }

    function popupFormbill(promiseid, months, round, id, type, vat, vattype, typepromise) {
        $("#createbill").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>Loading...');
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createbillpopup']) ?>";
        var data = {
            id: id,
            promiseid: promiseid,
            dateround: months,
            round: round,
            type: type,
            vat: vat,
            vattype: vattype,
            typepromise: typepromise
        };
        $.post(url, data, function(datas) {
            $("#createbill").html(datas);
        });
    }
    
    function setDate(){
        var invoice = $('#checkdateInvoice').is(':checked'); ;
        var bill = $('#checkdateBill').is(':checked');
        
        if(invoice == true){
            $(".divInvoice").show();
        } else {
            $(".divInvoice").hide();
        }
        
        if(bill == true){
            $(".divBill").show();
        } else {
            $(".divBill").hide();
        }
    }
</script>

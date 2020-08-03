<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
    #round{
        overflow: auto;
    }
</style>
<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

$this->title = "ใบวางบิล / ใบแจ้งยอด เหมาจ่ายครึ่งปี(6 เดือน)";
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="row" style=" margin-bottom: 0px;">
    <div class="col-lg-4 col-md-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <label>เลือกลูกค้า</label>
                <?php
                $listCustomer = ArrayHelper::map($customer, 'customerid', 'address');
                echo Select2::widget([
                    'name' => 'promise',
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
                <div id="createbill"></div>
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
    function getRound(customerId) {
        /*
         var url = "<?php //echo Yii::$app->urlManager->createUrl(['service/default/getroundpromisesixmonth'])                        ?>";
         var data = {promiseid: promise};
         $.post(url, data, function(datas) {
         $("#round").html(datas);
         });
         */
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createinvoicesixmonth']) ?>" + "&customerId=" + customerId;
        window.location = url;
    }

    function popupFormbill(promiseid, vat, typepromise, start, end) {
        $("#createbill").html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>Loading...');
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createbillsixmonth']) ?>";
        var data = {
            promiseid: promiseid,
            vat: vat,
            typepromise: typepromise,
            start: start,
            end: end
        };
        $.post(url, data, function(datas) {
            $("#createbill").html(datas);
        });
    }
</script>
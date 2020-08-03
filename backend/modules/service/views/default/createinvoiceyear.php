<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>
<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

$this->title = "ใบวางบิล / ใบแจ้งยอด(เหมาจ่ายทั้งปี)";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
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
<script type="text/javascript">
    function getRound(customerid) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createinvoiceyear']) ?>" + "&customerId=" + customerid;
        window.location=url;
//var data = {promiseid: promise};
        //$.post(url, data, function(datas) {
            //$("#round").html(datas);
        //});
    }

    function popupFormbill(promiseid) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/createbillpopupyear']) ?>";
        var data = {
            promiseid: promiseid
        };
        $.post(url, data, function(datas) {
            $("#createbill").html(datas);
        });
    }
</script>
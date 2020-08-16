<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = "บันทึกการจัดเก็บ";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="service-default-index">
    <div style=" border-radius: 10px; width: 300px; height: auto; border: solid 2px #002a80; padding: 10px; margin-bottom: 10px; background: #ffffff;">
        <i class="fa fa-info-circle"></i> รายชื่อลูกค้าจะแสดงในกล่องตัวเลือกก็ต่อเมื่อมีการทำสัญญาหรือข้อตกลงผ่านระบบแล้วเท่านั้นและสัญญาหรือข้อตกลงต้องมีการยืนยันสถานะที่พร้อมใช้งาน
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <!--
        <label>เลือกเลขที่สัญญา</label>
            <?php
            /*
              $listPromise = ArrayHelper::map($promise, 'id', 'promisenumber');
              echo Select2::widget([
              'name' => 'promise',
              'value' => '',
              'data' => $listPromise,
              'options' => [
              'multiple' => false,
              'placeholder' => 'Select Promise ...',
              'onchange' => 'getRound(this.value)',
              ],
              ]);
             */
            ?>
            -->

            <label style=" font-size: 20px;">เลือกลูกค้า</label>
            <?php
            $listCustomer = ArrayHelper::map($customer, 'id', 'company');
            echo Select2::widget([
                'name' => 'customer',
                'value' => '',
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
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div id="round"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getRound(id) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getround']) ?>";
        var data = {customer_id: id};
        $.post(url, data, function(datas) {
            $("#round").html(datas);
        });
    }
</script>

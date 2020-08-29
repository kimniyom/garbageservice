<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>
<?php

use app\models\Config;

//use kartik\select2\Select2;
//use yii\helpers\ArrayHelper;
//use kartik\date\DatePicker;
//use kartik\widgets\TimePicker;
//use kartik\datetime\DateTimePicker;
//use backend\model\Bookbank;

$this->title = "ข้อมูลการชำระเงิน";
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$Config = new Config();
?>
<h4 style=" font-family: Th; font-size: 24px; font-weight: bold;"><?php echo $this->title ?></h4>
<hr/>
<?php foreach ($history as $rs): ?>
    <div class="card" style=" margin-bottom: 10px;">
        <div class="card-body" style=" font-family: Th; font-size: 22px;">
            <ul>
                <li style=" font-family: Th; font-weight: bold; color: #0099ff;">#OrderId<em>(<?php echo $rs['invoicenumber'] ?>)</em></li>
                <li>ชำระเงินค่าบริการกำจัดขยะติดเชื้อ <?php echo number_format($rs['total'], 2) ?> .- </li>
                <li><?php echo $rs['bankname'] ?> (<?php echo $Config->thaidate($rs['dateservice']) ?> <?php echo $rs['timeservice'] ?>)</li>
                <li>สถานะ: <?php echo($rs['status'] == 1) ? "<span class='text-success'>เสร็จสมบูรณ์ <i class='fa fa-check'></i></span>" : "<span class='text-danger'>รอตรวจสอบ <i class='fa fa-info'></i></span>"; ?></li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>



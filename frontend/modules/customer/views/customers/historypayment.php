<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>
<?php

use app\models\Config;
use yii\helpers\Url;

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
<?php if ($history) { ?>
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
<?php } else { ?>
    <label class="alert alert-danger" style=" width: 100%;">ไม่มีรายการ</label>
<?php } ?>

<br/>
<h4 id="font-th" style=" font-size:28px;">ช่องทางการชำระเงิน</h4>
<div class="row">
<?php foreach ($bank as $rs): ?>
        <div class="col-md-6 col-lg-6" style=" margin-bottom: 20px;">
            <div class="card">
                <div class="card-body" id="font-th"  style=" font-size:20px; font-weight: bold;">
                    <div style=" float: left; text-align: center;">
                        <img src="<?php echo Url::to('../images/' . $rs['bank_img']) ?>"/>
                    </div>
                    <div style=" float: left; margin-left: 20px;">
                        ธนาคาร : <?php echo $rs['bankname'] ?><br/>
                        ชื่อบัญชี : <?php echo $rs['bookbankname'] ?><br/>
                        เลขที่บัญชี : <?php echo $rs['bookbanknumber'] ?><br/>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach; ?>
</div>




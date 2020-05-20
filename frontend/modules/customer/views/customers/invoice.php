<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customers */

$this->title = 'รายการที่ต้องชำระเงิน';
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-invoice">
    <h3  id="font-th" style=" font-size:30px;"><?= Html::encode($this->title) ?></h3>
    <hr/>
    <div class="list-group">
        <?php foreach ($invoicelist as $rs): ?>
        <?php if($rs['status'] == "0"){ ?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/payment', 'id' => $rs['id']]) ?>" class="list-group-item">
                Invoice #(<?php echo $rs['invoicenumber'] ?>) <?php echo ($rs['typeinvoice'] == 0) ? "ค่ากำจัดขยะติดเชื้อ" : "ค่าเรียกเก็บขยะส่วนเกิน"; ?> จำนวน (<?php echo number_format($rs['total'], 2) ?> .-)
            </a>
        <?php } else if($rs['status'] == "2") { ?>
            <em class='text-warning'>(อยู่ระหว่างการตรวจสอบ)Invoice #(<?php echo $rs['invoicenumber'] ?>) <?php echo ($rs['typeinvoice'] == 0) ? "ค่ากำจัดขยะติดเชื้อ" : "ค่าเรียกเก็บขยะส่วนเกิน"; ?> จำนวน (<?php echo number_format($rs['total'], 2) ?> .-)</em>
           
        <?php } ?>
        <?php endforeach; ?>
    </div>
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
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customers */

$this->title = 'รายการที่ต้องชำระเงิน';
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-invoice">
    <h3><?= Html::encode($this->title) ?></h3>
    <hr/>
    <div class="list-group">
        <?php foreach ($invoicelist as $rs): ?>
            <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/payment', 'id' => $rs['id']]) ?>" class="list-group-item">
                Invoice #(<?php echo $rs['invoicenumber'] ?>) <?php echo ($rs['typeinvoice'] == 0) ? "ค่ากำจัดขยะติดเชื้อ" : "ค่าเรียกเก็บขยะส่วนเกิน"; ?> จำนวน (<?php echo number_format($rs['total'], 2) ?> .-)
            </a>
        <?php endforeach; ?>
    </div>
</div>

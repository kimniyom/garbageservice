<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Invoice */

$this->title = "แจ้งชำระเงิน";
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'รายการที่ต้องชำระ', 'url' => ['invoice']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-update">

    <h4>
        แจ้งชำระค่าบริการ Invoice #<?php echo $model->invoicenumber ?><br/>
        <?php echo ($model->typeinvoice == 0) ? "ค่าบริการกำจัดขยะติดเชื้อ" : "ค่าบริการขยะเกิน"; ?>
    </h4>
    <?=
    $this->render('_form', [
        'model' => $model,
        'bank' => $bank
    ])
    ?>

</div>

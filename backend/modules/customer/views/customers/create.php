<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = 'เพิ่มลูกค้า';
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้าทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">
    <?= $this->render('_form', [
        'model' => $model,
        'taxnumber' => $taxnumber,
        'location'=> $location,
        'img'=> $img,
    ]) ?>
</div>

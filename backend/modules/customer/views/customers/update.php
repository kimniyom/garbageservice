<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = 'แก้ไข: ' . $model->company;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้าทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'views', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

    <?= $this->render('_form_update', [
        'model' => $model,
        'location' => $location,
    ]) ?>

</div>

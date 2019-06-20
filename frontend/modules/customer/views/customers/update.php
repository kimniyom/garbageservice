<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customers */

$this->title = 'แก้ไข: ' . $model->company;
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company, 'url' => ['view', 'userid' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customers-update">

    <h3><?=Html::encode($this->title)?></h3>
    <p style="color:red">* ต้องไม่เป็นค่าว่าง</p>
    <hr/>

    <?=$this->render('_form_update', [
	'model' => $model,
])?>

</div>

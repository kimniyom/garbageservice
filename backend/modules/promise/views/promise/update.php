<?php

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = 'แก้ไขสัญญาเลขที่ ' . $model->promisenumber;
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->promisenumber, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promise-update">



    <?=$this->render('_form', [
	'model' => $model,
	'customer' => $customer,
])?>

</div>

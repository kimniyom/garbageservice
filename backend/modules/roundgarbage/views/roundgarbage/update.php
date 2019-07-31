<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\Roundgarbage */

$this->title = 'แก้ไขรอบเก็บขยะ: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roundgarbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roundgarbage-update">

    <h1><?=Html::encode($this->title)?></h1>

    <?=$this->render('_form', [
	'model' => $model,
])?>

</div>

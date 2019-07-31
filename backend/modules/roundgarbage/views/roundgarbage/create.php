<?php

/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\Roundgarbage */

$this->title = 'เพิ่มรอบเก็บขยะ';
$this->params['breadcrumbs'][] = ['label' => 'Roundgarbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roundgarbage-create">

    <?=$this->render('_form', [
	'model' => $model,
])?>

</div>

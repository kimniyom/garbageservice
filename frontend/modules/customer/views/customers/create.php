<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customers */

$this->title = 'ลงทะเบียน';
//$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-create">

    <h3><?=Html::encode($this->title)?> (<?php echo $typename ?>)</h3>
    <p>* ต้องไม่เป็นค่าว่าง</p>
    <hr/>
    <?=$this->render('_form', [
	'model' => $model,
	'taxnumber' => $taxnumber,
	'type' => $type,
])?>

</div>

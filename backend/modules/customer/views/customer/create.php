<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = 'เพิ่มลูกค้า';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <h1><i class="fa fa-users"></i> <?= Html::encode($this->title) ?></h1>
<hr/>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

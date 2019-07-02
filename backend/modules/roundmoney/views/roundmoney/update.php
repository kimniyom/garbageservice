<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\roundmoney\models\Roundmoney */

$this->title = 'แก้ไขรอบการเก็บเงิน: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roundmoneys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roundmoney-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

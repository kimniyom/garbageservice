<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\car\models\Car */

$this->title = 'แก้ไข Car: ' . $model->carnumber;
$this->params['breadcrumbs'][] = ['label' => 'ทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->carnumber, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = 'Update Promise: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Promises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'customerid' => $model->customerid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promise-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

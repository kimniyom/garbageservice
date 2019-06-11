<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = 'Update Promise: ' . $model->promisid;
$this->params['breadcrumbs'][] = ['label' => 'Promises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->promisid, 'url' => ['view', 'id' => $model->promisid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promise-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

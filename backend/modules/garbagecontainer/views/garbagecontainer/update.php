<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\garbagecontainer\models\Garbagecontainer */

$this->title = 'Update Garbagecontainer: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Garbagecontainers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="garbagecontainer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

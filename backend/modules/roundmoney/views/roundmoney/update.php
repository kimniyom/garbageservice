<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\roundmoney\models\Roundmoney */

$this->title = 'Update Roundmoney: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roundmoneys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roundmoney-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\garbagecontainer\models\Garbagecontainer */

$this->title = 'แก้ไขสินค้าแนะนำ: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'สินค้าแนะนำ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="garbagecontainer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelImg'=> $modelImg,
        'oldImage'=> $oldImage,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\garbagecontainer\models\Garbagecontainer */

$this->title = 'เพิ่มสินค้าแนะนำ';
$this->params['breadcrumbs'][] = ['label' => 'สินค้าแนะนำ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="garbagecontainer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelImg'=> $modelImg,
    ]) ?>

</div>

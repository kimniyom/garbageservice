<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\car\models\Car */

$this->title = 'เพิ่มรถจัดเก็บขยะ';
$this->params['breadcrumbs'][] = ['label' => 'ทั้งหมด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

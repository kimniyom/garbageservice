<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\navbar\models\Navbar */

$this->title = 'แก้ไข: ' . $model->navbar;
$this->params['breadcrumbs'][] = ['label' => 'เมนู', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'view', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="navbar-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

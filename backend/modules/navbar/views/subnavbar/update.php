<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\navbar\models\Navbar */

$this->title = 'Update Navbar: ' . $model->subnavbar;
$this->params['breadcrumbs'][] = ['label' => 'Navbars', 'url' => ['navbar/index']];
$this->params['breadcrumbs'][] = ['label' => $model->subnavbar, 'url' => ['navbar/viewsubmenu', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="navbar-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

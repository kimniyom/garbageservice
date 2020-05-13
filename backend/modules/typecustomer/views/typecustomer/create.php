<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Typecustomer */

$this->title = 'Create Typecustomer';
$this->params['breadcrumbs'][] = ['label' => 'Typecustomers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typecustomer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

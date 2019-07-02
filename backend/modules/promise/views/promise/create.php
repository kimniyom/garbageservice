<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = $customer->company;
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promise-create">

    <?= $this->render('_form', [
        'model' => $model,
        'customer' => $customer,
    ]) ?>

</div>

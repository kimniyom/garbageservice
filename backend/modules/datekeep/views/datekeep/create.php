<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Datekeep */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Datekeeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datekeep-create">

    

    <?= $this->render('_form', [
        'model' => $data['model'],
    ]) ?>

</div>

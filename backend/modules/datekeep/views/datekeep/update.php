<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $data['model'] app\models\Datekeep */

$this->title = 'แก้ไขวันเข้าจัดเก็บ: ' . $data['model']->promiseid;
$this->params['breadcrumbs'][] = ['label' => 'Datekeeps', 'url' => ['index', 'promiseid'=> $data['model']->promiseid]];
$this->params['breadcrumbs'][] = ['label' => $data['model']->promiseid, 'url' => ['view', 'promiseid' => $data['model']->promiseid, 'datekeep' => $data['model']->datekeep]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="datekeep-update">

   

    <?= $this->render('_form', [
        'model' => $data['model'],
    ]) ?>

</div>

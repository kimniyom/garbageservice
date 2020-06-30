<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Confirmform */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Confirmforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="confirmform-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'confirmformnumber',
            'customerid',
            'typeform',
            'roundkeep_sunday',
            'roundkeep_monday',
            'roundkeep_tueday',
            'roundkeep_wednesday',
            'roundkeep_thursday',
            'roundkeep_friday',
            'roundkeep_saturday',
            'roundkeep_day',
            'timeperiod_morning:datetime',
            'timeperiod_affternoon:datetime',
            'timeperiod_time',
            'billdoc_originalinvoice',
            'billdoc_copyofinvoice',
            'billdoc_originalreceipt',
            'billdoc_copyofreceipt',
            'billdoc_copyofbank',
            'billdoc_etc',
            'billdoc_etctext:ntext',
            'cyclekeepmoney',
            'paymentschedule',
            'methodpeyment',
            'senddoc_finance',
            'senddoc_customer',
        ],
    ]) ?>

</div>

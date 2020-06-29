<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConfirmformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Confirmforms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confirmform-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Confirmform', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'confirmformnumber',
            'customerid',
            'typeform',
            'roundkeep_sunday',
            //'roundkeep_monday',
            //'roundkeep_tueday',
            //'roundkeep_wednesday',
            //'roundkeep_thursday',
            //'roundkeep_friday',
            //'roundkeep_saturday',
            //'roundkeep_day',
            //'timeperiod:datetime',
            //'timeperiod_time',
            //'billdoc_originalinvoice',
            //'billdoc_copyofinvoice',
            //'billdoc_originalreceipt',
            //'billdoc_copyofreceipt',
            //'billdoc_copyofbank',
            //'billdoc_etc',
            //'billdoc_etctext:ntext',
            //'cyclekeepmoney',
            //'paymentschedule',
            //'methodpeyment',
            //'sendtype',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

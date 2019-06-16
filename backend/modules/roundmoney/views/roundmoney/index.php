<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\roundmoney\models\RoundmoneySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roundmoneys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roundmoney-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Roundmoney', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'customerid',
            'promiseid',
            'datekeep',
            'round',
            //'amount',
           'keepby',
            //'status',
            'receiptnumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

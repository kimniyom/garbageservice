<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerneedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customerneeds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerneed-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customerneed', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'customername',
            'customrttype',
            'address',
            //'tel',
            //'contact',
            //'dayopen',
            //'location',
            //'roundofweek',
            //'roundofmount',
            //'priceofmount',
            //'priceofyear',
            //'typebill',
            //'roundprice',
            //'detail:ntext',
            //'d_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

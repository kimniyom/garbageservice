<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\promise\models\PromiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promises';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promise-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Promise', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'place',
            'license',
            'promisedatebegin',
            'promisedateend',
            //'recivetype',
            //'rate',
            //'ratetext',
            //'levy',
            //'employer',
            //'payperyear',
            //'payperyeartext',
            //'homenumber',
            //'tambon',
            //'ampur',
            //'changwat',
            //'createat',
            //'contactname',
            //'contactphone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
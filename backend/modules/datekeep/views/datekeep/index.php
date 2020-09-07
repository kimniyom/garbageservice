<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Config;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DatekeepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$Config = new Config();
?>
<div class="datekeep-index">

    
    <p>
        <?= Html::a('เพิ่มวันเข้าจัดเก็บ', ['create','promiseid'=>$data['promiseid']], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $data['dataProvider'],
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'promiseid',
            //'datekeep',
            //'status',
            [
                'attribute' => 'datekeep',
                'headerOptions' => ['style' => 'word-wrap: break-word;'],
                'contentOptions' => [
                    'style' => 'word-wrap: break-word;'
                ],
                'format' => 'raw',
                'value' => function($model) {
                    return Config::thaidate($model['datekeep']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'template'=>'{update}{delete}'
            ],
        ],
    ]); ?>


</div>

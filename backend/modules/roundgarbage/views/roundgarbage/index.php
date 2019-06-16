<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\roundgarbage\models\RoundgarbageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roundgarbages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roundgarbage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Roundgarbage', ['create'], ['class' => 'btn btn-success']) ?>
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
            [ 
                'attribute' => 'status',
                'format'=>'html',
                'value'=>function($model, $key, $index, $column){
                  return $model->status==1 ? "จัดเก็บแล้ว":"ยังไม่ได้จัดเก็บ";
                }
            ],
            //'amount',
            //'keepby',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Bank;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BookbankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookbanks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookbank-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('เพิ่มบัญชีธนาคาร', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'bookbanknumber',
            'bookbankname',
            'branch',
            [
                'label' => 'ธนาคาร',
                'format' => 'html',
                'value' => function($model, $key, $index, $column){
                    return Bank::findOne(['id' => $model->bank])['bankname'];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\car\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รถจัดเก็บขยะติดเชื้อ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Car', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'carnumber',
            'detail:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>

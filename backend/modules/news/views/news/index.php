<?php

use yii\grid\GridView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a('Create News', ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		//'ID',
		'TITLE:ntext',
		//'CONTENT:ntext',
		'CREATEAT',
		//'UPDATEAT',
		//'CREATEBY',
		//'UPDATEBY',
		//'ISSHOW',
		//'CATEGORY',

		['class' => 'yii\grid\ActionColumn'],
	],
]);?>


</div>

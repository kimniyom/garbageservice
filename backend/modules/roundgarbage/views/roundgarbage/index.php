<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\roundgarbage\models\RoundgarbageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รอบเก็บขยะ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roundgarbage-index">

    <p>
        <?=Html::a('เพิ่มรอบเก็บขยะ', ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
	'dataProvider' => $dataProvider,
	//'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
			'label' => 'ชื่อบริษัท',
			'format' => 'html',
			'value' => function ($model, $key, $index, $column) {
				$customerid = Promise::find()->where(['id' => $model->promiseid])->one()['customerid'];
				return Customers::find()->where(['id' => $customerid])->one()['company'];
			},
		],
		//'promiseid',
		'round',
		'datekeep',
		[
			'attribute' => 'status',
			'format' => 'html',
			'value' => function ($model, $key, $index, $column) {
				return $model->status == 1 ? "จัดเก็บแล้ว" : "ยังไม่ได้จัดเก็บ";
			},
		],
		//'amount',
		//'keepby',
		//'status',

		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '{update} {delete}',
		],
		
	],
]);?>


</div>

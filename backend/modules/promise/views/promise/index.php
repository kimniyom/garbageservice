<?php

use app\models\Config;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use app\modules\customer\models\Customers;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\promise\models\PromiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สัญญา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promise-index">

    <p>
        <?=Html::a('ทำสัญญา', ['beforecreate'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
			'attribute' => 'promisenumber',
			'format' => 'text',
			'label' => 'เลขที่สัญญา',
		],
		[
			'attribute' => 'customerid',
			'format' => 'text',
			'label' => 'รหัสลูกค้า',
			'value' => function($model){
				$Customer = new Customers();
				return $Customer->findOne(['id' => $model->customerid])['company'];
			}
		],
		[
			'attribute' => 'promisedatebegin',
			'value' => function ($model) {
				$config = new Config();
				return $config->thaidate($model->promisedatebegin);
			},
			'label' => 'วันเริ่มสัญญา',
		],
		[
			'attribute' => 'promisedateend',
			'value' => function ($model) {
				$config = new Config();
				return $config->thaidate($model->promisedateend);
			},
			'label' => 'วันสิ้นสุดสัญญา',
		],
		[
			'attribute' => 'recivetype',
			'format' => 'text',
			'label' => 'ประเภทการจ้าง',
			'value' => function ($model) {
				return ($model->recivetype == "0") ? "รายปี" : "รายเดือน";
			},
		],

		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '{view}',
		],
	],

	'pjax' => true,
	'bordered' => true,
	'striped' => false,
	'condensed' => false,
	'responsive' => true,
	'hover' => true,
	'floatHeader' => true,
	'showPageSummary' => false,
	'panel' => [
		'type' => GridView::TYPE_DEFAULT,
	],
]);?>


</div>

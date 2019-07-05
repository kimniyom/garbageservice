<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <?=GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		'company',
		'taxnumber',
		'address',
		'manager',
		'tel',
		//'OFFICETEL',
		//'EMAIL:email',
		//'STATUS',
		//'APPROVE',
		//'CHANGWAT',
		//'AMPUR',
		//'TAMBON',
		//'ZIPCODE',
		//'CREATE_DATE',
		//'UPDATE_DATE',
		//'DATE_APPROVE',
		//'latitude',
		//'longitude',

		['class' => 'yii\grid\ActionColumn'],
	],
]);?>


</div>

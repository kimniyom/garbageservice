<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

   <!-- <h1><?=Html::encode($this->title)?></h1>  -->
    <p>
        <?=Html::a('Create Customer', ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		'id',
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

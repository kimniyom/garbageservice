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
			'label' => 'ลูกค้า',
			'value' => function($model){
				$Customer = new Customers();
				return $Customer->findOne(['id' => $model->customerid])['company'];
			}
		],
    [
			//'attribute' => '',
			'format' => 'text',
			'label' => 'ผู้ประสานงาน',
			'value' => function($model){
				$Customer = new Customers();
        $Cs = $Customer->findOne(['id' => $model->customerid]);
        $tel = $Cs['tel'];
        $phone = ($Cs['telephone']) ? ",".$Cs['telephone'] : "";
        $val = $Cs['manager'].' (โทร.'.$Cs['tel'].$phone.')';
				return $val;
			}
		],
		[
			//'attribute' => 'promisedatebegin',
			'value' => function ($model) {
				$config = new Config();
				return $config->thaidate($model->promisedatebegin);
			},
			'label' => 'วันเริ่มสัญญา',
		],
		[
			//'attribute' => 'promisedateend',
			'value' => function ($model) {
				$config = new Config();
				return $config->thaidate($model->promisedateend);
			},
			'label' => 'วันสิ้นสุดสัญญา',
		],
		[
			//'attribute' => 'recivetype',
			'format' => 'text',
			'label' => 'ประเภทการจ้าง',
			'value' => function ($model) {
				if($model->recivetype == "1")
				{
					return "รายครั้ง/ต่อเดือน";
				}
				else if($model->recivetype == "2")
				{
					return "คิดตามน้ำหนักจริง";
				}
				else if($model->recivetype == "3")
				{
					return "เหมาจ่ายรายเดือน";
				}

			},
		],
		[
			//'attribute' => 'status',
			'format' => 'html',
			'label' => 'สถานะสัญญา',
			'value' => function ($model) {
				if($model->status == "0")
				{
					return "หมดสัญญา";
				}
				else if($model->status == "1")
				{
					return "<i class='fa fa-info text-warning'></i> รอยืนยัน";
				}
				else if($model->status == "2")
				{
					return "<i class='fa fa-check text-success'><i/>กำลังใช้งาน";
				}
				else if($model->status == "3")
				{
					return "กำลังต่อสัญญา";
				}
				else if($model->status == "4")
				{
					return "ยกเลิกสัญา";
				}

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

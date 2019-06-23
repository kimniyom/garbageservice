<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Config;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\promise\models\PromiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สัญญา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promise-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Promise', ['beforecreate'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'format' => 'text',
                'label' => 'เลขที่สัญญา',
            ],
            [
                'attribute' => 'customerid',
                'format' => 'text',
                'label' => 'รหัสลูกค้า',
            ],
            [
                'attribute' => 'promisedatebegin',
                'value'=>function($model){
                    $config = new Config();
                    return $config->thaidate($model->promisedatebegin);
                },
                'label' => 'วันเริ่มสัญญา',
            ],
            [
                'attribute' => 'promisedateend',
                'value'=>function($model){
                    $config = new Config();
                    return $config->thaidate($model->promisedateend);
                },
                'label' => 'วันสิ้นสุดสัญญา',
            ],
            [
                'attribute' => 'recivetype',
                'format' => 'text',
                'label' => 'ประเภทการจ้าง',
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

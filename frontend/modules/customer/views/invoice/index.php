<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\InvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Invoice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'invoicenumber',
            'promise',
            'round',
            'total',
            //'status',
            //'month',
            //'year',
            //'d_update',
            //'timeservice',
            //'dateservice',
            //'comment',
            //'type',
            //'dateinvoice',
            //'datebill',
            //'typeinvoice',
            //'slip',
            //'bank',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

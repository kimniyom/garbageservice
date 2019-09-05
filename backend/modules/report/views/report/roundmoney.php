<?php 
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Config;
use yii\helpers\Url;

$this->title = 'รานงานสรุปค่าบริการประจำเดือน';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['/report/report/monthservicefee']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php
    echo GridView::widget([
        'dataProvider'=>$dataProvider,
        'columns'=> [
            ['class' => 'yii\grid\SerialColumn'],
            'company',
            'promisenumber',
            [
                'attribute' => 'datekeep',
                'value' => function ($model) {
                    $config = new Config();
                    return $config->thaidate($model['datekeep']);
                },
                'label' => 'วันเก็บ',
            ],
            [
                'attribute' => 'round',
                'value' => function ($model) {
                    $config = new Config();
                    return number_format($model['round']);
                },
                'label' => 'รอบที่',
            ],
            [
                'attribute' => 'amount',
                'value' => function ($model) {
                    $config = new Config();
                    return number_format($model['amount']);
                },
                'label' => 'จำนวนเงิน',
            ],
            'keepby',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    $config = new Config();
                    if($model['status'] == "" || $model['status'] == 0)
                    {
                        return "<span class=\"glyphicon glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
                    }
                    else{
                        return "<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>";
                    }
                },
                'label' => 'สถานะ',
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
    ]);
?>
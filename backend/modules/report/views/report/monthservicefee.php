<?php 
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Config;
use yii\helpers\Url;

$this->title = 'รานงานสรุปค่าบริการประจำเดือน';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['index']];
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
                'attribute' => 'promisedatebegin',
                'value' => function ($model) {
                    $config = new Config();
                    return $config->thaidate($model['promisedatebegin']);
                },
                'label' => 'วันเริ่มสัญญา',
            ],
            [
                'attribute' => 'promisedateend',
                'value' => function ($model) {
                    $config = new Config();
                    return $config->thaidate($model['promisedateend']);
                },
                'label' => 'วันเริ่มสัญญา',
            ],
            [
                'attribute' => 'nopay',
                'value' => function ($model) {
                    $config = new Config();
                    return number_format($model['nopay']);
                },
                'label' => 'รอบที่ค้างจ่าย',
            ],
            [
                'attribute' => 'payed',
                'value' => function ($model) {
                    $config = new Config();
                    return number_format($model['payed']);
                },
                'label' => 'รอบที่จ่ายแล้ว',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator'=>function($action, $model, $key, $index)
                {
                    return Url::toRoute(['/report/report/roundmoney','promiseid'=>$model['id']]);
                }
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
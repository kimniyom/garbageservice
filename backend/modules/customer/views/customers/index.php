<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\customer\models\Customers;
use app\models\Typecustomer;
use app\models\Groupcustomer;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use dektrium\user\models\Profile;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'company',
            [
                'attribute' => 'company',
                'headerOptions' => ['style' => 'word-wrap: break-word;'],
                'contentOptions' => [
                    'style' => 'word-wrap: break-word;'
                ],
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a($model->company, Url::to(['view', 'id' => $model->id]));
                }
            ],
            [
                'attribute' => 'taxnumber',
                'headerOptions' => ['style' => 'word-wrap: break-word;'],
                'contentOptions' => [
                    'style' => 'word-wrap: break-word;'
                ],
                'format' => 'html',
                'value' => function($model) {
                    return ($model->taxnumber) ? $model->taxnumber : '<p class="text-danger">ยังไม่ได้กำหนด</p>';
                }
            ],
            [
                'attribute' => 'grouptype',
                'headerOptions' => ['style' => 'word-wrap: break-word;'],
                'contentOptions' => [
                    'style' => 'word-wrap: break-word;'
                ],
                'format' => 'html',
                'filter' => ArrayHelper::map(Groupcustomer::find()->all(), 'id', 'groupcustomer'), //กำหนด filter แบบ dropDownlist จากข้อมูล ใน field แบบ foreignKey
                'value' => function($model) {
                    return Groupcustomer::findOne(["id" => $model->grouptype])['groupcustomer'];
                }
            ],
            [
                'attribute' => 'type',
                'headerOptions' => ['style' => 'word-wrap: break-word;'],
                'contentOptions' => [
                    'style' => 'word-wrap: break-word;'
                ],
                //'format' => 'html',
                'filter' => ArrayHelper::map(Typecustomer::find()->all(), 'id', 'typename'), //กำหนด filter แบบ dropDownlist จากข้อมูล ใน field แบบ foreignKey
                'value' => function($model) {
                    return Typecustomer::findOne(["id" => $model->type])['typename'];
                }
            ],
            [
                'label' => 'Username',
                'format' => 'raw',
                'value' => function($model) {
                    return User::findOne(['id' => $model->user_id])['username'];
                }
            ],
            [
                'attribute' => 'address',
                'format' => 'text',
                'label' => 'ที่อยู่',
                'value' => function($model) {
                    $CustomerModel = new Customers();
                    $Customer = $CustomerModel->getAddress($model->id);
                    return $Customer['address'] . ' ต.' . $Customer['tambon_name'] . ' อ.' . $Customer['ampur_name'] . ' จ.' . $Customer['changwat_name'] . ' ' . $model->zipcode;
                }
            ],
            [
                'attribute' => 'manager',
                'format' => 'html',
                'value' => function($model) {
                    return ($model->manager) ? $model->manager : '<p class="text-danger">ยังไม่ได้กำหนด</p>';
                }
            ],
            'tel',
            'telephone',
            //'OFFICETEL',
            //'EMAIL:email',
            //'STATUS',,
            [
                'attribute' => 'approve',
                'format' => 'html',
                //'label' => 'ที่อยู่',
                'value' => function($model) {
                    return ($model->approve == 'Y') ? '<p class="text-success">ยืนยันแล้ว</p>' : '<p class="text-danger">ยังไม่ยืนยัน/ข้อมูลไม่สมบูรณ์</p>';
                }
            ],
            'remark',
            'timework',
            //'TAMBON',
            //'ZIPCODE',
            //'CREATE_DATE',
            //'UPDATE_DATE',
            //'DATE_APPROVE',
            ///'latitude',
            //'longitude',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => false,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
        ],
    ]);
    ?>


</div>

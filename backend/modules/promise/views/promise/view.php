<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = $model['id'];
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="promise-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model['id'], 'customerid' => $model['customerid']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         
         <?= Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> .Doc',['getdoc', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-black', 'title' => 'Microsoft word']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
       
        'attributes' => [
           
            [
                'label'=>'เลขที่สัญญา',
                'attribute'=>'id'
            ],
            [
                'label'=>'ลูกค้า',
                'attribute'=>'company'
            ],
            [
                'label'=>'ทำสัญญา ณ ',
                'value'=>$model['address'].' '.$model['tambon'].' '.$model['ampur'].' '.$model['changwat'],
               
            ],
            [
                'label'=>'วันเริ่มสัญญา',
                'value'=>Yii::$app->thaiFormatter->asDate($model['promisedatebegin'], 'long'),
               
            ],
            [
                'label'=>'วันสิ้นสุดสัญญา',
                'value'=>Yii::$app->thaiFormatter->asDate($model['promisedateend'], 'long'),
               
            ],
            [
                'label'=>'ประเภทการจ้าง',
                'attribute'=>'recivetype'
            ],
            [
                'label'=>'คิดค่าจ้างเหมาในอัตราเดือนละ',
                'attribute'=>'rate'
            ],
            [
                'label'=>'คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)',
                'attribute'=>'ratetext'
            ],
            [
                'label'=>'จำนวนครั้งที่จัดเก็บต่อเดือน',
                'attribute'=>'levy'
            ],
            [
                'label'=>'ค่าจ้างรวมทิ้งสิ้นต่อปี',
                'attribute'=>'payperyear'
            ],
            [
                'label'=>'ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)',
                'attribute'=>'payperyeartext'
            ],
            [
                'label'=>'วันที่ทำสัญญา',
                'value'=>Yii::$app->formatter->asDatetime($model['createat'],'dd/MM/Y'),
               
            ],
            [
                'label'=>'ผู้ประสาน',
                'value'=>$model['manager'],
               
            ],
            [
                'label'=>'เบอร์โทร',
                'value'=>$model['tel'],
               
            ],
            [
                'label'=>'ปริมาณขยะ (กิโลกรัม)',
                'value'=>$model['garbageweight'],
               
            ],
            [
                'label'=>'สถานะการใช้งาน',
                'value'=>$model['active']==1?"ใช้งาน":"ไม่ใช้งาน",
               
            ],
           
        ],
    ]) ?>

</div>

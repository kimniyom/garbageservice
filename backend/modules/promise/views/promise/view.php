<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Config;
/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = $model['id'];
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$Config = new Config();
?>
<div class="promise-view">

    <p>
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
                'value'=> $Config->thaidate($model['promisedatebegin']),
               
            ],
            [
                'label'=>'วันสิ้นสุดสัญญา',
                'value'=> $Config->thaidate($model['promisedateend']),
            ],
            [
                'label'=>'ประเภทการจ้าง',
                'value'=> $model['recivetype']==1?"รายเดือน":"รายปี",
            ],
            [
                'label'=>$model['recivetype']==1?"คิดค่าจ้างเหมาในอัตราเดือนละ":"ค่าจ้างรวมทิ้งสิ้นต่อปี",
                'value'=>($model['recivetype']==1)?(number_format($model['rate'])):(number_format($model['payperyear'])),
            ],
           
            [
                'label'=>'จำนวนครั้งที่จัดเก็บต่อเดือน',
                'attribute'=>'levy'
            ],
            [
                'label'=>'วันที่ทำสัญญา',
                'value'=> $Config->thaidate($model['createat']),
               
            ],
            [
                'label'=>'ปริมาณขยะ (กิโลกรัม)',
                'value'=>$model['garbageweight'],
               
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
                'label'=>'สถานะการชำระเงิน',
                'value'=>$model['checkmoney']==0?"ยังไม่ได้ชำระ":"ชำระแล้ว",
               
            ],
            [
                'label'=>'สถานะสัญญา',
                'value'=>function($model){
                    if($model['status']==0)
                    {
                        return "หมดสัญญา";
                    }
                    else if($model['status']==1)
                    {
                        return "รอยืนยัน";
                    }
                    else if($model['status']==2)
                    {
                        return "กำัลังใช้งาน";
                    }
                    else if($model['status']==3)
                    {
                        return "กำลังต่อสัญญา";
                    }
                     
                },
                
               
            ],
            [
                'label'=>'สถานะการใช้งาน',
                'value'=>$model['active']==1?"ใช้งาน":"ไม่ใช้งาน",
               
            ],

           
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Config;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = "อัพโหลดไฟล์สัญญา";
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$Config = new Config();
?>
<div class="promise-view">
    
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

<div class="promise-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>    

<script>
    function setstatus(id,status)
    {
        var data = {id: id, status: status};
        var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/onloaddoc']) ?>";
        $.post(url,data,function(result){
            if(result){
                alert("สถานะสัญญา : รอยืนยัน");
            } else {
                 alert("ไม่สามารถแก้ไขสถานะสัญญาได้");
            }
        });
    }       
</script>

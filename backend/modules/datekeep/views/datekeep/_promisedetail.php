<?php

//use yii\widgets\ActiveForm;
use app\models\Maspackage;
use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\models\Config;
use yii\helpers\Url;
use yii\widgets\DetailView;
$Config = new Config();
?>
<a href="<?php echo Yii::$app->urlManager->createUrl(['promise/promise/view','id' => $promise['id']])?>">
<button type="button" class="btn btn-default flat">
<i class="fa fa-chevron-left"></i> กลับ
</button></a>
<div class="promise-form" style=" margin: 0px; padding: 0px;">
    <div class="row" style=" margin-bottom: 0px;">
        <div class="col-md-6 col-lg-4">
            <div class="box box-success" id="box-left">
                <div class="box-header">ข้อมูลสัญญา</div>
                <div class="box-body">
                    <table>
                        <tr>
                            <td>เลขที่สัญญา:</td>
                            <td><?php echo $promise['promisenumber'] ?></td>
                        </tr>
                        <tr>
                            <td>ลูกค้า:</td>
                            <td><?php echo $promise['company'] ?></td>
                        </tr>
                        <tr>
                            <td>จำนวนครั้งต่อเดือน:</td>
                            <td style=" font-size: 20px; text-align: center; color: red;"><?php echo $promise['levy'] ?> ครั้ง</td>
                        </tr>
                        <tr>
                            <td>จำนวนครั้งทั้งหมด:</td>
                            <td style=" font-size: 20px; text-align: center; color: red;"><?php echo ($promise['levy'] * 12) ?> ครั้ง</td>
                        </tr>
                    </table>
                    <hr/>
                    <div style=" font-size: 20px; text-align: center; color: red;">
                        กำหนดวันเข้าจัดเก็บแล้ว <label class="alert alert-warning"><?php echo count($data['model'])?></label> ครั้ง
                    </div>
                    <!--
                    <div class="list-group">
                        <?php
                            /*DetailView::widget([
                                'model' => $promise,
                                'attributes' => [
                                    [
                                        'label' => 'เลขที่สัญญา',
                                        'attribute' => 'promisenumber',
                                    ],
                                    [
                                        'label' => 'ลูกค้า',
                                        'attribute' => 'company',
                                    ],
                                    [
                                        'label' => 'ทำสัญญา ณ ',
                                        'value' => $promise['address'] . ' ' . $promise['tambon'] . ' ' . $promise['ampur'] . ' ' . $promise['changwat'],
                                    ],
                                    [
                                        'label' => 'วันเริ่มสัญญา',
                                        'value' => $Config->thaidate($promise['promisedatebegin']),
                                    ],
                                    [
                                        'label' => 'วันสิ้นสุดสัญญา',
                                        'value' => $Config->thaidate($promise['promisedateend']),
                                    ],
                                    [
                                        'label' => 'ประเภทการจ้าง',
                                        'value' => $promise['recivetype'] == 1 ? "รายเดือน" : "รายปี",
                                    ],
                                    [
                                        'label' => 'จำนวนครั้งต่อเดือน',
                                        'value' => $promise['levy']." ครั้ง "
                                    ],
                                    [
                                        'label' => 'จำนวนครั้งทั้งหมด',
                                        'value' => ($promise['levy'] * 12)." ครั้ง "
                                    ],
                                    [
                                        'label' => 'เบอร์โทร',
                                        'value' => $promise['tel'],
                                    ],
                                
                                ],
                            ]);
                        
                             */ ?>
                             
                    </div>
                    -->
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="box box-success">
                <div class="box-header" style="color:red;">*คลิกที่ช่องว่างวันที่เพื่อเพิ่มวันเข้าจัดเก็บ,คลิกแถบสีเพื่อดูข้อมูลหรือลบออก</div>
                <div class="box-body" id="box-right" style=" position: relative; overflow: auto;">
                    
                    <?= $this->render($render, [
                        'data' => $data,
                    ]) ?>
                    
                </div>    
            </div>
        </div>
    </div>
</div>




<?php

$this->registerJs("setScreen();");

?>

<script>
function setScreen() {
        var h = window.innerHeight;
        $("#box-left").css({"height": h - 150,"overflow": "auto"});
        $("#box-right").css({"height": h - 195,"overflow": "auto"});
    }
</script>
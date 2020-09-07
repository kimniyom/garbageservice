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

<div class="promise-form">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="box box-success" id="box-left">
                <div class="box-header">ข้อมูลสัญญา</div>
                <div class="box-body">
                    <div class="list-group">
                        <?=
                            DetailView::widget([
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
                                        'label' => 'เบอร์โทร',
                                        'value' => $promise['tel'],
                                    ],
                                
                                ],
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="box box-success">
                <div class="box-header">บันทึกการเข้าจัดเก็บ</div>
                <div class="box-body"  id="box-right" style=" position: relative; overflow: auto;">
                    <div class="well">
                    <?= $this->render($render, [
                        'data' => $data,
                    ]) ?>
                    </div>
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
        $("#box-left").css({"height": h - 141});
        $("#box-right").css({"height": h - 255});
    }
</script>
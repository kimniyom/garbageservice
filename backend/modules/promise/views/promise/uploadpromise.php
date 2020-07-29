<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Config;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = "อัพโหลดไฟล์สัญญา";
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$Config = new Config();
?>
<div class="promise-view">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="box" id="box-detail">
                <div class="box-header" style=" padding-bottom: 0px;">รายละเอียดสัญญา</div>
                <div class="box-body">

                    <?=
                    DetailView::widget([
                        'model' => $model,
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
                                'value' => $model['address'] . ' ' . $model['tambon'] . ' ' . $model['ampur'] . ' ' . $model['changwat'],
                            ],
                            [
                                'label' => 'วันเริ่มสัญญา',
                                'value' => $Config->thaidate($model['promisedatebegin']),
                            ],
                            [
                                'label' => 'วันสิ้นสุดสัญญา',
                                'value' => $Config->thaidate($model['promisedateend']),
                            ],
                            [
                                'label' => 'ประเภทการจ้าง',
                                'value' => $model['recivetype'] == 1 ? "รายเดือน" : "รายปี",
                            ],
                            /*
                              [
                              'label' => $model['recivetype'] == 1 ? "คิดค่าจ้างเหมาในอัตราเดือนละ" : "ค่าจ้างรวมทิ้งสิ้นต่อปี",
                              'value' => ($model['recivetype'] == 1) ? (number_format($model['rate'])) : (number_format($model['payperyear'])),
                              ],
                              [
                              'label' => 'จำนวนครั้งที่จัดเก็บต่อเดือน',
                              'attribute' => 'levy',
                              ],
                              [
                              'label' => 'ระยะสัญญา',
                              'attribute' => 'yearunit',
                              'value' => $model['yearunit'],
                              ],
                              [
                              'label' => 'วันที่ทำสัญญา',
                              'value' => $Config->thaidate($model['createat']),
                              ],
                              [
                              'label' => 'ปริมาณขยะ (กิโลกรัม)',
                              'value' => $model['garbageweight'],
                              ],
                              [
                              'label' => 'มัดจำล่วงหน้า (เดือน)',
                              'value' => $model['deposit'],
                              ],
                              [
                              'label' => 'ผู้ประสาน',
                              'value' => $model['manager'],
                              ],
                             * 
                             */
                            [
                                'label' => 'เบอร์โทร',
                                'value' => $model['tel'],
                            ],
                        /*
                          [
                          'label' => 'สถานะการชำระเงิน',
                          'value' => $model['checkmoney'] == 0 ? "ยังไม่ได้ชำระ" : "ชำระแล้ว",
                          ],
                          [
                          'label' => 'สถานะสัญญา',
                          'value' => function ($model) {
                          if ($model['status'] == 0) {
                          return "หมดสัญญา";
                          } else if ($model['status'] == 1) {
                          return "รอยืนยัน";
                          } else if ($model['status'] == 2) {
                          return "กำัลังใช้งาน";
                          } else if ($model['status'] == 3) {
                          return "กำลังต่อสัญญา";
                          }
                          },
                          ],
                          [
                          'label' => 'สถานะการใช้งาน',
                          'value' => $model['active'] == 1 ? "ใช้งาน" : "ไม่ใช้งาน",
                          ],
                         * 
                         */
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="box">

                <div class="box-header" style=" padding-bottom: 0px;">
                    ไฟล์สัญญาข้อตกลง
                </div>
                <div class="box-body" id="box-unit">
                    <div class="row">
                        <div class="col-md-2 col-lg-2" style=" text-align: center;">
                            
                            <?php
                            $filename = \app\modules\promise\models\Promisefile::findOne(['promiseid' => $model['id']])['filename'];
                            $path = str_replace("backend/", "", Url::to('@web/uploads/promise/pdf/' . $filename, true));
                            ?>
                            <?php if($filename) { ?>
                            <a href="<?php echo $path ?>" target="_blank" style=" text-decoration: none;">
                                <button type="button" class="btn tn-default text-danger">
                                    <i class="fa fa-file-pdf-o fa-3x"></i> <br/><br/>
                                    <?php echo $model['promisenumber'] ?>
                                </button>
                            </a>
                            <?php } else { ?>
                            <i class="fa fa-info-circle fa-3x text-warning"></i>
                            <?php } ?>
                        </div>
                        <div class="col-md-10 col-lg-10">
                            <div class="promise-form">
                                อัพโหลดสัญญาที่เสร็จสมบูรณ์แล้ว<br/>
                                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                                <?= $form->field($promisefile, 'filename')->fileInput() ?>
                                <div class="form-group">
                                    <?=
                                    Html::submitButton('อัพโหลด', [
                                        'class' => 'btn btn-success',
                                        'data' => [
                                            'confirm' => 'ตรวจสอบสัญญาเรียบร้อยแล้วใช่หรือไม่',
                                        ],
                                    ])
                                    ?>
                                </div>

                                <?php ActiveForm::end(); ?>  
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJs('
        //var boxdetail = $("#box-detail").height();
        //$("#box-unit").css({"height": boxdetail-30,"overflow": "auto"});
        ');
?>

<script>
    function setstatus(id, status)
    {
        var data = {id: id, status: status};
        var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/setstatus']) ?>";
        $.post(url, data, function (result) {
            if (result) {
                alert("สถานะสัญญา : รอยืนยัน");
            } else {
                alert("ไม่สามารถแก้ไขสถานะสัญญาได้");
            }
        })
    }
</script>




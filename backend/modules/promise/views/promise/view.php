<style type="text/css">
    .t-right{
        float: right;
        padding-bottom: 0px;
        margin-bottom: 0px;
    }
</style>
<?php

use app\models\Config;
use app\models\Maspackage;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\modules\promise\models\Promise;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = $model['promisenumber'];
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$Config = new Config();
$promiseModel = new Promise();
?>

<?php
Modal::begin([
    'header' => '<h4>ระบุเหตุผลยกเลิกสัญญา</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo "<div id='modalContent'></div>";
Modal::End();
?>
<div class="promise-view">
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="box" id="box-detail">
                <div class="box-header" style=" padding-bottom: 0px;">รายละเอียดสัญญา</div>
                <div class="box-body">
                    <p>
                        <?php if ($model['status'] == "1") {
                            ?>
                            <?= Html::a('Update', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>

                            <?=
                            Html::a('Delete', ['delete', 'id' => $model['id'], 'customerid' => $model['customerid']], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                            <?= Html::button('Cancel', ['value' => Url::to(Yii::$app->urlManager->createUrl(['promise/promise/cancelpromise', 'id' => $model['id'], 'status' => '4'])), 'class' => 'btn btn-warning', 'id' => 'modalButton']) ?>
                        <?php } ?>

                        <?php
                        if ($model['status'] == '1') {
                            //ms word
                            /*
                              echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> .Doc', ['getdoc', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-black', 'title' => 'Microsoft word']);
                             */
                            //pdf preview
                            echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> พิมพ์สัญญา', ['pdfpreview', 'id' => $model['id'], 'promisenumber' => $model['promisenumber']], ['class' => 'btn btn-black', 'title' => 'PDF', 'target' => '_blank']);
                            //upload pdf
                            echo Html::a('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> อัพโหลดไฟล์สัญญาที่มีลายเซ็นต์ทั้ง 2 ฝ่าย', ['uploadpromise', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-black', 'title' => 'Upload pdf']);
                        }
                        if ($model['status'] == '2') {
                            //save pdf
                            echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> ดาวห์โหลดสัญญา', ['getpromisepdf', 'promisenumber' => $model['promisenumber']], ['class' => 'btn btn-success', 'title' => 'ดาวโหลดสัญญา']);
                        }
                        ?>
                    </p>
                    <?php
                    if ($model['vat'] == 1) {
                        $vat = "(รวม vat 7%)";
                    } else {
                        $vat = "";
                    }
                    ?>
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
                                'label' => 'วันทำสัญญา',
                                'value' => $Config->thaidate($model['createat']),
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
                                'value' => Maspackage::findOne(['id' => $model['recivetype']])['package'],
                            ],
                                [
                                'label' => 'ราคาต่อหน่วย',
                                'value' => $model['unitprice'],
                            ],
                                [
                                'label' => 'จำนวนครั้งที่จัดเก็บต่อเดือน',
                                'attribute' => 'levy',
                            ],
                                [
                                'label' => 'ค่าบริการรายเดือน',
                                'attribute' => 'rate',
                            ],
                                [
                                'label' => ($model['recivetype'] == 2) ? "-" : "ค่าจ้างต่อปี(ปกติ) ",
                                'format' => 'html',
                                'value' => ($model['recivetype'] == 2) ? "-" : (number_format($model['payperyear'], 2)) . " <em>" . $vat . "</em>",
                            ],
                                [
                                'label' => ($model['distcountpercent'] != "") ? "ส่วนลด " . $model['distcountpercent'] . " %" : "ส่วนลด",
                                'value' => ($model['distcountbath'] != "") ? number_format($model['distcountbath'], 2) : "-",
                            ],
                                [
                                'label' => $model['recivetype'] == 2 ? "-" : "ค่าจ้างต่อปี(หักส่วนลด)",
                                'value' => ($model['recivetype'] == 2) ? "-" : (number_format($model['total'], 2)),
                            ],
                                [
                                'label' => "ค่าปรับกิโลที่เกิน",
                                'format' => 'html',
                                'value' => ($model['fine'] != "") ? "กิโลกรัมละ " . $model['fine'] . " บาท" : "-",
                            ],
                                [
                                'label' => 'ระยะสัญญา',
                                'attribute' => 'yearunit',
                                'value' => $model['yearunit'] . " ปี",
                            ],
                            /*
                              [
                              'label' => 'วันที่จัดเก็บ',
                              'attribute' => 'dayinweek',
                              'value' => "ทุกวัน " . $Config->dayInweek($model['dayinweek']) . " ของสัปดาห์ที่ " . $model['weekinmonth'],
                              ],
                             */
                                [
                                'label' => 'ปริมาณขยะ',
                                'value' => ($model['recivetype'] != 2) ? "ไม่เกิน " . $model['garbageweight'] . " กิโลกรัมต่อครั้ง" : "-",
                            ],
                                [
                                'label' => 'มัดจำล่วงหน้า (เดือน)',
                                'value' => ($model['deposit'] != "") ? $model['deposit'] . " เดือน" : "-",
                            ],
                                [
                                'label' => 'ชื่อผู้ติดต่อได้สะดวก',
                                'value' => $model['manager'],
                            ],
                                [
                                'label' => 'เบอร์โทร',
                                'value' => $model['tel'],
                            ],
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
                                        return "กำลังใช้งาน";
                                    } else if ($model['status'] == 3) {
                                        return "กำลังต่อสัญญา";
                                    }
                                },
                            ],
                                [
                                'label' => 'ผู้ว่าจ้างคนที่ 1',
                                'value' => $model['employer1'],
                            ],
                                [
                                'label' => 'ผู้ว่าจ้างคนที่ 2',
                                'value' => $model['employer2'],
                            ],
                                [
                                'label' => 'พยานคนที่ 1',
                                'value' => $model['witness1'],
                            ],
                                [
                                'label' => 'พยานคนที่ 2',
                                'value' => $model['witness2'],
                            ],
                                [
                                'label' => 'สถานะการใช้งาน',
                                'value' => $model['active'] == 1 ? "ใช้งาน" : "ไม่ใช้งาน",
                            ],
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#sales-chart" data-toggle="tab"> สัญญา</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> รอบเดือน</li>
                </ul>
                <div class="tab-content padding">

                    <div class="chart tab-pane active" id="sales-chart">

                        <?php if ($model['recivetype'] == 1 || $model['recivetype'] == 2 || $model['recivetype'] == 3) {
                            ?>

                            <?php $month = ($model['yearunit'] * 12); ?>

                            <div class="box-unit">
                                <?php
                                foreach ($roundmoney as $rs) {
                                    $yearMonth = $Config->thaidatemonth($rs['datekeep']);
                                    $countRoundgarbage = $promiseModel->GetststusGarbage($yearMonth);
                                    echo "<pre>";
                                    echo $yearMonth;
                                    echo ($yearMonth > 0) ? "<p class='t-right'><i class='fa fa-check text-success'></i> มีการจัดเก็บ</p>" : "<p class='t-right'><i class='fa fa-remove text-danger'></i> ยังไม่มีการจัดเก็บ</p>";
                                    echo "</pre>";
                                }
                                ?>
                            </div>
                        <?php } else { ?>
                            <h4 style="text-align: center;">สัญญารายปี</h4>
                            <hr/>
                            <h4 style="text-align: center;">
                                <?php echo $model['checkmoney'] == 0 ? "ยังไม่ได้ชำระ" : "ชำระแล้ว"; ?>
                            </h4>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->


        </div>
    </div>
</div>

<?php
$this->registerJs('
        var boxdetail = $("#box-detail").height();
        $(".box-unit").css({"height": boxdetail-60,"overflow": "auto"});
        ');
?>

<script>
    function setstatus(id, status)
    {
        var data = {id: id, status: status};
        var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/setstatus']) ?>";
        $.post(url, data, function(result) {
            if (result) {
                alert("สถานะสัญญา : รอยืนยัน");
            } else {
                alert("ไม่สามารถแก้ไขสถานะสัญญาได้");
            }
        })
    }
</script>

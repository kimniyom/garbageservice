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
use app\models\Packagepayment;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\modules\promise\models\Promise;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = $model['promisenumber'];
//$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
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
                <div class="box-header" style=" padding-bottom: 0px; font-weight: bold;">รายละเอียดสัญญา <?php echo($model['status'] == "4") ? "<font style='color:red;'>(ยกเลิกสัญญา)</font>" : ""; ?></div>
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
                            if ($model['grouptype'] == 1 || $model['grouptype'] == 3 || $model['grouptype'] == 5 || $model['grouptype'] == 6) {
                                echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> พิมพ์สัญญา', ['pdfpreview', 'id' => $model['id'], 'promisenumber' => $model['promisenumber']], ['class' => 'btn btn-black', 'title' => 'PDF', 'target' => '_blank']);
                            }
                            //upload pdf
                            echo Html::a('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> อัพโหลดไฟล์สัญญาที่มีลายเซ็นต์ทั้ง 2 ฝ่าย', ['uploadpromise', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-black', 'title' => 'Upload pdf']);
                        }

                        if ($model['status'] == '2') {
                            //save pdf
                            echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> ดาวห์โหลดสัญญา', ['getpromisepdf', 'promisenumber' => $model['promisenumber']], ['class' => 'btn btn-success', 'title' => 'ดาวโหลดสัญญา']);
                            echo "&nbsp;" . Html::a('เพิ่มวันเข้าจัดเก็บ', ['/datekeep/datekeep/index', 'promiseid' => $model['id']], ['class' => 'btn btn-primary']);
                        }
                        ?>
                        <?php if ($model['status'] == 2) { ?>
                            <?= Html::button('ยกเลิกสัญญา', ['value' => Url::to(Yii::$app->urlManager->createUrl(['promise/promise/cancelpromise', 'id' => $model['id'], 'status' => '4'])), 'class' => 'btn btn-warning', 'id' => 'modalButton']) ?>
                            <button type="button" class="btn btn-info" onclick="approver('<?php echo $model['id'] ?>')">สิ้นสุดสัญญา</button>
                        <?php } ?>
                    </p>
                    <?php
                    if ($model['vattype'] == 1) {
                        $vat = "(รวม vat 7%)";
                    } else {
                        $vat = "(ไม่รวม vat 7%)";
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
                                'format' => 'raw', // I want something like this
                                'value' => yii\bootstrap\Html::a($model['company'], Yii::$app->urlManager->createUrl(['customer/customers/view', 'id' => $model['customerid']])),
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
                                'label' => 'ระยะสัญญา',
                                'attribute' => 'yearunit',
                                'value' => $model['payment'] == 1 ? "12 เดือน" : "1 ปี",
                            ],
                            [
                                'label' => 'ประเภทการจ้าง',
                                'value' => Maspackage::findOne(['id' => $model['recivetype']])['package'],
                            ],
                            [
                                'label' => 'การชำระเงิน',
                                'value' => Packagepayment::findOne(['id' => $model['payment']])['payment'],
                            ],
                            [
                                'label' => 'ราคาต่อหน่วย',
                                'value' => ($model['unitprice']) ? $model['unitprice'] . " บาท" : "-",
                            ],
                            [
                                'label' => 'จำนวนครั้งที่จัดเก็บต่อเดือน',
                                'value' => $model['levy'] . " ครั้ง",
                            ],
                            [
                                'label' => 'จำนวนครั้งที่จัดเก็บต่อปี',
                                'value' => $model['levy'] * 12 . " ครั้ง",
                                'visible' => $model['payment'] == 7 || $model['payment'] == 8 ? true : false,
                            ],
                            // [
                            //     'label' => 'ค่าบริการรายเดือน',
                            //     'attribute' => 'rate',
                            //     'visible' => $model['payment'] == 7 || $model['payment'] == 8
                            // ],
                            [
                                'label' => ($model['recivetype'] == 2) ? "-" : "ค่าจ้างต่อปี(ปกติ) ",
                                'format' => 'html',
                                'value' => ($model['recivetype'] == 2) ? "-" : (number_format($model['payperyear'], 2)) . " <em>" . $vat . "</em> บาท",
                            ],
                            [
                                'label' => ($model['distcountpercent'] != "") ? "ส่วนลด " . $model['distcountpercent'] . " %" : "ส่วนลด",
                                'value' => ($model['distcountbath'] != "") ? number_format($model['distcountbath'], 2) : "-",
                                'visible' => $model['distcountbath'] > 0 ? true : false,
                            ],
                            [
                                'label' => $model['recivetype'] == 2 ? "-" : "ค่าจ้างต่อปี(หักส่วนลด)",
                                'value' => ($model['recivetype'] == 2) ? "-" : (number_format($model['total'], 2)),
                                'visible' => $model['distcountbath'] > 0 ? true : false,
                            ],
                            [
                                'label' => "ค่าปรับกิโลที่เกิน",
                                'format' => 'html',
                                'value' => ($model['fine'] != "") ? "กิโลกรัมละ " . $model['fine'] . " บาท" : "-",
                            ],
                            // /*
                            //   [
                            //   'label' => 'วันที่จัดเก็บ',
                            //   'attribute' => 'dayinweek',
                            //   'value' => "ทุกวัน " . $Config->dayInweek($model['dayinweek']) . " ของสัปดาห์ที่ " . $model['weekinmonth'],
                            //   ],
                            //  */
                            [
                                'label' => 'ปริมาณขยะ',
                                'value' => ($model['recivetype'] != 2) ? "ไม่เกิน " . $model['garbageweight'] . " กิโลกรัมต่อครั้ง" : "-",
                            ],
                            [
                                'label' => 'มัดจำล่วงหน้า (เดือน)',
                                'value' => ($model['deposit'] != "") ? $model['deposit'] . " เดือน" : "-",
                                'visible' => $model['deposit'] > 0 ? true : false,
                            ],
                            [
                                'label' => 'ชื่อผู้ติดต่อได้สะดวก',
                                'value' => $model['manager'],
                            ],
                            [
                                'label' => 'เบอร์โทร',
                                'value' => ($model['tel']) ? $model['tel'] : "" . "  " . ($model['telephone']) ? $model['telephone'] : "",
                            ],
                            /*
                              [
                              'label' => 'สถานะการชำระเงิน',
                              'value' => $model['checkmoney'] == 0 ? "ยังไม่ได้ชำระ" : "ชำระแล้ว",
                              ],
                             *
                             */
                            [
                                'label' => 'สถานะสัญญา',
                                'format' => "raw",
                                'value' => function ($model) {
                                    $Config = new Config();
                                    return $Config->getStatusPromise($model['status']);
                                },
                            ],
                            [
                                'label' => 'ผู้ว่าจ้างคนที่ 1',
                                'value' => $model['employer1'] == "" ? "-" : $model['employer1'],
                            ],
                            [
                                'label' => 'ผู้ว่าจ้างคนที่ 2',
                                'value' => $model['employer2'],
                                'visible' => $model['employer2'] != "" ? true : false,
                            ],
                            [
                                'label' => 'พยานคนที่ 1',
                                'value' => $model['witness1'] == "" ? "-" : $model['witness1'],
                            ],
                            [
                                'label' => 'พยานคนที่ 2',
                                'value' => $model['witness2'],
                                'visible' => $model['witness2'] != "" ? true : false,
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
                    <li class="active"><a href="#sales-chart" data-toggle="tab"> รอบเดือนที่ต้องเข้าจัดเก็บ</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> รอบเดือน</li>
                </ul>
                <div class="tab-content padding">
                    <div class="chart tab-pane active" id="sales-chart">

                        <?php if ($model['recivetype'] == 1 || $model['recivetype'] == 2 || $model['recivetype'] == 3) {
                            ?>

                            <?php $month = ($model['yearunit'] * 12); ?>

                            <div class="box-unit">
                                <?php
                                $a = 0;
                                foreach ($roundmoney as $rs) {
                                    $a++;
                                    $yearMonth = $Config->thaidatemonth($rs['datekeep']);
                                    $countRoundgarbage = $promiseModel->GetststusGarbage($yearMonth, $model['id']);

                                    $day = substr($rs['datekeep'], 0, 7);
                                    //echo $day;
                                    $sql = "select COUNT(*) as total from roundgarbage where promiseid = '" . $model['id'] . "' and left(datekeep,7) = '$day'";
                                    //echo $sql;
                                    //exit();
                                    $countRoundGatbage = Yii::$app->db->createCommand($sql)->queryOne()['total'];
                                    echo "<pre>";
                                    echo $yearMonth;
                                    if ($rs['status'] == 3) {
                                        echo "<p class='t-right'><i class='fa fa-remove text-danger'></i> ยกเลิกสัญญา</p>";
                                    } else if ($rs['status'] == 4) {
                                        echo "<p class='t-right'><i class='fa fa-info text-info'></i> สิ้นสุดสัญญา</p>";
                                    } else {
                                        echo ($countRoundGatbage > 0) ? "<p class='t-right'><i class='fa fa-check text-success'></i> มีการจัดเก็บ</p>" : "<p class='t-right'><i class='fa fa-info text-warning'></i> ยังไม่มีการจัดเก็บ</p>";
                                    }
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
        checkRound();
        ');
?>

<script>

    function approver(id) {
        var r = confirm("กรุณาตรวจสอบข้อมูลก่อนยื่นยันรายการ เมื่อสิ้นสุดสัญญาบิลหรือรอบจัดเก็บในสัญญาจะถูกยกเลิกทั้งหมด");
        if (r == true) {
            var data = {id: id, status: status};
            var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/approvepromise']) ?>";
            $.post(url, data, function(result) {
                //if (result) {
                window.location.reload();
                //}
            });
        }
    }

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
        });
    }

    function checkRound() {
        var count = "<?php echo $a ?>";
        if (count != 12) {
            Success();
        }
    }


    function Success() {
        Swal.fire({
            title: 'ระยะสัญญาน้อยกว่าหรือมากกว่า 1 ปี กรุณาตรวจสอบวันที่เริ่มสัญญาและวันที่สิ้นสุดสัญญา',
            //text: "ระยะสัญญาน้อยกว่าหรือมากกว่า 1 ปี กรุณาตรวจสอบวันที่เริ่มสัญญาและวันที่สิ้นสุดสัญญา",
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                window.location = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/update']) ?>" + "&id=" + "<?php echo $model['id'] ?>";
            }
        });
    }


</script>

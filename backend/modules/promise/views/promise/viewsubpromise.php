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
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

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
                <div class="box-header" style=" padding-bottom: 0px;">
                    รายละเอียดสัญญา
                    <div class="alert alert-info">
                        * กรุณานำบันทึกข้อตกลงที่โรงพยาบาลหรือรพ.สต. ออกให้มาอัพโหลดให้สมบูรณ์<br/> 
                        * ปุ่มอัพโหลดจะแสดงเมื่อมีลูกข่ายอย่างน้อย 1 ที่
                    </div>
                    <?php if ($checksub <= 0) { ?>
                        <div class="alert alert-warning">
                            <i class="fa fa-info-circle"></i> ยังไม่ได้กำหนดลูกข่าย(จำเป็นต้องทำสัญญากับลูกข่ายอย่างน้อย 1 ที่)
                        </div>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <p>
                        <?php if ($model['status'] == "1") {
                            ?>
                            <?= Html::a('Update', ['updatesubpromise', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>

                            <?=
                            Html::a('Delete', ['delete', 'id' => $model['id'], 'customerid' => $model['customerid']], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ])
                            ?>
                        <?php } ?>
                        <?= Html::button('Cancel', ['value' => Url::to(Yii::$app->urlManager->createUrl(['promise/promise/cancelpromise', 'id' => $model['id'], 'status' => '4'])), 'class' => 'btn btn-warning', 'id' => 'modalButton']) ?>
                        <?php
                        if ($checksub > 0) {
                            ?>
                           <?php 
                           if($model['status'] != "1"){ 
                               //$path = Yii::getAlias('@webroot') . '/uploads/promise/pdf/' . $model['promisenumber'] . '.pdf';
                               $path = str_replace("backend/", "", Url::to('@web/uploads/promise/pdf/'.$model['promisenumber'].".pdf",true));
                               //echo $path;
                               ?>
                            
                        <a href="<?php echo $path ?>" target="_blank" style=" text-decoration: none;"><button type="button" class="btn tn-default"><i class="fa fa-file-pdf-o"></i> <?php echo $model['promisenumber'] ?></button></a>
                        <?php } ?>
                            <?php 
                            //upload pdf
                            echo Html::a('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> อัพโหลดไฟล์สัญญาข้อตกลง', ['uploadpromise', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-black', 'title' => 'Upload pdf']);
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
                                'label' => 'ประเภทการจ้าง',
                                'value' => Maspackage::findOne(['id' => $model['recivetype']])['package'],
                            ],
                            [
                                'label' => 'ราคาต่อหน่วย',
                                'value' => ($model['unitprice']) ? $model['unitprice'] . " บาท / กิโลกรัม" : "-",
                            ],
                            /*
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
                             *
                             */
                            /*
                              [
                              'label' => 'วันที่จัดเก็บ',
                              'attribute' => 'dayinweek',
                              'value' => "ทุกวัน " . $Config->dayInweek($model['dayinweek']) . " ของสัปดาห์ที่ " . $model['weekinmonth'],
                              ],
                             */
                            /*
                              [
                              'label' => 'ปริมาณขยะ',
                              'value' => ($model['recivetype'] != 2) ? "ไม่เกิน " . $model['garbageweight'] . " กิโลกรัมต่อครั้ง" : "-",
                              ],
                              [
                              'label' => 'มัดจำล่วงหน้า (เดือน)',
                              'value' => ($model['deposit'] != "") ? $model['deposit'] . " เดือน" : "-",
                              ],
                             *
                             */
                            [
                                'label' => 'ชื่อผู้ติดต่อได้สะดวก',
                                'value' => $model['manager'],
                            ],
                            [
                                'label' => 'เบอร์โทร',
                                'value' => ($model['tels']) ? $model['tel'] : "",
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
                                'value' => function ($model) {
                                    if ($model['status'] == 0) {
                                        return "หมดสัญญา";
                                    } else if ($model['status'] == 1) {
                                        return "รอยืนยัน";
                                    } else if ($model['status'] == 2) {
                                        return "กำลังใช้งาน";
                                    } else if ($model['status'] == 3) {
                                        return "กำลังต่อสัญญา";
                                    } else {
                                        return "ยกเลิกสัญญา";
                                    }
                                },
                            ],
                            /*
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
                             *
                             */
                            [
                                'label' => 'สถานะการใช้งาน',
                                'value' => $model['active'] == 1 ? "ใช้งาน" : "ไม่ใช้งาน",
                            ],
                        ],
                    ])
                    ?>
                    <hr/>
                    <label>เลือกลูกข่ายเพื่อทำสัญญา</label>
                    <div class="row">
                        <div class="col-lg-10 col-md-10">
                            <?php
                            echo Select2::widget([
                                'name' => 'state_10',
                                'data' => ArrayHelper::map($customer, "id", "company"),
                                'options' => [
                                    'placeholder' => 'เลือกลูกค้า',
                                    'id' => 'customerid'
                                ],
                                'pluginEvents' => [
                                    "select2:select" => "function(){setcustomerid(this.value)}",
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <button  type="button" class="btn btn-default btn-block" onclick="addSubpromise()"><i class="fa fa-plus"></i> เพื่ม</button>
                        </div>
                    </div>
                    <hr/>
                    <div id="detailcustomer"></div>

                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>เครือข่าย</th>
                            <th>ที่อยู่</th>
                            <th></th>
                        </tr>
                        <?php
                        $i = 0;
                        foreach ($list as $rs): $i++
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $rs['company'] ?></td>
                                <td><?php echo $rs['address'] ?> <?php echo "ต. " . $rs['tambon_name'] . " อ." . $rs['ampur_name'] . " จ." . $rs['changwat_name'] ?></td>
                                <td>
                                    <?php if ($model['status'] == "1") { ?>
                                        <button type="button" onclick="deletePromise('<?php echo $rs['promiseId'] ?>')"><i class="fa fa-trash-o"></i></button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
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
                                    if ($rs['status'] == 3) {
                                        echo "<p class='t-right'><i class='fa fa-remove text-danger'></i> ยกเลิกสัญญา</p>";
                                    } else {
                                        echo ($yearMonth > 0) ? "<p class='t-right'><i class='fa fa-check text-success'></i> มีการจัดเก็บ</p>" : "<p class='t-right'><i class='fa fa-info text-warning'></i> ยังไม่มีการจัดเก็บ</p>";
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
        });
    }

    function setcustomerid(id) {
        var data = {cusId: id};
        var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/getcustomer']) ?>";
        $.post(url, data, function(result) {
            $("#detailcustomer").html(result);
        });
    }

    function addSubpromise() {
        var upper = "<?php echo $model['id'] ?>";
        var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/addsubpromise']) ?>";
        var custometId = $("#custometId").val();
        var data = {
            custometId: custometId,
            upper: upper,
            createat: "<?php echo $model['createat'] ?>",
            promisedatebegin: "<?php echo $model['promisedatebegin'] ?>",
            promisedateend: "<?php echo $model['promisedateend'] ?>",
            recivetype: "<?php echo $model['recivetype'] ?>",
            unitprice: "<?php echo $model['unitprice'] ?>"
        };
        $.post(url, data, function(result) {
            if (result == 1) {
                alert("!...ไม่สามารถเลือกสถานบริการนี้ได้เนื่องจากยังคงสถานะการทำสัญญาหรือข้อตกลงอยู่");
                return false;
            } else {
                window.location.reload();
            }
            //$("#detailcustomer").html(result);
        });

    }

    function deletePromise(id) {
        var r = confirm("Are you sure..?");
        var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/deletesubpromise']) ?>";
        var data = {id: id}
        if (r == true) {
            $.post(url, data, function(res) {
                window.location.reload();
            });
        }
    }
</script>

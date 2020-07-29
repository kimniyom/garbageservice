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

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */
/* @var $form yii\widgets\ActiveForm */

$Config = new Config();
$yearUnit = array();
$levy = array();
$deposit = array();

//echo print_r($levy);
?>

<div class="promise-form">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="box box-success" id="box-left">
                <div class="box-header">ข้อมูลลูกค้า</div>
                <div class="box-body">
                    <div class="list-group">
                        <div class="list-group-item">
                            เลขที่ใบอนุญาต <span class="badge"><?php echo $customer['taxnumber'] ?></span>
                        </div>
                        <div class="list-group-item">
                            กลุ่มลูกค้า
                            <span class="badge"><?php echo $customer['groupcus'] ?></span>
                        </div>
                        <div class="list-group-item">
                            ประเภทการจดทะเบียน <span class="badge"><?php echo \app\models\Vattype::findOne($customer['typeregister'])['vattype'] ?></span>
                        </div>
                        <div class="list-group-item">
                            ชื่อลูกค้า <span class="badge"><?php echo $customer['company'] ?></span>
                        </div>
                        <div class="list-group-item">
                            เบอร์โทรศัพท์ <span class="badge">
                                <?php echo ($customer['tel']) ? $customer['tel'] : "" ?>
                                &nbsp;<?php echo ($customer['telephone']) ? $customer['telephone'] : "" ?>
                            </span>
                        </div>
                        <div class="list-group-item">
                            ชื่อผู้ประสานงาน <span class="badge"><?php echo $customer['manager'] ?></span>
                        </div>
                        <div class="list-group-item">
                            วันที่ลงทะเบียน <span class="badge"><?php echo $Config->thaidate($customer['create_date']) ?></span>
                        </div>
                        <hr/>
                        <div class="list-group-item">
                            User ผู้รับผิดชอบ <span class="badge"><?php echo $customer['username'] ?></span>
                        </div>
                    </div>
                    <div class="alert text-danger">
                        *สัญญาจะมีผลก็ต่อเมื่อมีการอัพโหลดไฟล์สัญญาที่มีลายมือชื่อทั้ง 2 ฝ่ายเข้าสู่ระบบแล้วเท่านั้น
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-8">
            <div class="box box-success">
                <div class="box-header">ข้อมูลสัญญา(<?php echo $customer['groupcus'] ?> <?php //echo $customer['grouptype']                                               ?>)</div>
                <div class="box-body"  id="box-right" style=" position: relative; overflow: auto;">
                    <div class="well">
                        <?php
                        //$form = ActiveForm::begin();
                        $form = ActiveForm::begin([
                                    'type' => ActiveForm::TYPE_VERTICAL,
                        ]);
                        ?>
                        <!--
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                        <?php //$form->field($model, 'promisenumber')->textInput(['maxlength' => true])   ?>
                                </div>
                                <div class="col-md-12 col-lg-6">
                        <?php //$form->field($model, 'active')->dropDownList([1 => 'ใช้งาน', 0 => 'ไม่ใช้งาน'], [], ['options' => ['onchange' => 'getrecivetype()']])   ?>
                                </div>
                            </div>
                        -->
                        <div class="row">
                            <div class="col-md-6 col-lg-5">
                                <?=
                                $form->field($model, 'createat')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ],
                                    'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);
                                ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-5">
                                <?=
                                $form->field($model, 'promisedatebegin')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ],
                                    'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);
                                ?>
                            </div>
                            <div class="col-md-6 col-lg-5">
                                <?=
                                $form->field($model, 'promisedateend')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ], 'options' => ['class' => 'form-control', 'autocomplete' => 'off']]);
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-lg-5">
                                <?php $listPackage = ArrayHelper::map(Maspackage::find()->where("id = '2'")->all(), 'id', 'package'); ?>
                                <?php
                                echo $form->field($model, 'recivetype')->widget(Select2::classname(), [
                                    'data' => $listPackage,
                                    'language' => 'th',
                                    'options' => [
                                        'placeholder' => '... ประเภทการจ้าง ...',
                                        'id' => 'RECIVETYPE',
                                        'onchange' => 'getrecivetype(this.value)',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                        //'onchange' => 'getrecivetype(this.value)',
                                ]);
                                ?>
                                <?php
                                /*
                                  echo $form->field($model, 'recivetype')->dropDownList($listPackage, [
                                  'onchange' => 'getrecivetype(this.value)',
                                  ]
                                  );
                                 */
                                ?>
                            </div>


                            <div class="col-md-4 col-lg-3">
                                <?=
                                $form->field($model, 'vat')->dropDownList([
                                    0 => 'ไม่เอา vat', 1 => 'เอา vat',
                                        ], [
                                    'onchange' => 'getvattype()',
                                ])
                                ?>
                            </div>
                            <div class="col-md-4 col-lg-4" id="divvattype" style="display: none;">
                                <?=
                                $form->field($model, 'vattype')->dropDownList(
                                        [
                                            //0 => 'ปกติ',
                                            1 => 'รวม vat',
                                            2 => 'ไม่รวม vat'
                                        ]
                                )
                                ?>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-5">
                                <?php
                                echo $form->field($model, 'payment')->dropDownList([
                                    "" => "== กรุณาเลือก ==",
                                    "1" => 'จ่ายรายเดือน',
                                        //1 => 'เหมาจ่าย',
                                        ], [
                                        //'onchange' => 'setDistcount()',
                                ])
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-lg-5">
                                <?= $form->field($model, 'yearunit')->hiddenInput(['value' => '1'])->label(false) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div id="unit" style=" display: none;">
                                <div class="col-md-4 col-lg-4">
                                    <?=
                                    $form->field($model, 'unitprice')->textInput(
                                            [
                                                'onkeyup' => 'calculation()'
                                            ]
                                    )
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4" id="garbageweight" style=" display: none;">
                                <?=
                                $form->field($model, 'garbageweight')->textInput(
                                        [
                                            'onkeyup' => 'calculation()',
                                        ]
                                )
                                ?>
                            </div>
                            <div class="col-md-4 col-lg-4" id="divlevy" style=" display: none;">
                                <?=
                                $form->field($model, 'levy')->dropDownList(
                                        $levy, [
                                    'onchange' => 'calculation()',
                                        ]
                                )
                                ?>
                            </div>
                        </div>

                        <div class="row" id="divmonth" style=" display: none;">
                            <div class="col-md-8 col-lg-5">
                                <?=
                                $form->field($model, 'rate')->textInput(
                                        [
                                            'onkeyup' => 'calculationtype3()',
                                        ]
                                )
                                ?>
                            </div>
                            <div class="col-md-5 col-lg-5">
                                <?= $form->field($model, 'deposit')->dropDownList($deposit, ['prompt' => 'ไม่มีมัดจำ']) ?>
                            </div>
                        </div>
                        <div class="fine" style=" display: none;">
                            <h4>ค่าปรับ</h4>
                            <hr style="margin-top:0px;"/>
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <?= $form->field($model, 'fine')->textInput() ?>
                                </div>
                            </div>
                        </div>

                        <div class="distcount" style=" display: none;">
                            <h4>ส่วนลด</h4>(*ถ้ามีการแก้ไขข้อมูลข้างบนส่วนลดจะต้องคำนวณใหม่ทุกครั้ง)
                            <hr style="margin-top:0px;"/>
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <?=
                                    $form->field($model, 'distcountpercent')->textInput(
                                            [
                                                //'value' => 0,
                                                'onkeyup' => 'calculationPercent()',
                                            ]
                                    )
                                    ?>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <?=
                                    $form->field($model, 'distcountbath')->textInput(
                                            [
                                                //'value' => 0,
                                                'onkeyup' => 'calculationBath()',
                                            ]
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="divyear" style=" display: none">
                            <div class="col-md-3 col-lg-5">
                                <?= $form->field($model, 'payperyear')->textInput(['readonly' => 'readonly']) ?>
                            </div>
                            <div class="col-md-3 col-lg-5">
                                <?= $form->field($model, 'total')->textInput(['readonly' => 'readonly']) ?>
                            </div>
                        </div>

                        <div id="manager" style="display: none">
                            <h4>ผู้ว่าจ้าง และพยาน</h4>
                            <hr style="margin-top:0px;"/>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <?= $form->field($model, 'employer1')->textInput() ?>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?= $form->field($model, 'employer2')->textInput() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <?= $form->field($model, 'witness1')->textInput() ?>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <?= $form->field($model, 'witness2')->textInput() ?>
                                </div>
                            </div>
                        </div>

                        <input type="checkbox" id="accept"/> *ให้แน่ใจว่าข้อมูลที่จะบันทึกถูกต้องครบถ้วนแล้ว
                        เมื่อท่านบันทึกข้อมูลจะไม่สมารถแก้ไขข้อมูลได้ในภายหลัง ต้องลบและสร้างใหม่เท่านั้น

                        <!-- <div class="row">
                            <div class="col-md-12 col-lg-6">
                        <?php //$form->field($model, 'status')->dropDownList(['0' => 'หมดสัญญา', '1' => 'รอยืนยัน', '2' => 'กำลังใช้งาน', '3' => 'กำลังต่อสัญญา'], ['prompt' => 'สถานะสัญญา'])      ?>
                            </div>
                            <div class="col-md-12 col-lg-6">
                        <?php //$form->field($model, 'checkmoney')->dropDownList(['0' => 'ยังไม่ได้ชำระ', '1' => 'ชำระเงินแล้ว'], ['prompt' => 'สถานะการชำระเงิน'])     ?>
                            </div>
                        </div> -->
                        <?php if ($error) { ?>
                            <div class="alert alert-danger"><?php echo $error ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <div id="btn-save" style="display:none;">
                            <?= Html::submitButton('บันทึกข้อมูลสัญญา', ['class' => 'btn btn-success']) ?>
                        </div>
                        <div id="btn-save-hide">
                            <div class="btn btn-default disabled">บันทึกข้อมูลสัญญา</div>
                        </div>

                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="popupsetYear" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                -->
                <h4 class="modal-title">ค่าจ้างต่อปี</h4>
            </div>
            <div class="modal-body">
                ค่าจ้างปีละ
                <input type="text" class="form-control" id="totalYear" onKeyUp="if (this.value * 1 != this.value)
                            this.value = '';"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="javascript:window.location.reload();">Close</button>
                <button type="button" class="btn btn-primary" onclick="setTypePromise();">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
$this->registerJs("$(document).ready(function() {
        if ($('#accept').is(':checked')) {
            $('#btn-save').show();
            $('#btn-save-hide').hide();
        } else {
            $('#btn-save-hide').show();
            $('#btn-save').hide();
        }

        $('#accept').click(function() {
            if ($(this).is(':checked')) {
                $('#btn-save').show();
                $('#btn-save-hide').hide();
            } else {
                $('#btn-save-hide').show();
                $('#btn-save').hide();
            }
        });
    })
    ");
$this->registerJs("setScreen();");
if ($model->id == "") {
    //$this->registerJs("getrecivetype();");
    //$this->registerJs("setDistcount()");
} else {
    $this->registerJs("getrecivetypeEdit(" . $model->recivetype . ");");
    $this->registerJs("getvattype()");
    /*
      $this->registerJs("
      setDistcount();
      ");
     */
}
?>
<script>
    function setdistCount(val) {
        //Set Default Distcount
        var paymentId = val;
        var url = "<?php echo Url::to(['promise/getpayment']) ?>";
        var data = {id: paymentId};
        $.post(url, data, function(res) {
            //alert(res);
            if (res == 1) {
                $(".distcount").show();
            } else {
                var price = $("#promise-payperyear").val();
                $("#promise-total").val(price);
                $(".distcount").hide();
            }
        });
        /*
         var payment = $("#promise-payment").val();
         var type = parseInt($("#promise-recivetype").val());
         if (type != 2) {
         if (payment == 0) {
         $(".distcount").hide();
         } else {
         $(".distcount").show();
         }
         } else {
         $(".distcount").hide();
         }
         */
    }

    function getvattype() {
        var vat = $("#promise-vat").val();
        if (vat == 0) {
            $("#divvattype").hide();
        } else if (vat == 1) {
            $("#divvattype").show();
        }
    }

    function getrecivetype(type) {
        resetForm();
        $("#promise-payment").val("");
        //var payment = $("#promise-payment").val();
        //if (payment == 0) {
        //$(".distcount").hide();
        //} else {
        //$(".distcount").show();
        //}
        if (type == 1) {
            $("#garbageweight").show();
            $(".fine").hide();
            $("#divmonth").hide();
            $("#divyear").hide();
            //$(".distcount").show();
            $("#dateservice").hide();
            $("#unit").hide();
            //calculation();
        } else if (type == 2) {
            $(".fine").hide();
            $("#divmonth").hide();
            //$(".distcount").hide();
            $("#garbageweight").hide();
            $("#divyear").hide();
            $("#promise-rate").val(0);
            $("#promise-payperyear").val(0);
            $("#dateservice").hide();
            $("#unit").show();
        } else if (type == 3) {
            $("#divmonth").hide();
            $("#garbageweight").hide();
            //$(".distcount").show();
            $(".fine").hide();
            $("#dateservice").hide();
            $("#unit").hide();
            $("#divyear").hide();
            $("#popupsetYear").modal();
            //$("#promise-payperyear").removeAttr("readonly");
            //$("#promise-payperyear").focus();
        }
    }

    function getrecivetypeEdit(type) {
        //resetForm();
        $("#promise-payment").val("");
        if (type == 1) {
            $("#garbageweight").show();
            $(".fine").show();
            $("#divmonth").show();
            $("#divyear").show();
            //$(".distcount").show();
            $("#dateservice").show();
            $("#unit").show();
            //calculation();
        } else if (type == 2) {
            $(".fine").hide();
            $("#divmonth").hide();
            //$(".distcount").hide();
            $("#garbageweight").hide();
            $("#divyear").hide();
            $("#promise-rate").val(0);
            $("#promise-payperyear").val(0);
            $("#dateservice").hide();
            $("#unit").show();
        } else if (type == 3) {
            $("#divmonth").show();
            $("#garbageweight").show();
            //$(".distcount").show();
            $(".fine").show();
            $("#dateservice").show();
            $("#unit").hide();
            $("#divyear").show();
            //$("#popupsetYear").modal();
            //$("#promise-payperyear").removeAttr("readonly");
            //$("#promise-payperyear").focus();
        }
    }

    function calculation() {
        //var total = "";
        //var totalSum = "";
        //var vat = $("#promise-vat").val();
        //var types = parseInt($("#RECIVETYPE").val());
        //$("#promise-unitprice").val(0);
        //$("#promise-garbageweight").val(0);
        //$("#promise-garbageweight").val(0);
        //$("#promise-rate").val(0);
        //$("#promise-fine").val(0);
        //var unit = 0;
        //var garbageweight = 0;
        //var levy = parseInt($("#promise-levy").val());
        //var payment = parseInt($("#promise-payment").val());
        //enable vattype
        //getvattype();
        var totalyear;
        //$("#fine").hide();
        if (types == 1) {
            total = (unit * levy);
            totalyear = (total * 12);
            let vatBath = (totalyear * 7) / 100;
            /*
             if (vat == 1) {
             totalSum = (totalyear - vatBath);
             } else {
             totalSum = totalyear;
             }
             */
            $("#promise-rate").val(0);
            $("#promise-payperyear").val(0);
            $("#promise-total").val(totalyear);
            $("#promise-distcountpercent").val(0);
            $("#promise-distcountbath").val(0);
        } else if (types == 3) {
            /*
             total = (unit * levy);
             totalyear = (total * 12);
             let vatBath = (totalyear * 7) / 100;
             if (vat == 1) {
             totalSum = (totalyear - vatBath);
             } else {
             totalSum = totalyear;
             }
             $("#promise-rate").val(total);
             $("#promise-payperyear").val(parseInt(totalSum));
             $("#promise-total").val(parseInt(totalSum));
             $("#promise-distcountpercent").val(0);
             $("#promise-distcountbath").val(0);
             */
        }
    }

    function calculationtype3() {
        var type = parseInt($("#promise-recivetype").val());
        var rate = parseInt($("#promise-rate").val());
        var totalyear;
        var totalSum;
        //enable vattype
        getvattype();

        if (type == 3)
        {
            totalyear = (rate * 12);
            totalSum = totalyear;
            $("#promise-payperyear").val(parseInt(totalSum));
            $("#promise-total").val(totalSum);
            $("#promise-distcountpercent").val(0);
            $("#promise-distcountbath").val(0);
        }
    }

    function calculationPercent() {
        var totalYear = parseInt($("#promise-payperyear").val());
        var percent = parseInt($("#promise-distcountpercent").val());
        var distCount = ((totalYear * percent) / 100);
        var totalAll = (totalYear - distCount);
        $("#promise-distcountbath").val(distCount);
        $("#promise-total").val(totalAll);
    }

    function calculationBath() {
        var totalYear = parseInt($("#promise-payperyear").val());
        $("#promise-distcountpercent").val(0);
        var distCount = $("#promise-distcountbath").val();
        var totalAll = (totalYear - distCount);
        //$("#promise-distcountbath").val(distCount);
        $("#promise-total").val(parseInt(totalAll));
    }

    function setScreen() {
        var h = window.innerHeight;
        $("#box-left").css({"height": h - 141});
        $("#box-right").css({"height": h - 255});
    }

    function setTypePromise() {
        var total = parseInt($("#totalYear").val());
        if (total == "") {
            alert("กรุณากรอกจำนวน...");
            $("#totalYear").focus();
            return false;
        }
        var totamonth = (total / 12);
        $("#promise-payperyear").val(total);
        $("#promise-total").val(total);
        $("#promise-rate").val(totamonth.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        $("#popupsetYear").modal("hide");
    }

    function resetForm() {
        $("#promise-vat").val("");
        $("#promise-yearunit").val("");
        $("#promise-vattype").val("");
        $("#promise-unitprice").val("");
        $("#promise-payment").val("");
        $("#promise-rate").val("");
        $("#promise-payperyear").val(0);
        $("#promise-total").val(0);
        $("#promise-distcountpercent").val(0);
        $("#promise-distcountbath").val(0);
        $("#promise-garbageweight").val("");
        $("#promise-levy").val("");
        $("#promise-deposit").val("");
        $("#promise-totalYear").val("");
        $("#promise-fine").val("");
    }
</script>

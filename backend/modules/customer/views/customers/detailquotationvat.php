
<style type="text/css">
    #invoice{
        position: relative;
    }

    #invoice table thead tr td{
        font-size: 14px;
    }

    #invoice table thead tr th{
        font-size: 14px;
    }


    #invoice table tbody tr td{
        font-size: 14px;
    }

    @media print {
        .text-body{
            font-size: 8px;
        }

        table thead tr th{
            font-size: 10px;
        }


        table tbody tr td{
            font-size: 10px;
        }


    }

</style>

<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\customer\models\Customers;
use yii\helpers\Url;
use app\models\Config;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$Config = new Config();
$this->title = 'ใบเสนอราคา';
$this->params['breadcrumbs'][] = $this->title;
?>
<a href="<?php echo Url::to(['quotation']) ?>">
    <button type="button" class="btn btn-default">
        <i class="fa fa-chevron-circle-left fa-2x"></i> <span style="font-size: 18px;">กลับ</span></button></a>
<button type="button" class="btn btn-default" id="quot">
    <i class="fa fa-plus fa-2x"></i> <span style="font-size: 18px;">ทำใบเสนอราคา</span></button>
<br/><br/>
<div class="box" id="box-detail">
    <div class="box-header" style=" padding-bottom: 0px;">
        <h4>ข้อมูลลูกค้า</h4>
    </div>
    <div class="box-body" style="padding-top:0px;">
        <table class="table">
            <tr>
                <td style="text-align: right; width: 200px;">เรื่อง</td>
                <td><?php echo $datas['title'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">สถานบริการ / บริษัท</td>
                <td><?php echo $datas['customername'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">ประเภทสถานบริการ</td>
                <td><?php echo $datas['typename'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">ชื่อผู้ติดต่อ</td>
                <td><?php echo $datas['contact'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">โทรศัพท์</td>
                <td><?php echo $datas['tel'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">ที่อยู่</td>
                <td>
                    <?php echo $datas['address'] ?>&nbsp;
                    ต.<?php echo $datas['tambon_name'] ?>&nbsp;
                    อ.<?php echo $datas['ampur_name'] ?>&nbsp;
                    จ.<?php echo $datas['tambon_name'] ?>&nbsp;
                    <?php echo $datas['zipcode'] ?>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">วัน - เวลา ที่เปิดทำการ</td>
                <td><?php echo $datas['dayopen'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">สถานที่ตั้ง</td>
                <td><?php echo ($datas['location']) ? $datas['location'] : "-"; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">รอบจัดเก็บ (ครั้งต่อสัปดาห์)</td>
                <td><?php echo $datas['roundofweek'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">รวมจำนวนครั้งต่อเดือน</td>
                <td><?php echo $datas['roundofmount'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">ราคาต่อเดือน</td>
                <td><?php echo $datas['priceofmount'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">ราคาต่อปี</td>
                <td><?php echo $datas['priceofyear'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">ออกบิลในนาม</td>
                <td><?php echo $datas['vattype'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">vat</td>
                <td><?php echo $datas['vat'] ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">รอบการชำระเงิน</td>
                <td><?php echo ($datas['roundprice'] == "1") ? "รายเดือน" : "รายปี"; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">รายละเอียดอื่น ๆ</td>
                <td><?php echo ($datas['detail']) ? $datas['detail'] : "-"; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">วันที่บันทึก</td>
                <td><?php echo $datas['d_update'] ?></td>
            </tr>
        </table>
    </div>
</div>

<div id="head-invoice"></div>
<?php if ($datas['status'] == 0) { ?>
    <div class="row">
        <div class="col-md-4 col-lg-4">
            <label>วันกำหนดส่งมอบงาม</label>
            <input type="text" id="duedate" class="form-control" value="<?php echo $datas['duedate'] ?>"/>
        </div>
        <div class="col-md-4 col-lg-4">
            <label>เงื่อนไขการชำระเงิน</label>
            <input type="text" id="createdittime" class="form-control" value="<?php echo $datas['createdittime'] ?>"/>
        </div>
        <div class="col-md-4 col-lg-4">
            <label>ยืนยันราคาภายใน</label>
            <input type="text" id="expiredate" class="form-control" value="<?php echo $datas['expiredate'] ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <label>จำนวนจุดจัดเก็บ</label>
            <input type="text" id="numpoint" class="form-control" value="<?php echo $datas['numpoint'] ?>"/>
        </div>
        <div class="col-md-9 col-lg-9">
            <label>สถานที่</label>
            <input type="text" id="locationpoint" class="form-control" value="<?php echo $datas['locationpoint'] ?>"/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <button class="btn btn-default" onclick="onUpdate()"><i class="fa fa-plus"></i> เพิ่มรายละเอียด</button>
        </div>
    </div>
    <br/>
<?php } ?>
<?php if ($datas['status'] == 1) { ?>
    <button type="button" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์ใบเสนอราคา</button>
<?php } ?>
<div style="background:#ffffff; padding:20px; width: 210mm;" id="invoice">

    <div style="width:50%; left:30px;  position:absolute; z-index: 10; top:50px;">
        <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
    </div>

    <div style="text-align:center; margin-bottom: 0px;">
        <b>บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด</b><br/>
        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
        เลขที่ 50/9 หมู่ 6  ตำบล บางหลวง อำเภอเมือง จังหวัด ปทุมธานี 12000 <br/>
        12/1  Moo 8  Bangkuwat , Mueng , Pathumthani 12000<br/>
        โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564 E-mail : iccquality@icqs.net
    </div>

    <table style="width: 100%;">
        <tr>
            <td style=" width: 70%; text-align: center;">
                <h2>ใบเสนอราคา(Quotation)</h2>
            </td>
            <td style="width:30%;">
                <div style="right:20px; text-align: right;">
                    เลขที่(NO.): <?php echo $no ?><br/>
                    วันที่(Date): <?php echo $Config->thaidate(date("Y-m-d")) ?>
                </div>
            </td>
        </tr>
    </table>

    <table class="table table-bordered">
        <tr>
            <td style=" width: 55%; font-size: 12px; font-weight: bold;">
                รหัสลูกค้า(Customer Code): <?php echo $cusCode ?><br/>
                ชื่อบริษัทลูกค้า(Company Name): <?php echo $datas['customername'] ?><br/>
                ชื่อผู้ติดต่อ(Name): <?php echo $datas['contact'] ?><br/>
                ที่อยู่ <?php echo $datas['address'] ?>&nbsp;
                ต.<?php echo $datas['tambon_name'] ?>&nbsp;
                อ.<?php echo $datas['ampur_name'] ?>&nbsp;
                จ.<?php echo $datas['changwat_name'] ?>&nbsp;
                <?php echo $datas['zipcode'] ?><br/>
                โทรศัพท์(Phone Number): <?php echo $datas['tel'] ?><br/>
                อีเมล์(E-mail): -<br/>
            </td>
            <td style=" width: 45%; font-size: 12px;" >
                วันกำหนดส่งมอบงาน(Due Date): <?php echo $datas['duedate'] ?> วัน<br/>
                เงื่อนไขการชำระเงิน(Credit Term): <?php echo $datas['createdittime'] ?><br/>
                ยืนยันราคาภายใน(Expire Date): <?php echo $datas['expiredate'] ?>
                <hr style="margin-top:2px; margin-bottom: 2px;"/>
                <b>จุดจัดเก็บ</b> : จำนวน <?php echo $datas['numpoint'] ?> จุด<br/>
                <b>สถานที่</b> : <?php echo $datas['locationpoint'] ?>
            </td>
        </tr>
    </table>

    <table class="table table-bordered" id="tables">
        <thead>
            <tr>
                <th style="text-align: center; width: 10%; padding: 5px;  font-size: 12px;">รหัสบริการ<br/>Code No.</th>
                <th style="text-align:center; width: 40%; padding: 5px;  font-size: 12px;">รายการรับบริการ<br/>Description</th>
                <th style="text-align:center;padding: 5px;  font-size: 12px;">รอบการจัดเก็บ<br/>Period of time</th>
                <th style="text-align:center;padding: 5px;  font-size: 12px;">จำนวน<br/>Quantity</th>
                <th style="text-align:center;padding: 5px;  font-size: 12px;">หน่วย<br/>Unit</th>
                <th style="text-align:center;padding: 5px;  font-size: 12px;">ราคาเหมาจ่าย<br/>Price/Month</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = 0;
            $i = 0;
            foreach ($quotation as $rs): $i++;
                $sum = $sum + (int) $rs['priceofmonth'];
                ?>
                <tr>
                    <td style=" text-align: center;padding: 5px; font-size: 12px;" class="text-body"><?php echo $i ?></td>
                    <td class="text-body" style="padding: 5px; font-size: 12px;"><?php echo $rs['description'] ?></td>
                    <td class="text-body" style="padding: 5px; font-size: 12px;"><?php echo $rs['periodoftime'] ?></td>
                    <td class="text-body" style="padding: 5px; font-size: 12px;"><?php echo $rs['quantity'] ?></td>
                    <td class="text-body" style="padding: 5px; font-size: 12px; width: 12%;"><?php echo $rs['unit'] ?></td>
                    <td style="text-align:right;padding: 5px; font-size: 12px; width: 13%;" class="text-body">
                        <?php echo number_format($rs['priceofmonth']) ?>
                        <?php if ($datas['status'] == 0) { ?>
                            <i class="fa fa-trash text-danger" style=" cursor: pointer;" onclick="deleteQuotation(<?php echo $rs['id'] ?>)"></i>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if ($datas['status'] == 0) { ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-default btn-block" onclick="onSave()">
                            <i class="fa fa-plus"></i>
                        </button>
                    </td>
                    <td><input type="text" class="form-control" id="description"/></td>
                    <td><input type="text" class="form-control" id="periodoftime"/></td>
                    <td><input type="text" class="form-control" id="quantity"/></td>
                    <td><input type="text" class="form-control" id="unit"/></td>
                    <td><input type="text" class="form-control" id="priceofmonth"/></td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td id="hbody"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php } ?>
            <!--
        <tr>
            <td style="font-size: 12px; font-weight: bold;">หมายเหตุ:<br/>
            <?php //if ($datas['status'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-block" onclick="onUpdateComment()"><i class="fa fa-plus"></i> </button>
            <?php //} ?>
            </td>
            <td colspan="3" style="font-size: 12px;">
            <?php //echo $datas['comment'] ?>
            <?php //if ($datas['status'] == 0) { ?>
                    <textarea class="form-control" id="comment" rows="3"></textarea>
            <?php //} ?>
            </td>
            <td></td>
            <td></td>
        </tr>
            -->
        </tbody>
        <tfoot>
            <tr>
                <td rowspan="5" style="font-size: 12px; font-weight: bold;">หมายเหตุ: <br/>
                    <?php if ($datas['status'] == 0) { ?>
                        <button type="button" class="btn btn-default btn-block" onclick="onUpdateComment()"><i class="fa fa-plus"></i> </button>
                    <?php } ?>
                </td>
                <td rowspan="5" colspan="2">
                    <?php echo $datas['comment'] ?>
                    <?php if ($datas['status'] == 0) { ?>
                        <textarea class="form-control" id="comment" rows="3"></textarea>
                    <?php } ?>
                </td>
                <td colspan="2">รวมเป็นเงิน</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">มอบส่วนลด</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">จำนวนหักส่วนลด</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">ภาษีมูลค่าเพิ่ม 7 %</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <th colspan="3" style="text-align:center;  font-size: 12px;">
                    <?php echo $Config->Convert($sum) ?>
                </th>
                <th style="text-align:right; font-size: 12px;" colspan="2">จำนวนเงินรวมทั้งสิ้น</th>
                <th style="text-align:right; font-size: 12px;"><?php echo number_format($sum) ?></th>
            </tr>
            <tr>
                <th colspan="6" style=" font-size: 12px;">
                    <b style=" font-size: 12px;">ชำระเงินโดย:</b>
                    <?php echo $datas['payment'] ?>
                    <?php if ($datas['status'] == 0) { ?>
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <button type="button" class="btn btn-default btn-block" onclick="onUpdatePayment()"><i class="fa fa-plus"></i> </button>
                            </div>
                            <div class="col-md-9 col-lg-9">
                                <input type="text" id="payment" class="form-control" value="<?php echo $datas['payment'] ?>"/>
                            </div>
                        </div>
                    <?php } ?>
                </th>
            </tr>
            <tr>
                <th colspan="6" style=" font-size: 12px;">
                    <div style="width: 30%; float: left; margin-right: 40px;">
                        <div style=" text-align: center; margin-bottom: 40px;">เสนอราคาโดย:</div>
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div>
                        <div style="text-align:center;margin-top: 10px;">เจ้าหน้าที่ฝ่ายขาย</div>
                    </div>
                    <div style="width: 30%; float: left;">
                        <div style=" text-align: center; margin-bottom: 40px;">อนุมัติโดย:</div>
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div>
                        <div style="text-align:center; margin-top: 10px;">ผู้จัดการทั่วไป</div>
                    </div>
                    <div style="width: 30%; float: right;">
                        <div style=" text-align: center; margin-bottom: 40px;">ผู้รับบริการ:</div>
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div>
                        <div style="text-align:center;margin-top: 10px;">ผู้มีอำนาจลงนาม</div>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<?php if ($datas['status'] == 0) { ?>
    <hr/>
    <button type="button" class="btn btn-success" onclick="confirmQuotation()"><i class="fa fa-save"></i> บันทึกใบเสนอราคา</button>
<?php } ?>
<button type="button" id="top" class="btn btn-default" style="position: fixed; right: 10px; bottom: 10px; z-index: 5; display: none;">Click To Top</button>

<script type="text/javascript">
    function onSave() {
        var url = "<?php echo Yii::$app->urlManager->createUrl('customer/customers/saveqoutation') ?>";
        var description = $("#description").val();
        var periodoftime = $("#periodoftime").val();
        var quantity = $("#quantity").val();
        var unit = $("#unit").val();
        var priceofmonth = $("#priceofmonth").val();
        var id = "<?php echo $datas['id'] ?>";
        var data = {
            id: id,
            description: description,
            periodoftime: periodoftime,
            quantity: quantity,
            unit: unit,
            priceofmonth: priceofmonth
        };
        if (description == "" || periodoftime == "" || quantity == "" || unit == "" || priceofmonth == "") {
            alert("กรอกข้อมูลไม่ครบ");
            return false;
        }

        $.post(url, data, function(res) {
            window.location.reload();
        });
    }

    function onUpdate() {
        var id = "<?php echo $datas['id'] ?>";
        var duedate = $("#duedate").val();
        var createdittime = $("#createdittime").val();
        var expiredate = $("#expiredate").val();
        var numpoint = $("#numpoint").val();
        var locationpoint = $("#locationpoint").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl('customer/customers/updatequotation') ?>";
        var data = {
            id: id,
            duedate: duedate,
            createdittime: createdittime,
            expiredate: expiredate,
            numpoint: numpoint,
            locationpoint: locationpoint
        };
        if (duedate == "" || createdittime == "" || expiredate == "" || numpoint == "" || locationpoint == "") {
            alert("กรอกข้อมูลไม่ครบ");
            return false;
        }

        $.post(url, data, function(res) {
            window.location.reload();
        });
    }

    function setComment() {
        var commentVal = "<?php echo $datas['comment'] ?>";
        var comments = commentVal.split("&nbsp;").join(" ");
        var comment = comments.split("<br/>").join("\n");
        $("#comment").val(comment);
    }

    function onUpdateComment() {
        var id = "<?php echo $datas['id'] ?>";
        var commentval = $("#comment").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl('customer/customers/updatecomment') ?>";
        var comments = commentval.replace(/ /g, "&nbsp;");
        var comment = comments.split("\n").join("<br/>");
        var data = {
            id: id,
            comment: comment
        };
        if (comment == "") {
            alert("กรอกข้อมูลไม่ครบ");
            return false;
        }

        $.post(url, data, function(res) {
            window.location.reload();
        });
    }

    function onUpdatePayment() {
        var id = "<?php echo $datas['id'] ?>";
        var payment = $("#payment").val();
        var url = "<?php echo Yii::$app->urlManager->createUrl('customer/customers/updatepayment') ?>";
        var data = {
            id: id,
            payment: payment
        };
        if (payment == "") {
            alert("กรอกข้อมูลไม่ครบ");
            return false;
        }

        $.post(url, data, function(res) {
            window.location.reload();
        });
    }

    function deleteQuotation(id) {
        var r = confirm("Are you sure");
        if (r == true) {
            var url = "<?php echo Yii::$app->urlManager->createUrl('customer/customers/deletequotation') ?>";
            var data = {id: id};
            $.post(url, data, function(res) {
                window.location.reload();
            });
        }
    }

    function confirmQuotation() {
        var r = confirm("ตรวจสอบข้อมูลก่อนบันทึก");
        var id = "<?php echo $datas['id'] ?>";
        var no = "<?php echo $no ?>";
        var code = "<?php echo $cusCode ?>";
        if (r == true) {
            var url = "<?php echo Yii::$app->urlManager->createUrl('customer/customers/confirmquotation') ?>";
            var data = {
                id: id,
                no: no,
                code: code
            };
            $.post(url, data, function(res) {
                window.location.reload();
            });
        }
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

<?php
$this->registerJs('
        setComment();
        settables();
        $(document).ready(function() {
            $("#quot").click(function() {
                $("html, body").animate({
                    scrollTop: $("#head-invoice").offset().top
                });
                $("#top").show();
            });

            $("#top").click(function() {
                 $("html, body").animate({ scrollTop: 0 }, "slow");
                 $("#top").hide();
                 return false;
              });
        });
         ');
?>




<?php

use yii\helpers\Url;
use app\models\Config;

$Config = new Config();
?>

<?php if ($status > 0) { ?>
    <button type="button" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์ใบแจ้งหนี้</button>
<?php } ?>
<div style="background:#ffffff; padding:10px;" id="invoice">

    <div style="width:50%; left:20px;  position:absolute;">
        <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
    </div>

    <div style="width:30%; right:20px; text-align: right;position:absolute;">
        เลขที่ <?php echo $invnumber ?><br/>
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
            วันที่ <?php echo $Config->thaidate(date("Y-m-d")) ?>
    </div>

    <h4 style="text-align: center;">ใบเสนอราคา</h4>
    <div style="text-align:center;">
        <?php if ($type == 1) { ?>
            <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
            IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
            เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
            50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
            โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564 Eขmail : icqualitysystem2019@gmail.com<br/><br/>
        <?php } else { ?>
            <b></b>บริษัทไอซีควอลิตี้ ซิสเท็ม<br/>
            IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
            เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
            12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
            โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564 E-mail : iccqualitysystem2019@gmail.com<br/><br/>
        <?php } ?>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="6">
                    ชื่อลูกค้า <?php //echo $customer['company'] ?><br/>
                    ที่อยู่ <?php //echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?>

                </th>
            </tr>
            <tr>
                <th colspan="6">
                    ประจำเดือน <?php //echo $Config->thaidatemonth($rounddate) ?>
                </th>
            </tr>
            <tr>
                <th style="text-align: center;">#</th>
                <th>รายการ</th>
                <th style="text-align:right;">จำนวน กก.</th>
                <th style="text-align:right;">ราคา/หน่วย(บาท)</th>
                <th style="text-align:right;">ขยะเกิน(กก.)</th>
                <th style="text-align:right;">จำนวนเงิน(บาท)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = 0;
            $i = 0;
            foreach ($billdetail as $rs): $i++;
                $fineprice = ($promise['fine'] * $rs['garbageover']);
                $totalRow = ($promise['unitprice'] + $fineprice);
                $sum = $sum + $totalRow;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td>ค่ากำจัดขยะติดเชื้อ วันที่ <?php echo $Config->thaidate($rs['datekeep']) ?></td>
                    <td style="text-align:right;"><?php echo $rs['amount'] ?></td>
                    <td style="text-align:right;"><?php echo number_format($promise['unitprice'], 2) ?></td>
                    <td style="text-align:right;">
                        <?php
                        echo ($rs['garbageover'] > 0) ? $promise['fine'] . ' x ' . $rs['garbageover'] . " = " : "";
                        echo number_format($fineprice);
                        ?>
                    </td>
                    <td style="text-align:right;"><?php echo number_format($totalRow, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <?php
            $vatbath = 0;
            if ($vat == 1) {
                ?>
                <tr>
                    <th colspan="4" style="text-align:center;">

                    </th>
                    <th style="text-align:right;">ราคาสุทธิค่าบริการ</th>
                    <th style="text-align:right;">
                        <?php
                        echo number_format($sum, 2);
                        ?>
                    </th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align:center;">

                    </th>
                    <th style="text-align:right;">ภาษีมูลค่าเพิ่ม 7%</th>
                    <th style="text-align:right;">
                        <?php
                        //คำนวน vat
                        $vatbath = (($sum * 7) / 100);
                        echo number_format($vatbath, 2);
                        ?>
                    </th>
                </tr>
            <?php } ?>
            <tr>
                <th colspan="4" style="text-align:center;">
                    <?php
                    if ($vattype == 1) {//vat ลบ
                        $sumVat = ($sum - $vatbath);
                    } else if ($vattype == 2) {// vat เพิ่ม
                        $sumVat = ($sum + $vatbath);
                    } else {
                        $sumVat = $sum;
                    }
                    echo $Config->Convert($sumVat)
                    ?>
                </th>
                <th style="text-align:right;">จำนวนเงินทั้งสิ้น</th>
                <th style="text-align:right;"><?php echo number_format($sumVat, 2) ?></th>
            </tr>

            <tr>
                <th colspan="6">
                    <div style="width: 30%; float: left; margin-right: 40px;">
                        <br/>
                        ลงชื่อ
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                        <div style="text-align:center;">ผู้รับวางบิล</div>
                    </div>
                    <div style="width: 30%; float: left;">
                        <br/>
                        ลงชื่อ
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                        <div style="text-align:center;">ผู้วางบิล</div>
                    </div>
                    <div style="width: 30%; float: right;">
                        <br/>
                        ลงชื่อ
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                        <div style="text-align:center;">ผู้มีอำนาจลงนาม</div>
                    </div>
                </th>
            </tr>
            <?php if ($status <= 0) { ?>
                <tr>
                    <th colspan="6">
                        <!--if($i == $promise['levy'])-->
                        <?php if ($i > 0) { ?>
                            <button class="btn btn-success" type="button" onclick="saveInvoice()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                        <?php } else { ?>
                            <button class="btn btn-warning disabled" type="button"><i class="fa fa-info"></i> ยังไม่มีการจัดเก็บในรอบเดือน</button>
                        <?php } ?>
                    </th>
                </tr>
            <?php } ?>

        </tfoot>
    </table>
</div>
<input type="hidden" id="id" name="id" class="form-control" value="<?php echo $id ?>"/>



<script type="text/javascript">
    function saveInvoice() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/addinvoice']) ?>";
        var invoiceNumber = "<?php echo $invnumber ?>";
        var promiseId = "<?php echo $promise['id'] ?>";
        var total = "<?php echo $sum ?>";
        var roundId = "<?php echo $id ?>";
        var monthyear = "<?php echo $rounddate ?>";
        var dateinvoice = $("#dateinvoice").val();
        var datebill = $("#datebill").val();
        var data = {
            invoiceNumber: invoiceNumber,
            promiseId: promiseId,
            total: total,
            roundId: roundId,
            monthyear: monthyear,
            dateinvoice: dateinvoice,
            datebill: datebill
        }
        //console.log(data);

        $.post(url, data, function (datas) {
            getInvoice();
        });

    }

    function getInvoice() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getinvoice']) ?>";
        var promiseid = "<?php echo $promise['id'] ?>";
        var dateround = "<?php echo $rounddate ?>";
        var id = "<?php echo $id ?>";
        var invoice = "<?php echo $invnumber ?>";
        var data = {
            id: id,
            promiseid: promiseid,
            dateround: dateround,
            invoice: invoice,
            type: 1
        };
        $.post(url, data, function (datas) {
            $("#createbill").html(datas);
        });
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
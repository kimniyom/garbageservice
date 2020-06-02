<style tyle="text/css">
    table thead tr th{
        background:#eeeeee;
    }
</style>
<?php

use yii\helpers\Url;
use app\models\Config;

$Config = new Config();
?>

<button type="button" class="print" style="display:none;" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์ใบแจ้งหนี้</button>
<div style="background:#ffffff; padding:10px;" id="invoice">
    <div style="width:50%; left:20px;  position:absolute;">
        <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
    </div>

    <div style="width:30%; right:20px; text-align: right;position:absolute;">
        เลขที่ <?php echo $invnumber ?><br/>
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
        <?php if ($status > 0) { ?>
            วันที่ <?php echo $Config->thaidate($invoicedetail['dateinvoice']) ?>
        <?php } else { ?>
            วันที่
        <?php } ?>
    </div>

    <h4 style="text-align: center;">ใบวางบิล / ใบแจ้งหนี้</h4>
    <div style="text-align:center;">
        <?php if ($type == 1) { ?>
            <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
            IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
            เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
            50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
            โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564 Eขmail : icqualitysystem2019@gmail.com<br/><br/>
        <?php } else { ?>
            <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม<br/>
            IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
            เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
            12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
            โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564 E-mail : iccqualitysystem2019@gmail.com<br/><br/>
        <?php } ?>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="5">
                    ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                    ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?>
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th style="text-align:center;">รายการ</th>
                <th style="text-align:right;">ราคาต่อหน่วย(เดือนะ)</th>
                <th style="text-align:center;">จำนวน(ครั้ง)</th>
                <th style="text-align:right;">ค่าใช้จ่าย</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sum = 0;
            $i = 0;
            foreach ($billdetail as $rs): $i++;
                //$totalRow = ($promise['unitprice'] * $promise['levy']);
                $totalRow = $promise['rate'];
                $sum = $sum + $totalRow;
                $month = substr($rs['datekeep'], 5, 2);
                $year = substr($rs['datekeep'], 0, 4);
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td>ค่ากำจัดขยะติดเชื้อ ประจำเดือน (<?php echo $Config->month_shot()[$month] . " " . ($year + 543) ?>)</td>
                    <td style="text-align:right;"><?php echo number_format($promise['rate'], 2) ?></td>
                    <td style="text-align:center;"><?php echo $promise['levy'] ?></td>
                    <td style="text-align:right;"><?php echo number_format($promise['rate'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:center;">

                </th>
                <th style="text-align:left;">ยอดเงินสุทธิ</th>
                <th style="text-align:right;"><?php echo number_format($sum, 2) ?></th>
            </tr>
            <tr>
                <th colspan="3" style="text-align:center;"></th>
                <th style="text-align:left;">ส่วนลด <?php echo ($promise['distcountpercent']) ? $promise['distcountpercent'] . " %" : ""; ?></th>
                <th style="text-align:right;"><?php echo ($promise['distcountbath']) ? number_format($promise['distcountbath'], 2) : "-"; ?></th>
            </tr>
            <?php
            //ราคาหักส่วนลด
            $orderTotal = number_format($sum, 2);
            $distCountPromise = number_format($promise['distcountbath'], 2);
            $resultOrder = ($sum - $distCountPromise);
            ?>
            <?php if ($vat == 1) {//กรณีเอา vat?>
                <?php
                if ($vattype == 1) {//รวม vat
                    $vatbath = number_format((($resultOrder * 7) / 100), 2);
                    $totalvat = number_format(($resultOrder - $vatbath), 2);
                    $totalPromise = (($resultOrder - $vatbath) + $vatbath);
                    ?>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ราคาทั้งสิ้น</th>
                        <th style="text-align:right;"><?php echo $totalvat ?></th>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ภาษีมูลค่าเพิ่ม 7%</th>
                        <th style="text-align:right;"><?php echo $vatbath ?></th>
                    </tr>
                    <?php
                } else if ($vattype == 2) {//ไม่รวม vat
                    $vatbath = number_format((($resultOrder * 7) / 100), 2);
                    $totalvat = number_format($resultOrder, 2);
                    $totalPromise = ($resultOrder + $vatbath);
                    ?>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ราคาทั้งสิ้น</th>
                        <th style="text-align:right;"><?php echo $totalvat ?></th>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ภาษีมูลค่าเพิ่ม 7%</th>
                        <th style="text-align:right;"><?php echo $vatbath ?></th>
                    </tr>

                <?php } ?>
            <?php } else { ?>
                <?php $totalPromise = $resultOrder ?>
            <?php } ?>
            <tr>
                <th colspan="3" style="text-align:center; background:#eeeeee;">
                    <div style="text-align:left; float:left;background:#eeeeee;"><em>(ตัวอักษร)</em></div><?php echo $Config->Convert($totalPromise) ?>
                </th>
                <th style="text-align:left;background:#eeeeee;">ที่ต้องชำระ </th>
                <th style="text-align:right;background:#eeeeee;">
                    <?php echo number_format($totalPromise, 2) ?>
                </th>
            </tr>
            <tr>

            <tr>
                <th colspan="2">
                    <b>การชำระเงิน</b>
                    <ul>
                        <li><input type="radio" name="payment" id="payment"/> ชำระเงินสด</li>
                        <li><input type="radio" name="payment" id="payment"/> โอนผ่านบัญชีธนาคาร</li>
                    </ul>
                </th>
                <th colspan="3">
                    <br/>
                    ลงชื่อ
                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                    <div style="text-align:center;">ผู้มีอำนาจลงนาม</div>
                </th>
            </tr>
            <?php if ($status <= 0) { ?>
                <tr>
                    <th colspan="5">

                        <button class="btn btn-success" type="button" id="btn-save" onclick="saveInvoice()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>

                    </th>
                </tr>
            <?php } ?>

        </tfoot>
    </table>
</div>

<!-- /////////////////////// Bill ///////////////////////////-->
<br/>
<button type="button" class="print" style="display:none;" onclick="printDiv('bill')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
<div style="background:#ffffff; padding:10px;" id="bill">
    <div style="width:50%; left:20px;  position:absolute;">
        <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
    </div>
    <div style="text-align:center;">
        <div style="width:50%; float: right;">

            <div style="width:30%; right:20px; text-align: right;position:absolute;">
                เลขที่ <?php echo $invnumber ?><br/>
                อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
                <?php if ($status > 0) { ?>
                    วันที่ <?php echo $Config->thaidate($invoicedetail['dateinvoice']) ?>
                <?php } else { ?>
                    วันที่
                <?php } ?>
            </div>
        </div>
        <h4 style="text-align: center;">บิล / ใบเสร็จรับเงิน</h4>

        <?php if ($type == 1) { ?>
            <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
            IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
            เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
            50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
            โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564 Eขmail : icqualitysystem2019@gmail.com<br/><br/>
        <?php } else { ?>
            <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม<br/>
            IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
            เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
            12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
            โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564 E-mail : iccqualitysystem2019@gmail.com<br/><br/>
        <?php } ?>
    </div>

    <table class="table table-bordered">

        <tr>
            <th colspan="5">
                ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?>
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:right;">ราคาต่อหน่วย</th>
            <th style="text-align:center;">จำนวน</th>
            <th style="text-align:right;">ค่าใช้จ่าย</th>
        </tr>

        <?php
        $sum = 0;
        $i = 0;
        foreach ($billdetail as $rs): $i++;
            //$totalRow = ($promise['unitprice'] * $promise['levy']);
            $totalRow = $promise['rate'];
            $sum = $sum + $totalRow;
            $month = substr($rs['datekeep'], 5, 2);
            $year = substr($rs['datekeep'], 0, 4);
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td>ค่ากำจัดขยะติดเชื้อ ประจำเดือน (<?php echo $Config->month_shot()[$month] . " " . ($year + 543) ?>)</td>
                <td style="text-align:right;"><?php echo $promise['rate'] ?></td>
                <td style="text-align:center;"><?php echo $promise['levy'] ?></td>

                <td style="text-align:right;"><?php echo number_format($totalRow, 2) ?></td>
            </tr>
        <?php endforeach; ?>

        <tfoot>
            <tr>
                <th colspan="3" style="text-align:center;">

                </th>
                <th style="text-align:left;">ยอดเงินสุทธิ</th>
                <th style="text-align:right;"><?php echo number_format($sum, 2) ?></th>
            </tr>
            <tr>
                <th colspan="3" style="text-align:center;"></th>
                <th style="text-align:left;">ส่วนลด <?php echo ($promise['distcountpercent']) ? $promise['distcountpercent'] . " %" : ""; ?></th>
                <th style="text-align:right;"><?php echo ($promise['distcountbath']) ? number_format($promise['distcountbath'], 2) : "-"; ?></th>
            </tr>
            <?php
            //ราคาหักส่วนลด
            $orderTotal = number_format($sum, 2);
            $distCountPromise = number_format($promise['distcountbath'], 2);
            $resultOrder = ($sum - $distCountPromise);
            ?>
            <?php if ($vat == 1) {//กรณีเอา vat?>
                <?php
                if ($vattype == 1) {//รวม vat
                    $vatbath = number_format((($resultOrder * 7) / 100), 2);
                    $totalvat = number_format(($resultOrder - $vatbath), 2);
                    $totalPromise = (($resultOrder - $vatbath) + $vatbath);
                    ?>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ราคาทั้งสิ้น</th>
                        <th style="text-align:right;"><?php echo $totalvat ?></th>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ภาษีมูลค่าเพิ่ม 7%</th>
                        <th style="text-align:right;"><?php echo $vatbath ?></th>
                    </tr>
                    <?php
                } else if ($vattype == 2) {//ไม่รวม vat
                    $vatbath = number_format((($resultOrder * 7) / 100), 2);
                    $totalvat = number_format($resultOrder, 2);
                    $totalPromise = ($resultOrder + $vatbath);
                    ?>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ราคาทั้งสิ้น</th>
                        <th style="text-align:right;"><?php echo $totalvat ?></th>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:center;"></th>
                        <th style="text-align:left;">ภาษีมูลค่าเพิ่ม 7%</th>
                        <th style="text-align:right;"><?php echo $vatbath ?></th>
                    </tr>

                <?php } ?>
            <?php } else { ?>
                <?php $totalPromise = $resultOrder ?>
            <?php } ?>
            <tr>
                <th colspan="3" style="text-align:center; background:#eeeeee;">
                    <div style="text-align:left; float:left;background:#eeeeee;"><em>(ตัวอักษร)</em></div><?php echo $Config->Convert($totalPromise) ?>
                </th>
                <th style="text-align:left;background:#eeeeee;">ที่ต้องชำระ </th>
                <th style="text-align:right;background:#eeeeee;">
                    <?php echo number_format($totalPromise, 2) ?>
                </th>
            </tr>
            <tr>
                <th colspan="5">
                    <b>ชำระเงินโดย</b>
                    <ul>
                        <li><input type="radio" name="payment" id="payment"/> ชำระเงินสด</li>
                        <li><input type="radio" name="payment" id="payment"/> โอนผ่านบัญชีธนาคาร</li>
                    </ul>
                </th>
            </tr>
            <tr>
                <th colspan="5">
                    <br/><br/>
                    <div style="width:45%; float: left;">
                        ลงชื่อ
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                        <div style="text-align:center;">ผู้รับเงิน</div>
                    </div>

                    <div style="width:45%; float: right;">
                        ลงชื่อ
                        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                        <div style="text-align:center;">ผู้มีอำนาจลงนาม</div>
                    </div>
                </th>
            </tr>

        </tfoot>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var status = "<?php echo $status ?>";
        if (status > 0) {
            $(".print").show();
            $("#btn-save").hide();
        }
    });
    function saveInvoice() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/addinvoice']) ?>";
        var invoiceNumber = "<?php echo $invnumber ?>";
        var promiseId = "<?php echo $promise['id'] ?>";
        var total = "<?php echo $promise['total'] ?>";
        var dateinvoice = $("#dateinvoice").val();
        var datebill = $("#datebill").val();
        var data = {
            invoiceNumber: invoiceNumber,
            promiseId: promiseId,
            total: total,
            roundId: '',
            monthyear: '',
            dateinvoice: dateinvoice,
            datebill: datebill,
            type: 2
        };
        //console.log(data);

        $.post(url, data, function(datas) {
            $(".print").show();
            $("#btn-save").hide();
            getInvoice();
        });

    }

    function getInvoice() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getinvoiceyear']) ?>";
        var promiseid = "<?php echo $promise['id'] ?>";
        var invoice = "<?php echo $invnumber ?>";
        var data = {
            promiseid: promiseid,
            invoice: invoice
        };
        $.post(url, data, function(datas) {
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
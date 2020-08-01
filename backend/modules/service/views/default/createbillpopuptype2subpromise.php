<style type="text/css">
    #invoice table tbody td{
        padding: 2px;
    }
</style>
<?php

use yii\helpers\Url;
use app\models\Config;

$Config = new Config();
//ConfigBill
//ConfigBill
$arrayDateInvoice = array('1', '3'); //เอาวันที่
//ConfigBill
$arrayDate = array('3'); //เอาวันที่
?>
<div class="row">
    <div class="col-md-3 col-lg-3">
        <label>ส่วนลด(ถ้ามี)</label>
        <input type="text" class=" form-control" id="discount" value="0"/>
    </div>
    <div class="col-md-3 col-lg-3">
        <label>มัดจำ(ถ้ามี)</label>
        <input type="text" class=" form-control" id="deposit" value="0"/>
    </div>
    <div class="col-md-3 col-lg-3">
        <label>เครดิต(ถ้ามี)</label>
        <input type="text" class=" form-control" id="credit" />
    </div>
    <div class="col-md-3 col-lg-3">

        <?php if ($status <= 0) { ?>
            <button class="btn btn-success" type="button" onclick="saveInvoice()" style=" margin-top: 25px;"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
        <?php } ?>
    </div>
</div>



<?php
//ประเภทกลุ่มลูกค้า
//echo $customer['groupcustomer'] . " => " . $customer['grouptype'] . "<br/>";
//echo "แม่ข่าย => " . $customer['flag'] . "<br/>";
//echo (in_array($customer['grouptype'], $arrayDate)) ? "วันที่ => ไม่เอา" : "วันที่ => เอาวันที่";
?>

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="border-left: none;  ">รวม Vat</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">แยก Vat</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content" id="boxtypebill">
        <div role="tabpanel" class="tab-pane active" id="home">
            <?php if ($status > 0) { ?>
                <div style=" width: 100%; background: #ffffff;">
                    <button type="button" class="btn btn-default" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์ใบแจ้งหนี้</button>
                </div>
            <?php } ?>
            <div style="background:#ffffff; padding:10px; position: relative;" id="invoice">
                <div style="width:50%; left:20px;  position:absolute;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
                </div>

                <div style="width:30%; right:20px; text-align: right;position:absolute;font-family: THSarabun; font-size: 18px;">
                    เลขที่ <?php echo $invnumber ?><br/>
                    อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
                    <?php if ($status > 0 && in_array($customer['grouptype'], $arrayDateInvoice)) { ?>
                        วันที่ <?php echo $Config->thaidate($invoicedetail['dateinvoice']) ?>
                    <?php } else { ?>

                    <?php } ?>

                </div>

                <h4 style="text-align: center; font-family: THSarabun;font-size: 24px; font-weight: bold;">ใบวางบิล / ใบแจ้งหนี้</h4>
                <div style="text-align:center;font-family: THSarabun;font-size: 18px; font-weight: bold;">
                    <?php if ($customer['grouptype'] != 1) { ?>
                        <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
                        เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
                        50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564<br/><br/>
                    <?php } else { ?>
                        <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
                        เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
                        12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564<br/><br/>
                    <?php } ?>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                                ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?><br/>
                                เลขประจำตัวผู้เสียภาษี:<?php echo $customer['taxnumber'] ?><br/>
                                โทร. <?php echo $customer['tel'] ?>

                                <div class="pull-right">
                                    เครดิต  <?php echo ($invoicedetail['credit']) ? $invoicedetail['credit'] : "...... " ?> วัน
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ประจำเดือน <?php echo $Config->thaidatemonth($rounddate) ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;font-family: THSarabun;font-size: 18px;">No</th>
                            <th style="font-family: THSarabun;font-size: 18px;">รายละเอียด</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">จำนวน</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">หน่วยละ</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">จำนวนเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $sumDiscount = 0;
                        $sumDeposit = 0;
                        $i = 0;
                        foreach ($billdetail as $rs): $i++;
                            //$fineprice = ($promise['fine'] * $rs['garbageover']);
                            $totalRow = $rs['total'];
                            $sum = $sum + $totalRow;

                            //CongigBill
                            if ($status > 0) {
                                $sumDiscount = ($sum - $invoicedetail['discount']);
                                $sumDeposit = ($sumDiscount - $invoicedetail['deposit']);
                            }
                            ?>

                        <?php endforeach; ?>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <?php if ($vat == 1) { ?>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หมายเหตุ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ราคาสุทธิค่าบริการ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    <?php
                                    echo number_format($sum, 2);
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">1.กรุณาโอเงินผ่านธนาคารไทยพาณิชย์ บัญชีออมทรัพย์</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><font style=" text-decoration: underline;">หักส่วนลด</font></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['discount'], 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ชื่อบัญชี บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนหลังหักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDiscount, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">เลขบัญชี 372-259936-7</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักเงินมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['deposit'], 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">2.ส่งหลักฐานการชำระเงินระบุชื่อบริษัทและเดือนที่ชำระค่าบริการให้ชัดเจนส่งมาที่</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนเงินหลังหักมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDeposit, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    LineID:@icqualitysystem หรือทาง E-Mail:icquality@icqs.net
                                </th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ภาษีมูลค่าเพิ่ม 7%</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    <?php
                                    //คำนวน vat
                                    $vatbath = (($sumDeposit * 7) / 100);
                                    echo number_format($vatbath, 2);
                                    ?>
                                </th>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="3" style="text-align:center;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                <?php
//if ($vattype == 1) {//vat ลบ
//$sumVat = ($sum - $vatbath);
//} else if ($vattype == 2) {// vat เพิ่ม
                                $sumVat = ($sumDeposit + $vatbath);
//} else {
//$sumVat = $sum;
//}
                                echo $Config->Convert($sumVat)
                                ?>
                            </th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนเงินทั้งสิ้น</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumVat, 2) ?></th>
                        </tr>

                        <tr>
                            <th colspan="5">
                                <div style="width: 30%; float: left; margin-right: 40px;font-family: THSarabun;font-size: 18px;">
                                    <br/>
                                    ลงชื่อ
                                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                    <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้รับวางบิล</div>
                                </div>
                                <div style="width: 30%; float: left;font-family: THSarabun;font-size: 18px;">
                                    <br/>
                                    ลงชื่อ
                                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;font-size: 18px;"></div><br/>
                                    <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้วางบิล</div>
                                </div>
                                <div style="width: 30%; float: right;font-family: THSarabun;font-size: 18px;">
                                    <br/>
                                    ลงชื่อ
                                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;font-size: 18px;"></div><br/>
                                    <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้มีอำนาจลงนาม</div>
                                </div>

                            </th>
                        </tr>


                    </tfoot>
                </table>
            </div>
            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $id ?>"/>

            <!-- /////////////////////// Bill ///////////////////////////-->
            <br/>
            <?php if ($status > 0) { ?>
                <button type="button" onclick="printDiv('bill')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
            <?php } ?>

            <div style="background:#ffffff; padding:10px; position: relative;" id="bill">
                <div style="width:50%; left:20px;  position:absolute;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
                </div>

                <div style="width:30%; right:20px; text-align: right;position:absolute;font-family: THSarabun;font-size: 18px;">
                    เลขที่ <?php echo $invnumber ?><br/>
                    อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
                    <?php if ($status > 0 && in_array($customer['grouptype'], $arrayDate)) { ?>
                        วันที่ <?php echo $Config->thaidate($invoicedetail['datebill']) ?>
                    <?php } else { ?>

                    <?php } ?>
                </div>

                <h4 style="text-align: center; font-family: THSarabun;font-size: 24px; font-weight: bold;">ใบเสร็จรับเงิน / ใบกำกับภาษี</h4>
                <div style="text-align:center;font-family: THSarabun;font-size: 18px; font-weight: bold;">
                    <?php if ($customer['grouptype'] != 1) { ?>
                        <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
                        เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
                        50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564<br/><br/>
                    <?php } else { ?>
                        <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
                        เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
                        12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564<br/><br/>
                    <?php } ?>

                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                                ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?><br/>
                                เลขประจำตัวผู้เสียภาษี:<?php echo $customer['taxnumber'] ?><br/>
                                โทร. <?php echo $customer['tel'] ?>
                                <div class="pull-right">
                                    เครดิต  <?php echo ($invoicedetail['credit']) ? $invoicedetail['credit'] : "...... " ?> วัน
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ประจำเดือน <?php echo $Config->thaidatemonth($rounddate) ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center; font-family: THSarabun;font-size: 18px;">No</th>
                            <th style="text-align: center; font-family: THSarabun;font-size: 18px;">รายละเอียด</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">จำนวน</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">หน่วยละ</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">จำนวนเงิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $i = 0;
                        foreach ($billdetail as $rs): $i++;
                            //$fineprice = ($promise['fine'] * $rs['garbageover']);
                            $totalRow = $rs['total'];
                            $sum = $sum + $totalRow;
                            //เช็คการเก็บขยะ
                            //if ($rs['status'] == 1) {
                            ?>

                            <?php //} ?>
                        <?php endforeach; ?>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <?php if ($vat == 1) { ?>
                            <tr>
                                <th colspan="3" style="text-align:center;"></th>
                                <th style="text-align:right; font-family: THSarabun;font-size: 18px;padding: 0px 5px;">ราคาสุทธิค่าบริการ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                    <?php
                                    echo number_format($sum, 2);
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['discount'], 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนหลังหักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDiscount, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักเงินมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['deposit']) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนเงินหลังหักมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDeposit, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:center;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">ภาษีมูลค่าเพิ่ม 7%</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                    <?php
                                    //คำนวน vat
                                    $vatbath = (($sumDeposit * 7) / 100);
                                    echo number_format($vatbath, 2);
                                    ?>
                                </th>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="3" style="text-align:center;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                <?php
//if ($vattype == 1) {//vat ลบ
//$sumVat = ($sum - $vatbath);
//} else if ($vattype == 2) {// vat เพิ่ม
                                $sumVat = ($sumDeposit + $vatbath);
//} else {
//$sumVat = $sum;
//}
                                echo "(" . $Config->Convert($sumVat) . ")";
                                ?>
                            </th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">จำนวนเงินทั้งสิ้น</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;"><?php echo number_format($sumVat, 2) ?></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                <b>ชำระเงินโดย</b>
                                <ul>
                                    <li><input type="radio" name="payment" id="payment"/> ชำระเงินสด</li>
                                    <li><input type="radio" name="payment" id="payment"/> โอนผ่านบัญชีธนาคาร</li>
                                </ul>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3" style="font-family: THSarabun;font-size: 18px;">
                                <br/>
                                ลงชื่อ
                                <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้รับเงิน</div>
                            </th>
                            <th colspan="2" style="font-family: THSarabun;font-size: 18px;">
                                <br/>
                                ลงชื่อ
                                <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้มีอำนาจลงนาม</div>
                            </th>
                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>

        <!--
        ###################################
        ################ แยกVat ##############
        ###################################
        -->
        <div role="tabpanel" class="tab-pane" id="profile">
            <?php if ($status > 0) { ?>
                <div style=" width: 100%; background: #ffffff; position: relative;">
                    <button type="button" class="btn btn-default" onclick="printDiv('invoicesetvat')"><i class="fa fa-print"></i> พิมพ์ใบแจ้งหนี้</button>
                </div>
            <?php } ?>
            <div style="background:#ffffff; padding:10px; position: relative;" id="invoicesetvat">
                <div style="width:50%; left:20px;  position:absolute;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
                </div>

                <div style="width:30%; right:20px; text-align: right;position:absolute;font-family: THSarabun; font-size: 18px;">
                    เลขที่ <?php echo $invnumber ?><br/>
                    อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
                    <?php if ($status > 0 && in_array($customer['grouptype'], $arrayDateInvoice)) { ?>
                        วันที่ <?php echo $Config->thaidate($invoicedetail['dateinvoice']) ?>
                    <?php } else { ?>

                    <?php } ?>
                </div>

                <h4 style="text-align: center; font-family: THSarabun;font-size: 24px; font-weight: bold;">ใบวางบิล / ใบแจ้งหนี้</h4>
                <div style="text-align:center;font-family: THSarabun;font-size: 18px; font-weight: bold;">
                    <?php if ($customer['grouptype'] != 1) { ?>
                        <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
                        เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
                        50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564<br/><br/>
                    <?php } else { ?>
                        <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
                        เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
                        12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564<br/><br/>
                    <?php } ?>

                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                                ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?><br/>
                                เลขประจำตัวผู้เสียภาษี:<?php echo $customer['taxnumber'] ?><br/>
                                โทร. <?php echo $customer['tel'] ?>
                                <div class="pull-right">
                                    เครดิต  <?php echo ($invoicedetail['credit']) ? $invoicedetail['credit'] : "...... " ?> วัน
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ประจำเดือน <?php echo $Config->thaidatemonth($rounddate) ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;font-family: THSarabun;font-size: 18px;">No</th>
                            <th style="font-family: THSarabun;font-size: 18px;">รายละเอียด</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">จำนวน</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">หน่วยละ</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">ราคารวมภาษี</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $i = 0;
                        foreach ($billdetail as $rs): $i++;
                            $totalRow = $rs['total'];
                            $sum = $sum + $totalRow;
                            ?>
                            <tr>
                                <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;"><?php echo $i ?></td>
                                <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo $rs['company'] ?></td>
                                <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                                <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($totalRow, 2) ?></td>
                                <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($totalRow, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                    <tfoot>
                        <?php if ($vat == 1) { ?>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หมายเหตุ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ราคาสุทธิค่าบริการ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    <?php
                                    echo $sum;
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">1.กรุณาโอเงินผ่านธนาคารไทยพาณิชย์ บัญชีออมทรัพย์</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['discount'], 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ชื่อบัญชี บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนหลังหักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDiscount, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">เลขบัญชี 372-259936-7</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักเงินมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['deposit'], 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">2.ส่งหลักฐานการชำระเงินระบุชื่อบริษัทและเดือนที่ชำระค่าบริการให้ชัดเจนส่งมาที่</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนเงินหลังหักมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDeposit, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    LineID:@icqualitysystem หรือทาง E-Mail:icquality@icqs.net
                                </th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ภาษีมูลค่าเพิ่ม 7%</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    <?php
                                    //คำนวน vat
                                    $vatbath = (($sumDeposit * 7) / 100);
                                    echo number_format($vatbath, 2);
                                    ?>
                                </th>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="3" style="text-align:center;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                <?php
//if ($vattype == 1) {//vat ลบ
//$sumVat = ($sum - $vatbath);
//} else if ($vattype == 2) {// vat เพิ่ม
                                $sumVat = ($sumDeposit + $vatbath);
//} else {
//$sumVat = $sum;
//}
                                echo "(" . $Config->Convert($sumVat) . ")";
                                ?>
                            </th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนเงินทั้งสิ้น</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumVat, 2) ?></th>
                        </tr>

                        <tr>
                            <th colspan="5">
                                <div style="width: 30%; float: left; margin-right: 40px;font-family: THSarabun;font-size: 18px;">
                                    <br/>
                                    ลงชื่อ
                                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                    <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้รับวางบิล</div>
                                </div>
                                <div style="width: 30%; float: left;font-family: THSarabun;font-size: 18px;">
                                    <br/>
                                    ลงชื่อ
                                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;font-size: 18px;"></div><br/>
                                    <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้วางบิล</div>
                                </div>
                                <div style="width: 30%; float: right;font-family: THSarabun;font-size: 18px;">
                                    <br/>
                                    ลงชื่อ
                                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;font-size: 18px;"></div><br/>
                                    <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้มีอำนาจลงนาม</div>
                                </div>

                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /////////////////////// BillPromise ///////////////////////////-->
            <br/>
            <?php if ($status > 0) { ?>
                <button type="button" onclick="printDiv('billsubpromise')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
            <?php } ?>
            <div style="background:#ffffff; padding:10px; position: relative;" id="billsubpromise">
                <div style="width:50%; left:20px;  position:absolute;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
                </div>

                <div style="width:30%; right:20px; text-align: right;position:absolute;font-family: THSarabun;font-size: 18px;">
                    เลขที่ <?php echo $invnumber ?><br/>
                    อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
                    <?php if ($status > 0 && in_array($customer['grouptype'], $arrayDate)) { ?>
                        วันที่ <?php echo $Config->thaidate($invoicedetail['datebill']) ?>
                    <?php } else { ?>

                    <?php } ?>
                </div>

                <h4 style="text-align: center; font-family: THSarabun;font-size: 24px; font-weight: bold;">ใบเสร็จรับเงิน / ใบกำกับภาษี</h4>
                <div style="text-align:center;font-family: THSarabun;font-size: 18px; font-weight: bold;">
                    <?php if ($customer['grouptype'] != 1) { ?>
                        <b></b>บริษัทไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
                        เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
                        50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564<br/><br/>
                    <?php } else { ?>
                        <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
                        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
                        เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
                        12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
                        โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564<br/><br/>
                    <?php } ?>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                                ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?><br/>
                                เลขประจำตัวผู้เสียภาษี:<?php echo $customer['taxnumber'] ?><br/>
                                โทร. <?php echo $customer['tel'] ?>
                                <div class="pull-right">
                                    เครดิต  <?php echo ($invoicedetail['credit']) ? $invoicedetail['credit'] : "...... " ?> วัน
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;">
                                ประจำเดือน <?php echo $Config->thaidatemonth($rounddate) ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center; font-family: THSarabun;font-size: 18px;">No</th>
                            <th style="text-align: center; font-family: THSarabun;font-size: 18px;">รายละเอียด</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">จำนวน</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">หน่วยละ</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;">ราคารวมภาษี</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sum = 0;
                        $i = 0;
                        foreach ($billdetail as $rs): $i++;
                            //$fineprice = ($promise['fine'] * $rs['garbageover']);
                            $totalRow = $rs['total'];
                            $sum = $sum + $totalRow;
                            //เช็คการเก็บขยะ
                            //if ($rs['status'] == 1) {
                            ?>
                            <tr>
                                <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo $i ?></td>
                                <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo $rs['company'] ?></td>
                                <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                                <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($totalRow, 2) ?></td>
                                <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($totalRow, 2) ?></td>
                            </tr>
                            <?php //}  ?>
                        <?php endforeach; ?>

                    </tbody>
                    <tfoot>
                        <?php if ($vat == 1) { ?>
                            <tr>
                                <th colspan="3" style="text-align:center;"></th>
                                <th style="text-align:right; font-family: THSarabun;font-size: 18px;padding: 0px 5px;">ราคาสุทธิค่าบริการ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                    <?php
                                    echo number_format($sum, 0);
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['discount'], 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนหลังหักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDiscount, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักเงินมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($invoicedetail['deposit'], 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนเงินหลังหักมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sumDeposit, 2) ?></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:center;"></th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">ภาษีมูลค่าเพิ่ม 7%</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                    <?php
                                    //คำนวน vat
                                    $vatbath = (($sumDeposit * 7) / 100);
                                    echo number_format($vatbath, 2);
                                    ?>
                                </th>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="3" style="text-align:center;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                <?php
//if ($vattype == 1) {//vat ลบ
//$sumVat = ($sum - $vatbath);
//} else if ($vattype == 2) {// vat เพิ่ม
                                $sumVat = ($sumDeposit + $vatbath);
//} else {
//$sumVat = $sum;
//}
                                echo "(" . $Config->Convert($sumVat) . ")";
                                ?>
                            </th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;">จำนวนเงินทั้งสิ้น</th>
                            <th style="text-align:right;font-family: THSarabun;font-size: 18px;padding: 0px 5px;"><?php echo number_format($sumVat, 2) ?></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-family: THSarabun;font-size: 18px;padding: 0px 5px;">
                                <b>ชำระเงินโดย</b>
                                <ul>
                                    <li><input type="radio" name="payment" id="payment"/> ชำระเงินสด</li>
                                    <li><input type="radio" name="payment" id="payment"/> โอนผ่านบัญชีธนาคาร</li>
                                </ul>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3" style="font-family: THSarabun;font-size: 18px;">
                                <br/>
                                ลงชื่อ
                                <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้รับเงิน</div>
                            </th>
                            <th colspan="2" style="font-family: THSarabun;font-size: 18px;">
                                <br/>
                                ลงชื่อ
                                <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                <div style="text-align:center;font-family: THSarabun;font-size: 18px;">ผู้มีอำนาจลงนาม</div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- End แยก vat -->
    </div>
</div>

<script type="text/javascript">
    setBoxs();
    function setBoxs() {
        var h = window.innerHeight;
        //$("#round").css({"height": h - 200});
        $("#boxtypebill").css({"height": h - 311, "overflow-x": "hidden"});

        var status = "<?php echo $status ?>";
        if (status == 1) {
            $("#dateinvoice").attr("disabled", "disabled");
            $("#datebill").attr("disabled", "disabled");
            $("#discount").attr("disabled", "disabled");
            $("#deposit").attr("disabled", "disabled");
            $("#credit").attr("disabled", "disabled");
        } else {
            $("#dateinvoice").removeAttr("disabled");
            $("#datebill").removeAttr("disabled");
        }
    }
    function saveInvoice() {
        var checkNull = "<?php echo $sumVat ?>";
        if (checkNull <= 0) {
            alert("ยังไม่มีรายการจัดเก็บในเดือนนี่...!");
            return false;
        }
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/addinvoice']) ?>";
        var invoiceNumber = "<?php echo $invnumber ?>";
        var promiseId = "<?php echo $promise['id'] ?>";
        var total = "<?php echo $sumVat ?>";
        var roundId = "<?php echo $id ?>";
        var monthyear = "<?php echo $rounddate ?>";
        var dateinvoice = $("#dateinvoice").val();
        var datebill = $("#datebill").val();
        var discount = $("#discount").val();
        var deposit = $("#deposit").val();
        var credit = $("#credit").val();
        var data = {
            invoiceNumber: invoiceNumber,
            promiseId: promiseId,
            total: total,
            roundId: roundId,
            monthyear: monthyear,
            dateinvoice: dateinvoice,
            datebill: datebill,
            discount: discount,
            deposit: deposit,
            credit: credit
        };
        //console.log(data);

        $.post(url, data, function(datas) {
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
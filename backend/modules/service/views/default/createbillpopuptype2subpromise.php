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
$arrayDate = array('2', '4', '5'); //เอาวันที่
?>

<?php if ($status > 0) { ?>
    <button type="button" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์ใบแจ้งหนี้</button>
<?php } ?>
<?php
//ประเภทกลุ่มลูกค้า
echo $customer['groupcustomer'] . " => " . $customer['grouptype'] . "<br/>";
echo "แม่ข่าย => " . $customer['flag'] . "<br/>";
echo (in_array($customer['grouptype'], $arrayDate)) ? "วันที่ => ไม่เอา" : "วันที่ => เอาวันที่";
?>

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">รวม Vat</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">แยก Vat</a></li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <div style="background:#ffffff; padding:10px; " id="invoice">
                <div style="width:50%; left:20px;  position:absolute;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
                </div>

                <div style="width:30%; right:20px; text-align: right;position:absolute;font-family: THSarabun; font-size: 18px;">
                    เลขที่ <?php echo $invnumber ?><br/>
                    อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
                    <?php if ($status > 0 && !in_array($customer['grouptype'], $arrayDate)) { ?>
                        วันที่ <?php echo $Config->thaidate($invoicedetail['dateinvoice']) ?>
                    <?php } else { ?>

                    <?php } ?>
                </div>

                <h4 style="text-align: center; font-family: THSarabun;font-size: 20px; font-weight: bold;">ใบวางบิล / ใบแจ้งหนี้</h4>
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
                        $i = 0;
                        foreach ($billdetail as $rs): $i++;
                            //$fineprice = ($promise['fine'] * $rs['garbageover']);
                            $totalRow = $rs['total'];
                            $sum = $sum + $totalRow;
                            ?>

                        <?php endforeach; ?>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-family: THSarabun;font-size: 18px; padding:0px 5px;">1</td>
                            <td style="font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"> 1 เดือน</td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
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
                                    echo $sum;
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">1.กรุณาโอเงินผ่านธนาคารไทยพาณิชย์ บัญชีออมทรัพย์</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ชื่อบัญชี บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนหลังหักส่วนลด</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">เลขบัญชี 372-259936-7</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">หักเงินมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">2.ส่งหลักฐานการชำระเงินระบุชื่อบริษัทและเดือนที่ชำระค่าบริการให้ชัดเจนส่งมาที่</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">จำนวนเงินหลังหักมัดจำ</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;"></th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:left;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    LineID:@icqualitysystem หรือทาง E-Mail:icquality@icqs.net
                                </th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">ภาษีมูลค่าเพิ่ม 7%</th>
                                <th style="text-align:right;font-family: THSarabun;font-size: 18px; padding: 0px 5px;">
                                    <?php
                                    //คำนวน vat
                                    $vatbath = (($sum * 7) / 100);
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
                                $sumVat = ($sum + $vatbath);
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
                        <?php if ($status <= 0) { ?>
                            <tr>
                                <th colspan="5">
                                    <button class="btn btn-success" type="button" onclick="saveInvoice()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                                </th>
                            </tr>
                        <?php } ?>

                    </tfoot>
                </table>
            </div>
            <input type="hidden" id="id" name="id" class="form-control" value="<?php echo $id ?>"/>

            <!-- /////////////////////// Bill ///////////////////////////-->
            <br/>
            <?php if ($status > 0) { ?>
                <button type="button" onclick="printDiv('bill')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
            <?php } ?>

            <div style="background:#ffffff; padding:10px;" id="bill">
                <div style="width:50%; left:20px;  position:absolute;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
                </div>

                <div style="width:30%; right:20px; text-align: right;position:absolute;">
                    เลขที่ <?php echo $invnumber ?><br/>
                    อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
                    <?php if ($status > 0 && !in_array($customer['grouptype'], $arrayDate)) { ?>
                        วันที่ <?php echo $Config->thaidate($invoicedetail['datebill']) ?>
                    <?php } else { ?>

                    <?php } ?>
                </div>

                <h4 style="text-align: center;">ใบเสร็จรับเงิน</h4>
                <div style="text-align:center;">
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
                            <th colspan="5">
                                ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                                ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?>

                            </th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                ประจำเดือน <?php echo $Config->thaidatemonth($rounddate) ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="5">
                                ประจำเดือน <?php echo $Config->thaidatemonth($rounddate) ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th>รายละเอียด</th>
                            <th style="text-align:right;">จำนวน</th>
                            <th style="text-align:right;">หน่วยละ</th>
                            <th style="text-align:right;">จำนวนเงิน</th>
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
                            <td style="text-align: center;">1</td>
                            <td>ค่ากำจัดขยะติดเชื้อ <?php echo $Config->thaidatemonth($rounddate) ?></td>
                            <td style="text-align:right;"><?php echo $sum ?></td>
                            <td style="text-align:right;"><?php echo number_format($sum, 2) ?></td>
                            <td style="text-align:right;"><?php echo number_format($sum, 2) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <?php if ($vat == 1) { ?>
                            <tr>
                                <th colspan="3" style="text-align:center;">

                                </th>
                                <th style="text-align:right;">ราคาสุทธิค่าบริการ</th>
                                <th style="text-align:right;">
                                    <?php
                                    echo $sum;
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align:center;">

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
                            <th colspan="3" style="text-align:center;">
                                <?php
                                //if ($vattype == 1) {//vat ลบ
                                //$sumVat = ($sum - $vatbath);
                                //} else if ($vattype == 2) {// vat เพิ่ม
                                $sumVat = ($sum + $vatbath);
                                //} else {
                                //$sumVat = $sum;
                                //}
                                echo $Config->Convert($sumVat)
                                ?>
                            </th>
                            <th style="text-align:right;">จำนวนเงินทั้งสิ้น</th>
                            <th style="text-align:right;"><?php echo number_format($sumVat, 2) ?></th>
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
                            <th colspan="3">
                                <br/>
                                ลงชื่อ
                                <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                <div style="text-align:center;">ผู้รับเงิน</div>
                            </th>
                            <th colspan="2">
                                <br/>
                                ลงชื่อ
                                <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                                <div style="text-align:center;">ผู้มีอำนาจลงนาม</div>
                            </th>
                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">Profile</div>
    </div>

</div>



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
        };
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
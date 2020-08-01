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
        อ้างจากสัญญา <?php echo $confirm['confirmformnumber']; ?><br/>
        วันที่ <?php echo $Config->thaidate(date("Y-M-d")) ?>
        
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
                <th colspan="3">
                    ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
                    ที่อยู่ <?php echo 'ตำบล / แขวง ' . $customer['tambon_name'] . ' อำเภอ ' . $customer['ampur_name'] . ' จังหวัด ' . $customer['changwat_name'] . ' ' . $customer['zipcode'] ?>

                </th>
            </tr>
            
            <tr>
                <th style="text-align: center;">#</th>
                <th >รายการ</th>
                <th >จำนวนเงิน</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>1</td>
                    <td>ค่ากำจัดขยะติดเชื้อ ตามแบบยืนยันเข้าจัดเก็บเลขที่ <?php echo $confirm['confirmformnumber'] ?></td>
                    <td style="text-align:right;"><?php echo number_format($money, 2) ?></td>
                    
                </tr>
            
        </tbody>
        <tfoot>
           
            <tr>
                <th></th>
                <th style="text-align:right;">ราคาสุทธิค่าบริการ</th>
                <th style="text-align:right;">
                    <?php
                    echo number_format($money, 2);
                    ?>
                </th>
            </tr>
                
            <tr>
                <th style="text-align:center;">
                    <?php
                    
                    echo $Config->Convert($money)
                    ?>
                </th>
                <th style="text-align:right;">จำนวนเงินทั้งสิ้น</th>
                <th style="text-align:right;"><?php echo number_format($money, 2) ?></th>
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
                        <?php if ($billdetail) { ?>
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

<script type="text/javascript">

    function saveInvoice() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/servicepertime/addinvoice']) ?>";
        var invoiceNumber = "<?php echo $invnumber ?>";
        var confirmid = "<?php echo $confirm['id'] ?>";
        var total = "<?php echo $money ?>";
        var dateinvoice = $("#dateinvoice").val();
        var datebill = $("#datebill").val();
        var customerid = "<?php echo $customer['id'] ?>";
        var data = {
            invoiceNumber: invoiceNumber,
            confirmid: confirmid,
            total: total,
            dateinvoice: dateinvoice,
            datebill: datebill,
            customerid : customerid
        }
        

        $.post(url, data, function(datas) {
            console.log(datas);
            //getInvoice();
        });
    }

    function getInvoice() {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getinvoice']) ?>";
        var confirmid = "<?php echo $confirm['id'] ?>";
        
        
        var invoice = "<?php echo $invnumber ?>";
        var data = {
            id: id,
            confirmid: confirmid,
          
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
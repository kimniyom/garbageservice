<style type="text/css">
    #invoice table tbody td{
        padding: 2px;
    }
</style>
<?php

use yii\helpers\Url;
use app\models\Config;

$Config = new Config();
?>
<button type="button" onclick="printDiv('sendcompany')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
<hr/>
<div style="background:#ffffff; padding:10px; position: relative; padding-bottom: 200px; color: #000000;" id="sendcompany">
    <div style="width:50%; left:20px;  position:absolute;">
        <div style=" float: left;">
            <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/>
        </div>
        <div style=" float: left;font-family: THSarabun;font-size: 18px; font-weight: bold; padding-left: 10px;">
            บริษัทไอซีควอลติี้ซิสเท็ม จำกัด (สำนักงานใหญ่)<br/>
            IC QUALITY SYSTEM<br/>
            50/19 ม.6 ต.บางหลวง อ.เมือง จ.ปทุมธานี 12000
        </div>
    </div>

    <div style=" text-align: center;font-family: THSarabun;font-size: 18px; font-weight: bold; width: 45%; float: right;">
        <div style="font-family: THSarabun;font-size: 18px; font-weight: bold;">ใบส่งมอบงาน</div>
        ค่าจ้างเหมาขนขยะติดเชื้อเป็นรายเดือน<br/>
        ประจำเดือน ..... <?php echo $Config->thaidatemonth($detail['datekeep']) ?> ..... / สัปดาห์.......... <br/><br/>
    </div>
    
    <div style=" right: 0px;  font-size: 10px; float: right; clear: both;">อ้างจากสัญญาเลขที่:<?php echo $promise['promisenumber'] ?></div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" style=" text-align: center;font-family: THSarabun;font-size: 18px;">ลำดับที่</th>
                <th rowspan="2" style=" text-align: center;font-family: THSarabun;font-size: 18px;">รายนาม</th>
                <th colspan="2" style=" text-align: center;font-family: THSarabun;font-size: 18px; position: relative;">
                    
    
                    วันที่จัดเก็บขยะ<br/>
                    วันที่ ... <?php echo $Config->thaidate($detail['datekeep']) ?> ...
                </th>
            </tr>
            <tr>
                <th style=" text-align: center;font-family: THSarabun;font-size: 18px;">จำนวนขยะ / กก.</th>
                <th style=" text-align: center;font-family: THSarabun;font-size: 18px;">เจ้าหน้าที่ส่งขยะ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style=" text-align: center;font-family: THSarabun;font-size: 18px;">1</td>
                <td style="font-family: THSarabun;font-size: 18px;"><?php echo $customer['company'] ?></td>
                <td style=" text-align: center;font-family: THSarabun;font-size: 18px;"><?php echo $detail['amount'] ?></td>
                <td style=" text-align: center;font-family: THSarabun;font-size: 18px;">Kimniyom</td>
            </tr>
        </tbody>
    </table>
    <div style="font-family: THSarabun;font-size: 18px; font-weight: bold;">สรุปน้ำหนักขยะ</div>
    <div style="font-family: THSarabun;font-size: 18px; text-align: center;">น้ำหนักขยะติดเชื้อ = ...............<?php echo $detail['amount'] ?>............... กิโลกรัม</div><br/>
    <div style="font-family: THSarabun;font-size: 18px; text-align: center;">"ผู้รับทำลายขยะ บริษัท ที่ดินบางปะอิน จำกัด โดยวิธีการเผา"</div><br/><br/>
    <div style="font-family: THSarabun;font-size: 18px; width: 45%; float: left; text-align: center; position: relative;">
        ลงชื่อ ............................................................. <br/>
        เจ้าหน้าที่รับขยะ<br/>
        วันที่ ...........................
    </div>
    <div style="font-family: THSarabun;font-size: 18px; width: 45%; float: right; text-align: center; position: relative;">
        ลงชื่อ ............................................................. <br/>
        ผู้รับใบสรุปการจัดเก็บขยะ<br/>
        วันที่ ...........................
    </div><br/><br/>
    <div style="font-family: THSarabun;font-size: 18px; width: 100%; clear: both; padding-top: 30px;">
        เลขทะเบียนรถ................... เวลาเข้า........................... เวลาออก.........................
    </div>
</div>

<script type="text/javascript">
    function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
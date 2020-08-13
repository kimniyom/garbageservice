<?php

use yii\helpers\Url;
use app\models\Config;

$Config = new Config();
?>
<title>ใบส่งมอบ-<?php echo $customer['company'] ?>-<?php echo $Config->thaidatemonth($datekeep) ?></title>
<style type="text/css">
    @font-face {
        font-family: 'THSarabun';
        src: url('<?php echo Url::to('@web/web/fonts/thsarabun/THSarabun.ttf') ?>') format("woff");
    }

    @font-face {
        font-family: 'THSarabunBold';
        src: url('<?php echo Url::to('@web/web/fonts/thsarabun/THSarabun.ttf') ?>') format("woff");
    }
    #billtranfer table tbody td{
        padding: 2px;
    }

</style>


<div style="background:#ffffff; padding:10px; position: relative; padding-bottom: 200px;" id="billtranfer">
    <div style=" text-align: center;font-family: THSarabun;font-size: 18px; font-weight: bold;">
        <div style="font-family: THSarabun;font-size: 28px; font-weight: bold;">ใบส่งมอบงาน</div>
        ค่าจ้างเหมาขนขยะติดเชื้อเป็นรายเดือน<br/>
        สำหรับโรงพยาบาลส่งเสริมสุขภาพตำบลในเครือข่าย <?php echo $customer['company'] ?><br/>
        ประจำเดือน <?php echo $Config->thaidatemonth($datekeep) ?> <br/><br/>
    </div>
    <table class="table table-bordered" style=" width: 100%; border: solid 1px #000000;" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th rowspan="2" style=" text-align: center;font-family: THSarabun;font-size: 18px;">ลำดับที่</th>
                <th rowspan="2" style=" text-align: center;font-family: THSarabun;font-size: 18px;">โรงพยาบาล</th>
                <th colspan="2" style=" text-align: center;font-family: THSarabun;font-size: 18px;">
                    วันที่จัดเก็บขยะ<br/>
                    วันที่ .....<?php echo $Config->thaidate($datekeep) ?>.....
                </th>
            </tr>
            <tr>
                <th style=" text-align: center;font-family: THSarabun;font-size: 18px; color:#000000;">จำนวน / กก.</th>
                <th style=" text-align: center;font-family: THSarabun;font-size: 18px; color:#000000;">เจ้าหน้าที่ส่งขยะ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $a = 0;
            $sum = 0;
            foreach ($detail as $rs): $a++;
                $sum = $sum + $rs['amount'];
                ?>
                <tr>
                    <td style=" text-align: center;font-family: THSarabun;font-size: 18px; color:#000000;"><?php echo $a ?></td>
                    <td style="font-family: THSarabun;font-size: 18px; color:#000000;"><?php echo $rs['company'] ?></td>
                    <td style=" text-align: center;font-family: THSarabun;font-size: 18px; color:#000000;"><?php echo $rs['amount'] ?></td>
                    <td style=" text-align: center;font-family: THSarabun;font-size: 18px; color:#000000;"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><br/>
    <div style="font-family: THSarabun;font-size: 18px; color:#000000; font-weight: bold;">สรุปน้ำหนักขยะ</div><br/><br/>
    <div style="font-family: THSarabun;font-size: 18px; text-align: center; color:#000000;">น้ำหนักขยะติดเชื้อ รพ.สต. ...<?php echo $a ?>... แห่ง = ..............<?php echo $sum ?>................ กิโลกรัม</div><br/><br/>
    <div style="font-family: THSarabun;font-size: 18px; width: 45%; float: left; text-align: center; position: relative;color:#000000;">
        ลงชื่อ ............................................................. <br/>
        เจ้าหน้าที่รับขยะ<br/>
        วันที่ ...........................
    </div>
    <div style="font-family: THSarabun;font-size: 18px; width: 45%; float: right; text-align: center; position: relative;color:#000000;">
        ลงชื่อ ............................................................. <br/>
        ผู้รับใบสรุปการจัดเก็บขยะ<br/>
        วันที่ ...........................
    </div>
</div>

<script type="text/javascript">
    printDiv("billtranfer");
    function printDiv(divName) {

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

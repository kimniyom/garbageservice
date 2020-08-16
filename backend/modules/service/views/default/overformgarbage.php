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
$arrayDateInvoice = array('1', '3'); //เอาวันที่
//ConfigBill
$arrayDate = array('3'); //เอาวันที่
?>
<div style=" width: 100%; background: #ffffff;">
    <button type="button" class="btn btn-default" onclick="printDiv('sendcompany')"><i class="fa fa-print"></i> พิมพ์</button>
</div>
<div style="background:#ffffff; padding:20px; position: relative; padding-bottom: 200px; color: #000000;" id="sendcompany">

    <div style="width:50%; left:20px;  position:absolute;">
        <div style=" float: left;">
            <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/>
        </div>

    </div>
    <div style=" font-family: THSarabun;font-size: 24px; font-weight: bold; padding-left: 10px; text-align: center;">
        บันทึกรายงานการเก็บขยะเกิน<br/>
        วันที่ ..... <?php echo $Config->thaidate($detail['datekeep']) ?> .....<br/>
        สาย .................................................................................................
    </div><br/><br/>
    <table class="table table-bordered" style=" width: 100%; border: solid 1px #000000;" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th style=" text-align: center;font-family: THSarabun;font-size: 20px; font-weight: bold;">ชื่อลูกค้า</th>
                <th style=" text-align: center;font-family: THSarabun;font-size: 20px;  font-weight: bold;">รายละเอียดงาน</th>
                <th style=" text-align: center;font-family: THSarabun;font-size: 20px;  font-weight: bold;">ปริมาณ / กก.</th>
                <th style=" text-align: center;font-family: THSarabun;font-size: 20px;  font-weight: bold;">หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2" style=" text-align: left;font-family: THSarabun;font-size: 20px; font-weight: bold;padding:5px;"><?php echo $customer['company'] ?></td>
                <td style=" text-align: left;font-family: THSarabun;font-size: 20px; font-weight: bold; padding:5px;">น้ำหนักขยะ</td>
                <td style=" text-align: right;font-family: THSarabun;font-size: 20px; font-weight: bold; padding:5px;"><?php echo $detail['amount'] ?> กิโลกรัม</td>
                <td style=" text-align: center;font-family: THSarabun;font-size: 20px; font-weight: bold; padding:5px;"></td>
            </tr>
            <tr>
                <td style=" text-align: left;font-family: THSarabun;font-size: 20px; font-weight: bold; padding:5px;">น้ำหนักขยะส่วนเกิน</td>
                <td style=" text-align: right;font-family: THSarabun;font-size: 20px; font-weight: bold; padding:5px;"><?php echo $detail['garbageover'] ?> กิโลกรัม</td>
                <td style=" text-align: center;font-family: THSarabun;font-size: 20px; font-weight: bold; padding:5px;"></td>
            </tr>
        </tbody>
    </table><br/><br/>
    <div style="font-family: THSarabun;font-size: 20px; width: 45%; float: left; text-align: center; position: relative; font-weight: bold;">
        ลงชื่อ ............................................................. ผู้ส่ง<br/>
        วันที่ .........................................
    </div>
    <div style="font-family: THSarabun;font-size: 20px; width: 45%; float: right; text-align: center; position: relative; font-weight: bold;">
        ลงชื่อ ............................................................. ผู้รับ<br/>
        วันที่ .........................................
    </div><br/><br/>
</div>

<script type="text/javascript">
    setBoxs();
    function setBoxs() {
        var h = window.innerHeight;
        //$("#round").css({"height": h - 200});
        $("#boxtypebill").css({"height": h - 311, "overflow-x": "hidden"});
    }

    function printDiv(divName) {
        var divToPrint = document.getElementById(divName); // เลือก div id ที่เราต้องการพิมพ์
        var font = "<?php echo Url::to('@web/web/fonts/thsarabun/THSarabun.ttf') ?>";
        var style = '<style type="text/css">' +
                '@media print {#invoice {font-family: THSarabun;}}' +
                "@font-face {font-family: 'THSarabun';src: url(" + font + ") format('woff');" +
                '</style>';
        var html = '<html>' + //
                '<head>' + style +
                '</head>' +
                '<body onload="window.print(); window.close();">' + divToPrint.innerHTML + '</body>' +
                '</html>';
        var popupWin = window.open();
        popupWin.document.open();
        popupWin.document.write(html); //โหลด print.css ให้ทำงานก่อนสั่งพิมพ์
        popupWin.document.close();
    }
</script>
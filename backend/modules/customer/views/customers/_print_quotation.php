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
?>

<div style="width:50%; left:80px;  position:absolute; z-index: 10; top: 110px;">
    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
</div>
<div style="background:#ffffff; padding:10px;font-family:sarabun;" id="invoice">

    <div style="text-align:center; font-size: 18px;">
        <b style=" font-size: 20px;">ไอซี ควอลิตี้ ซิสเท็ม</b><br/>
        IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 1102000920966<br/>
        เลขที่ 12/1 หมู่ 8  ตำบล บางคูวัด อำเภอเมืองปทุมธานี จังหวัด ปทุมธานี 12000 <br/>
        12/1  Moo 8  Bangkuwat , Muengpathumthani , Pathumthani 12000<br/>
        โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564 E-mail : iccquality@icqs.net<br/><br/>
    </div>

    <table style="width: 100%;font-family:sarabun; font-size: 18px;">
        <tr>
            <td style=" width: 70%; text-align: center;">
                <h2 style="font-family:sarabun;">ใบเสนอราคา(Quotation)</h2>
            </td>
            <td style="width:30%; text-align: right;">
                เลขที่(NO.): <?php echo $no ?><br/>
                วันที่(Date): <?php echo $Config->thaidate(date("Y-m-d")) ?>
            </td>
        </tr>
    </table>

    <table style="width: 100%;font-family:sarabun; color: #000000; font-size: 18px;" class="table table-bordered">
        <tr>
            <td style="padding: 5px;">
                รหัสลูกค้า(Customer Code): <?php echo $cusCode ?><br/>
                ชื่อองค์กรลูกค้า(Company Name): <?php echo $datas['customername'] ?><br/>
                ชื่อผู้ติดต่อ(Name): <?php echo $datas['contact'] ?><br/>
                ที่อยู่ <?php echo $datas['address'] ?>&nbsp;
                ต.<?php echo $datas['tambon_name'] ?>&nbsp;
                อ.<?php echo $datas['ampur_name'] ?>&nbsp;
                จ.<?php echo $datas['changwat_name'] ?>&nbsp;
                <?php echo $datas['zipcode'] ?><br/>
                โทรศัพท์(Phone Number): <?php echo $datas['tel'] ?><br/>
                อีเมล์(E-mail): -<br/>
            </td>
            <td style="padding: 5px; width: 40%;">
                วันกำหนดส่งมอบงาน(Due Date): <?php echo $datas['duedate'] ?> วัน<br/>
                เงื่อนไขการชำระเงิน(Credit Term): <?php echo $datas['createdittime'] ?><br/>
                ยืนยันราคาภายใน(Expire Date): <?php echo $datas['expiredate'] ?>
                <hr style="margin-top:2px; margin-bottom: 2px;"/>
                จุดจัดเก็บ : จำนวน <?php echo $datas['numpoint'] ?> จุด<br/>
                สถานที่ : <?php echo $datas['locationpoint'] ?>
            </td>
        </tr>
    </table>

    <table class="table table-bordered" style="font-family:sarabun; font-size: 16px;" id="tables">
        <thead>
            <tr>
                <th style="text-align: center; width: 15%; padding: 5px;">รหัสบริการ<br/>Code No.</th>
                <th style="text-align:center;padding: 5px;">รายการรับบริการ<br/>Description</th>
                <th style="text-align:center;padding: 5px;">รอบการจัดเก็บ<br/>Period of time</th>
                <th style="text-align:center;padding: 5px;">จำนวน<br/>Quantity</th>
                <th style="text-align:center;padding: 5px;">หน่วย<br/>Unit</th>
                <th style="text-align:center;padding: 5px;">ราคาเหมาจ่าย<br/>Price/Month</th>
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
                    <td style=" text-align: center; padding: 5px;"><?php echo $i ?></td>
                    <td style="padding: 5px;"><?php echo $rs['description'] ?></td>
                    <td style="padding: 5px;"><?php echo $rs['periodoftime'] ?></td>
                    <td style="padding: 5px;"><?php echo $rs['quantity'] ?></td>
                    <td style="padding: 5px;"><?php echo $rs['unit'] ?></td>
                    <td style="text-align:right;padding: 5px;" >
                        <?php echo number_format($rs['priceofmonth']) ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td id="hbody"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th style="padding: 5px;">หมายเหตุ:</th>
                <td colspan="3" style="padding: 5px;">
                    <?php echo $datas['comment'] ?>
                </td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align:center; padding: 5px;">
                    <?php echo $Config->Convert($sum) ?>
                </th>
                <th style="text-align:right;padding: 5px;">จำนวนเงินรวมทั้งสิ้น</th>
                <th style="text-align:right;padding: 5px;"><?php echo number_format($sum) ?></th>
            </tr>
            <tr>
                <th style="padding: 5px;">
                    <b>ชำระเงินโดย:</b>
                </th>
                <td colspan="5" style="padding: 5px;">
                    <?php echo $datas['payment'] ?>

                </td>
            </tr>
        </tfoot>
    </table>

    <div style="width: 30%; float: left; margin-right: 100px;">
        <div style=" text-align: center; margin-bottom: 40px; font-weight: bold;">เสนอราคาโดย:</div>
        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div>
        <div style="text-align:center;margin-top: 10px;">เจ้าหน้าที่ฝ่ายขาย</div>
    </div>
    <div style="width: 30%; float: left; margin-left: 30px;">
        <div style=" text-align: center; margin-bottom: 40px; font-weight: bold;">อนุมัติโดย:</div>
        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div>
        <div style="text-align:center; margin-top: 10px;">ผู้จัดการทั่วไป</div>
    </div>
    <div style="width: 30%; float: right;">
        <div style=" text-align: center; margin-bottom: 40px; font-weight: bold;">ผู้รับบริการ:</div>
        <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div>
        <div style="text-align:center;margin-top: 10px;">ผู้มีอำนาจลงนาม</div>
    </div>
</div>
<script type="text/javascript">
    settables();
    function settables() {
        var h = $("#tables").height();
        var htable = (250 - h);
        $("#hbody").css({"height": htable});
    }
</script>




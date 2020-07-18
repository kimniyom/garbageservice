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

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\Config;

/* @var $this yii\web\View */
/* @var $datas app\datass\Confirmform */


$this->params['breadcrumbs'][] = ['label' => 'Confirmforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$Config = new Config();
$sunday = $datas['roundkeep_sunday'] == 1 ? 'checked' : '';
$monday = $datas['roundkeep_monday'] == 1 ? 'checked' : '';
$tueday = $datas['roundkeep_tueday'] == 1 ? 'checked' : '';
$wednesday = $datas['roundkeep_wednesday'] == 1 ? 'checked' : '';
$tursday = $datas['roundkeep_thursday'] == 1 ? 'checked' : '';
$friday = $datas['roundkeep_friday'] == 1 ? 'checked' : '';
$saturday = $datas['roundkeep_saturday'] == 1 ? 'checked' : '';
$morning = $datas['timeperiod_morning'] == 1 ? 'checked' : '';
$affernoon = $datas['timeperiod_affternoon'] == 1 ? 'checked' : '';
$timeperiod_time = $datas['timeperiod_time'] != '' ? 'checked' : '';

$billdoc_originalinvoice = $datas['billdoc_originalinvoice'] != '' ? 'checked' : '';
$billdoc_copyofinvoice = $datas['billdoc_copyofinvoice'] != '' ? 'checked' : '';
$billdoc_originalreceipt = $datas['billdoc_originalreceipt'] != '' ? 'checked' : '';
$billdoc_copyofreceipt = $datas['billdoc_copyofreceipt'] != '' ? 'checked' : '';
$billdoc_copyofbank = $datas['billdoc_copyofbank'] != '' ? 'checked' : '';
$billdoc_etc = $datas['billdoc_etc'] != '' ? 'checked' : '';
?>


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $datas['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $datas['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box" id="box-detail">
        <div class="box-header" style=" padding-bottom: 0px;">
            <h4>ข้อมูลลูกค้า</h4>
        </div>
        <div class="box-body" style="padding-top:0px;">
                <table class="table">
                    <tr>
                        <td style="text-align: right;">สถานบริการ / บริษัท</td>
                        <td><?php echo $datas['company'] ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">ประเภทสถานบริการ</td>
                        <td><?php echo $datas['typename'] ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">ชื่อผู้ติดต่อ</td>
                        <td><?php echo $datas['manager'] ?></td>
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
                            จ.<?php echo $datas['changwat_name'] ?>&nbsp;
                            <?php echo $datas['zipcode'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">วัน - เวลา ที่เปิดทำการ</td>
                        <td><?php echo $datas['timework'] ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">สถานที่ตั้ง</td>
                        <td><?php echo ($datas['location'])!=' ' ? $datas['location'] : "-"; ?></td>
                    </tr>
                  
                </table>
        </div>
    </div>

    <div id="head-invoice"></div>
    <button type="button" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์แบบยืนยัน</button>
    <div style="background:#ffffff; padding:20px;width: 210mm;" id="invoice">

        <div class="row" style="margin-top: 10px;">
                <div style="float: left;width: 40%;text-align:right;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;padding-top: 10px;"/><br/><br/>
                </div>
                <div style="float: left;width: 60%;padding-left:20px">
                    <b>บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด (สำนักงานใหญ่)</b><br/>
                        เลขที่ 50/19 หมู่ 6  ต.บางหลวง อ.เมืองปทุมธานี จ.ปทุมธานี 12000<br/>
                        เลขที่ผู้เสียภาษี : 0135557019633<br/>
                    </div>
        </div>
        <br>
        <div class="row text-center" style="font-size:20px;">
                <div class="col-12"><u><strong>แบบยืนยันลูกค้าเพื่อเข้าเก็บขยะติดเชื้อ</strong></u></div>
        </div> 
        <br>
        <br> 
        <div class="row">
                <div class="col-sm-12" style="font-size:14px;">
                    ชื่อสถานที่เข้าจัดเก็บ <?php echo $datas['company'];?>  
                    <br>ที่อยู่ <?php echo $datas['address'] ?>&nbsp; ต.<?php echo $datas['tambon_name'] ?>&nbsp;อ.<?php echo $datas['ampur_name'] ?>&nbsp;จ.<?php echo $datas['changwat_name'] ?>&nbsp; 
                    <br>ชื่อผู้ประสานงาน <?php echo $datas['manager'];?> แผนก/หน่วยงาน <?php echo $datas['department']?> เบอร์โทรศัพท์ <?php echo $datas['tel'];?>
                    <br>รอบวันเข้าจัดเก็บ 
                    <input type="checkbox" <?php echo $sunday;?> disabled>วันอาทิตย์&nbsp;
                    <input type="checkbox" <?php echo $monday;?> disabled>วันจันทร์&nbsp;
                    <input type="checkbox" <?php echo $tueday;?> disabled>วันอังคาร&nbsp;
                    <input type="checkbox" <?php echo $wednesday;?> disabled>วันพุธ&nbsp;
                    <input type="checkbox" <?php echo $tursday;?> disabled>วันพฤหัสบดี&nbsp;
                    <input type="checkbox" <?php echo $friday;?> disabled>วันศุกร์&nbsp;
                    <input type="checkbox" <?php echo $saturday;?> disabled>วันเสาร์&nbsp;    
                    <br>วันที่เข้าจัดเก็บขยะ <?php echo $datas['roundkeep_day']==""? " ............ " : $Config->thaidate($datas['roundkeep_day'])?> 
                    ช่วงเวลาที่เข้าจัดเก็บขยะ 
                    <input type="checkbox" <?php echo $morning;?> disabled>ช่วงเช้า&nbsp;
                    <input type="checkbox" <?php echo $affernoon;?> disabled>ช่วงบ่าย&nbsp;
                    <input type="checkbox" <?php echo $timeperiod_time;?> disabled>ระบุเวลา&nbsp;<?php echo $datas['timeperiod_time']?>
                </div>
        </div>
        <br>
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><u><strong>เอกสารที่ต้องนำไปพร้อมพนักงานจัดเก็บขยะ </strong></u> ได้แก่</div>
        </div>  
        <br>
        <div class="row " style="font-size:14px;">
            <div style="float:left;width:25%;padding-left: 15px;"><strong>1.เอกสารวางบิล </strong></div>
            <div style="float:left;width:75%">
                <input type="checkbox" <?php echo $billdoc_originalinvoice;?> disabled>&nbsp;1.ต้นฉบับใบวางบิล/ใบแจ้งหนี้<br>
                <input type="checkbox" <?php echo $billdoc_copyofinvoice;?> disabled>&nbsp;2.สำเนาใบวางบิล/ใบแจ้งหนี้<br>
                <input type="checkbox" <?php echo $billdoc_originalreceipt;?> disabled>&nbsp;3.ต้นฉบับใบเสร็จเงิน/กำกับภาษี<br>
                <input type="checkbox" <?php echo $billdoc_copyofreceipt;?> disabled>&nbsp;4.สำเนาใบเสร็จรับเงิน/ใบกำกับภาษี<br>
                <input type="checkbox" <?php echo $billdoc_copyofbank;?> disabled>&nbsp;5.สำเนาเลขที่บัญชีธนาคารเพื่ิอให้ลูกค้าโอนเงิน<br>
                <input type="checkbox" <?php echo $billdoc_etc;?> disabled>&nbsp;6.อื่น ๆ  ระบุ <?php echo $datas['billdoc_etctext'];?>
            </div>
        </div>  
        <div class="row " style="font-size:14px;">
            <div class="col-sm-12"><strong>2.รอบการวางบิล/ชำระเงินของลูกค้าของทุกเดือน คือ </strong> <?php echo $Config->thaidate($datas['cyclekeepmoney'])?></div>
        </div> 
        <div class="row " style="font-size:14px;">
            <div class="col-sm-12"><strong>3.กำหนดการชำระเงิน </strong></div>
        </div> 
        <div class="row " style="font-size:14px;">
            <div style="float:left;width:25%;padding-left:50px;"><strong>ลูกค้าชำระเงิน </strong></div>
            <div style="float:left;width:40%;">
                <strong>
                    <?php 
                       echo $payment['payment'];
                    ?>
                </strong>
            </div>
        </div> 
        <div class="row " style="font-size:14px;">
            <div style="float:left;width:25%;padding-left:15px;"><strong>4.วิธีการชำระเงิน </strong></div>
            <div style="float:left;width:40%;"><strong><?php echo $method['method'];?> </strong></div>
        </div> 
        <br>
        <div class="row " style="font-size:14px;">
            <div class="col-sm-12"><strong>ติดต่อกับแผนกการเงินระบุชื่อ  <?php echo $datas['manager']?> เบอร์โทรศัพท์ <?php echo $datas['tel']?> </strong></div>
        </div>
        <div class="row " style="font-size:14px;">
            <div class="col-sm-12"><strong>พิกัด GPS:  N <?php echo $datas['lat'];?> E <?php echo $datas['long'];?> </strong></div>
        </div>
        <br>
        <div class="row " style="font-size:14px;">
            <div style="float:left;width:40%;padding-left:15px;"><strong><input type="checkbox" <?php echo $billdoc_etc;?> disabled>&nbsp;ส่งเอกสารให้บัญชี/การเงิน</strong></div>
            <div style="float:left;width:40%;"><strong><input type="checkbox" <?php echo $billdoc_etc;?> disabled>&nbsp;ส่งเอกสารให้ลูกค้า</strong></div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="row" >
            <div class="col-sm-12 text-center">
                ที่ตั้งสถานประกอบการ : เลขที่ 44/5 ม.2 ต.บ้านกลาง อ.เมืองปทุมธานี 12000 <br>
                www.icqs.net : E-mail : icquality@icqs.net ; Line id @icqualitysystem ; Facebook : บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด<br>
                โทร 02-101-0325 , 092-641-7564 , 096-878-1596 , 097-193-8558
            </div>
        </div>
        <div class="div" style="page-break-after:always;"></div>

        <!-- new page -->
        <br>
        
            <div class="row">
                <div style="float: left;width: 40%;text-align:right;">
                    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;padding-top: 10px;"/><br/><br/>
                </div>
                <div style="float: left;width: 60%;padding-left:20px">
                    <b>บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด (สำนักงานใหญ่)</b><br/>
                        เลขที่ 50/19 หมู่ 6  ต.บางหลวง อ.เมืองปทุมธานี จ.ปทุมธานี 12000<br/>
                        เลขที่ผู้เสียภาษี : 0135557019633<br/>
                    </div>
            </div>
            
            <br>
        
            <div class="row" style="font-size:18px;">
                <div class="col-sm-12 text-center"><u><strong>เงื่อนไขการจัดการมูลฝอยติดเชื้อสำหรับสถานบริการสาธารณสุข / บริษัทเอกชน ที่รับการบริการ</strong></u></div>
            </div> 
            <div  class="row ">
                <div class="col-sm-12" style="font-size:14px;">
                    <br>1.ถุงพลาสติกที่ใช้บรรจุมูลฝอยติดเชื้อต้องทนทาน  ไม่ฉีกขาดง่าย  มีสีแดงสด  ทึบแสง บรรจุมูลฝอยติดเชื้อไม่เกิน 2 ใน 3 <br>&nbsp;&nbsp;&nbsp;ส่วนของถุงพลาสติกแดง และไม่ใส่ปะปนกับมูลฝอยทั่วไป แล้วมัดปากถุงด้วยเชือกหรือวัสดุอื่นๆให้แน่น  
                    <br>2.ภาชนะมูลฝอยติดเชื้อประเภทของมีคม ต้องบรรจุอยู่ในภาชนะที่ทนทานต่อการทิ่มแทงทะลุ  มีฝาปิดกล่อง  มีสีแดงสด  ทึบแสง <br>&nbsp;&nbsp;&nbsp;โดยจะต้องบรรจุไม่เกิน 3 ใน 4 ส่วนของความจุภาชนะนั้นๆ
                    <br>3.ห้ามมิให้สถานบริการสาธารณสุขทิ้งเข็มฉีดยา หรือวัตถุมีคมประเภทต่างๆ ลงในถุงขยะติดเชื้อโดยตรง  ควรรวบรวมทิ้งไว้ใน<br>&nbsp;&nbsp;&nbsp;กระป๋องหรือกระปุกที่มีฝาปิดมิดชิด  เพราะเข็มฉีดยาหรือวัตถุมีคมทำให้ถุงฉีกขาดเป็นการแพร่กระจายของเชื้อโรค และอาจทำ<br>&nbsp;&nbsp;&nbsp;อันตรายเจ้าหน้าที่ในขณะปฏิบัติงานได้
                    <br>4.กรณีทีตั้งของลูกค้าอยู่บนอาคารสูง ต้องติดต่อกับเจ้าของอาคารในการจัดที่พักมูลฝอยไว้ทางด้านล่างของอาคาร  เพื่อป้องกัน &nbsp;&nbsp;&nbsp;การแพร่กระจายของเชื้อโรค  
                    <br>5.ขอความร่วมมือลูกค้านำมูลฝอยติดเชื้อมาใส่ถังที่มีฝาปิดมิดชิดและติดป้ายชัดเจนว่า  “ขยะติดเชื้อ BIOHAZARD WASTE” เท่านั้น &nbsp;&nbsp;&nbsp;และนำถังมาไว้ที่จุดที่พักขยะ โดยแยกขยะติดเชื้อออกจากขยะทั่วไปอย่างชัดเจน
                    <br>6.เนื่องจากในแต่ละวัน ทางบริษัทฯ ต้องให้บริการลูกค้าเป็นจำนวนมาก และในการเข้าเก็บขน ในแต่ละพื้นที่มักจะประสบปัญหา &nbsp;&nbsp;&nbsp;เรื่องการจราจร ทางบริษัทฯ  จึงขอความร่วมมือให้ลูกค้า จัดเตรียมขยะไว้ที่จุดพักขยะให้พร้อม เพื่อให้เข้าเก็บได้ทันที

                </div>
            </div>
            <br>
        
            <div class="row " style="font-size:18px;">
                <div class="col-sm-12"><u><strong>รายการขยะติดเชื้อที่รับจัดเก็บ ได้แก่ </strong></u></div>
            </div> 
            <div class="row">
                <div class="col-sm-12" style="font-size:14px;">
                    <br>1.วัสดุของมีคม เช่น เข็ม ใบมีด กระบอกฉีดยา หลอดแก้ว ภาชนะที่ทำด้วยแก้วสไลด์ และแผ่นกระจกปิดสไลด์
                    <br>2.วัสดุซึ่งสัมผัส หรือ สงสัยว่าจะสัมผัสกับเลือด ส่วนประกอบขยะเลือด ผลิตภัณฑ์ที่ได้จากเลือด สารน้ำจากร่างกายของมนุษย์หรือ<br>&nbsp;&nbsp;&nbsp;สัตว์หรือวัคซีนที่ทำจากเชื้อโรคที่มีชีวิต เช่น สำลี ผ้าก๊อต  ผ้าต่างๆ และท่อยาง
                    <br>3.มูลฝอยทุกชนิดที่มาจากห้องรักษาผู้ป่วยติดเชื้อร้ายแรง 
                    <br>4.ขยะติดเชื้ออื่นๆ ตามเงื่อนไขของผู้รับกำจัด
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12" style="font-size:14px;" >
                ทางบริษัทฯ หวังเป็นอย่างยิ่งว่า  ลูกค้าทุกท่านจะปฏิบัติตามเงื่อนไขดังกล่าวอย่างเคร่งครัด  เพื่อให้การเก็บขนมูลฝอยติดเชื้อ ดำเนินการอย่างมีประสิทธิภาพและถูกต้องตามหลักสุขาภิบาล หากลูกค้าท่านใดไม่ปฏิบัติตามเงื่อนปฏิบัติ ทางบริษัทฯ ขอสงวนสิทธิ์การเข้าจัดเก็บมูลฝอยติดเชื้อ จนกว่าท่านจะดำเนินการแก้ไขให้เป็นไปตามเงื่อนไขของบริษัทฯ เรียบร้อยแล้ว
            
                </div>
            </div>
            <br><br>
            <div style="float: right;width:42%; font-size:14px;" class="text-left">
                (ลงชื่อ)........................รับทราบปฏิบัติตามเงื่อนไข
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(................................)  
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่......./......../........
            </div>
            <div style="clear:both;"></div>
            <br><br>
            <div class="row">
                <div class="col-sm-12" style="font-size:14px;">
                    •	รบกวนลูกค้าลงชื่อและส่งเอกสารยืนยันกลับมาที่บริษัทฯ ก่อนวันเข้าจัดเก็บล่วงหน้า 3 วัน ส่งทางE-mail : icquality@icqs.net                          หรือADD LINE : @ icqualitysystem
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="row" style="">
                <div class="col-sm-12 text-center">
                    ที่ตั้งสถานประกอบการ : เลขที่ 44/5 ม.2 ต.บ้านกลาง อ.เมืองปทุมธานี 12000 <br>
                    www.icqs.net : E-mail : icquality@icqs.net ; Line id @icqualitysystem ; Facebook : บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด<br>
                    โทร 02-101-0325 , 092-641-7564 , 096-878-1596 , 097-193-8558
                </div>
            </div>
        
    </div>
    

<script>
function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>


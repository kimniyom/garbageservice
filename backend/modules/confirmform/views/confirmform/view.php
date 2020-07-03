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
$sunday = $datas['roundkeep_sunday'] == 1 ? 'วันอาทิตย์' : '';
$monday = $datas['roundkeep_monday'] == 1 ? 'วันจันทร์' : '';
$tueday = $datas['roundkeep_tueday'] == 1 ? 'วันอังคาร' : '';
$wednesday = $datas['roundkeep_wednesday'] == 1 ? 'วันพุธ' : '';
$tursday = $datas['roundkeep_thursday'] == 1 ? 'วันพฤหัส' : '';
$friday = $datas['roundkeep_friday'] == 1 ? 'วันศุกร์' : '';
$saturday = $datas['roundkeep_saturday'] == 1 ? 'วันเสาร์' : '';
$day = $sunday.' '.$monday.' '.$tueday.' '.$tueday.' '.$wednesday.' '.$tursday.' '.$friday.' '.$friday.' '.$saturday;

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
    <div style="background:#ffffff; padding:20px; width: 210mm;" id="invoice">

        <div style="width:50%; left:132px;  position:absolute; z-index: 10; top:30px;">
            <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" style="width:100px;"/><br/><br/>
        </div>

        <div style="text-align:left; margin-bottom: 0px;margin-left: 245px;">
            <b>บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด (สำนักงานใหญ่)</b><br/>
            เลขที่ 50/19 หมู่ 6  ต.บางหลวง อ.เมืองปทุมธานี จ.ปทุมธานี 12000<br/>
            เลขที่ผู้เสียภาษี : 0135557019633<br/>
        </div>
        <br>
        <div class="row text-center" style="font-size:20px;">
                <div class="col-12"><u><strong>แบบยืนยันลูกค้าเพื่อเข้าเก็บขยะติดเชื้อ</strong></u></div>
        </div> 
        <br>
        <br> 
        <div class="row">
                <div class="col-sm-12" style="font-size:14px;">
                    ชื่อสถานที่เข้าจัดเก็บ <?php echo $datas['company'];?>  ประเภทลูกค้า        ทำสัญญา        ใบเสนอราคา (รายครั้ง)
                    <br>ที่อยู่ <?php echo $datas['address'] ?>&nbsp; ต.<?php echo $datas['tambon_name'] ?>&nbsp;อ.<?php echo $datas['ampur_name'] ?>&nbsp;จ.<?php echo $datas['changwat_name'] ?>&nbsp; 
                    <br>ชื่อผู้ประสานงาน <?php echo $datas['manager'];?> แผนก/หน่วยงาน.................เบอร์โทรศัพท์ <?php echo $datas['tel'];?>
                    รอบวันเข้าจัดเก็บ   <?php echo $day;?>   วันที่เข้าจัดเก็บขยะ <?php echo $Config->thaidate(date($datas['roundkeep_day']))?> ช่วงเวลาที่เข้าจัดเก็บขยะ     ⃣   ช่วงเช้า    ⃣   ช่วงบ่าย    ⃣   ระบุเวลา............................
                </div>
        </div>
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><u><strong>เอกสารที่ต้องนำไปพร้อมพนักงานจัดเก็บขยะ </strong></u> ได้แก่</div>
        </div>  
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><strong>1.เอกสารวางบิล </strong></div>
        </div>  
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><strong>2.รอบการวางบิล/ชำระเงินของลูกค้าของทุกเดือน คือ </strong></div>
        </div> 
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><strong>3.กำหนดการชำระเงิน </strong></div>
        </div> 
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><strong>4.วิธีการชำระเงิน </strong></div>
        </div> 
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><strong>ติดต่อกับแผนกการเงินระบุชื่อ..........................................................................................เบอร์โทรศัพท์............................................... </strong></div>
        </div>
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><strong>พิกัด GPS:  N <?php echo $datas['lat'];?> E <?php echo $datas['long'];?> </strong></div>
        </div>
        <div class="row " style="font-size:18px;">
            <div class="col-sm-12"><strong>ส่งเอกสาร </strong></div>
        </div>
        <div class="row" style="">
            <div class="col-sm-12 text-center">
                ที่ตั้งสถานประกอบการ : เลขที่ 44/5 ม.2 ต.บ้านกลาง อ.เมืองปทุมธานี 12000 <br>
                www.icqs.net : E-mail : icquality@icqs.net ; Line id @icqualitysystem ; Facebook : บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด<br>
                โทร 02-101-0325 , 092-641-7564 , 096-878-1596 , 097-193-8558
            </div>
        </div>
        <div class="div" style="page-break-after:always;"></div>
    </div>


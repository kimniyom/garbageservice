<?php 
use yii\helpers\Html;
use app\models\Config;
$Config = new Config();
?>
<?php if ($model['typeregister'] == 1): ?>
<div style="font-family:sarabun;font-size:14px;text-align:center;font-weight: normal;font-style: normal;">
บริษทั ไอซีควอลิต้ีซิสเทม็ จำกัด เลขที่ 50/19 หมู่6 ตำบล บำงหลวง อำเภอ เมืองปทุมธำนี จังหวัด ปทุมธำนี 12000 เลขประจำตัวผู้เสียภำษีเลขที่ : 0135557019633
<br>โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564 E-mail : icquality@icqs.net ID Line : @icqualitysystem
</div>
<?php endif;?>


<?php if ($model['typeregister'] == 3): ?>
    <div style="font-family:sarabun;font-size:14px;text-align:center;font-weight: normal;font-style: normal;">
    ไอซี ควอลิตี้ ซิสเท็ม เลขที่ 44/5 ม.2 ต.บ้านกลาง อ.เมืองปทุมธานี จ.ปทุมธานี 12000 เลขประจำตัวผู้เสียภาษีเลขที่ : 1102000920966
    <br>โทรศัพท์ (Tel.) : 02-101-0325 , 092-641-7564 E-mail : icquality@icqs.net ID Line : @icqualitysystem
    </div>
<?php endif?>
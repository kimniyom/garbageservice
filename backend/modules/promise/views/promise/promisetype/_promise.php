<?php

use yii\helpers\Html;
use app\models\Config;
use yii\helpers\Url;

$Config = new Config();
$promiseWith = "";
$contracktor = "";
$vatText = "";
$total = $model['total'];
$discount = "";
$discountText = "";

if($model['typeregister'] == 1)
{
    $promiseWith = "บริษัท ไอซี ควอลิตี้ ซิสเท็ม จำกัด  โดย นายนิติพัฒน์   วงศ์ศิริธร ตำแหน่ง กรรมการ  ผู้มีอำนาจลงนาม  สำนักงานตั้งอยู่เลขที่  50/19  หมู่ที่ 6  ตำบลบางหลวง  อำเภอเมืองปทุมธานี  จังหวัดปทุมธานี 12000 โทรศัพท์   02 - 1010325" ;
    $contracktor = "นายนิติพัฒน์   วงศ์ศิริธร";
}
else{
    $promiseWith = "ไอซี ควอลิตี้ ซิสเท็ม  โดย นายอาทิตย์   บุญเคน   ผู้รับมอบอำนาจ สำนักงานตั้งอยู่เลขที่  12/1  หมู่ที่ 8 ตำบลบางคูวัด  อำเภอเมืองปทุมธานี  จังหวัดปทุมธานี 12000  โทรศัพท์  02-1010325";
    $contracktor = "นายอาทิตย์   บุญเคน";
}


$address = $model['changwat_id'] != 1 ? " ตำบล  " . $model['tambon'] . " อำเภอ " . $model['ampur'] . " จังหวัด " . $model['changwat'] : "  " . $model['tambon'] . "  " . $model['ampur'] . " " . $model['changwat'];
// $date1 = date_create($model['promisedatebegin']);
// $date2 = date_create($model['promisedateend']);
// $diff = date_diff($date1, $date2);
// $month = number_format($diff->format('%a') / 30);
$levy = ""; //"สัปดาห์ละ ". $model['levy']." ครั้ง (ทุกวันอังคาร)";

$discountBath = number_format($model['distcountbath']);
$discountBathText = str_replace(",", "", $discountBath);
//$discountBathText = str_replace(".","",$discountBath);

if($Config->getDiscount($model['payment']) == 1 && $discountBath > 0)
{
    $discount = " แต่เนื่องด้วยผู้ว่าจ้างเลือกจ่ายชำระเงินเป็นเป็นรายปี จึงได้รับส่วนลด " . $discountBath . " บาท (" . $Config->Convert($discountBathText) . ")";
    $total = $model['payperyear'];
    $tatalAll = number_format($model['total']);
    $tatalAllText = str_replace(",", "", $tatalAll);
    $discountText = " คิดเป็นค่าจ้างรวมทั้งปี ".$tatalAll . " บาท (" . $Config->Convert($tatalAllText) . ")";
}



if ($model['vat'] == 1 && $model['vattype'] == 2) {
    $vatText = " ราคานี้ ยังไม่รวมภาษีมูลค่าเพิ่ม 7% ";
    //$total = ($total * 100) / 107;
} else if ($model['vat'] == 1 && $model['vattype'] == 1) {
    $vatText = " ราคานี้ รวมภาษีมูลค่าเพิ่ม 7% ";
    $total = $total + (($total * 7) / 100);
}

$total = number_format($total);
$totalText = str_replace(",", "", $total);
//$totalText = str_replace(".","",$totalText);

$unitprice = $model['unitprice'];
$unitpriceText = "";
$paymentNumber = 0;
$countlevy = "";

$promiseType = "";
$paymentType = "";
if ($model['payment'] == 1) {
    $promiseType = " รายเดือน ";
    $paymentType = " งวดละ ";
    $paymentNumber = $model['unitprice'];
    $month = " 12 เดือน ";
}else if ($model['payment'] == 7) {
    $promiseType = " รายปี ";
    $paymentType = " ครั้งละ ";
    $paymentNumber = $model['unitprice'];
    $month = " 1 ปี ";
    $countlevy = " รวม ".$model['levy'] * 12 ." ครั้งต่อปี ";
}

else if ($model['payment'] == 2) {
    $promiseType = " รายเดือน ";
    $paymentType = "";
    $vatText = "";
    $paymentNumber = $model['rate'];
    // if ($model['vat'] == 1 && $model['vattype'] == 2) {
    //     $unitprice = ($unitprice * 100) / 107;
    // } else if ($model['vat'] == 1 && $model['vattype'] == 1) {
    //     $unitprice = $unitprice + (($unitprice * 7) / 100);
    // }
    $month = " 1 ปี ";
} else if ($model['payment'] == 8) {
    $promiseType = " รายครึ่งปี ";
    $paymentType = " ครั้งละ ";
    $paymentNumber = $model['unitprice'];
    $month = " 1 ปี ";
    $countlevy = " รวม ".$model['levy'] * 12 ." ครั้งต่อปี ";
} else if ($model['payment'] == 6 || $model['payment'] == 3) {
    $promiseType = " รายเดือน ";
    $paymentType = " เดือนละ ";
    $paymentNumber = $model['rate'];
    $month = " 1 ปี ";
}

$unitprice = number_format($unitprice, 2);
$unitpriceText = str_replace(",", "", $unitprice);
//$unitpriceText = str_replace(".","",$unitpriceText);

$recivetype = "";
$text1 = " โดยกำหนดค่าจ้าง ตามปริมาณน้ำหนักขยะไม่เกิน " . $model['garbageweight'] . " กิโลกรัมต่อครั้ง  ปริมาณที่มีน้ําหนักขยะเกิน  " . $model['garbageweight'] . " กิโลกรัมขึ้นไป ทางบริษัท จะคิดค่าขยะเพิ่มกิโลกรัมละ " . number_format($model['fine']) . " บาท (" . $Config->Convert($model['fine']) . ") ขยะที่ “ผู้รับจ้าง” เก็บขนย้าย ไปทำลายในแต่ละเดือน  คิดค่าจ้างเหมา ในอัตรา{$paymentType} " . number_format($paymentNumber) . " บาท (" . $Config->Convert($paymentNumber) . ")  โดยเข้าจัดเก็บ " . $model['levy'] . " ครั้งต่อเดือน  ".$countlevy."" . $discount . " เป็นค่าจ้างรวมทั้งสิ้นต่อปี " . $total . " บาท (" . $Config->Convert($totalText) . ")" . $vatText;
$text2 = " โดยกำหนดค่าจ้าง ตามปริมาณน้ำหนักขยะ ในอัตราค่าบริการกิโลกรัมละ " . $unitprice . " บาท (" . $Config->Convert($unitpriceText) . ") " . $vatText . " \"ผู้รับจ้าง\" จะทำการเก็บขนย้าย ไปทำลาย ในแต่ละเดือน โดยเข้าจัดเก็บทุกสัปดาห์ {$levy} ";
$text3 = " โดยกําหนดค่าจ้าง ตามปริมาณน้ําหนักขยะไม่เกิน " . $model['garbageweight'] . " กิโลกรัมต่อครั้ง ในอัตรา{$paymentType} " . number_format($paymentNumber) . " บาท (" . $Config->Convert($paymentNumber).") ".$vatText." ส่วนปริมาณน้ําหนักขยะ ส่วนท่ีเกิน " . $model['garbageweight'] . " กิโลกรัมขึ้นไป ทางบริษัทฯ จะคิดค่าขยะเพิ่มกิโลกรัมละ " . number_format($model['fine']) . " บาท (" . $Config->Convert($model['fine']) . ") “ผู้รับจ้าง” จะทําการเก็บ ขนย้ายไปทําลายในแต่ละเดือน โดยเข้า จัดเก็บเดือนละ " . $model['levy'] . " ครั้ง ".$countlevy."  คิดเป็นค่าจ้างรวมทั้งปี " . $total . " บาท (" . $Config->Convert($totalText) . ")  " . $discount . " ".$discountText."".$vatText;
if ($model['recivetype'] == 1 || $model['recivetype'] == 3) {
    if($model['payment'] == 1)
    {
        $recivetype =  $text1;
    }
    else if($model['payment'] == 7)
    {
        $recivetype =  $text3;
    }
    else if($model['payment'] == 8)
    {
        $recivetype =  $text3;
    }

} else if ($model['recivetype'] == 2) {
    $recivetype = $text2;
}
?>

<div style="font-family:sarabun;font-size:20px;">
    <div style="text-align:right">เลขที่ <?php echo $model['promisenumber'] ?></div>
    <div style="text-align:center"><strong>สัญญาตกลงการจ้างเหมาบริการ</strong></div>
    <p align ="justify">

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาตกลงการจ้างฉบับนี้ทำขึ้น ณ <?php echo $model['company']; ?> เลขที่ใบอนุญาต  <?php echo $model['taxnumber']; ?>  ตั้งอยู่เลขที่ <?php echo $model['address']; ?>
<?php echo $address; ?> รหัสไปรษณีย์ <?php echo $model['zipcode']; ?> เบอร์โทรสถานประกอบการ <?php echo $model['tel']; ?> เมื่อวันที่ <?php echo $Config->thaidateFull($model['createat']); ?> ระหว่าง <?php echo $model['company']; ?>  โดย <?php echo $model['manager']; ?>  ตำแหน่งเจ้าของสถานประกอบการ   ซึ่งต่อไปนี้เรียกว่า   “ผู้ว่าจ้าง”   ฝ่ายหนึ่ง  กับ <?php echo $promiseWith; ?> ซึ่งต่อไปนี้ในสัญญาเรียกว่า  “ผู้รับจ้าง”  อีกฝ่ายหนึ่ง  คู่สัญญาทั้งสองฝ่ายได้ตกลงกันโดยมีสาระสำคัญ ดังต่อไปนี้
    </p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 1 </strong>“ผู้ว่าจ้าง”  ตกลงว่าจ้าง และ “ผู้รับจ้าง” ตกลงรับจ้างเหมาทำการเก็บขนย้ายและกำจัดขยะมูลฝอยติดเชื้อ  ให้กับ   “ผู้ว่าจ้าง” เพื่อให้การทำลายขยะดังกล่าวเป็นไปตามกฎกระทรวงสาธารณสุขว่าด้วยการกำจัดขยะมูลฝอยติดเชื้อ พ.ศ. 2545 และกฎหมายอื่นๆที่เกี่ยวข้อง   ตามรายละเอียดแนบท้ายบันทึกที่แนบมาพร้อมนี้  โดยมีข้อกำหนดและเงื่อนไขแห่งบันทึกนี้ รวมทั้งเอกสารแนบท้ายบันทึกนี้</p>
    <p>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 2 </strong>“ผู้รับจ้าง” ตามข้อ 1 สัญญาว่าจะเริ่มนับตั้งแต่  วันที่ <?php echo $Config->thaidateFull($model['promisedatebegin']); ?> ถึงวันที่ <?php echo $Config->thaidateFull($model['promisedateend']); ?> รวมระยะเวลา <?php echo $month; ?>   ถ้าผู้รับจ้างมิได้ลงมือทำงานภายในกำหนดเวลา  หรือมีเหตุให้เชื่อได้ว่าผู้รับจ้าง ไม่สามารถทำงาน ให้แล้วเสร็จ ภายใน กำหนดเวลา  หรือล่าช้าเกินกว่ากำหนดเวลา   หรือผู้รับจ้างทำผิดข้อตกลงข้อใดข้อหนึ่ง  ผู้ว่าจ้างมีสิทธิ ที่จะบอกเลิกจ้างตามบันทึกนี้ได้ </p>
    <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 3 </strong> “ผู้ว่าจ้าง”  ตกลงจ่าย  และผู้รับจ้างตกลงรับเงินค่าจ้างเป็น<?php echo $promiseType; ?>  รวมระยะเวลา  <?php echo $month; ?>   <?php echo $recivetype; ?>   โดยกำหนดจ่าย ภายใน  30 วัน นับตั้งแต่วันที่ “ผู้ว่าจ้าง” หรือตัวแทนของ “ผู้ว่าจ้าง” ได้ทำการตรวจรับ ถูกต้องเรียบร้อยแล้ว </p>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 4 หน้าที่รับผิดชอบของ “ผู้รับจ้าง”</strong>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.1 “ผู้รับจ้าง”  จะต้องทำการเก็บขนย้ายและกำจัดขยะมูลฝอยติดเชื้อ โดยใช้พนักงานที่มีความรู้ผ่านการอบรม การกำจัดขยะติดเชื้อและขนย้าย  เพื่อป้องกันอันตรายจากการเก็บขยะ และปฏิบัติตามหลักเกณฑ์ที่กฎหมายและระเบียบ ได้กำหนดไว้อย่างเคร่งครัด  เพื่อให้เป็นไปตามกฎกระทรวงสาธารณสุขว่าด้วยการกำจัดขยะมูลฝอยติดเชื้อ พ.ศ. 2545</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.2 “ผู้รับจ้าง” จะต้องเป็นผู้มีอาชีพรับจ้างขนและกำจัดขยะมูลฝอยติดเชื้อ ที่มีสถานที่ผู้ได้รับใบอนุญาตกำจัดขยะ มูลฝอยติดเชื้อ ซึ่งเป็นนิติบุคคลผู้มีอาชีพรับจ้างกำจัดขยะมูลฝอยติดเชื้อ  ไว้รองรับการกำจัดขยะมูลฝอยติดเชื้อ โดยวิธีเผา ในเตาเผาขยะมูลฝอยติดเชื้อ  ตลอดระยะเวลาตามสัญญานี้ด้วย</p>
    <p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.3 “ผู้รับจ้าง” จะต้องทำการเก็บขนย้ายและกำจัดขยะมูลฝอยติดเชื้อ ในวันและเวลาตามตารางการจัดเก็บของ  “ผู้รับจ้าง”  ไปกำจัดตามวิธีการที่กำหนดและถูกต้อง ในการขนย้ายขยะฯดังกล่าวทุกครั้งจะต้องบันทึกปริมาณน้ำหนัก </p>
    <div style="page-break-after: always;"></div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 5 หน้าที่รับผิดชอบของ “ผู้ว่าจ้าง”</strong>

    <p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.1  “ผู้ว่าจ้าง” จะต้องจัดเก็บขยะมูลฝอยติดเชื้อที่บรรจุไว้ในถุงแดงอยู่ในสภาพเรียบร้อย ถุงไม่แตก ไม่รั่วซึม         มัดปากถุงอย่างถูกต้อง และแยกของมีคมทุกชนิดบรรจุมิดชิด ไม่ให้แทงทะลุออกจากถุง ไว้ที่จุดพักตามสถานที่พักขยะของ “ผู้ว่าจ้าง”  โดยปฏิบัติให้เป็นไปตามประกาศกระทรวงสาธารณสุข และกฎหมายที่เกี่ยวข้องทุกประการ</p>
    <p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.2  “ผู้ว่าจ้าง” จะต้องจัดเจ้าหน้าที่ผู้รับผิดชอบขยะมูลฝอยติดเชื้อไว้ ประสานงานและร่วมมือรับทราบ การบันทึกน้ำหนักขยะ ตลอดจนการลงลายมือชื่อร่วมไว้ในเอกสารดังกล่าว ตามวันและเวลาที่ทั้งสองฝ่ายได้ตกลงกำหนดไว้ด้วย</p>
    <p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.3  “ผู้ว่าจ้าง” จะต้องจัดเก็บขยะมูลฝอยติดเชื้อ ตามข้อ 5.1 ไว้ที่จุดพัก พักขยะซึ่ง “ผู้รับจ้าง” สามารถทำการ เก็บขนได้   ตามวันและเวลาที่ทั้งสองฝ่ายได้ตกลงกำหนดกันไว้</p>
    <p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.4 &nbsp;หาก”ผู้ว่าจ้าง”เปิดทำการไม่ตรงเวลาทำการของ”ผู้รับจ้าง” หรือมีเหตุให้ต้องหยุดทำการในวันและเวลา ที่ตกลงกันไว้ “ผู้ว่าจ้าง” จะต้องวางขยะไว้ในจุดที่ “ผู้รับจ้าง”สามารถเก็บขนได้ หาก“ผู้ว่าจ้าง”ไม่วางขยะตามกำหนดวัน และเวลาที่ตกลงกันไว้”ผู้ว่าจ้าง”ยินยอมจ่ายค่าบริการให้ “ผู้รับจ้าง”</p>

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 6 </strong> กรณี“ผู้รับจ้าง” ไม่ปฏิบัติตามข้อตกลงในสัญญานี้ข้อหนึ่งข้อใดด้วยเหตุใดๆก็ตามเป็นเหตุให้เกิดความเสียหายแก่    “ผู้ว่าจ้าง” แล้ว  “ผู้รับจ้าง” ยินดีรับผิดชอบ  และยินยอมชดใช้ค่าเสียหาย  อันเกิดจากการที่ “ผู้รับจ้าง” ไม่ปฏิบัติตามข้อตกลงนั้น ให้แก่ “ผู้ว่าจ้าง” โดยสิ้นเชิง  ภายในกำหนด 30 วัน  นับแต่วันที่ได้รับแจ้งจาก “ผู้ว่าจ้าง”</p>
    <p >
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 7 </strong> กรณีที่“ผู้ว่าจ้าง” ประสงค์จะบอกเลิกสัญญาฉบับนี้ก่อนกำหนด “ผู้ว่าจ้าง” จะต้องแจ้งให้ “ผู้รับจ้าง” ทราบล่วงหน้าไม่น้อยกว่า 30 วัน
        สัญญาจ้างนี้ทำขึ้นสองฉบับ  มีข้อความถูกต้องตรงกัน  ทั้งสองฝ่ายได้อ่านและเข้าใจดีแล้ว  จึงได้ลงลายมือชื่อพร้อมทั้งประทับตรา (ถ้ามี) ไว้ต่อหน้าพยานเป็นสำคัญและเก็บไว้ฝ่ายละฉบับ
    </p>


    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หมายเหตุ : ทาง”ผู้รับจ้าง” จะเข้าดำเนินการจัดเก็บขยะมูลฝอยติดเชื้อให้กับ “ผู้ว่าจ้าง” หลังจากทำสัญญาแล้วประมาณ 1 เดือน
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้ประกอบการ <?php echo $model['company']; ?> เบอร์โทรศัพท์ <?php echo $model['tel']; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้ประสานงาน (ผู้ติดต่อได้) <?php echo $model['manager']; ?>  เบอร์โทรศัพท์ <?php echo $model['telephone']; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานที่ตั้ง	N <?php echo $model['lat']; ?>        E <?php echo $model['long']; ?>.
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันเวลาทำการ <?php echo $model['timework'] == "" ? "-" : $model['timework']; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานที่จัดเก็บ <?php echo $model['company']; ?>
<?php
$employer1 = $model['employer1']; //== "" ? "................................................." : $model['employer1'];
$employer2 = $model['employer2']; //== "" ? "................................................." : $model['employer2'];
$witness = "";

// if($model['employer1'] != "" && $model['employer2'] != "")
// {
//     $employer =  $model['employer1'].", ".$model['employer2'];
// }
// else if($model['employer1'] != "" || $model['employer2'] != "")
// {
//     $employer = $model['employer1'].$model['employer2'];
// }
// else{
//     $employer = ".................................................";
// }


if ($model['witness1'] != "" && $model['witness2'] != "") {
    $witness = $model['witness1'] . ", " . $model['witness2'];
} else if ($model['witness1'] != "" || $model['witness2'] != "") {
    $witness = $model['witness1'] . $model['witness2'];
} else {
    $witness = ".................................................";
}
?>
     <br><br>
    <?php if($employer1 != "" && $employer2 != ""):?>
        <div>
            <div style="float: left;width:30%; text-align: center;">
                (ลงชื่อ).....................................ผู้ว่าจ้าง
                <br>
                (<?php echo $employer1; ?>)
            </div>

            <div style="float: left;width:30%; text-align: center;">
                (ลงชื่อ).....................................ผู้ว่าจ้าง
                <br>
                (<?php echo $employer2; ?>)
            </div>
            <div style="float: left;width:40%; text-align: center;">
                (ลงชื่อ).....................................ผู้รับจ้าง
                <br>
                (นายนิติพัฒน์      วงศ์ศิริธร)
            </div>
        </div>
    <?php endif;?>
    <?php  if($employer1 != "" && $employer2 == ""){?>
        <div>
            <div style="float: left;width:50%; text-align: center;">
                (ลงชื่อ).....................................ผู้ว่าจ้าง
                <br>
                (<?php echo $employer1; ?>)
            </div>

            <div style="float: left;width:50%; text-align: center;">
                (ลงชื่อ).....................................ผู้รับจ้าง
                <br>
                (นายนิติพัฒน์      วงศ์ศิริธร)
            </div>
        </div>
    <?php }?>
    <br>
    <?php  if($employer1 == "" && $employer2 == ""){?>
        <div>
            <div style="float: left;width:50%; text-align: center;">
                (ลงชื่อ).....................................ผู้ว่าจ้าง
                <br>
                (..............................................)
            </div>

            <div style="float: left;width:50%; text-align: center;">
                (ลงชื่อ).....................................ผู้รับจ้าง
                <br>
                (<?php echo $contracktor;?>)
            </div>
        </div>
    <?php }?>
    <br>
    <div>
        <div style="float: left;width:50%; text-align: center;">
            (ลงชื่อ).....................................พยาน
            <br>
            (<?php echo $witness; ?>)
        </div>
        <div style="float: left;width:50%; text-align: center;">
            (ลงชื่อ).....................................พยาน
            <br>
            (นางบุญสวย    พรมไพร)
        </div>
    </div>

<?php if ($model['typeregister'] == 1): ?>
        <div class="div" style="page-break-after:always;"></div>
        <div class="row"  style="padding-left:20px;font-family:sarabun;font-size:20px;line-height: 1">
            <div class="text-center "><strong>เอกสารแนบท้ายสัญญา</strong></div>
            &nbsp;&nbsp;&nbsp;&nbsp;เงื่อนไขการจัดการมูลฝอยติดเชื้อสำหรับสถานบริการสาธารณสุข / บริษัทเอกชน ที่รับการบริการ
            <div style="">
                <br>1.&nbsp;&nbsp;ถุงพลาสติกที่ใช้บรรจุมูลฝอยติดเชื้อต้องทนทาน  ไม่ฉีกขาดง่าย  มีสีแดงสด  ทึบแสง บรรจุมูลฝอยติดเชื้อไม่เกิน 2 ใน 3 ส่วน<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ของถุงพลาสติกแดง และไม่ใส่ปะปนกับมูลฝอยทั่วไป แล้วมัดปากถุงด้วยเชือกหรือวัสดุอื่นๆให้แน่น
                <br>2.&nbsp;&nbsp;ภาชนะมูลฝอยติดเชื้อประเภทของมีคม ต้องบรรจุอยู่ในภาชนะที่ทนทานต่อการทิ่มแทงทะลุ  มีฝาปิดกล่อง  มีสีแดงสด  ทึบแสง <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โดยจะต้องบรรจุไม่เกิน 3 ใน 4 ส่วนของความจุภาชนะนั้นๆ
                <br>3.&nbsp;&nbsp;ห้ามมิให้สถานบริการสาธารณสุขทิ้งเข็มฉีดยา หรือวัตถุมีคมประเภทต่างๆ ลงในถุงขยะติดเชื้อโดยตรง  ควรรวบรวมทิ้งไว้ในกระป๋อง<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือกระปุกที่มีฝาปิดมิดชิด  เพราะเข็มฉีดยาหรือวัตถุมีคมทำให้ถุงฉีกขาดเป็นการแพร่กระจายของเชื้อโรค<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;และอาจทำอันตรายเจ้าหน้าที่ในขณะปฏิบัติงานได้
                <br>4.&nbsp;&nbsp;กรณีสถานบริการสาธารณสุขอยู่ในอาคารสูง สถานพยาบาลนั้นๆ ต้องติดต่อกับเจ้าของอาคารในการจัดที่พักมูลฝอยไว้<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางด้านล่างของอาคาร  เพื่อป้องกันการแพร่กระจายของเชื้อโรค
                <br>5.&nbsp;&nbsp;สถานบริการสาธารณสุขควรนำมูลฝอยติดเชื้อมาใส่ถังที่มีฝาปิดมิดชิดและติดป้ายชัดเจนว่า  “ขยะติดเชื้อ BIOHAZARD WASTE”<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เท่านั้น และนำถังมาไว้ที่จุดที่พักขยะ โดยแยกขยะติดเชื้อออกจากขยะทั่วไปอย่างชัดเจน
                <br>6.&nbsp;&nbsp;เนื่องจากในแต่ละวัน ทางบริษัทฯ ต้องให้บริการแก่สถานบริการสาธารณสุขเป็นจำนวนมาก และในการเข้าเก็บขนในแต่ละพื้นที่<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;มักจะประสบปัญหา          เรื่องการจราจร ทางบริษัทฯ  จึงขอความร่วมมือให้สถานบริการสาธารณสุข จัดเตรียมขยะไว้ที่จุดพักขยะ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ให้พร้อม เพื่อให้เข้าเก็บได้ทันที
                <br>7.&nbsp;&nbsp;เมื่อสถานบริการสาธารณสุขมีความประสงค์ต้องการรับการบริการ  ยกเลิก  ปิดกิจการ  ย้ายที่อยู่  เปลี่ยนชื่อ  ปิดปรับปรุง <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรุณาแจ้งเป็นลายลักษณ์อักษรให้ทราบล่วงหน้าอย่างน้อย  1   เดือน
                <br>8.&nbsp;&nbsp;กรณีที่สถานบริการสาธารณสุขชำระค่าบริการเป็นรายเดือนทุกเดือน  ขอความร่วมมือให้ชำระค่าบริการโดยการโอนเงินเข้าบัญชี <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือชำระด้วยเช็คสั่งจ่ายเท่านั้น   กรณีที่มีความจำเป็นต้องชำระเป็นเงินสดกับพนักงานจัดเก็บ ขอให้ทางสถานบริการสาธารณสุข <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ร้องขอใบเสร็จที่มีการประทับตราบริษัทฯด้วยทุกครั้ง เพื่อเป็นการยืนยันว่าท่านได้ชำระเงินเรียบร้อยแล้ว   หากไม่มีใบเสร็จที่ออก<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จากทางบริษัทฯมายืนยัน  บริษัทฯจะไม่รับผิดชอบต่อความเสียหายใดๆที่เกิดขึ้นทั้งสิ้น
                <br>9.&nbsp;&nbsp;หลังจากที่ทำสัญญาเรียบร้อยแล้วทางบริษัทฯ จะจัดรอบการเข้าจัดเก็บ และแจ้งให้ทราบอีกครั้งว่า รอบการเข้าจัดเก็บ เป็นวันอะไร <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัปดาห์ที่เท่าไหร่ของเดือน  ซึ่งทางสถานบริการสาธารณสุขจะต้องนำมูลฝอยติดเชื้อ วางไว้ที่จุดพักขยะให้พร้อม เพื่อให้เจ้าหน้า<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ที่สามารถทำการจัดเก็บได้  กรณีไม่มีเจ้าหน้าที่เข้าจัดเก็บตามรอบ  ต้องรีบแจ้งเรื่องให้บริษัทฯ รับทราบทันที
            </div>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัทฯ หวังเป็นอย่างยิ่งว่า  สถานบริการสาธารณสุขของท่านจะปฏิบัติตามเงื่อนไขดังกล่าวอย่างเคร่งครัด  เพื่อให้การเก็บขน<br>มูลฝอยติดเชื้อดำเนินการอย่างมีประสิทธิภาพและถูกต้องตามหลักสุขาภิบาล หากสถานบริการสาธารณสุขใดไม่ปฏิบัติตามเงื่อนปฏิบัติ ทางบริษัทฯ ขอสงวนสิทธิ์การเข้าจัดเก็บมูลฝอยติดเชื้อจากสถานบริการสาธารณสุขนั้นๆ  จนกว่าท่านจะดำเนินการแก้ไขให้เป็นไปตาม<br>เงื่อนไขของบริษัทฯเรียบร้อยแล้ว
            <div style="text-decoration: underline;">รายการขยะติดเชื้อที่รับจัดเก็บ ได้แก่</div>
            1.วัสดุของมีคม เช่น เข็ม ใบมีด กระบอกฉีดยา หลอดแก้ว ภาชนะที่ทำด้วยแก้วสไลด์ และแผ่นกระจกปิดสไลด์
            <br>2.วัสดุซึ่งสัมผัส หรือ สงสัยว่าจะสัมผัสกับเลือด ส่วนประกอบขยะเลือด ผลิตภัณฑ์ที่ได้จากเลือด สารน้ำจากร่างกายของมนุษย์หรือสัตว์ หรือวัคซีนที่ทำจากเชื้อโรคที่มีชีวิต เช่น สำลี ผ้าก๊อต  ผ้าต่างๆ และท่อยาง
            <br>3.มูลฝอยทุกชนิดที่มาจากห้องรักษาผู้ป่วยติดเชื้อร้ายแรง
            <br>4.ขยะติดเชื้ออื่นๆ ตามเงื่อนไขของผู้รับกำจัด
            <div class="text-center" style="border:1px solid;">ช่องทางและเงื่อนไขการชำระค่าบริการ</div>
            <div class="row" style="margin-top:10px;">
                <div style="float:left;width:30%;padding-left:20px;">
                    <img src="<?php echo Url::to('@web/../images/scbfull.jpg') ?>"/>
                </div>
                <div style="float:left;width:60%;padding-left:20px;">
                    <strong>ธนาคาร  : ไทยพาณิชย์  สาขา : ตลาดพูนทรัพย์ (ปทุมธานี)</strong>
                    <strong><br>ชื่อบัญชี : บริษัท ไอซี  ควอลิตี้  ซิสเท็ม  จำกัด</strong>
                    <strong><br>เลขที่บัญชี : 372 – 259936 –7 </strong>
                </div>
            </div>
            <div style="padding-left:15px;">
                หมายเหตุ  :   หากท่านชำระเงินแล้ว กรุณาส่งหลักฐานการโอนเงินหรือสลิป พร้อมทั้งระบุชื่อสถานบริการสาธารณสุข<br>และเดือนที่ท่านชำระค่าบริการให้ชัดเจน   โดยส่งได้ที่ ID Line OA : @icqualitysystem  หรือนำส่งทาง e–mail : icquality@icqs.net  โทรศัพท์  02–101–0325 / 096-878-1596  (กรุณาชำระเงินภายใน 30 วัน หลังจากส่งมอบงาน)
            </div>
            <div class="row" style="margin-top:10px;">
                <div style="float:left;width:10%;padding-left:30px;">
                    <img src="<?php echo Url::to('@web/../images/qrcodeline.PNG') ?>" width="70px"/>
                </div>
                <div style="float:left;width:80%;padding-left:20px;">
                    <strong>สามารถสแกน QR Code เพื่อเพิ่มเพื่อนใน Line Official Account บริษัทฯ ได้เลยค่ะ </strong>
                    <strong><br>ID  Line OA :  @icqualitysystem </strong>
                </div>
            </div>
        </div>
<?php endif; ?>

<?php if ($model['typeregister'] == 3): ?>
        <div class="div" style="page-break-after:always;"></div>
        <div class="row"  style="padding-left:20px;font-family:sarabun;font-size:20px;line-height: 1">
            <div class="text-center "><strong>เอกสารแนบท้ายสัญญา</strong></div>
            &nbsp;&nbsp;&nbsp;&nbsp;เงื่อนไขการจัดการมูลฝอยติดเชื้อสำหรับสถานบริการสาธารณสุข / บริษัทเอกชน ที่รับการบริการ
            <div style="">
                <br>1.&nbsp;&nbsp;ถุงพลาสติกที่ใช้บรรจุมูลฝอยติดเชื้อต้องทนทาน  ไม่ฉีกขาดง่าย  มีสีแดงสด  ทึบแสง บรรจุมูลฝอยติดเชื้อไม่เกิน 2 ใน 3 ส่วน<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ของถุงพลาสติกแดง และไม่ใส่ปะปนกับมูลฝอยทั่วไป แล้วมัดปากถุงด้วยเชือกหรือวัสดุอื่นๆให้แน่น
                <br>2.&nbsp;&nbsp;ภาชนะมูลฝอยติดเชื้อประเภทของมีคม ต้องบรรจุอยู่ในภาชนะที่ทนทานต่อการทิ่มแทงทะลุ  มีฝาปิดกล่อง  มีสีแดงสด  ทึบแสง <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โดยจะต้องบรรจุไม่เกิน 3 ใน 4 ส่วนของความจุภาชนะนั้นๆ
                <br>3.&nbsp;&nbsp;ห้ามมิให้สถานบริการสาธารณสุขทิ้งเข็มฉีดยา หรือวัตถุมีคมประเภทต่างๆ ลงในถุงขยะติดเชื้อโดยตรง  ควรรวบรวมทิ้งไว้ในกระป๋อง<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือกระปุกที่มีฝาปิดมิดชิด  เพราะเข็มฉีดยาหรือวัตถุมีคมทำให้ถุงฉีกขาดเป็นการแพร่กระจายของเชื้อโรค<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;และอาจทำอันตรายเจ้าหน้าที่ในขณะปฏิบัติงานได้
                <br>4.&nbsp;&nbsp;กรณีสถานบริการสาธารณสุขอยู่ในอาคารสูง สถานพยาบาลนั้นๆ ต้องติดต่อกับเจ้าของอาคารในการจัดที่พักมูลฝอยไว้<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางด้านล่างของอาคาร  เพื่อป้องกันการแพร่กระจายของเชื้อโรค
                <br>5.&nbsp;&nbsp;สถานบริการสาธารณสุขควรนำมูลฝอยติดเชื้อมาใส่ถังที่มีฝาปิดมิดชิดและติดป้ายชัดเจนว่า  “ขยะติดเชื้อ BIOHAZARD WASTE”<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เท่านั้น และนำถังมาไว้ที่จุดที่พักขยะ โดยแยกขยะติดเชื้อออกจากขยะทั่วไปอย่างชัดเจน
                <br>6.&nbsp;&nbsp;เนื่องจากในแต่ละวัน ทางบริษัทฯ ต้องให้บริการแก่สถานบริการสาธารณสุขเป็นจำนวนมาก และในการเข้าเก็บขนในแต่ละพื้นที่<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;มักจะประสบปัญหา          เรื่องการจราจร ทางบริษัทฯ  จึงขอความร่วมมือให้สถานบริการสาธารณสุข จัดเตรียมขยะไว้ที่จุดพักขยะ<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ให้พร้อม เพื่อให้เข้าเก็บได้ทันที
                <br>7.&nbsp;&nbsp;เมื่อสถานบริการสาธารณสุขมีความประสงค์ต้องการรับการบริการ  ยกเลิก  ปิดกิจการ  ย้ายที่อยู่  เปลี่ยนชื่อ  ปิดปรับปรุง <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรุณาแจ้งเป็นลายลักษณ์อักษรให้ทราบล่วงหน้าอย่างน้อย  1   เดือน
                <br>8.&nbsp;&nbsp;กรณีที่สถานบริการสาธารณสุขชำระค่าบริการเป็นรายเดือนทุกเดือน  ขอความร่วมมือให้ชำระค่าบริการโดยการโอนเงินเข้าบัญชี <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือชำระด้วยเช็คสั่งจ่ายเท่านั้น   กรณีที่มีความจำเป็นต้องชำระเป็นเงินสดกับพนักงานจัดเก็บ ขอให้ทางสถานบริการสาธารณสุข <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ร้องขอใบเสร็จที่มีการประทับตราบริษัทฯด้วยทุกครั้ง เพื่อเป็นการยืนยันว่าท่านได้ชำระเงินเรียบร้อยแล้ว   หากไม่มีใบเสร็จที่ออก<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จากทางบริษัทฯมายืนยัน  บริษัทฯจะไม่รับผิดชอบต่อความเสียหายใดๆที่เกิดขึ้นทั้งสิ้น
                <br>9.&nbsp;&nbsp;หลังจากที่ทำสัญญาเรียบร้อยแล้วทางบริษัทฯ จะจัดรอบการเข้าจัดเก็บ และแจ้งให้ทราบอีกครั้งว่า รอบการเข้าจัดเก็บ เป็นวันอะไร <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัปดาห์ที่เท่าไหร่ของเดือน  ซึ่งทางสถานบริการสาธารณสุขจะต้องนำมูลฝอยติดเชื้อ วางไว้ที่จุดพักขยะให้พร้อม เพื่อให้เจ้าหน้า<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ที่สามารถทำการจัดเก็บได้  กรณีไม่มีเจ้าหน้าที่เข้าจัดเก็บตามรอบ  ต้องรีบแจ้งเรื่องให้บริษัทฯ รับทราบทันที
            </div>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัทฯ หวังเป็นอย่างยิ่งว่า  สถานบริการสาธารณสุขของท่านจะปฏิบัติตามเงื่อนไขดังกล่าวอย่างเคร่งครัด  เพื่อให้การเก็บขน<br>มูลฝอยติดเชื้อดำเนินการอย่างมีประสิทธิภาพและถูกต้องตามหลักสุขาภิบาล หากสถานบริการสาธารณสุขใดไม่ปฏิบัติตามเงื่อนปฏิบัติ ทางบริษัทฯ ขอสงวนสิทธิ์การเข้าจัดเก็บมูลฝอยติดเชื้อจากสถานบริการสาธารณสุขนั้นๆ  จนกว่าท่านจะดำเนินการแก้ไขให้เป็นไปตาม<br>เงื่อนไขของบริษัทฯเรียบร้อยแล้ว
            <div style="text-decoration: underline;">รายการขยะติดเชื้อที่รับจัดเก็บ ได้แก่</div>
            1.วัสดุของมีคม เช่น เข็ม ใบมีด กระบอกฉีดยา หลอดแก้ว ภาชนะที่ทำด้วยแก้วสไลด์ และแผ่นกระจกปิดสไลด์
            <br>2.วัสดุซึ่งสัมผัส หรือ สงสัยว่าจะสัมผัสกับเลือด ส่วนประกอบขยะเลือด ผลิตภัณฑ์ที่ได้จากเลือด สารน้ำจากร่างกายของมนุษย์หรือสัตว์ หรือวัคซีนที่ทำจากเชื้อโรคที่มีชีวิต เช่น สำลี ผ้าก๊อต  ผ้าต่างๆ และท่อยาง
            <br>3.มูลฝอยทุกชนิดที่มาจากห้องรักษาผู้ป่วยติดเชื้อร้ายแรง
            <br>4.ขยะติดเชื้ออื่นๆ ตามเงื่อนไขของผู้รับกำจัด
            <div class="text-center" style="border:1px solid;">ช่องทางและเงื่อนไขการชำระค่าบริการ</div>
            <div class="row" style="margin-top:10px;">
                <div style="float:left;width:30%;padding-left:20px;">
                    <img src="<?php echo Url::to('@web/../images/scbfull.jpg') ?>"/>
                </div>
                <div style="float:left;width:60%;padding-left:20px;">
                    <strong>ธนาคาร  : ไทยพาณิชย์  สาขา : ตลาดพูนทรัพย์ (ปทุมธานี)</strong>
                    <strong><br>ชื่อบัญชี : นายอาทิตย์ บุญเคน</strong>
                    <strong><br>เลขที่บัญชี : 372 – 269136 –3 </strong>
                </div>
            </div>
            <div style="padding-left:15px;">
                หมายเหตุ  :   หากท่านชำระเงินแล้ว กรุณาส่งหลักฐานการโอนเงินหรือสลิป พร้อมทั้งระบุชื่อสถานบริการสาธารณสุข<br>และเดือนที่ท่านชำระค่าบริการให้ชัดเจน   โดยส่งได้ที่ ID Line OA : @icqualitysystem  หรือนำส่งทาง e–mail : icquality@icqs.net  โทรศัพท์  02–101–0325 / 096-878-1596  (กรุณาชำระเงินภายใน 30 วัน หลังจากส่งมอบงาน)
            </div>
            <div class="row" style="margin-top:10px;">
                <div style="float:left;width:10%;padding-left:30px;">
                    <img src="<?php echo Url::to('@web/../images/qrcodeline.PNG') ?>" width="70px"/>
                </div>
                <div style="float:left;width:80%;padding-left:20px;">
                    <strong>สามารถสแกน QR Code เพื่อเพิ่มเพื่อนใน Line Official Account บริษัทฯ ได้เลยค่ะ </strong>
                    <strong><br>ID  Line OA :  @icqualitysystem </strong>
                </div>
            </div>
        </div>
<?php endif; ?>
</div>

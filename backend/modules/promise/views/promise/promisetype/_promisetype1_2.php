<?php

use yii\helpers\Html;
use app\models\Config;

$Config = new Config();
?>

<div style="font-family:sarabun;font-size:18px;">
    <div style="text-align:right">เลขที่ <?php echo $model['promisenumber'] ?></div>
    <div style="text-align:center"><strong>สัญญาตกลงการจ้างเหมาบริการ</strong></div>
    <p align ="justify">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาตกลงการจ้างฉบับนี้ทำขึ้น ณ <?php echo $model['company']; ?> เลขที่ใบอนุญาต  <?php echo $model['taxnumber']; ?>  ตั้งอยู่เลขที่ <?php echo $model['address']; ?>
        ถนน <?php echo ""; ?> ซอย <?php echo ""; ?> ตำบล/แขวง <?php echo $model['tambon']; ?> อำเภอ/เขต <?php echo $model['ampur']; ?> จังหวัด <?php echo $model['changwat']; ?> รหัสไปรษณีย์ <?php echo $model['zipcode']; ?> เบอร์โทรสถานประกอบการ <?php echo $model['tel']; ?> เมื่อวันที่ <?php echo $Config->thaidate($model['createat']); ?> ระหว่าง <?php echo $model['company']; ?>  โดย <?php echo $model['manager']; ?>  ตำแหน่งเจ้าของสถานประกอบการ   ซึ่งต่อไปนี้เรียกว่า   “ผู้ว่าจ้าง”   ฝ่ายหนึ่ง  กับ บริษัท ไอซี ควอลิตี้ซิสเท็ม จำกัด  โดย นายนิติพัฒน์   วงศ์ศิริธร  ผู้รับมอบอำนาจ  สำนักงานตั้งอยู่เลขที่  50/19  หมู่ที่ 6  ตำบลบางหลวง  อำเภอเมืองปทุมธานี  จังหวัดปทุมธานี 12000 โทรศัพท์   02 - 1010325 ซึ่งต่อไปนี้ในสัญญาเรียกว่า  “ผู้รับจ้าง”  อีกฝ่ายหนึ่ง  คู่สัญญาทั้งสองฝ่ายได้ตกลงกันโดยมีสาระสำคัญ ดังต่อไปนี้
    </p>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 1 </strong>“ผู้ว่าจ้าง”  ตกลงว่าจ้าง และ “ผู้รับจ้าง” ตกลงรับจ้างเหมาทำการเก็บขนย้ายและกำจัดขยะมูลฝอยติดเชื้อ  ให้กับ   “ผู้ว่าจ้าง” เพื่อให้การทำลายขยะดังกล่าวเป็นไปตามกฎกระทรวงสาธารณสุขว่าด้วยการกำจัดขยะมูลฝอยติดเชื้อ พ.ศ. 2545 และกฎหมายอื่นๆที่เกี่ยวข้อง   ตามรายละเอียดแนบท้ายบันทึกที่แนบมาพร้อมนี้  โดยมีข้อกำหนดและเงื่อนไขแห่งบันทึกนี้ รวมทั้งเอกสารแนบท้ายบันทึกนี้

    <p align ="justify">  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 2 </strong>“ผู้รับจ้าง” ตามข้อ 1 สัญญาว่าจะเริ่มนับตั้งแต่  วันที่ <?php echo $Config->thaidate($model['promisedatebegin']); ?> ถึงวันที่ <?php echo $Config->thaidate($model['promisedateend']); ?> รวมระยะเวลา 12 เดือน  ถ้าผู้รับจ้างมิได้ลงมือทำงานภายในกำหนดเวลา  หรือมีเหตุให้เชื่อได้ว่าผู้รับจ้าง ไม่สามารถทำงานให้แล้วเสร็จภายในกำหนดเวลา  หรือล่าช้าเกินกว่ากำหนดเวลา   หรือผู้รับจ้างทำผิดข้อตกลงข้อใดข้อหนึ่ง  ผู้ว่าจ้างมีสิทธิที่จะบอกเลิกจ้างตามบันทึกนี้ได้ </p>
    <p align ="justify">
        <?php
        $discount = $model['payment'] == 6 ? " แต่เนื่องด้วยผู้ว่าจ้างเลือกจ่ายชำระเงินเป็นเป็นรายปี จึงได้รับส่วนลด " . number_format($model['distcountbath']) . " บาท (" . $Config->Convert(($model['distcountbath'])) . ")" : "";
        ?>
        <?php if ($model['payment'] == 0) { ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 3 </strong> “ผู้ว่าจ้าง”  ตกลงจ่าย  และผู้รับจ้างตกลงรับเงินค่าจ้างเป็นรายครั้ง  รวม  12  เดือน โดยกำหนดค่าจ้างตามน้ำหนักไม่เกิน <?php echo $model['garbageweight'] ?> กิโลกรัมต่อครั้ง  ปริมาณน้ำหนักขยะส่วนที่เกิน  <?php echo $model['garbageweight'] ?> กิโลกรัมขึ้นไป ทางบริษัทฯ จะคิดค่าขยะส่วนที่เกิน  เพิ่มกิโลกรัมละ <?php echo number_format($model['fine']) ?> บาท (<?php echo $Config->Convert($model['fine']) ?>) ขยะที่“ผู้รับจ้าง” เก็บขนย้ายไปทำลายในแต่ละเดือน  คิดค่าจ้างเหมาในอัตราครั้งละ <?php echo number_format($model['rate']); ?> บาท (<?php echo $Config->Convert($model['rate']) ?>)  จัดเก็บ <?php echo $model['levy']; ?> ครั้งต่อ เดือน เป็นค่าจ้างรวมทั้งสิ้นต่อปี <?php echo number_format($model['total']); ?> บาท (<?php echo $Config->Convert($model['total']) ?>)  ราคานี้รวมภาษีมูลค่าเพิ่ม  7 %  โดยกำหนดจ่ายภายใน  30 วัน นับตั้งแต่วันที่ “ผู้ว่าจ้าง” หรือตัวแทนของ “ผู้ว่าจ้าง” ได้ทำการตรวจรับถูกต้องเรียบร้อยแล้ว
        <?php } else if ($model['payment'] == 1) { ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 3 </strong> “ผู้ว่าจ้าง”  ตกลงจ่าย  และผู้รับจ้างตกลงรับเงินค่าจ้างเป็นรายปี  ระยะเวลา  1  ปี โดยคิดค่าจ้างตามปริมาณน้ำหนักขยะไม่เกิน <?php echo $model['garbageweight'] ?> กิโลกรัมต่อครั้ง  ในอัตราเดือนละ  <?php echo number_format($model['rate']); ?> บาท (<?php echo $Config->Convert($model['rate']) ?>) ส่วนปริมาณน้ำหนักขยะส่วนที่เกิน <?php echo $model['garbageweight'] ?> กิโลกรัมขึ้นไป จะคิดค่าจัดเก็บขยะเพิ่ม ในอัตรากิโลกรัมละ <?php echo number_format($model['fine']) ?> บาท (<?php echo $Config->Convert($model['fine']) ?>) “ผู้รับจ้าง” เก็บขนย้ายไปทำลายในแต่ละเดือน โดยเข้าจัดเก็บเดือนละ <?php echo $model['levy']; ?> ครั้ง รวม <?php echo ((int) $model['levy'] * 12) ?> ครั้งต่อปี <?php echo $discount; ?> คิดเป็นค่าจ้างรวมทั้งปี <?php echo number_format($model['total']) ?> บาท (<?php echo $Config->Convert(($model['total'])) ?>) ราคานี้รวมภาษีมูลค่าเพิ่ม 7 % โดยกำหนดจ่ายชำระภายใน 30 วัน นับตั้งแต่วันที่ “ผู้ว่าจ้าง” หรือตัวแทนของ “ผู้ว่าจ้าง” ได้ทำการตรวจรับถูกต้องเรียบร้อยแล้ว
        <?php } else if ($model['payment'] == 7) { ?>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 3 </strong> “ผู้ว่าจ้าง”  ตกลงจ่าย  และผู้รับจ้างตกลงรับเงินค่าจ้างเป็นรายปี  ระยะเวลา  1  ปี โดยคิดค่าจ้างตามปริมาณน้ำหนักขยะไม่เกิน <?php echo $model['garbageweight'] ?> กิโลกรัมต่อครั้ง  ในอัตราครั้งละ  <?php echo number_format($model['unitprice']); ?> บาท (<?php echo $Config->Convert($model['unitprice']) ?>) ส่วนปริมาณน้ำหนักขยะส่วนที่เกิน <?php echo $model['garbageweight'] ?> กิโลกรัมขึ้นไป จะคิดค่าจัดเก็บขยะเพิ่ม ในอัตรากิโลกรัมละ <?php echo number_format($model['fine']) ?> บาท (<?php echo $Config->Convert($model['fine']) ?>) “ผู้รับจ้าง” เก็บขนย้ายไปทำลายในแต่ละเดือน โดยเข้าจัดเก็บเดือนละ <?php echo $model['levy']; ?> ครั้ง รวม <?php echo ((int) $model['levy'] * 12) ?> ครั้งต่อปี <?php echo $discount; ?> คิดเป็นค่าจ้างรวมทั้งปี <?php echo number_format($model['total']) ?> บาท (<?php echo ($model['total'] > 0) ? $Config->Convert($model['total']) : "0" ?>) ราคานี้รวมภาษีมูลค่าเพิ่ม 7 % โดยกำหนดจ่ายชำระภายใน 30 วัน นับตั้งแต่วันที่ “ผู้ว่าจ้าง” หรือตัวแทนของ “ผู้ว่าจ้าง” ได้ทำการตรวจรับถูกต้องเรียบร้อยแล้ว
        <?php } ?>
    </p>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 4 หน้าที่รับผิดชอบของ “ผู้รับจ้าง”</strong>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.1 “ผู้รับจ้าง”  จะต้องทำการเก็บขนย้ายและกำจัดขยะมูลฝอยติดเชื้อ โดยใช้พนักงานที่มีความรู้ผ่านการอบรมการกำจัดขยะติดเชื้อ<br>และขนย้าย  เพื่อป้องกันอันตรายจากการเก็บขยะ และปฏิบัติตามหลักเกณฑ์ที่กฎหมายและระเบียบได้กำหนดไว้อย่างเคร่งครัด  เพื่อให้เป็นไปตาม<br>กฎกระทรวงสาธารณสุขว่าด้วยการกำจัดขยะมูลฝอยติดเชื้อ พ.ศ. 2545</p>
    <p align ="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.2 “ผู้รับจ้าง” จะต้องเป็นผู้มีอาชีพรับจ้างขนและกำจัดขยะมูลฝอยติดเชื้อ ที่มีสถานที่ผู้ได้รับใบอนุญาตกำจัดขยะมูลฝอยติดเชื้อ ซึ่งเป็นนิติบุคคลผู้มีอาชีพรับจ้างกำจัดขยะมูลฝอยติดเชื้อ  ไว้รองรับการกำจัดขยะมูลฝอยติดเชื้อ โดยวิธีเผาในเตาเผาขยะมูลฝอยติดเชื้อ  ตลอดระยะเวลาตามสัญญานี้ด้วย</p>
    <p align ="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.3 “ผู้รับจ้าง” จะต้องทำการเก็บขนย้ายและกำจัดขยะมูลฝอยติดเชื้อ ในวันและเวลาตามตารางการจัดเก็บของ  “ผู้รับจ้าง”  ไปกำจัดตามวิธีการที่กำหนดและถูกต้อง ในการขนย้ายขยะฯดังกล่าวทุกครั้งจะต้องบันทึกปริมาณน้ำหนัก </p>
    <div style="page-break-after: always;"></div>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 5 หน้าที่รับผิดชอบของ “ผู้ว่าจ้าง”</strong>

    <p align ="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.1  “ผู้ว่าจ้าง” จะต้องจัดเก็บขยะมูลฝอยติดเชื้อที่บรรจุไว้ในถุงแดงอยู่ในสภาพเรียบร้อย ถุงไม่แตก ไม่รั่วซึม         มัดปากถุงอย่างถูกต้อง และแยกของมีคมทุกชนิดบรรจุมิดชิด ไม่ให้แทงทะลุออกจากถุง ไว้ที่จุดพักตามสถานที่พักขยะของ “ผู้ว่าจ้าง”  โดยปฏิบัติให้เป็นไปตามประกาศกระทรวงสาธารณสุข และกฎหมายที่เกี่ยวข้องทุกประการ</p>
    <p align ="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.2  “ผู้ว่าจ้าง” จะต้องจัดเจ้าหน้าที่ผู้รับผิดชอบขยะมูลฝอยติดเชื้อไว้ ประสานงานและร่วมมือรับทราบการบันทึกน้ำหนักขยะ ตลอดจนการลงลายมือชื่อร่วมไว้ในเอกสารดังกล่าว ตามวันและเวลาที่ทั้งสองฝ่ายได้ตกลงกำหนดไว้ด้วย</p>
    <p align ="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.3  “ผู้ว่าจ้าง” จะต้องจัดเก็บขยะมูลฝอยติดเชื้อ ตามข้อ 5.1 ไว้ที่จุดพัก พักขยะซึ่ง “ผู้รับจ้าง” สามารถทำการเก็บขนได้   ตามวันและเวลาที่ทั้งสองฝ่ายได้ตกลงกำหนดกันไว้</p>
    <p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.4 &nbsp;หาก”ผู้ว่าจ้าง”เปิดทำการไม่ตรงเวลาทำการของ”ผู้รับจ้าง” หรือมีเหตุให้ต้องหยุดทำการในวันและเวลาที่ตกลงกันไว้ “ผู้ว่าจ้าง” จะต้องวางขยะไว้ในจุดที่ “ผู้รับจ้าง”สามารถเก็บขนได้ หาก“ผู้ว่าจ้าง”ไม่วางขยะตามกำหนดวันและเวลาที่ตกลงกันไว้”ผู้ว่าจ้าง”ยินยอมจ่าย<br>ค่าบริการให้ “ผู้รับจ้าง”</p>

    <p><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 6 </strong> กรณี“ผู้รับจ้าง” ไม่ปฏิบัติตามข้อตกลงในสัญญานี้ข้อหนึ่งข้อใดด้วยเหตุใดๆก็ตามเป็นเหตุให้เกิดความเสียหายแก่    “ผู้ว่าจ้าง” แล้ว  “ผู้รับจ้าง” ยินดีรับผิดชอบ  และยินยอมชดใช้ค่าเสียหาย  อันเกิดจากการที่ “ผู้รับจ้าง” ไม่ปฏิบัติตามข้อตกลงนั้น ให้แก่ “ผู้ว่าจ้าง” โดยสิ้นเชิง  ภายในกำหนด 30 วัน  นับแต่วันที่ได้รับแจ้งจาก “ผู้ว่าจ้าง”</p>
    <p align ="justify">
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ข้อ 7 </strong> กรณีที่“ผู้ว่าจ้าง” ประสงค์จะบอกเลิกสัญญาฉบับนี้ก่อนกำหนด “ผู้ว่าจ้าง” จะต้องแจ้งให้ “ผู้รับจ้าง” ทราบล่วงหน้าไม่น้อยกว่า 30 วัน
        สัญญาจ้างนี้ทำขึ้นสองฉบับ  มีข้อความถูกต้องตรงกัน  ทั้งสองฝ่ายได้อ่านและเข้าใจดีแล้ว  จึงได้ลงลายมือชื่อพร้อมทั้งประทับตรา (ถ้ามี) ไว้ต่อหน้าพยานเป็นสำคัญและเก็บไว้ฝ่ายละฉบับ
    </p>


    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หมายเหตุ : <?php echo $model['remark']; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้ประกอบการ <?php echo $model['company']; ?> เบอร์โทรศัพท์<?php echo $model['tel']; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ชื่อผู้ประสานงาน (ผู้ติดต่อได้) <?php echo $model['manager']; ?>  เบอร์โทรศัพท์ <?php echo $model['telephone']; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานที่ตั้ง	N <?php echo $model['lat']; ?>        E <?php echo $model['long']; ?>.
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เวลาทำการ <?php echo $model['timework'] == "" ? "-" : $model['timework']; ?>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานที่จัดเก็บ <?php echo $model['company']; ?>
    <?php
    $employer = "";
    $witness = "";

    if ($model['employer1'] != "" && $model['employer2'] != "") {
        $employer = $model['employer1'] . ", " . $model['employer2'];
    } else if ($model['employer1'] != "" || $model['employer2'] != "") {
        $employer = $model['employer1'] . $model['employer2'];
    } else {
        $employer = ".................................................";
    }


    if ($model['witness1'] != "" && $model['witness2'] != "") {
        $witness = $model['witness1'] . ", " . $model['witness2'];
    } else if ($model['witness1'] != "" || $model['witness2'] != "") {
        $witness = $model['witness1'] . $model['witness2'];
    } else {
        $witness = ".................................................";
    }
    ?>
    <br><br> <br><br>
    <div>
        <div style="float: left;width:50%; text-align: center;">
            (ลงชื่อ).........................................ผู้ว่าจ้าง
            <br>
            (<?php echo $employer; ?>)
        </div>
        <div style="float: left;width:50%; text-align: center;">
            (ลงชื่อ).........................................ผู้รับจ้าง
            <br>
            (นายนิติพัฒน์      วงศ์ศิริธร)
        </div>
    </div>
    <br>
    <div>
        <div style="float: left;width:50%; text-align: center;">
            (ลงชื่อ).........................................พยาน
            <br>
            (<?php echo $witness; ?>)
        </div>
        <div style="float: left;width:50%; text-align: center;">
            (ลงชื่อ).........................................พยาน
            <br>
            (นางบุญสวย    พรมไพร)
        </div>
    </div>

    <!-- <br><br>
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ลงชื่อ).........................................ผู้ว่าจ้าง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (ลงชื่อ).........................................ผู้รับจ้าง
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $employer; ?>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(นายนิติพัฒน์      วงศ์ศิริธร)
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้รับมอบอำนาจ


  <br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ลงชื่อ).........................................พยาน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ลงชื่อ).........................................พยาน
  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $witness; ?>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(นางบุญสวย    พรมไพร)   -->

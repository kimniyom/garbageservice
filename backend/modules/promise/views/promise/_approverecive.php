<?php

use yii\helpers\Html;
use yii\helpers\Url;


$address = $model['changwat_id'] != 1 ? " ตำบล  ".$model['tambon']." อำเภอ ". $model['ampur']." จังหวัด ".  $model['changwat'] : "  ".$model['tambon']."  ". $model['ampur']." ".  $model['changwat'] ;
?>


<div style="font-family:sarabun;padding-left:20px;">
    <div style="text-align:center;font-size:16px;">~ 1/2 ~</div>	 
    <div class="row">
        <div class="col-sm-12 text-center"><img src="<?php echo Url::to('../images/icheader.png');?>" class="img-fluid" alt="Responsive image"></div>
    </div>
    <br><br>
    <div class="row text-center" style="font-size:27px;">
        <div class="col-12"><u><strong>แบบยืนยันลูกค้าเพื่อเข้าเก็บขยะติดเชื้อ</strong></u></div>
    </div>  
    <div class="row">
        <div class="col-sm-12" style="font-size:20px;">
        ชื่อสถานที่เข้าจัดเก็บ <?php echo $model['company'];?>  ประเภทลูกค้า        ทำสัญญา        ใบเสนอราคา (รายครั้ง)
        <br>ที่อยู่ <?php echo $model['address'];?> <?php echo $address;?> รหัสไปรษณีย์ <?php echo $model['zipcode'];?> 
        <br>ชื่อผู้ประสานงาน <?php echo $model['manager'];?> แผนก/หน่วยงาน.................เบอร์โทรศัพท์ <?php echo $model['telephone'];?>
        รอบวันเข้าจัดเก็บ      วันที่เข้าจัดเก็บขยะ............../........../.......... ช่วงเวลาที่เข้าจัดเก็บขยะ     ⃣   ช่วงเช้า    ⃣   ช่วงบ่าย    ⃣   ระบุเวลา............................

        </div>
    </div>
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><u><strong>เอกสารที่ต้องนำไปพร้อมพนักงานจัดเก็บขยะ </strong></u> ได้แก่</div>
    </div>  
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><strong>1.เอกสารวางบิล </strong></div>
    </div>  
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><strong>2.รอบการวางบิล/ชำระเงินของลูกค้าของทุกเดือน คือ </strong></div>
    </div> 
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><strong>3.กำหนดการชำระเงิน </strong></div>
    </div> 
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><strong>4.วิธีการชำระเงิน </strong></div>
    </div> 
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><strong>ติดต่อกับแผนกการเงินระบุชื่อ..........................................................................................เบอร์โทรศัพท์............................................... </strong></div>
    </div>
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><strong>พิกัด GPS:  N <?php echo $model['lat'];?> E <?php echo $model['long'];?> </strong></div>
    </div>
    <div class="row " style="font-size:22px;">
        <div class="col-sm-12"><strong>ส่งเอกสาร </strong></div>
    </div>
    <div class="row" style="">
        <div class="col-sm-12 text-center"><img src="<?php echo Url::to('../images/icfooter.png');?>" class="img-fluid" alt="Responsive image"></div>
    </div>
    <div class="div" style="page-break-after:always;"></div>



    <!-- new page -->
    <div class="row">
        <div class="col-sm-12 text-center"><img src="<?php echo Url::to('../images/icheader.png');?>" class="img-fluid" alt="Responsive image"></div>
    </div>
    <br>
    
    <div class="row" style="font-size:20px;">
        <div class="col-sm-12 text-center"><u><strong>เงื่อนไขการจัดการมูลฝอยติดเชื้อสำหรับสถานบริการสาธารณสุข / บริษัทเอกชน ที่รับการบริการ</strong></u></div>
    </div> 
    <div  class="row ">
        <div class="col-sm-12" style="font-size:19px;">
            <br>1.ถุงพลาสติกที่ใช้บรรจุมูลฝอยติดเชื้อต้องทนทาน  ไม่ฉีกขาดง่าย  มีสีแดงสด  ทึบแสง บรรจุมูลฝอยติดเชื้อไม่เกิน 2 ใน 3 ส่วนของถุงพลาสติกแดง และไม่ใส่ปะปนกับมูลฝอยทั่วไป แล้วมัดปากถุงด้วยเชือกหรือวัสดุอื่นๆให้แน่น  
            <br>2.ภาชนะมูลฝอยติดเชื้อประเภทของมีคม ต้องบรรจุอยู่ในภาชนะที่ทนทานต่อการทิ่มแทงทะลุ  มีฝาปิดกล่อง  มีสีแดงสด  ทึบแสง โดยจะต้องบรรจุไม่เกิน 3 ใน 4 ส่วนของความจุภาชนะนั้นๆ
            <br>3.ห้ามมิให้สถานบริการสาธารณสุขทิ้งเข็มฉีดยา หรือวัตถุมีคมประเภทต่างๆ ลงในถุงขยะติดเชื้อโดยตรง  ควรรวบรวมทิ้งไว้ในกระป๋อง หรือกระปุกที่มีฝาปิดมิดชิด  เพราะเข็มฉีดยาหรือวัตถุมีคมทำให้ถุงฉีกขาดเป็นการแพร่กระจายของเชื้อโรค และอาจทำอันตรายเจ้าหน้าที่ในขณะปฏิบัติงานได้
            <br>4.กรณีทีตั้งของลูกค้าอยู่บนอาคารสูง ต้องติดต่อกับเจ้าของอาคารในการจัดที่พักมูลฝอยไว้ทางด้านล่างของอาคาร  เพื่อป้องกันการแพร่กระจายของเชื้อโรค  
            <br>5.ขอความร่วมมือลูกค้านำมูลฝอยติดเชื้อมาใส่ถังที่มีฝาปิดมิดชิดและติดป้ายชัดเจนว่า  “ขยะติดเชื้อ BIOHAZARD WASTE” เท่านั้น                      และนำถังมาไว้ที่จุดที่พักขยะ โดยแยกขยะติดเชื้อออกจากขยะทั่วไปอย่างชัดเจน
            <br>6.เนื่องจากในแต่ละวัน ทางบริษัทฯ ต้องให้บริการลูกค้าเป็นจำนวนมาก และในการเข้าเก็บขนในแต่ละพื้นที่มักจะประสบปัญหา                            เรื่องการจราจร ทางบริษัทฯ  จึงขอความร่วมมือให้ลูกค้า จัดเตรียมขยะไว้ที่จุดพักขยะให้พร้อม เพื่อให้เข้าเก็บได้ทันที

        </div>
    </div>
    <br>
    
    <div class="row " style="font-size:19px;">
        <div class="col-sm-12"><u><strong>รายการขยะติดเชื้อที่รับจัดเก็บ ได้แก่ </strong></u></div>
    </div> 
    <div class="row">
        <div class="col-sm-12" style="font-size:19px;">
            <br>1.วัสดุของมีคม เช่น เข็ม ใบมีด กระบอกฉีดยา หลอดแก้ว ภาชนะที่ทำด้วยแก้วสไลด์ และแผ่นกระจกปิดสไลด์
            <br>2.วัสดุซึ่งสัมผัส หรือ สงสัยว่าจะสัมผัสกับเลือด ส่วนประกอบขยะเลือด ผลิตภัณฑ์ที่ได้จากเลือด สารน้ำจากร่างกายของมนุษย์หรือสัตว์ หรือวัคซีนที่ทำจากเชื้อโรคที่มีชีวิต เช่น สำลี ผ้าก๊อต  ผ้าต่างๆ และท่อยาง
            <br>3.มูลฝอยทุกชนิดที่มาจากห้องรักษาผู้ป่วยติดเชื้อร้ายแรง 
            <br>4.ขยะติดเชื้ออื่นๆ ตามเงื่อนไขของผู้รับกำจัด
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" style="font-size:19px;" >
           ทางบริษัทฯ หวังเป็นอย่างยิ่งว่า  ลูกค้าทุกท่านจะปฏิบัติตามเงื่อนไขดังกล่าวอย่างเคร่งครัด  เพื่อให้การเก็บขนมูลฝอยติดเชื้อ ดำเนินการอย่างมีประสิทธิภาพและถูกต้องตามหลักสุขาภิบาล หากลูกค้าท่านใดไม่ปฏิบัติตามเงื่อนปฏิบัติ ทางบริษัทฯ ขอสงวนสิทธิ์การเข้าจัดเก็บมูลฝอยติดเชื้อ จนกว่าท่านจะดำเนินการแก้ไขให้เป็นไปตามเงื่อนไขของบริษัทฯ เรียบร้อยแล้ว
       
        </div>
    </div>
    <div>
            <div style="float: right;width:50%; text-align: center;font-size:19px;">
                (ลงชื่อ).................รับทราบปฏิบัติตามเงื่อนไข
                <br>
                (........................)  
                <br>
                วันที่..../.../...
            </div>
    </div>
    <div class="row">
        <div class="col-sm-12" style="font-size:19px;">
            •	รบกวนลูกค้าลงชื่อและส่งเอกสารยืนยันกลับมาที่บริษัทฯ ก่อนวันเข้าจัดเก็บล่วงหน้า 3 วัน ส่งทางE-mail : icquality@icqs.net                          หรือADD LINE : @ icqualitysystem
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center"><img src="<?php echo Url::to('../images/icfooter.png');?>" class="img-fluid" alt="Responsive image"></div>
    </div>

</div>
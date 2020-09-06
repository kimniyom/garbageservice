<style type="text/css">
    .row{
        margin-bottom: 10px;
    }

    .box-bill{
        margin-bottom: 30px;
        text-align: center;
        box-shadow: 0px 0px 30px 0px #c1c2c2;
        transition: 0.25s ease-out;
        width: 250px;
        height: 250px;
        font-family: Thk;
        padding: 20px;
        font-size: 22px;

        border-radius: 20px;
        color:#ffffff;

        float: left;
        margin-left: 20px;
    }

    .box-bill:hover{
        cursor: pointer;
        box-shadow: 0px 0px 30px 0px #999999;
        transition: 0.25s ease-out;
        color: yellow;
    }

</style>
<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = "ใบวางบิล / ใบแจ้งยอด";
$this->params['breadcrumbs'][] = $this->title;
?>

<hr/>
<a href="<?php echo Yii::$app->urlManager->createUrl(['service/default/createbill', 'type' => 1]) ?>">
    <div class="box-bill" style="background: #9D50BB;  /* fallback for old browsers */
         background: -webkit-linear-gradient(to right, #6E48AA, #9D50BB);  /* Chrome 10-25, Safari 5.1-6 */
         background: linear-gradient(to right, #6E48AA, #9D50BB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

         ">
        <i class="fa fa-file-o fa-2x"></i><br/><br/>
        <b>ออกใบวางบิลรอบเดือน</b>
        <hr style=" margin: 5px;"/>
        สัญญาหรือข้อตกลงที่มีการเก็บเงินเป็นรายเดือนทุก ๆ เดือน
    </div>
</a>


<!--
<div class="row">
    <div class="col-md-4 col-lg-4">
    <a href="javascript:alert('กำลังดำเนินการ...')">
        <button type="button" class="btn btn-info btn-block btn-lg">
            ออกใบวางบิลค่ามัดจำ
        </button></a>
    </div>
</div>
-->

<a href="<?php echo Yii::$app->urlManager->createUrl(['service/default/createinvoiceyear', 'type' => 3]) ?>">
    <div class="box-bill" style="background: #ADD100;  /* fallback for old browsers */
         background: -webkit-linear-gradient(to right, #7B920A, #ADD100);  /* Chrome 10-25, Safari 5.1-6 */
         background: linear-gradient(to right, #7B920A, #ADD100); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
         ">
        <i class="fa fa-file-o fa-2x"></i><br/><br/>
        <b>ออกใบวางจ่ายรายปี</b>
        <hr style=" margin: 5px;"/>
        สัญญาหรือข้อตกลงที่มีการเก็บเงินเป็นรายปี
    </div>
</a>


<a href="<?php echo Yii::$app->urlManager->createUrl(['service/default/createinvoicesixmonth']) ?>">
    <div class="box-bill" style="background: #00c6ff;  /* fallback for old browsers */
         background: -webkit-linear-gradient(to right, #0072ff, #00c6ff);  /* Chrome 10-25, Safari 5.1-6 */
         background: linear-gradient(to right, #0072ff, #00c6ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

         ">
        <i class="fa fa-file-o fa-2x"></i><br/><br/>
        <b>ออกใบวางบิลรายครึ่งปี(6 เดือน)</b>
        <hr style=" margin: 5px;"/>
        สัญญาหรือข้อตกลงที่มีการเก็บเงิน เหมาจ่ายรายครึ่งปี(6 เดือน)
    </div>
</a>



<a href="<?php echo Yii::$app->urlManager->createUrl(['service/servicepertime/createbill']) ?>">
    <div class="box-bill" style="background: #fe8c00;  /* fallback for old browsers */
         background: -webkit-linear-gradient(to right, #f83600, #fe8c00);  /* Chrome 10-25, Safari 5.1-6 */
         background: linear-gradient(to right, #f83600, #fe8c00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

         ">
        <i class="fa fa-file-o fa-2x"></i><br/><br/>
        <b>ออกใบวางบิลรายครั้ง</b>
        <hr style=" margin: 5px;"/>
        อตกลงที่มีการเก็บเงินเป็นรายครั้ง
    </div>
</a>
<!--
<div class="row">
    <div class="col-md-6 col-lg-6">
        <a href="<?php //echo Yii::$app->urlManager->createUrl(['service/default/createinvoiceyear', 'type' => 3])                                                                         ?>">
            <button type="button" class="btn btn-primary btn-block btn-lg">
                ออกใบวางบิลขยะส่วนเกิน<em>(กรณีลูกค้าเลือกชำระแบบรายปี)</em>
            </button></a>
    </div>
</div>
-->

<div class="alert alert-default" style=" clear: both;">
    <hr/>
    เมื่อท่านบันทึกใบวางบิล / ใบแจ้งหนี้ ข้อมูลจะแสดงในส่วนของ user นั้นด้วย...
</div>

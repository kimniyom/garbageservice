<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name . ' backend';

//จำนวนที่กู้
$loan = 10000000;
echo "จำนวนที่กู้ ";
echo number_format($loan, 2) . " บาท";
echo "<br>";
//ดอกเบี้ย
$fee = 8 / 100; //8%
$calculate_free = $loan * $fee;
echo "จำนวนดอกเบี้ย ";
echo number_format($calculate_free, 2) . " บาท";
echo "<br>";
echo "เงินกู้ + จำนวนดอกเบี้ย ";
$total = $loan * $fee + $loan;
echo number_format($total, 2) . " บาท";
echo "<br>";
echo "จำนวนงวดที่ผ่อนชำระ ";
$month = 15;
$total_month = $month + 1; //เอามาบวก 1 เพื่อให้ต้วแปร i เริ่มต้นที่ 1 เพราะปกติตัวแปรอาเรย์จะเริ่มต้นที่ 0
echo $month . " เดือน";
echo "<br>";
echo "ชำระงวดละ ";
$pay = $total / $month;
echo number_format($pay, 2) . " บาท";

for ($i = 1; $i < $total_month; $i++) {
	$myDate = date("Y-m-d", strtotime(date("2019-06-01", strtotime(date("Y-m-d"))) . "+$i month"));
	echo "<pre>";
	echo " งวดที่ " . $i;
	echo " กำหนดชำระ ";
	echo date('d/m/Y', strtotime($myDate));
	//echo "<b>";
	//echo " จำนวน " . number_format($pay, 2) . " บาท";
	//echo "</b>";
	echo "</pre>";
}
?>
<div class="site-index">
    <div class="body-content">
    <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="text-align:center">ลูกค้าใหม่รอการยืนยัน</span><br/>
                        <div style="text-align:center">
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/customernonapprove']) ?>">
                            <button style="text-align:center;" class="btn btn-danger"><?php echo $customernonapprove ?></button></a>
                        </div>
                    </div>
                <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="text-align:center">แจ้งชำระเงิน(ผ่านระบบ)</span><br/>
                        <div style="text-align:center">
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/customernonapprove']) ?>">
                            <button style="text-align:center;" class="btn btn-danger"><?php echo $customernonapprove ?></button></a>
                        </div>
                    </div>
                <!-- /.info-box-content -->
                </div>
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="text-align:center">สัญญาใกล้หมด</span><br/>
                        <div style="text-align:center">
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/customernonapprove']) ?>">
                            <button style="text-align:center;" class="btn btn-danger"><?php echo $customernonapprove ?></button></a>
                        </div>
                    </div>
                <!-- /.info-box-content -->
                </div>
        </div>
        <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a href="">
                    <button class="btn btn-primary btn btn-block btn-lg"><i class="fa fa-save"></i> บันทึกรายการจัดเก็บ</button></a>
            </div>
        </div>
    </div>
</div>

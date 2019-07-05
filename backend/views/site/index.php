<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name . ' backend';

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

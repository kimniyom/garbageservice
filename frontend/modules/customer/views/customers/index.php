<style type="text/css">
    #user_menu .card{
        margin-bottom: 30px;
        text-align: center;;
    }

    #user_menu .card:hover{
        cursor: pointer;
        box-shadow: 0px 0px 20px 0px #999999;
    }
</style>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">
    <h3><?=Html::encode($this->title)?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <div class="panel panel-default">
                <div class="list-group">
                    <div class="list-group-item active">แจ้งเตือน</div>
                    <a href="" class="list-group-item">รายการข้อมูลค้างจ่าย <span class="badge badge-danger badge-pill" style="padding-top:5px;">0</span></a>
                    <a href="" class="list-group-item">จำนวนสัญญาคงเหลือ <span class="badge badge-danger badge-pill" style="padding-top:5px;">0</span></a>
                    <div class="list-group-item">
                        <?php
echo
Html::beginForm(['/site/logout'], 'post')
. Html::submitButton(
	'<i class="fa fa-power-off text-danger"></i> ออกจากระบบ (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-block'])
?>
                    </div>

                </div>
            </div>
            <br/>
            <?php
if ($customer['approve'] == "Y") {
	?>
                <label class="alert alert-success" style="width: 100%; text-align: center;"><i class="fa fa-check"></i> ยืนยันข้อมูลลูกค้า</label>
            <?php } else {?>
                <label class="alert alert-warning" style="width: 100%; text-align: center;"><i class="fa fa-info"></i> รอการยืนยันข้อมูล</label>
            <?php }?>
        </div>
        <div class="col-md-9 col-lg-9">
            <div class="row" id="user_menu">
                <div class="col-md-6 col-lg-4">
                    <?php if ($customer['id']) {?>
                        <div class="card">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/view', 'userid' => Yii::$app->user->identity->id]) ?>">
                                <div class="card-body">
                                    <i class="fa fa-building fa-5x"></i><br/><br/>
                                    ข้อมูลร้านค้า / บริษัท
                                </div></a>
                        </div>
                    <?php } else {?>
                        <div class="card" style="border:none;">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/check']) ?>">
                                <div class="card-body" style="border: #999999 dashed 2px; border-radius: 10px">
                                    <i class="fa fa-plus fa-5x"></i><br/><br/>
                                    ข้อมูลร้านค้า / บริษัท
                                </div></a>
                        </div>
                    <?php }?>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['user/settings/profile']) ?>">
                            <div class="card-body">
                                <i class="fa fa-user fa-5x"></i><br/><br/>
                                ข้อมูลผู้ใช้งาน
                            </div></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <?php if($promise['status'] == "2") { ?>
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/promise']) ?>">
                        <div class="card-body">
                            <i class="fa fa-file-alt fa-5x"></i><br/><br/>
                            ข้อมูลสัญญา
                        </div></a>
                    <?php } else if($promise['status'] == "1"){ ?>
                        <div class="card-body" style="padding-bottom: 26px; background: #eeeeee;">
                            <i class="fa fa-file-alt fa-3x"></i><br/><br/>
                            ข้อมูลสัญญารอการตรวจสอบจากผู้ให้บริการ
                        </div>
                    <?php } else { ?>
                        <div class="card-body" style="background: #eeeeee;">
                            <i class="fa fa-info fa-5x"></i><br/><br/>
                            ยังไม่มีการตกลงสัญญา
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <a href="#">
                        <div class="card-body">
                            <i class="fa fa-dollar-sign fa-5x"></i><br/><br/>
                            แจ้งชำระเงิน
                        </div></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                             <i class="fa fa-credit-card fa-5x"></i><br/><br/>
                            รายการข้อมูลค้างจ่าย
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                             <i class="fa fa-file fa-5x"></i><br/><br/>
                            จำนวนสัญญาคงเหลือ
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

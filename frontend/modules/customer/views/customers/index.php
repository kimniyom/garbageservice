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
use yii\grid\GridView;
use yii\widgets\Menu;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="col-md-3 col-lg-3">
            <div class="panel panel-default">
                <div class="list-group">       
                    <div class="list-group-item active">แจ้งเตือน</div>
                    <a href="" class="list-group-item">รายการข้อมูลค้างจ่าย <span class="badge badge-danger badge-pill" style="padding-top:5px;">0</span></a>
                    <a href="" class="list-group-item">จำนวนสัญญาคงเหลือ <span class="badge badge-danger badge-pill" style="padding-top:5px;">0</span></a>
                    
                    <?php 
                    echo 
                    Html::beginForm(['/site/logout'], 'post')
                    .Html::submitButton(
                        '<i class="fa fa-power-off text-danger"></i> ออกจากระบบ (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'list-group-item text-danger'])
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-lg-9">
            <div class="row" id="user_menu">
                <div class="col-md-6 col-lg-4">
                     <div class="card">
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/view','userid' => Yii::$app->user->identity->id]) ?>">
                        <div class="card-body">
                            <i class="fa fa-building fa-5x"></i><br/><br/>
                            ข้อมูลร้านค้า / บริษัท
                        </div></a>
                    </div>
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
                        <div class="card-body">
                            <i class="fa fa-file-alt fa-5x"></i><br/><br/>
                            ข้อมูลสัญญา
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                     <div class="card">
                        <div class="card-body">
                            รายการข้อมูลค้างจ่าย
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                     <div class="card">
                        <div class="card-body">
                            จำนวนสัญญาคงเหลือ
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

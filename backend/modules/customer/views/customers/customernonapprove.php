<?php

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */
use yii\widgets\ActiveForm;
use app\models\Typecustomer;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\modules\customer\models\Customers;

$this->title = 'ลูกค้ารอการตรวจสอบข้อมูล';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-nonapprove">

    
<?php $form = ActiveForm::begin(['options' => ['class' => ''],]); ?>
    <div class="row">
        <div class="col-md-3">
           
            <?php
                $customers = Customers::find()->all();
            
                echo Select2::widget([
                    'name' => 'customer',
                    'data' => ArrayHelper::map($customers, "id", "company"),
                    'options' => [
                        'placeholder' => 'ค้นหาชื่อลูกค้า',
                    ],
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
                $type = Typecustomer::find()->all();
            
                echo Select2::widget([
                    'name' => 'typecustomer',
                    'data' => ArrayHelper::map($type, "id", "typename"),
                    'options' => [
                        'placeholder' => 'เลือกประเภทธุรกิจ',
                    ],
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary" >
                <i class="fa fa-search"></i> ค้นหา
            </button>
        </div>
    </div>

<?php ActiveForm::end(); ?>
   

<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ</th>
                    <th>ที่อยู่</th>
                    <th>ติดต่อ</th>
                    <th>ประเภทธุรกิจ</th>
                    <th>วันที่ลงทะเบียน</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;foreach ($customer as $rs): $i++;?>
	                <tr>
	                    <td><?php echo $i ?></td>
	                    <td><?php echo $rs['company'] ?></td>
                        <td><?php echo $rs['address'].' ต.'.$rs['tambon_name'].' อ.'.$rs['ampur_name'].'<br> จ.'.$rs['changwat_name'].' '.$rs['zipcode'] ?></td>
	                    <td>
	                        <?php echo "คุณ " . $rs['manager'] ?><br/>
	                        <?php echo $rs['tel'] ?> <?php echo ($rs['telephone']) ? "," . $rs['telephone'] : "" ?>
	                    </td>
                        
                        <td><?php echo $rs['typename'] ?></td>
	                    <td><?php echo $rs['create_date'] ?></td>
	                    <td>
	                    <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customers/view', 'id' => $rs['id']]) ?>">
	                    ตรวจสอบข้อมูล</a>
	                    </td>
	                </tr>
	            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

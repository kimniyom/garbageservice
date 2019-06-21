<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = 'ลูกค้ารอการตรวจสอบข้อมูล';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-nonapprove">
<div class="box">

            <!-- /.box-header -->
            <div class="box-body">
            <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th>ติดต่อ</th>
                <th>วันที่ลงทะเบียน</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php $i=0;foreach($customer as $rs): $i++;?>
            <tr>
                <td><?php echo $i ?></td>
                <td>
                    <?php echo $rs['typename'] ?><br/>
                    <?php echo $rs['company'] ?>
                </td>
                <td>
                    <?php echo "คุณ ".$rs['manager'] ?><br/>
                    <?php echo $rs['tel'] ?> <?php echo ($rs['telephone']) ? ",".$rs['telephone'] : "" ?>
                </td>
                <td><?php echo $rs['create_date'] ?></td>
                <td>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['customer/customer/view','id' => $rs['id']]) ?>">
                ตรวจสอบข้อมูล</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    

</div>

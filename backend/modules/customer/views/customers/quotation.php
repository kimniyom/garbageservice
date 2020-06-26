<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\customer\models\Customers;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบเสนอราคา';
$this->params['breadcrumbs'][] = $this->title;
?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>เรื่อง</th>
            <th>สถานบริการ / บริษัท</th>
            <th>ประเภทสถานบริการ</th>
            <th>โทรศัพท์</th>
            <th>ชื่อผู้ติดต่อ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($datas as $rs): $i++
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['customername'] ?></td>
                <td><?php echo $rs['title'] ?></td>
                <td><?php echo $rs['typename'] ?></td>
                <td><?php echo $rs['tel'] ?></td>
                <td><?php echo $rs['contact'] ?></td>
                <td>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <a href="<?php echo Url::to(['detailquotation','id' => $rs['id']]) ?>">
                                <button class="btn btn-info btn-sm btn-block" type="button">ดูข้อมูล</button></a>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <button class="btn btn-primary btn-sm btn-block" type="button"><i class="fa fa-plus"></i> ทำใบเสนอราคา</button>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


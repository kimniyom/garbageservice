<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\useremp\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผู้ใช้งาน(เจ้าหน้าที่)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('เพิ่มผู้ใช้งาน', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $this->title ?></div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อ - สกุล</th>
                        <th>แผนก</th>
                        <th>โทรศัพท์</th>
                        <th>Username</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($users as $rs): $i++;
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $rs['name'] ?></td>
                            <td><?php echo $rs['tel'] ?></td>
                            <td><?php echo $rs['departmentname'] ?></td>
                            <td><?php echo $rs['username'] ?></td>
                            <td><a href="<?php echo Yii::$app->urlManager->createUrl(['useremp/user/update', 'id' => $rs['id']]) ?>"><i class="fa fa-pencil"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

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
    <a href="<?php echo Yii::$app->urlManager->createUrl(['useremp/user/create']) ?>" class="btn btn-app" style=" margin-left: 0px;">
        <i class="fa fa-plus text-success"></i> เพิ่มผู้ใช้งาน
    </a>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $this->title ?></div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อ - สกุล</th>
                        <th>โทรศัพท์</th>
                        <th>แผนก</th>
                        <th>Username</th>
                        <th>Block</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($users as $rs): $i++;
                        $id = $rs['id'];
                        if ($rs['blocked_at']) {
                            $class = "text-red";
                        } else {
                            $class = "text-success";
                        }
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><i class="fa fa-user-circle-o <?php echo $class ?>" aria-hidden="true"></i> <?php echo $rs['name'] ?></td>
                            <td><?php echo $rs['tel'] ?></td>
                            <td><?php echo $rs['departmentname'] ?></td>
                            <td><?php echo $rs['username'] ?></td>
                            <td>
                                <?php if ($rs['blocked_at']) { ?>
                                    <button type="button" class="btn btn-success btn-xs" onclick="setBlock('<?php echo $id ?>', '0')">ปลดบล็อคการใช้งาน</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-danger btn-xs" onclick="setBlock('<?php echo $id ?>', '1')">บล็อคการใช้งาน</button>
                                <?php } ?>
                            </td>
                            <td><a href="<?php echo Yii::$app->urlManager->createUrl(['useremp/user/update', 'id' => $rs['id']]) ?>"><i class="fa fa-pencil"></i> แก้ไข</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script type="text/javascript">
    function setBlock(id, val) {
        var data = {id: id, type: val};
        var url = "<?php echo Yii::$app->urlManager->createUrl(['useremp/user/setblock']) ?>";
        $.post(url, data, function(res) {
            window.location.reload();
        });
    }
</script>

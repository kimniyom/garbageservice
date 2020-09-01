<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Confirmform;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'แบบยืนยันลูกค้าเพื่อเข้าเก็บขยะติดเชื้อ';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= Html::a('<i class="fa fa fa-plus"></i> สร้างแบบยืนยันลูกค้าเพื่อเข้าจัดเก็บขยะ', ['beforecreate'], ['class' => 'btn btn-primary']) ?>
<div class="box" id="box-detail">
    <div class="box-header" style=" padding-bottom: 0px;">
        <label>สถานะ</label>
        <select id="status" class="form-control" onchange="getConfirmform()">
            <option value="3" <?php echo($status == '3') ? "selected" : "" ?>>ยกเลิก</option>
            <option value="2" <?php echo($status == '2') ? "selected" : "" ?>>เสร็จ</option>
            <option value="1" <?php echo($status == '1') ? "selected" : "" ?>>กำลังดำเนินการ</option>
        </select>
    </div>
    <div class="box-body" style="padding-top:0px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                  
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
                        <td><?php echo $rs['typename'] ?></td>
                        <td><?php echo $rs['tel'] ?></td>
                        <td><?php echo $rs['contact'] ?></td>
                        <td>
                            <a href="<?php echo Url::to(['view', 'id' => $rs['id']]) ?>">
                                <button class="btn btn-success btn-sm btn-block text-success" type="button"><i class="fa fa-check"></i> แบบยืนยัน</button>
                            </a>
                           
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    function getConfirmform() {
        var status = $("#status").val();
        var url = "<?php echo Url::to(['index']) ?>" + "&status=" + status;
        window.location = url;
    }
</script>



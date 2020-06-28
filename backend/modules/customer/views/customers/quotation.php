<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\customer\models\Customers;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'คำขอใบเสนอราคา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box" id="box-detail">
    <div class="box-header" style=" padding-bottom: 0px;">
        <label>สถานะ</label>
        <select id="status" class="form-control" onchange="getQuotation()">
            <option value="" <?php echo($status == '2') ? "selected" : "" ?>>ทั้งหมด</option>
            <option value="1" <?php echo($status == '1') ? "selected" : "" ?>>ทำแล้ว</option>
            <option value="0" <?php echo($status == '0') ? "selected" : "" ?>>ยังไม่ทำ</option>
        </select>
    </div>
    <div class="box-body" style="padding-top:0px;">
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
                            <?php if($rs['status'] == 0) { ?>
                            <a href="<?php echo Url::to(['detailquotation', 'id' => $rs['id']]) ?>">
                                <button class="btn btn-primary btn-sm btn-block" type="button"><i class="fa fa-plus"></i> สร้างใบเสนอราคา</button></a>
                            <?php } else { ?>
                            <a href="<?php echo Url::to(['detailquotation', 'id' => $rs['id']]) ?>">
                                <button class="btn btn-success btn-sm btn-block text-success" type="button"><i class="fa fa-check"></i> ใบเสนอราคา</button></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function getQuotation() {
        var status = $("#status").val();
        var url = "<?php echo Url::to(['quotation']) ?>" + "&status=" + status;
        window.location = url;
    }
</script>


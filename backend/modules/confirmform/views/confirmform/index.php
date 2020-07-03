<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\Confirmform;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'คำขอใบเสนอราคา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box" id="box-detail">
   
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
                        <td><?php echo $rs['company'] ?></td>
                        <td><?php echo $rs['typename'] ?></td>
                        <td><?php echo $rs['tel'] ?></td>
                        <td><?php echo $rs['manager'] ?></td>
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
    function getQuotation() {
        var status = $("#status").val();
        var url = "<?php echo Url::to(['quotation']) ?>" + "&status=" + status;
        window.location = url;
    }
</script>


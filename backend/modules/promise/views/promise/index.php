<style>
    .bs-wizard {margin-top: 0px;}
    /*Form Wizard*/
    .bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {font-size: 14px; margin-bottom: 5px;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #006633; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: '\2713  '; width: 14px; height: 14px;  position: absolute; top: 5px; left: 10px; font-weight: bold; color:#FFFFFF;}
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #006633;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    /*END Form Wizard*/
</style>
<?php

use app\models\Config;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use app\modules\customer\models\Customers;
use app\models\Packagepayment;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\promise\models\PromiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$Config = new Config();
$this->title = 'สัญญา(' . $groupname . ")";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="promise-index">

    <p>
        <?= Html::a('ทำสัญญา', ['beforecreate', 'group' => $group], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="nav-tabs-custom" style=" margin-bottom: 0px;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#detail" data-toggle="tab">แบบขั้นตอน</a></li>
            <li><a href="#table"  data-toggle="tab">แบบตาราง</a></li>

        </ul>
        <div class="tab-content padding" id="box-content">
            <div class="chart tab-pane active" id="detail">
                <ul class="list-group">
                    <?php if ($promise) { ?>
                        <?php
                        foreach ($promise as $rs):
                            if ($rs['status'] != 0) {
                                ?>
                                <li class="list-group-item" style=" font-weight: bold;">
                                    <?php
                                    $Customer = new Customers();
                                    echo "(" . $rs['promisenumber'] . ")";
                                    echo $Customer->findOne(['id' => $rs['customerid']])['company'];

                                    $sql = "select * from promisefile where promiseid = '" . $rs['id'] . "'";
                                    $checkfile = Yii::$app->db->createCommand($sql)->queryScalar();
                                    if ($rs['flag'] == "1") {
                                        $link = \yii\helpers\Url::to(['promise/viewsubpromise', 'id' => $rs['id']]);
                                    } else {
                                        $link = \yii\helpers\Url::to(['promise/view', 'id' => $rs['id']]);
                                    }
                                    ?>
                                </li>
                                <?php if ($rs['status'] != '4') { ?>
                                    <li class="list-group-item">
                                        <div class="row bs-wizard" style="border-bottom:0;">
                                            <div class="col-xs-4 bs-wizard-step <?php echo ($rs['status'] > 0) ? "complete" : "disabled"; ?>">
                                                <div class="text-center bs-wizard-stepnum <?php echo ($rs['status'] > 0) ? "text-success" : "text-danger"; ?>">สร้าง / แก้ไข</div>
                                                <div class="progress"><div class="progress-bar"></div></div>
                                                <a href="<?php echo $link ?>" class="bs-wizard-dot"></a>
                                                <div class="bs-wizard-info text-center"></div>
                                            </div>

                                            <div class="col-xs-4 bs-wizard-step <?php echo ($checkfile >= 1) ? "complete" : "disabled"; ?>"><!-- complete -->
                                                <div class="text-center bs-wizard-stepnum <?php echo ($checkfile >= 1) ? "text-success" : "text-danger"; ?>">ตรวจสอบบ / อัพโหลดสัญญา</div>
                                                <div class="progress"><div class="progress-bar"></div></div>
                                                <a href="<?php echo $link ?>" class="bs-wizard-dot"></a>
                                                <div class="bs-wizard-info text-center"></div>
                                            </div>

                                            <div class="col-xs-4 bs-wizard-step <?php echo ($checkfile >= 1) ? "active" : "disabled"; ?>"><!-- complete -->
                                                <div class="text-center bs-wizard-stepnum <?php echo ($checkfile >= 1) ? "text-success" : "text-danger"; ?>">ทำสัญญาสำเร็จ</div>
                                                <div class="progress"><div class="progress-bar"></div></div>
                                                <a href="<?php echo $link ?>" class="bs-wizard-dot"></a>
                                                <div class="bs-wizard-info text-center"></div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li class="list-group-item text-danger">
                                        <i class="fa fa-remove"></i> ยกเลิกสัญญา<br/>
                                        เหตุผลการยกเลิก <?php echo $rs['etc'] ?>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <li class="list-group-item" style=" text-align: center;">ยังไม่มีรายการ</li>
                    <?php } ?>
                </ul>
            </div>
            <div class="chart tab-pane" id="table">
                <table class="table table-bordered table-striped" id="promise">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>เลขสัญญา</th>
                            <th>ลูกค้า</th>
                            <th>วันที่ทำสัญญา</th>
                            <th>วันที่เริ่มสัญญา</th>
                            <th>วันที่สิ้นสุดสัญญา</th>
                            <th>การชำระเงิน</th>
                            <th style=" text-align: center">จำนวนครั้ง / เดือน</th>
                            <th>ติดต่อ</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>จังหวัด</th>
                            <th>สถานะ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($promise) { ?>
                            <?php
                            $i = 0;
                            foreach ($promise as $rs):
                                if ($rs['status'] != 0) {
                                    $i++;
                                    $Customer = new Customers();
                                    //$customerData = $Customer->findOne(['id' => $rs['customerid']]);
                                    $customerSql = "SELECT *
                                                            FROM customers c INNER JOIN changwat p ON c.changwat = p.changwat_id
                                                            WHERE c.id = '" . $rs['customerid'] . "' ";
                                    $customerData = Yii::$app->db->createCommand($customerSql)->queryOne();
                                    $sql = "select * from promisefile where promiseid = '" . $rs['id'] . "'";
                                    $checkfile = Yii::$app->db->createCommand($sql)->queryScalar();
                                    if ($rs['flag'] == "1") {
                                        $link = \yii\helpers\Url::to(['promise/viewsubpromise', 'id' => $rs['id']]);
                                    } else {
                                        $link = \yii\helpers\Url::to(['promise/view', 'id' => $rs['id']]);
                                    }

                                    $status = "";
                                    if ($rs['status'] == 1) {
                                        $class = "text-warning";
                                        $status = "รอยืนยัน";
                                    } else if ($rs['status'] == 2) {
                                        $class = "text-success";
                                        $status = "กำลังใช้งาน";
                                    } else if ($rs['status'] == 3) {
                                        $class = "text-info";
                                        $status = "กำลังต่อสัญญา";
                                    } else if ($rs['status'] == 4) {
                                        $class = "text-danger";
                                        $status = "ยกเลิกสัญญา";
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $rs['promisenumber'] ?></td>
                                        <td><?php echo $customerData['company'] ?></td>
                                        <td><?php echo $Config->thaidate($rs['createat']) ?></td>
                                        <td><?php echo $Config->thaidate($rs['promisedatebegin']) ?></td>
                                        <td><?php echo $Config->thaidate($rs['promisedateend']) ?></td>
                                        <td><?php echo Packagepayment::findOne(['id' => $rs['payment']])['payment'] ?></td>
                                        <td><?php echo $rs['levy'] ?></td>
                                        <td><?php echo $customerData['manager'] ?></td>
                                        <td>
                                            <?php echo ($customerData['tel']) ? $customerData['tel'] : ""; ?>
                                            <?php echo ($customerData['telephone']) ? "," . $customerData['telephone'] : ""; ?>
                                        </td>
                                        <td><?php echo $customerData['changwat_name'] ?></td>
                                        <td class="<?php echo $class ?>"><?php echo $status ?></label></td>
                                        <td><a href="<?php echo $link ?>">รายละเอียด</a></td>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="12">ยังไม่มีรายการ</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]);       ?>

    <?php
    /*
      echo GridView::widget([
      'dataProvider' => $dataProvider,
      'filterModel' => $searchModel,
      'columns' => [
      ['class' => 'yii\grid\SerialColumn'],
      [
      'attribute' => 'promisenumber',
      'format' => 'text',
      'label' => 'เลขที่สัญญา',
      ],
      [
      'attribute' => 'customerid',
      'format' => 'text',
      'label' => 'ลูกค้า',
      'value' => function($model) {
      $Customer = new Customers();
      return $Customer->findOne(['id' => $model->customerid])['company'];
      }
      ],
      [
      //'attribute' => '',
      'format' => 'text',
      'label' => 'ผู้ประสานงาน',
      'value' => function($model) {
      $Customer = new Customers();
      $Cs = $Customer->findOne(['id' => $model->customerid]);
      $tel = $Cs['tel'];
      $phone = ($Cs['telephone']) ? "," . $Cs['telephone'] : "";
      $val = $Cs['manager'] . ' (โทร.' . $Cs['tel'] . $phone . ')';
      return $val;
      }
      ],
      [
      //'attribute' => 'promisedatebegin',
      'value' => function ($model) {
      $config = new Config();
      return $config->thaidate($model->promisedatebegin);
      },
      'label' => 'วันเริ่มสัญญา',
      ],
      [
      //'attribute' => 'promisedateend',
      'value' => function ($model) {
      $config = new Config();
      return $config->thaidate($model->promisedateend);
      },
      'label' => 'วันสิ้นสุดสัญญา',
      ],
      [
      //'attribute' => 'recivetype',
      'format' => 'text',
      'label' => 'ประเภทการจ้าง',
      'value' => function ($model) {
      if ($model->recivetype == "1") {
      return "รายครั้ง/ต่อเดือน";
      } else if ($model->recivetype == "2") {
      return "คิดตามน้ำหนักจริง";
      } else if ($model->recivetype == "3") {
      return "เหมาจ่ายรายเดือน";
      }
      },
      ],
      [
      //'attribute' => 'status',
      'format' => 'html',
      'label' => 'สถานะสัญญา',
      'value' => function ($model) {
      if ($model->status == "0") {
      return "หมดสัญญา";
      } else if ($model->status == "1") {
      return "<i class='fa fa-info text-warning'></i> รอยืนยัน";
      } else if ($model->status == "2") {
      return "<i class='fa fa-check text-success'><i/>กำลังใช้งาน";
      } else if ($model->status == "3") {
      return "กำลังต่อสัญญา";
      } else if ($model->status == "4") {
      return "ยกเลิกสัญา";
      }
      },
      ],
      [
      'class' => 'yii\grid\ActionColumn',
      'template' => '{view}',
      ],
      ],
      'pjax' => true,
      'bordered' => true,
      'striped' => false,
      'condensed' => false,
      'responsive' => true,
      'hover' => true,
      'floatHeader' => true,
      'showPageSummary' => false,
      'panel' => [
      'type' => GridView::TYPE_DEFAULT,
      ],
      ]);
     *
     */
    ?>


</div>
<?php
$this->registerJs("
        setBox();
         $('#promise').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false
              })
        ");
?>
<script type="text/javascript">
    function setBox() {
        var h = window.innerHeight;
        $("#box-content").css({"height": h - 210});
        //$("#paper").css({"height": h - 260});
        //$("#createbill").css({"height": h - 200, "overflow-x": "hidden"});
    }
</script>

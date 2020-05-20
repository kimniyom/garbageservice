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

/* @var $this yii\web\View */
/* @var $searchModel app\modules\promise\models\PromiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'สัญญา';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="promise-index">

    <p>
        <?= Html::a('ทำสัญญา', ['beforecreate'], ['class' => 'btn btn-success']) ?>
    </p>

    <ul class="list-group">
        <?php foreach ($promise as $rs): ?>
            <li class="list-group-item" style=" font-weight: bold;">
                <?php
                $Customer = new Customers();
                echo "(" . $rs['promisenumber'] . ")";
                echo $Customer->findOne(['id' => $rs['customerid']])['company'];

                $sql = "select * from promisefile where promiseid = '" . $rs['id'] . "'";
                $checkfile = Yii::$app->db->createCommand($sql)->queryScalar();
                ?>
            </li>
            <li class="list-group-item">
                <div class="row bs-wizard" style="border-bottom:0;">
                    <div class="col-xs-4 bs-wizard-step <?php echo ($rs['status'] >= 1) ? "complete" : "disabled"; ?>">
                        <div class="text-center bs-wizard-stepnum <?php echo ($rs['status'] >= 1) ? "text-success" : "text-danger"; ?>">สร้าง / แก้ไข</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="<?php echo \yii\helpers\Url::to(['promise/view', 'id' => $rs['id']]) ?>" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center"></div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step <?php echo ($checkfile >= 1) ? "complete" : "disabled"; ?>"><!-- complete -->
                        <div class="text-center bs-wizard-stepnum <?php echo ($checkfile >= 1) ? "text-success" : "text-danger"; ?>">ตรวจสอบบ / อัพโหลดสัญญา</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="<?php echo \yii\helpers\Url::to(['promise/view', 'id' => $rs['id']]) ?>" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center"></div>
                    </div>

                    <div class="col-xs-4 bs-wizard-step <?php echo ($checkfile >= 1) ? "active" : "disabled"; ?>"><!-- complete -->
                        <div class="text-center bs-wizard-stepnum <?php echo ($checkfile >= 1) ? "text-success" : "text-danger"; ?>">ทำสัญญาสำเร็จ</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="<?php echo \yii\helpers\Url::to(['promise/view', 'id' => $rs['id']]) ?>" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center"></div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

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

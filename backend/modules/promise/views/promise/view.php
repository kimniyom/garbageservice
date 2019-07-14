<?php

use app\models\Config;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = $model['promisenumber'];
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$Config = new Config();
?>
<div class="promise-view">
<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="box" id="box-detail">
            <div class="box-header" style=" padding-bottom: 0px;">รายละเอียดสัญญา</div>
            <div class="box-body">
    <p>
        <?php if ($model['status'] == "1") {?>
				<?=Html::a('Update', ['update', 'id' => $model['id']], ['class' => 'btn btn-primary'])?>
			
				<?=Html::a('Delete', ['delete', 'id' => $model['id'], 'customerid' => $model['customerid']], [
					'class' => 'btn btn-danger',
					'data' => [
						'confirm' => 'Are you sure you want to delete this item?',
						'method' => 'post',
					],
				])?>
				<?=Html::a('Cancel', ['cancelpromise', 'id' => $model['id'], 'status'=>'4'], [
					'class' => 'btn btn-warning',
					'data' => [
						'confirm' => 'Are you sure you want to cancel this item?',
						'method' => 'post',
					],
				])?>
		<?php }?>

		<?php
			if ($model['status'] == '1') 
			{
				//ms word
				echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> .Doc', ['getdoc', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-black', 'title' => 'Microsoft word']);
				//pdf preview 
				echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> .pdf', ['pdfpreview', 'id' => $model['id'], 'promisenumber' => $model['promisenumber']], ['class' => 'btn btn-black', 'title' => 'PDF']);
				//upload pdf
				echo Html::a('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span> .Upload PDF', ['uploadpromise', 'id' => $model['id'], 'customerid' => $model['customerid']], ['class' => 'btn btn-black', 'title' => 'Upload pdf']);
			}
			if ($model['status'] == '2') 
			{
				//save pdf
        		echo Html::a('<span class="glyphicon glyphicon-save" aria-hidden="true"></span> .ดาวห์โหลดสัญญา', ['getpromisepdf', 'promisenumber' => $model['promisenumber']], ['class' => 'btn btn-black', 'title' => 'ดาวโหลดสัญญา']);
				
			}
		?>
    </p>
	
    <?=DetailView::widget([
	'model' => $model,

	'attributes' => [

		[
			'label' => 'เลขที่สัญญา',
			'attribute' => 'promisenumber',
		],
		[
			'label' => 'ลูกค้า',
			'attribute' => 'company',
		],
		[
			'label' => 'ทำสัญญา ณ ',
			'value' => $model['address'] . ' ' . $model['tambon'] . ' ' . $model['ampur'] . ' ' . $model['changwat'],

		],
		[
			'label' => 'วันเริ่มสัญญา',
			'value' => $Config->thaidate($model['promisedatebegin']),

		],
		[
			'label' => 'วันสิ้นสุดสัญญา',
			'value' => $Config->thaidate($model['promisedateend']),
		],
		[
			'label' => 'ประเภทการจ้าง',
			'value' => $model['recivetype'] == 1 ? "รายเดือน" : "รายปี",
		],
		[
			'label' => $model['recivetype'] == 1 ? "คิดค่าจ้างเหมาในอัตราเดือนละ" : "ค่าจ้างรวมทิ้งสิ้นต่อปี",
			'value' => ($model['recivetype'] == 1) ? (number_format($model['rate'])) : (number_format($model['payperyear'])),
		],

		[
			'label' => 'จำนวนครั้งที่จัดเก็บต่อเดือน',
			'attribute' => 'levy',
		],

		[
			'label' => 'ระยะสัญญา',
			'attribute' => 'yearunit',
			'value' => $model['yearunit'],
		],
		[
			'label' => 'วันที่ทำสัญญา',
			'value' => $Config->thaidate($model['createat']),

		],
		[
			'label' => 'ปริมาณขยะ (กิโลกรัม)',
			'value' => $model['garbageweight'],

		],
		[
			'label' => 'มัดจำล่วงหน้า (เดือน)',
			'value' => $model['deposit'],

		],

		[
			'label' => 'ผู้ประสาน',
			'value' => $model['manager'],

		],
		[
			'label' => 'เบอร์โทร',
			'value' => $model['tel'],

		],
		[
			'label' => 'สถานะการชำระเงิน',
			'value' => $model['checkmoney'] == 0 ? "ยังไม่ได้ชำระ" : "ชำระแล้ว",

		],
		[
			'label' => 'สถานะสัญญา',
			'value' => function ($model) {
				if ($model['status'] == 0) {
					return "หมดสัญญา";
				} else if ($model['status'] == 1) {
					return "รอยืนยัน";
				} else if ($model['status'] == 2) {
					return "กำัลังใช้งาน";
				} else if ($model['status'] == 3) {
					return "กำลังต่อสัญญา";
				}

			},

		],
		[
			'label' => 'สถานะการใช้งาน',
			'value' => $model['active'] == 1 ? "ใช้งาน" : "ไม่ใช้งาน",

		],

	],
])?>
</div>
</div>
</div>
<div class="col-md-4 col-lg-4">
    <div class="box">
        <?php if ($model['recivetype'] == 1) {
	?>
<div class="box-header" style=" padding-bottom: 0px;">
    <?php $month = ($model['yearunit'] * 12);?>
    จำนวนที่ต้องชำระ <?php echo $month ?> เดือน ชำระเดือนละ <?php echo number_format($model['rate'], 2) ?>

</div>
            <div class="box-body" id="box-unit">
    <?php

	foreach ($roundmoney as $rs) {

		echo "<pre>";
		echo " งวดที่ " . $rs['round'];
		echo " กำหนดชำระ ";
		echo $Config->thaidate($rs['datekeep']);

		echo "</pre>";
	}
	?>
</div>
<?php } else {?>
    <div class="box-body">
        <h4 style="text-align: center;">สัญญารายปี</h4>
        <hr/>
        <h4 style="text-align: center;">
            <?php echo $model['checkmoney'] == 0 ? "ยังไม่ได้ชำระ" : "ชำระแล้ว"; ?>
        </h4>
    </div>
    <?php }?>
</div>
</div>
</div>
</div>

<?php
$this->registerJs('
        var boxdetail = $("#box-detail").height();
        $("#box-unit").css({"height": boxdetail-30,"overflow": "auto"});
        ');
?>

<script>
function setstatus(id,status)
{
    var data = {id:id, status: status};
    var url = "<?php echo Yii::$app->urlManager->createUrl(['promise/promise/setstatus']) ?>";
    $.post(url,data,function(result){
        if(result){
            alert("สถานะสัญญา : รอยืนยัน");
        }
        else{
            alert("ไม่สามารถแก้ไขสถานะสัญญาได้");
        }
    })
}
</script>


<?php

namespace app\modules\service\controllers;
use app\models\Invoice;
use app\models\Config;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;
use app\modules\roundmoney\models\Roundmoney;
use app\modules\roundgarbage\models\Roundgarbage;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `service` module
 */
class DefaultController extends Controller {
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex() {
		//$data['promise'] = Promise::find()->where(['status' => '2'])->all();
		$data['customer'] = Customers::find()->all();
		return $this->render('index', $data);
	}

	public function actionGetround() {
		$customerId = Yii::$app->request->post('customer_id');
		$Promise = Promise::find()->where(['customerid' => $customerId, 'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $customerId])->One();
		//$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
		$str = "";
		$str .= "<b>ลูกค้า " . $Customer['company'] . "</b><br/>";
		$str .= "<b>เลขที่สัญญา " . $Promise['promisenumber'] . "</b><br/>";
		$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'promise' => $Promise['id']]);
		$str .= "  <a href='" . $link . "' class='btn btn-success'><i class='fa fa-save'></i> บันทึกรายการ</a> " . "<br/>";
		/*
			foreach ($RoundGarbage as $rs):
				if ($rs['status'] == 0) {
					$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $rs['promiseid'], 'round' => $rs['round']]);
					$str .= "รอบที่ => " . $rs['round'] . " วันที่จัดเก็บ => " . $rs['datekeep'] . "  <a href='" . $link . "'><i class='fa fa-save'></i> บันทึกรายการ</a> " . "<br/>";
				} else {
					$str .= "รอบที่ => " . $rs['round'] . " วันที่จัดเก็บ => " . $rs['datekeep'] . " <i class='fa fa-check'></i>" . "<br/>";
				}
			endforeach;
		*/
		if ($Promise) {
			return $str;
		} else {
			return "ไม่มีการทำสัญญา";
		}

	}

	public function actionFormsaveround($promise) {
		$Promise = Promise::find()->where(['id' => $promise, 'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$data['promise'] = $Promise;
		$data['customer'] = $Customer;
		$data['promiseid'] = $promise;
		return $this->render('formsaveround', $data);
	}

/*
public function actionFormsaveround($id, $promise, $round) {
$Promise = Promise::find()->where(['id' => $promise, 'status' => '2'])->One();
$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
$data['promise'] = $Promise;
$data['customer'] = $Customer;
$data['promiseid'] = $promise;
$data['round'] = $round;
$data['id'] = $id;
return $this->render('formsaveround', $data);
}
 */
	public function actionSave() {
		//$id = Yii::$app->request->post('id');
		$garbageover = Yii::$app->request->post('garbageover');
		$promiseid = Yii::$app->request->post('promiseid');
		$amount = Yii::$app->request->post('amount');
		$datekeep = Yii::$app->request->post('datekeep');

		//$Promise = Promise::find()->where(['id' => $promise,'status' => '2'])->One();

		$columns = array(
			"garbageover" => $garbageover,
			"keepby" => Yii::$app->user->id,
			"amount" => $amount,
			"status" => 1,
			"datekeep" => $datekeep,
			"promiseid" => $promiseid,
			"d_update" => date("Y-m-d H:i:s"),
		);

		Yii::$app->db->createCommand()
			->insert("roundgarbage", $columns)
			->execute();
		/*
			Yii::$app->db->createCommand()
				->update("roundgarbage", $columns, "id = '$id'")
				->execute();
		*/
	}

	public function actionMainbill() {
		return $this->render('mainbill');
	}

	public function actionCreatebill($type,$customerId = "") {
		//ออกบิลสำหรับสัญญาที่แบ่งจ่ายรายเดือน
		//$data['promise'] = Promise::find()->where(['status' => '2', 'payment' => '0'])->all();
		$sql = "select c.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',p.changwat_name) as address
		from customers c 
		inner join changwat p on c.changwat = p.changwat_id 
		inner join ampur a on c.ampur = a.ampur_id 
		inner join tambon t on c.tambon = t.tambon_id";
		$result = Yii::$app->db->createCommand($sql)->queryAll();
		$data['customer'] = $result;
		$data['type'] = $type;
		$data['round'] = $this->actionGetroundpromise($customerId);
		$data['customerId'] = $customerId;
		return $this->render('createbill', $data);
	}

	
	public function actionGetroundpromise($customerId) {
		$Config = new Config();
		//$customerId = Yii::$app->request->post('customer_id');
		$Promise = Promise::find()->where(['customerid' => $customerId, 'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $customerId])->One();
		$RoundMoney = Roundmoney::find()->where(['promiseid' => $Promise['id']])->all();

		$sql = "select * from vattype where id = '".$Customer['typeregister']."'";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();

		$promiseId = $Promise['id'];
		$typePromise = $Promise['recivetype'];//ประเภทการจ้าง
		$data['vat'] = $Promise['vat'];//เช็คเอา vat  ไม่เอา vat
		$data['typevat'] = $Promise['vattype'];//เช็คเอา vat- +
		$vatBill = $Promise['vat'];
		$typevatBill = $Promise['vattype'];
		if($Promise['vat'] == 1) { $vateBill = "เอา vat"; } else { $vateBill = "ไม่เอา vat"; }
		$str = "";
		$str .= "<b>ลูกค้า " . $Customer['company'] . "</b> ";
		$str .= "<b>สัญญา ".$rs['vattype']."</b>";
		$str .= " <b>".$vateBill."</b>";
		$linkPromise = Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $promiseId]);
		$str .= "<br/><em><a href='" . $linkPromise . "' target='_back'>ข้อมูลสัญญา</a></em><hr/>";
		$typeCustomrt = $Customer['typeregister'];
		foreach ($RoundMoney as $rs):
			if (!$rs['receiptnumber']) {
				$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $rs['promiseid'], 'round' => $rs['round'],'vat' => $Promise['vat'],'typevat' => $Promise['vattype']]);
				$dateMonth = '"' . $rs['datekeep'] . '"';
				$round = $rs['round'];
				$id = $rs['id'];
				$str .= "รอบบิล => " . $rs['round'] . " เดือน => " . $Config->thaidatemonth($rs['datekeep']) . "  <a href='javascript:popupFormbill($promiseId,$dateMonth,$round,$id,$typeCustomrt,$vatBill,$typevatBill,$typePromise)'><i class='fa fa-save'></i> สร้างใบวางบิล</a>" . "<br/>";
			} else {
				$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $promiseId, 'round' => $rs['round'],'vat' => $Promise['vat'],'typevat' => $Promise['vattype']]);
				$dateMonth = '"' . $rs['datekeep'] . '"';
				$round = $rs['round'];
				$id = $rs['id'];
				$str .= "รอบบิล => " . $rs['round'] . " เดือน => " .  $Config->thaidatemonth($rs['datekeep']) . " <a href='javascript:popupFormbill($promiseId,$dateMonth,$round,$id,$typeCustomrt,$vatBill,$typevatBill,$typePromise)'><i class='fa fa-check'></i> ใบวางบิล / ใบเสร็จ</a>" . "<br/>";
			}
		endforeach;
		if ($RoundMoney) {
			return $str;
		} else {
			return "ไม่มีรอบจัดเก็บ";
		}
	}

	public function actionCreatebillpopup() {
		$promiseId = Yii::$app->request->post('promiseid');
		$dateround = Yii::$app->request->post('dateround');
		$round = Yii::$app->request->post('round');
		$id = Yii::$app->request->post('id');
		$data['vat'] = Yii::$app->request->post('vat');
		$data['vattype'] = Yii::$app->request->post('vattype');
		$data['type'] = Yii::$app->request->post('type');
		$typepromise = Yii::$app->request->post('typepromise');

		$Promise = Promise::find()->where(['id' => $promiseId])->One();
		//$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$Customer = $this->actionGetcustomer($Promise['customerid']);
		$YearMonth = substr($dateround, 0, 7);
		$sql = "select * from roundgarbage where promiseid = '$promiseId' and LEFT(datekeep,7) = '$YearMonth' and status='1'";
		$data['billdetail'] = Yii::$app->db->createCommand($sql)->queryAll();
		$data['customer'] = $Customer;
		$data['promise'] = $Promise;
		$data['rounddate'] = $YearMonth;
		$data['round'] = $round;
		$data['id'] = $id;

		$sqlCheckInvoice = "select * from roundmoney where id = '$id' and receiptnumber != ''";
		$Invoice = Yii::$app->db->createCommand($sqlCheckInvoice)->queryOne();
		if (!$Invoice['receiptnumber']) {
			$data['invnumber'] = $this->getNextId();
			$data['status'] = 0;
			$sqlInvoice = "select * from invoice where invoicenumber = '".$Invoice['receiptnumber']."'";
			$data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
		} else {
			$data['invnumber'] = $Invoice['receiptnumber'];
			$data['status'] = 1;
			$sqlInvoice = "select * from invoice where invoicenumber = '".$Invoice['receiptnumber']."'";
			$data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
		}
		if($typepromise == 1){
			$page = "createbillpopup";
		} else if($typepromise == 2){
			$page = "createbillpopuptype2";
		} else {
			$page = "createbillpopuptype3";
		}
		
		return $this->renderPartial($page, $data);
	}

	public function actionGetcustomer($customerid) {
		$sql = "SELECT c.company,ch.changwat_name,a.ampur_name,t.tambon_name,c.zipcode,c.tel,c.telephone,c.typeregister
				FROM customers c INNER JOIN changwat ch ON c.changwat = ch.changwat_id
				INNER JOIN ampur a ON c.ampur = a.ampur_id
				INNER JOIN tambon t ON c.tambon = t.tambon_id
				WHERE c.id = '$customerid'";
		return Yii::$app->db->createCommand($sql)->queryOne();
	}

	//บันทึกรายการใบแจ้งหนี้
	public function actionAddinvoice() {
		$invoiceNumber = Yii::$app->request->post('invoiceNumber');
		$promiseId = Yii::$app->request->post('promiseId');
		$total = Yii::$app->request->post('total');
		$roundId = Yii::$app->request->post('roundId');
		$type = Yii::$app->request->post('type');
		$monthyear = Yii::$app->request->post('monthyear');
		$dateinvoice = Yii::$app->request->post('dateinvoice');
		$datebill = Yii::$app->request->post('datebill');
		$year = substr($monthyear, 0, 4);
		$month = substr($monthyear, 5, 2);
		$columns = array(
			"invoicenumber" => $invoiceNumber,
			"promise" => $promiseId,
			"round" => $roundId,
			"total" => $total,
			"status" => "0",
			"year" => $year,
			"month" => $month,
			"type" => $type,
			"dateinvoice" => $dateinvoice,
			"datebill" => $datebill,
			"d_update" => date("Y-m-d H:i:s"),
		);

		Yii::$app->db->createCommand()
			->insert("invoice", $columns)
			->execute();

		$columnsUpdate = array(
			"receiptnumber" => $invoiceNumber,
		);
		Yii::$app->db->createCommand()
			->update("roundmoney", $columnsUpdate, "id = '$roundId'")
			->execute();
	}

	public function getNextId() {
		//ตัวอย่างหากต้องการ SN59-00001
		$lastRecord = Invoice::find()->where(['like', 'invoicenumber', 'INV'])->orderBy(['id' => SORT_DESC])->one(); //หาตัวล่าสุดก่อน
		if ($lastRecord) {
			$digit = explode('INV', $lastRecord->invoicenumber);

			$lastDigit = ((int) $digit[1]); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
			$lastDigit++; //เพิ่ม 1
			$lastDigit = str_pad($lastDigit, 5, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
		} else {
			$lastDigit = '00001';
		}

		return 'INV' . $lastDigit;

	}

	public function actionGetinvoice() {
		$promiseId = Yii::$app->request->post('promiseid');
		$dateround = Yii::$app->request->post('dateround');
		$id = Yii::$app->request->post('id');
		$invoice = Yii::$app->request->post('invoice');

		$Promise = Promise::find()->where(['id' => $promiseId])->One();
		//$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$Customer = $this->actionGetcustomer($Promise['customerid']);
		$YearMonth = substr($dateround, 0, 7);
		$sql = "select * from roundgarbage where promiseid = '$promiseId' and LEFT(datekeep,7) = '$YearMonth' and status='1'";
		$data['billdetail'] = Yii::$app->db->createCommand($sql)->queryAll();
		$data['customer'] = $Customer;
		$data['type'] = $Customer['typeregister'];
		$data['promise'] = $Promise;
		$data['rounddate'] = $YearMonth;
		$data['id'] = $id;
		$data['invnumber'] = $invoice;
		$Status = Invoice::find()->where(['invoicenumber' => $invoice])->One();
		$data['status'] = count($Status);
		$sqlInvoice = "select * from invoice where invoicenumber = '$invoice'";
	    $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
		return $this->renderPartial('createbillpopup', $data);
	}

	public function actionConfirmorder() {
		$sql = "SELECT i.*,CONCAT('(Invoice #',i.invoicenumber,') ',c.company,' (จำนวน ',i.total,' .-)') as orders,
					p.promisenumber,c.company,r.round as roundmoney
					FROM invoice i INNER JOIN promise p ON i.promise = p.id
					INNER JOIN customers c ON p.customerid = c.id
					LEFT JOIN roundmoney r ON i.round = r.id
					WHERE i.`status` = '0'";
		$data['order'] = Yii::$app->db->createCommand($sql)->queryAll();
		return $this->render('order', $data);
	}

	public function actionSaveconfirmorder() {
		$id = Yii::$app->request->post('id');
		$dateservice = Yii::$app->request->post('dateservice');
		$timeservice = Yii::$app->request->post('timeservice');
		$comment = Yii::$app->request->post('comment');
		$columns = array(
			"dateservice" => $dateservice,
			"timeservice" => $timeservice,
			"comment" => $comment,
			"status" => 1,
			"d_update" => date("Y-m-d H:i:s"),
		);

		Yii::$app->db->createCommand()
			->update("invoice", $columns, "id = '$id'")
			->execute();
	}

	public function actionCreateinvoiceyear($type) {
		//ออกบิลสำหรับสัญญาที่เหมาจ่ายแบบรายปี
		//$data['promise'] = Promise::find()->where(['status' => '2', 'payment' => '1'])->all();
		$sql = "select p.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',ch.changwat_name) as address
				from customers c inner join promise p on c.id = p.customerid 
				inner join changwat ch on c.changwat = ch.changwat_id
				inner join ampur a on c.ampur = a.ampur_id
				inner join tambon t on c.tambon = t.tambon_id
				where p.status = '2' and p.payment = '1'";
		$data['customer'] = Yii::$app->db->createCommand($sql)->queryAll();
		$data['type'] = $type;
		return $this->render('createinvoiceyear', $data);
	}

	public function actionGetroundpromiseyear() {
		$promiseId = Yii::$app->request->post('promiseid');
		$Promise = Promise::find()->where(['id' => $promiseId, 'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$RoundMoney = Roundmoney::find()->where(['promiseid' => $promiseId])->all();
		$str = "";
		$str .= "<b>ลูกค้า " . $Customer['company'] . "</b> ";
		$linkPromise = Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $promiseId]);
		$str .= "<em><a href='" . $linkPromise . "' target='_back'>ข้อมูลสัญญา</a></em><br/><br/>";
		$str .= "<a href='javascript:popupFormbill($promiseId)' class='btn btn-default'><i class='fa fa-save'></i> สร้างใบวางบิล</a>" . "<br/>";
		return $str;
	}

	public function actionCreatebillpopupyear() {
		$promiseId = Yii::$app->request->post('promiseid');

		$Promise = Promise::find()->where(['id' => $promiseId])->One();
		$Customer = $this->actionGetcustomer($Promise['customerid']);
		$RoundMoney = Roundmoney::find()->where(['promiseid' => $promiseId])->all();
		$data['billdetail'] = $RoundMoney;
		$data['customer'] = $Customer;
		$data['promise'] = $Promise;
		$data['type'] = $Customer['typeregister'];
		$data['vat'] = $Promise['vat'];
		$data['vattype'] = $Promise['vattype'];
		$sqlCheckInvoice = "select * from invoice where promise = '$promiseId' and invoicenumber != ''";
		$Invoice = Yii::$app->db->createCommand($sqlCheckInvoice)->queryOne();

		if (!$Invoice['invoicenumber']) {
			$data['invnumber'] = $this->getNextId();
			$data['status'] = 0;
		} else {
			$data['invnumber'] = $Invoice['invoicenumber'];
			$data['status'] = 1;
		}
		return $this->renderPartial('createbillpopupyear', $data);
	}

	public function actionGetroundlist() {
		$Config = new Config();
		$promiseId = Yii::$app->request->post('promiseid');
		//$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
		$sql = "select r.*,p.name
				from roundgarbage r inner join profile p on r.keepby = p.user_id 
				where r.promiseid = '$promiseId'";
		$RoundGarbage = Yii::$app->db->createCommand($sql)->queryAll();
		$i=0;
		$str = "";
		$str .="<br/><b>ประวัติการจัดเก็บ</b><br/>
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่</th>
						<th style='text-align:right;'>ปริมาณ</th>
						<th style='text-align:right;'>ขยะเกิน</th>
						<th style='text-align:center;'>ผู้บันทึก</th>
						<th style='text-align:center;'></th>";
			$str .= "</tr></thead>";
			$str .= "<tbody>";
		foreach($RoundGarbage as $rs){
			$i++;
			$str .= "<tr>";
			$str .= "<td>".$i."</td>";
			$str .= "<td>".$Config->thaidate($rs['datekeep'])."</td>";
			$str .= "<td style='text-align:right;'>".$rs['amount']." กิโลกรัม</td>";
			$str .= "<td style='text-align:right;'>".$rs['garbageover']." กิโลกรัม</td>";
			$str .= "<td style='text-align:center;'>".$rs['name']."</td>";
			if(Yii::$app->user->id == $rs['keepby']){
			$str .= "<td style='text-align:center;'><i class='fa fa-pencil'></i></td>";
			} else {
				$str .= "<td style='text-align:center;'></td>";
			}
			$str .= "</tr>";
		}

		$str .= "</tbody></table>";

		return $str;
	}

}

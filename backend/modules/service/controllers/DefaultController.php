<?php

namespace app\modules\service\controllers;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;
use app\modules\roundgarbage\models\Roundgarbage;
use app\modules\roundmoney\models\Roundmoney;
use app\models\Invoice;
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
		$data['promise'] = Promise::find()->where(['status' => '2'])->all();
		return $this->render('index', $data);
	}

	public function actionGetround() {
		$promiseId = Yii::$app->request->post('promiseid');
		$Promise = Promise::find()->where(['id' => $promiseId, 'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
		$str = "";
		$str .= "<b>ลูกค้า " . $Customer['company'] . "</b><br/>";
		foreach ($RoundGarbage as $rs):
			if ($rs['status'] == 0) {
				$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $rs['promiseid'], 'round' => $rs['round']]);
				$str .= "รอบที่ => " . $rs['round'] . " วันที่จัดเก็บ => " . $rs['datekeep'] . "  <a href='" . $link . "'><i class='fa fa-save'></i> บันทึกรายการ</a> " . "<br/>";
			} else {
				$str .= "รอบที่ => " . $rs['round'] . " วันที่จัดเก็บ => " . $rs['datekeep'] . " <i class='fa fa-check'></i>" . "<br/>";
			}
		endforeach;
		if ($RoundGarbage) {
			return $str;
		} else {
			return "ไม่มีรอบจัดเก็บ";
		}

	}

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

	public function actionSave() {
		$id = Yii::$app->request->post('id');
		$garbageover = Yii::$app->request->post('garbageover');
		$promiseid = Yii::$app->request->post('promiseid');
		$amount = Yii::$app->request->post('amount');

		//$Promise = Promise::find()->where(['id' => $promise,'status' => '2'])->One();

		$columns = array(
			"garbageover" => $garbageover,
			"keepby" => Yii::$app->user->id,
			"amount" => $amount,
			"status" => 1,
			"d_update" => date("Y-m-d H:i:s"),
		);

		Yii::$app->db->createCommand()
			->update("roundgarbage", $columns, "id = '$id'")
			->execute();
	}

	public function actionMainbill() {
		return $this->render('mainbill');
	}

	public function actionCreatebill($type) {
		//ออกบิลสำหรับสัญญาที่แบ่งจ่ายรายเดือน
		$data['promise'] = Promise::find()->where(['status' => '2','payment' => '0'])->all();
		$data['type'] = $type;
		return $this->render('createbill', $data);
	}

	public function actionGetroundpromise() {
		$promiseId = Yii::$app->request->post('promiseid');
		$Promise = Promise::find()->where(['id' => $promiseId, 'status' => '2'])->One();
		$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
		$RoundMoney = Roundmoney::find()->where(['promiseid' => $promiseId])->all();
		$str = "";
		$str .= "<b>ลูกค้า " . $Customer['company'] . "</b> ";
		$linkPromise = Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $promiseId]);
		$str .= "<em><a href='".$linkPromise."' target='_back'>ข้อมูลสัญญา</a></em><br/>";
		foreach ($RoundMoney as $rs):
			if (!$rs['receiptnumber']) {
				$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $rs['promiseid'], 'round' => $rs['round']]);
				$dateMonth = '"'.$rs['datekeep'].'"';
				$round = $rs['round'];
				$id = $rs['id'];
				$str .= "รอบบิล => " . $rs['round'] . " เดือน => " . $rs['datekeep'] . "  <a href='javascript:popupFormbill($promiseId,$dateMonth,$round,$id)'><i class='fa fa-save'></i> สร้างใบวางบิล</a>"."<br/>";
			} else {
				$link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $rs['promiseid'], 'round' => $rs['round']]);
				$dateMonth = '"'.$rs['datekeep'].'"';
				$round = $rs['round'];
				$id = $rs['id'];
				$str .= "รอบที่ => " . $rs['round'] . " เดือน => " . $rs['datekeep'] . " <a href='javascript:popupFormbill($promiseId,$dateMonth,$round,$id)'><i class='fa fa-check'></i> ใบวางบิล / ใบเสร็จ</a>"."<br/>";
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
		
		if(!$Invoice['receiptnumber']){
			$data['invnumber'] = $this->getNextId();
			$data['status'] = 0;
		} else {
			$data['invnumber'] = $Invoice['receiptnumber'];
			$data['status'] = 1;
		}
		return $this->renderPartial('createbillpopup', $data);
	}

	public function actionGetcustomer($customerid){
		$sql = "SELECT c.company,ch.changwat_name,a.ampur_name,t.tambon_name,c.zipcode,c.tel,c.telephone
				FROM customers c INNER JOIN changwat ch ON c.changwat = ch.changwat_id
				INNER JOIN ampur a ON c.ampur = a.ampur_id
				INNER JOIN tambon t ON c.tambon = t.tambon_id 
				WHERE c.id = '$customerid'";
		return Yii::$app->db->createCommand($sql)->queryOne();
	}

	//บันทึกรายการใบแจ้งหนี้
	public function actionAddinvoice(){
		$invoiceNumber = Yii::$app->request->post('invoiceNumber');
        $promiseId = Yii::$app->request->post('promiseId');
    	$total = Yii::$app->request->post('total');
		$roundId = Yii::$app->request->post('roundId');
		$monthyear = Yii::$app->request->post('monthyear');
		$year = substr($monthyear,0,4);
		$month = substr($monthyear,5,2);
		$columns = array(
			"invoicenumber" => $invoiceNumber,
			"promise" => $promiseId,
			"round" => $roundId,
			"total" => $total,
			"status" => "0",
			"year" => $year,
			"month" => $month,
			"d_update" => date("Y-m-d H:i:s")
		);

		Yii::$app->db->createCommand()
			->insert("invoice",$columns)
			->execute();

		$columnsUpdate = array(
			"receiptnumber" => $invoiceNumber
		);
		Yii::$app->db->createCommand()
			->update("roundmoney",$columnsUpdate,"id = '$roundId'")
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
		$data['promise'] = $Promise;
		$data['rounddate'] = $YearMonth;
		$data['id'] = $id;
		$data['invnumber'] = $invoice;
		$Status = Invoice::find()->where(['invoicenumber' => $invoice])->One();
		$data['status'] = count($Status);
		return $this->renderPartial('createbillpopup', $data);
	}

	public function actionConfirmorder(){
		$sql = "SELECT i.*,CONCAT('(Invoice #',i.invoicenumber,')',' บริษัท/สถานประกอบการ ',c.company,' จำนวน ',i.total,' .-') as orders,
					p.promisenumber,c.company,r.round as roundmoney
					FROM invoice i INNER JOIN promise p ON i.promise = p.id
					INNER JOIN customers c ON p.customerid = c.id
					INNER JOIN roundmoney r ON i.round = r.id
					WHERE i.`status` = '0'";
		$data['order'] = Yii::$app->db->createCommand($sql)->queryAll();
		return $this->render('order', $data);
	}

	public function actionSaveconfirmorder(){
		$id = Yii::$app->request->post('id');
        $dateservice = Yii::$app->request->post('dateservice');
		$timeservice = Yii::$app->request->post('timeservice');
		$comment = Yii::$app->request->post('comment');
		$columns = array(
			"dateservice" => $dateservice,
			"timeservice" => $timeservice,
			"comment" => $comment,
			"status" => 1,
			"d_update" => date("Y-m-d H:i:s")
		);

		Yii::$app->db->createCommand()
			->update("invoice",$columns,"id = '$id'")
			->execute();
	}


}

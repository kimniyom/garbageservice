<?php

namespace app\modules\promise\controllers;

use app\models\Config;
use app\modules\promise\models\Promise;
use app\modules\promise\models\Promisefile;
use app\modules\promise\models\PromiseSearch;
use common\models\Customers;
use kartik\mpdf\Pdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PromiseController implements the CRUD actions for Promise model.
 */
class PromiseController extends Controller {
	/**
	 * {@inheritdoc}
	 */
	public function behaviors() {
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
					//'cancelpromise' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all Promise models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new PromiseSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Promise model.
	 * @param string $id
	 * @param integer $customerid
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id) {
		$data['model'] = $this->getPromise($id);
		$data['roundmoney'] = $this->getRoundMoney($id);
		$data['roundgarbage'] = $this->getRoundGarbage($id);
		return $this->render('view', $data);
	}

	function getRoundGarbage($id) {
		$sql = "select * from roundgarbage where promiseid = '$id' order by id asc";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		return $rs;
	}

	function getRoundMoney($id) {
		$sql = "select * from roundmoney where promiseid = '$id'";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		return $rs;
	}

	public function actionBeforecreate() {
		$customer = Customers::find()->where(['flag' => 1, 'approve' => 'Y'])->all();
		return $this->render('beforecreate', [
			'customer' => $customer,
		]);
	}

	/**
	 * Creates a new Promise model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($customerid) {
		$conFig = new Config();
		$model = new Promise();
		$model->customerid = $customerid;
		//$model->createat = date('Y-m-d');
		$model->promisenumber = $this->getNextId("promise", "promisenumber", 5);
		$error = "";
		if ($model->load(Yii::$app->request->post())) {
			if ($model->recivetype == 1 || $model->recivetype == 3) {
				$week = $model->weekinmonth;
				$weekround = implode(",", $week);
				$model->weekinmonth = $weekround;
				$countWeek = count($week);
				if ($model->levy != $countWeek) {
					$error = "จำนวนครั้งที่จัดเก็บไม่เท่ากัน..!";
				} else {
					$model->save();
					$this->actionSetmonth($model->id, $customerid, $model->yearunit, $model->promisedatebegin, $model->rate);
					return $this->redirect(['view', 'id' => $model->id]);
				}

			} else {
				return $this->redirect(['view', 'id' => $model->id]);
			}

		}

		return $this->render('create', [
			'model' => $model,
			'customer' => $this->getCustomer($customerid),
			'error' => $error,
		]);
	}

	public function getNextId() {
		//ตัวอย่างหากต้องการ SN59-00001
		$lastRecord = Promise::find()->where(['like', 'promisenumber', 'IC'])->orderBy(['id' => SORT_DESC])->one(); //หาตัวล่าสุดก่อน
		if ($lastRecord) {

			$digit = explode('IC', $lastRecord->promisenumber);

			$lastDigit = ((int) $digit[1]); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
			$lastDigit++; //เพิ่ม 1
			$lastDigit = str_pad($lastDigit, 5, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
		} else {
			$lastDigit = '00001';
		}

		return 'IC' . $lastDigit;

	}

	public function actionSetmonth($promiseID, $customerID, $promiesYear, $dateStart, $priceMonth) {
		$month = ($promiesYear * 12);
		$total_month = $month + 1; //เอามาบวก 1 เพื่อให้ต้วแปร i เริ่มต้นที่ 1 เพราะปกติตัวแปรอาเรย์จะเริ่มต้นที่ 0
		$pay = $priceMonth;
		$j = 0;
		for ($i = 1; $i < $total_month; $i++) {
			$j = $i - 1; //เริ่มเก็บเดือนที่เริ่มสัญญา ถ้า เริ่มเก็บเดือนถัดไปให้เรียกใช้ i
			$myDate = date("Y-m-d", strtotime(date($dateStart, strtotime(date("Y-m-d"))) . "+$j month"));
			/*
				echo "<pre>";
				echo " งวดที่ " . $i;
				echo " กำหนดชำระ ";
				$datekeep = date('Y-m-d', strtotime($myDate));
				echo "<b>";
				echo " จำนวน " . number_format($pay, 2) . " บาท";
				echo "</b>";
				echo "</pre>";
			*/
			$datekeep = date('Y-m-d', strtotime($myDate));
			$columns = array(
				"customerid" => $customerID,
				"promiseid" => $promiseID,
				"datekeep" => $datekeep,
				"round" => $i,
				"amount" => $pay,
			);

			Yii::$app->db->createCommand()
				->insert("roundmoney", $columns)
				->execute();
		}
	}

	/**
	 * Updates an existing Promise model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @param integer $customerid
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		$model->weekinmonth = explode(",", $model->weekinmonth);
		$error = "";
		if ($model->load(Yii::$app->request->post())) {
			$week = $model->weekinmonth;
			$weekround = implode(",", $week);
			$model->weekinmonth = $weekround;

			if ($model->recivetype == 1 || $model->recivetype == 3) {
				$countWeek = count($week);
				if ($model->levy != $countWeek) {
					$error = "จำนวนครั้งที่จัดเก็บไม่เท่ากัน..!";
				} else {
					//ถ้าแบ่งจ่ายรายเดือนจะคำนวณหาวันที่ต้องชำระเงินในแต่ละเดือน
					if ($model->payment == 0) {
						$id = $model->id;
						Yii::$app->db->createCommand()
							->delete("roundmoney", "promiseid = '$id'")
							->execute();

						$this->actionSetmonth($model->id, $model->customerid, $model->yearunit, $model->promisedatebegin, $model->rate);
					}

					$model->save();
					return $this->redirect(['view', 'id' => $model->id]);
				}
			} else {
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			}

		}

		return $this->render('update', [
			'model' => $model,
			'customer' => $this->getCustomer($model->customerid),
			'error' => $error,
		]);
	}

	/**
	 * Deletes an existing Promise model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @param integer $customerid
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	public function actionCancelpromise($id, $status) {
		$model = Promise::findOne(['id' => $id]);
		$model->status = $status;
		$model->active = '0';

		if ($model->load(Yii::$app->request->post())  && $model->save(false)) {
			return $this->redirect(['index']);
		}

		return $this->renderAjax('_modalcancel', [
			'model' => $model,
		]);
	}

	public function actionGetdoc($id, $customerid) {

		$rs = $this->getPromise($id, $customerid);
		Settings::setTempDir(Yii::getAlias('@webroot') . '/web/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
		$templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . '/web/doc/templetpromise.docx'); //Path ของ template ที่สร้างเอาไว้
		$Config = new Config();
		$templateProcessor->setValue(
			[
				'promisenumber',
				'customerid',
				'promisedatebegin',
				'promisedateend',
				'recivetype',
				'rate',
				'ratetext',
				'levy',
				'payperyear',
				'payperyeartext',
				'createat',
				'company',
				'taxnumber',
				'address',
				'changwat',
				'ampur',
				'tambon',
				'zipcode',
				'manager',
				'tel',
				'telephone',
				'lat',
				'long',
			],
			[
				$rs['promisenumber'],
				$rs['customerid'],
				$Config->thaidate($rs['promisedatebegin']),
				$Config->thaidate($rs['promisedateend']),
				$rs['recivetype'] == 0 ? 'รายครั้ง' : 'รายเดือน',
				$rs['rate'],
				$rs['ratetext'],
				$rs['levy'],
				$rs['payperyear'],
				$rs['payperyeartext'],
				$Config->thaidate($rs['createat']),
				$rs['company'],
				$rs['taxnumber'],
				$rs['address'],
				$rs['changwat'],
				$rs['ampur'],
				$rs['tambon'],
				$rs['zipcode'],
				$rs['manager'],
				$rs['tel'],
				$rs['telephone'],
				$rs['lat'],
				$rs['long'],
			]);

		$templateProcessor->saveAs(Yii::getAlias('@webroot') . '/web/doc/promise.docx');
		Yii::$app->response->sendFile(Yii::getAlias('@webroot') . '/web/doc/promise.docx');

		//clear temp
		$files = glob(Yii::getAlias('@webroot') . '/web/temp/*');
		foreach ($files as $file) {
			if (is_file($file)) {
				unlink($file);
			}

		}
	}

	/**
	 * Finds the Promise model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @param integer $customerid
	 * @return Promise the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Promise::findOne(['id' => $id])) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	protected function getCustomer($customerid) {

		$sql = "
                SELECT

                    customers.*,
                    changwat.changwat_name as changwat,
                    ampur.ampur_name as ampur,
                    tambon.tambon_name as tambon,

                    user.username
                    FROM customers
                INNER JOIN changwat ON customers.changwat = changwat.changwat_id
                INNER JOIN ampur ON customers.ampur = ampur.ampur_id
                INNER JOIN tambon ON customers.tambon = tambon.tambon_id
                LEFT JOIN user ON customers.user_id = user.id
                WHERE
                    customers.flag = 1
                    AND customers.approve = 'Y'
                    AND customers.id = '{$customerid}'

        ";

		return Yii::$app->db->createCommand($sql)->queryOne();

		/*
			if (($model = Customers::findOne(['id' => $customerid])) !== null) {
				return $model;
			}
		*/
		//throw new NotFoundHttpException('The requested page does not exist.');
	}

	protected function getPromise($id) {
		$sql = "
                SELECT
                promise.id,
                    promise.promisenumber,
                    promise.customerid,
                    promise.promisedatebegin,
					promise.promisedateend,
					promise.createat,
                    promise.recivetype,
                    promise.rate,
                    promise.ratetext,
                    promise.levy,
                    promise.payperyear,
                    promise.payperyeartext,
                    promise.createat,
                    promise.garbageweight,
                    promise.checkmoney,
                    promise.status,
					promise.active,
					promise.vat,
					promise.deposit,
                    promise.yearunit,
					promise.unitprice,
					promise.distcountpercent,
					promise.distcountbath,
					promise.total,
					promise.fine,
                    customers.company,
                    customers.taxnumber,
					customers.address,
					customers.timework,
                    changwat.changwat_name as changwat,
                    ampur.ampur_name as ampur,
                    tambon.tambon_name as tambon,
                    customers.zipcode,
                    customers.manager,
                    customers.tel,
					customers.telephone,
					customers.remark,
                    location.lat,
                    location.long,
                    promise.dayinweek,
					promise.weekinmonth,
					promise.employer1,
					promise.employer2,
					promise.witness1,
					promise.witness2
                FROM
                    promise
                INNER JOIN customers ON promise.customerid = customers.id
                INNER JOIN changwat ON customers.changwat = changwat.changwat_id
                INNER JOIN ampur ON customers.ampur = ampur.ampur_id
                INNER JOIN tambon ON customers.tambon = tambon.tambon_id
                LEFT JOIN location ON promise.customerid = location.customer_id
                WHERE
                    customers.flag = 1
                    AND customers.approve = 'Y'
                    AND promise.id = '{$id}'

        ";

		return Yii::$app->db->createCommand($sql)->queryOne();
	}

	public function actionIscustomerexpired() {
		$customerid = Yii::$app->request->post('customerid');
		$isReccord = 0;
		$rs = Promise::find()->where("customerid = '$customerid' and status != '0' and active = '1'")->count();
		if ($rs > 0) {
			$isReccord = 1;
		}
		return $isReccord;
	}

	public function actionSetstatus() {
		$id = Yii::$app->request->post('id');
		$status = Yii::$app->request->post('status');
		$model = Promise::findOne(['id' => $id]);
		$model->status = $status;

		return $model->save();
	}

	public function actionUploadpromise($id, $customerid) {
		$model = $this->getPromise($id, $customerid);
		$promise = Promise::findOne(['id' => $id]);
		$promisefile = new Promisefile();
		$promisefile->scenario = 'create';

		if ($promisefile->load(Yii::$app->request->post())) {

			$promisefile->filename = UploadedFile::getInstance($promisefile, 'filename');
			$promisefile->promiseid = $id;
			$promisefile->uploadby = Yii::$app->user->id;
			$promisefile->dateupload = date('Y-m-d H:i');
			
			if ($promisefile->filename && $promisefile->validate() && ($promise->promisenumber === str_replace(".pdf","",$promisefile->filename))) {
				$path = '../uploads/promise/pdf/' . $promise->promisenumber . '.' . $promisefile->filename->extension;
				$promisefile->promiseid = $id;
				$promisefile->filename->name = $promise->promisenumber . '.' . $promisefile->filename->extension;

				if ($promisefile->save() && $promisefile->filename->saveAs($path)) {
					$promise->status = '2';
					
					$promise->save(false);
					
					return $this->redirect(['view',
						'id' => $id,
						'customerid' => $customerid,
					]);
					
				}
			}
			else{
				Yii::$app->getSession()->setFlash('alert',[
					'body'=>'กรุณาตรวจสอบชื่อไฟล์ให้ถูกต้อง',
					'options'=>['class'=>'alert-warning']
				]);
			}

		}

		return $this->render('uploadpromise', [
			'model' => $model,
			'promisefile' => $promisefile,
		]);
	}

	public function actionGetpromisepdf($promisenumber) {
		$path = Yii::getAlias('@webroot') . '/../uploads/promise/pdf/' . $promisenumber . '.pdf';

		if (is_file($path)) {
			Yii::$app->response->sendFile($path);
		}

	}

	public function actionPdfpreview($id, $promisenumber) {
		$model = $this->getPromise($id);
		//promise form มี 3 แบบ นิติบุคคลรวม vat, นิติบุคคลรวม ไม่รวม vat, บุคคลธรรมดา
		// นิติบุคคล รายครั้ง ไม่รวม vat
		if ($model['recivetype'] == 1 && $model['vat'] == '0') {
			$content = $this->renderPartial('promisetype/_promisetype1_1', ['model' => $model]);
		}
		// นิติบุคคล รายครั้ง รวม vat
		else if ($model['recivetype'] == 1 && $model['vat'] == '1') {
			$content = $this->renderPartial('promisetype/_promisetype1_2', ['model' => $model]);
		}
		// นิติบุคคลรวม คิดตามน้ำหนักจริง ไม่รวม vat
		else if ($model['recivetype'] == 2 && $model['vat'] == '0') {
			$content = $this->renderPartial('promisetype/_promisetype2_1', ['model' => $model]);
		}
		// นิติบุคคลรวม คิดตามน้ำหนักจริง รวม vat
		else if ($model['recivetype'] == 2 && $model['vat'] == '1') {
			$content = $this->renderPartial('promisetype/_promisetype2_2', ['model' => $model]);
		}
		// บุคคลธรรมดา ไม่คิด vat
		//if ($model['recivetype'] == 3) {
		//	$content = $this->renderPartial('promisetype/_promisetype3', ['model' => $model]);
		//}

		// นิติบุคคล รายเดือน ไม่รวม vat
		else if ($model['recivetype'] == 3 && $model['vat'] == '0') {
			$content = $this->renderPartial('promisetype/_promisetype3_1', ['model' => $model]);
		}
		// นิติบุคคล รายเดือน รวม vat
		else if ($model['recivetype'] == 3 && $model['vat'] == '1') {
			$content = $this->renderPartial('promisetype/_promisetype3_2', ['model' => $model]);
		}
		$pdf = new Pdf([
			// set to use core fonts only
			'mode' => 'th',
			// A4 paper format
			'format' => Pdf::FORMAT_A4,
			// portrait orientation
			'orientation' => Pdf::ORIENT_PORTRAIT,
			// stream to browser inline
			'destination' => Pdf::DEST_BROWSER,
			// your html content input
			'content' => $content,
			// format content from your own css file if needed or use the
			// enhanced bootstrap css built by Krajee for mPDF formatting
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
			// any css to be embedded if required
			'cssInline' => '.kv-heading-1{font-size:18px}',
			// set mPDF properties on the fly
			'options' => ['title' => 'Krajee Report Title'],
			//'filename' => $promisenumber,
			'filename' => $promisenumber.".pdf",
			// call mPDF methods on the fly
			'methods' => [
				//'SetHeader'=>['Krajee Report Header'],
				'SetFooter' => ['{PAGENO}'],
			],
		]);

		$defaultConfig = (new ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];

		$defaultFontConfig = (new FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];

		$pdf->options['fontDir'] = array_merge($fontDirs, [
			Yii::getAlias('@webroot') . '/web/fonts/thsarabun/',
		]);

		$pdf->options['fontdata'] = $fontData + [

			'sarabun' => [
				'R' => 'THSarabun.ttf',
			],
		];

		// return the pdf output as per the destination setting
		return $pdf->render();
	}

	public function actionSetroundgarbage($promiseID, $promiesYear, $dateStart, $round, $weekinmonth, $dayinweek) {
		$month = ($promiesYear * 12);
		$total_month = $month + 1; //เอามาบวก 1 เพื่อให้ต้วแปร i เริ่มต้นที่ 1 เพราะปกติตัวแปรอาเรย์จะเริ่มต้นที่ 0
		$j = 0;
		for ($i = 1; $i < $total_month; $i++) {
			$j = $i - 1; //เริ่มเก็บเดือนที่เริ่มสัญญา ถ้า เริ่มเก็บเดือนถัดไปให้เรียกใช้ i
			$myDate = date("Y-m-d", strtotime(date($dateStart, strtotime(date("Y-m-d"))) . "+$j month"));

			//echo "<pre>";
			//echo " งวดที่ " . $i;
			//echo " เดือนที่ต้องจัดเก็บ ";
			$datekeep = date('Y-m-d', strtotime($myDate));
			$yearRound = substr($datekeep, 0, 4);
			$monthRound = substr($datekeep, 5, 2);
			//echo "</pre>";

			$roundNumber = $round; //เดือนละกี่รอบรอบ
			$weekInmonth = explode(",", $weekinmonth); //อาทิตย์ที่จะให้จัดเก็บ
			$dayInweek = $dayinweek; //วันใน week ที่ให้จัดเก็บเก็บเป็นตัวเลข 0 = วันจันทร์

			//$sqlRound = "select MONTH(datekeep) as m,YEAR(datekeep) as y from roundmoney where promiseid = '$promise' ";
			//$result = Yii::$app->db->createCommand($sqlRound)->queryAll();
			//foreach ($result as $rs):
			//if (strlen($rs['m']) < 2) {$month = '0' . $rs['m'];} else { $month = $rs['m'];}
			//$year = $rs['y'];
			echo $yearRound . "-" . (int) $monthRound . "<hr/>";
			$Round = $this->rangweek(2019, (int) $monthRound);
			//print_r($Round);
			foreach ($weekInmonth as $key):
				//$Round['สัปดาห์ในที่']['วันในสัปดาห์']
				$week = ($key - 1);
				//echo $week . "<br/>";
				//$Round[$week];
				echo $Round[$week][$dayInweek] . "<br/>";
			endforeach;
			//endforeach;

			//$datekeep = date('Y-m-d', strtotime($myDate));
			/*
			$columns = array(
				"customerid" => $customerID,
				"promiseid" => $promiseID,
				"datekeep" => $datekeep,
				"round" => $i,
			);

			Yii::$app->db->createCommand()
				->insert("roundmoney", $columns)
				->execute();
				*/
		}

		/*
			$roundNumber = 2; //เดือนละ 2 รอบ
			$weekInmonth = array('1'); //อาทิตย์ที่จะให้จัดเก็บ
			$dayInweek = 6; //วันใน week ที่ให้จัดเก็บเก็บเป็นตัวเลข 0 = วันจันทร์

			$sqlRound = "select MONTH(datekeep) as m,YEAR(datekeep) as y from roundmoney where promiseid = '$promise' ";
			$result = Yii::$app->db->createCommand($sqlRound)->queryAll();
			foreach ($result as $rs):
				if (strlen($rs['m']) < 2) {$month = '0' . $rs['m'];} else { $month = $rs['m'];}
				$year = $rs['y'];
				echo $year . "-" . $month . "<hr/>";
				$Round = $this->rangweek($year, $month);
				foreach ($weekInmonth as $key):
					//$Round['สัปดาห์ในที่']['วันในสัปดาห์']
					$week = ($key - 1);
					echo $Round[$week][$dayInweek] . "<br/>";
				endforeach;
			endforeach;
		*/

	}

	public function actionRangweek() {
//$year, $month
		$year = '2019';
		$month = '11';
		$last_month_day_num = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		$first_month_day_timestamp = strtotime($year . '-' . $month . '-01');
		$last_month_daty_timestamp = strtotime($year . '-' . $month . '-' . $last_month_day_num);

		$first_month_week = date('W', $first_month_day_timestamp);
		$last_month_week = date('W', $last_month_daty_timestamp);

		$mweek = array();
		for ($week = $first_month_week; $week <= $last_month_week; $week++) {
			#echo sprintf('%d-%02d-1', $year, $week ), "\n <br>";
			array_push($mweek, array(
				date("Y-m-d", strtotime(sprintf('%dW%02d-1', $year, $week))),
				date("Y-m-d", strtotime(sprintf('%dW%02d-2', $year, $week))),
				date("Y-m-d", strtotime(sprintf('%dW%02d-3', $year, $week))),
				date("Y-m-d", strtotime(sprintf('%dW%02d-4', $year, $week))),
				date("Y-m-d", strtotime(sprintf('%dW%02d-5', $year, $week))),
				date("Y-m-d", strtotime(sprintf('%dW%02d-6', $year, $week))),
				date("Y-m-d", strtotime(sprintf('%dW%02d-7', $year, $week))),
			));
		}
		print_r($mweek);
	}

	public function actionGetweek() {
		$mm = 11;
		$yy = 2019;
		$startdate = date($yy . "-" . $mm . "-01");
		$current_date = date('Y-m-t');
		$ld = cal_days_in_month(CAL_GREGORIAN, $mm, $yy);
		$lastday = $yy . '-' . $mm . '-' . $ld;
		$start_date = date('Y-m-d', strtotime($startdate));
		$end_date = date('Y-m-d', strtotime($lastday));
		$end_date1 = date('Y-m-d', strtotime($lastday . " + 6 days"));
		$count_week = 0;
		$week_array = array();

		for ($date = $start_date; $date <= $end_date1; $date = date('Y-m-d', strtotime($date . ' + 7 days'))) {
			$getarray = $this->getWeekDates($date, $start_date, $end_date);
			echo "<br>";
			$week_array[] = $getarray;
			echo "\n";
			$count_week++;
		}

		// its give the number of week for the given month and year
		echo $count_week;
		//print_r($week_array);

		/*
			for ($i = 0; $i < $count_week; $i++) {
				$start = $week_array[$i]['ssdate'];
				echo "--";

				$week_array[$i]['eedate'];
				echo "<br>";
			}
		*/
	}

	function getWeekDates($date, $start_date, $end_date) {
		$week = date('W', strtotime($date));
		$year = date('Y', strtotime($date));
		$from = date("Y-m-d", strtotime("{$year}-W{$week}+1"));
		if ($from < $start_date) {
			$from = $start_date;
		}

		$to = date("Y-m-d", strtotime("{$year}-W{$week}-6"));
		if ($to > $end_date) {
			$to = $end_date;
		}

		$array1 = array(
			"ssdate" => $from,
			"eedate" => $to,
		);

		return $array1;
		// echo "Start Date-->".$from."End Date -->".$to;
	}

	public function actionPromisenearexpire()
	{
		$sql = "SELECT
					promise.id ,
					promise.promisenumber,
					promise.promisedateend,
					customers.company,
					customers.manager,
					customers.tel,
					customers.telephone
				FROM promise
				INNER JOIN customers ON promise.customerid = customers.id
				WHERE DATEDIFF(promisedateend, NOW()) < 30";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		$data['promise'] = $rs;
		return $this->render('promisenearexpire', $data);
	}

	public function actionPromisewaitapprove()
	{
		$sql = "SELECT
					promise.id ,
					promise.promisenumber,
					promise.promisedateend,
					customers.company,
					customers.manager,
					customers.tel,
					customers.telephone
				FROM promise
				INNER JOIN customers ON promise.customerid = customers.id
				WHERE promise.status = '1'";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		$data['promise'] = $rs;
		return $this->render('promisewaitapprove', $data);
	}

	public function actionPromisepay()
	{
		$sql = "SELECT
					promise.id ,
					promise.promisenumber,
					promise.promisedateend,
					customers.company,
					customers.manager,
					customers.tel,
					customers.telephone
				FROM promise
				INNER JOIN customers ON promise.customerid = customers.id
				WHERE promise.checkmoney = '1'";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		$data['promise'] = $rs;
		return $this->render('promisepay', $data);
	}

}

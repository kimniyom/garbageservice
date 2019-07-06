<?php

namespace app\modules\promise\controllers;

use app\models\Config;
use app\modules\promise\models\Promise;
use app\modules\promise\models\Promisefile;
use app\modules\promise\models\PromiseSearch;
use common\models\Customers;
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
		
		return $this->render('view', $data);
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
		$model->createat = date('Y-m-d');
		$model->promisenumber = $conFig->getNextId("promise", "promisenumber", 5);
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if ($model->recivetype == 1) {
				$this->actionSetmonth($model->id, $customerid, $model->yearunit, $model->createat, $model->rate);
			}
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('create', [
			'model' => $model,
			'customer' => $this->getCustomer($customerid),
		]);
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

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if ($model->recivetype == 1) {
				$id = $model->id;
				Yii::$app->db->createCommand()
					->delete("roundmoney", "promiseid = '$id'")
					->execute();

				$this->actionSetmonth($model->id, $model->customerid, $model->yearunit, $model->createat, $model->rate);
			}
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
			'customer' => $this->getCustomer($model->customerid),
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
                    customers.company,
                    customers.taxnumber,
                    customers.address,
                    changwat.changwat_name as changwat,
                    ampur.ampur_name as ampur,
                    tambon.tambon_name as tambon,
                    customers.zipcode,
                    customers.manager,
                    customers.tel,
                    customers.telephone,
                    location.lat,
                    location.long,
                    promise.deposit,
                    promise.yearunit
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

	public function actionUploadpromise($id, $customerid)
    {
        $model = $this->getPromise($id, $customerid);
        $promise = Promise::findOne(['id'=>$id]);
        $promisefile = new Promisefile();
        $promisefile->scenario = 'create';

        if ($promisefile->load(Yii::$app->request->post())) {

            $promisefile->filename = UploadedFile::getInstance($promisefile,'filename');
            $promisefile->promiseid = $id;
            $promisefile->uploadby = Yii::$app->user->id;
            $promisefile->dateupload = date('Y-m-d H:i');

            if($promisefile->filename && $promisefile->validate())
            {
                $path = '../uploads/promise/pdf/'.$id.'.'.$promisefile->filename->extension;
                $promisefile->promiseid =$id;
                $promisefile->filename->name = $id.'.'.$promisefile->filename->extension;

                if($promisefile->save() && $promisefile->filename->saveAs($path)){
                    $promise->status = '2';
                    $promise->save();
                    return $this->redirect(['view', 
                        'id' => $id, 
                        'customerid'=>$customerid
                    ]);
                }
            }
            
        }

        return $this->render('uploadpromise',[
            'model'=>$model,
            'promisefile'=>$promisefile,
        ]);
    }

    public function actionGetpromisepdf($id)
    {
        $path = Yii::getAlias('@webroot') . '/../uploads/promise/pdf/'.$id.'.pdf';
        
        if(is_file($path))
        {
            Yii::$app->response->sendFile($path);
        }
        
    }

}

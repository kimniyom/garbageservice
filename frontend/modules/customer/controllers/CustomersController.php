<?php

namespace app\modules\customer\controllers;

use app\modules\customer\models\Customers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CustomersController implements the CRUD actions for Customers model.
 */
class CustomersController extends Controller {

	/**
	 * {@inheritdoc}
	 */
	public $layout = '@app/views/layouts/template';

	/**
	 * Lists all Customers models.
	 * @return mixed
	 */
	public function actionIndex() {
		$userid = \Yii::$app->user->identity->id;
		$customer = \app\modules\customer\models\Customers::findOne(['user_id' => $userid]);
		$data['promise'] = \app\modules\customer\models\Promise::find()->where(['customerid' => $customer['id']])
		->orWhere(['status' => '1','status' => '2'])->one();
		$data['customer'] = $customer;
		return $this->render('index', $data);
	}

	/**
	 * Displays a single Customers model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($userid) {
		$models = new Customers();
		$model = $models->Detail($userid);
		$sql = "select * from location where customer_id = '" . $model['id'] . "'";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		return $this->render('view', [
			'model' => $model,
			'location' => $rs,
		]);
	}

	/**
	 * Creates a new Customers model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($taxnumber, $type, $typename) {
		$model = new Customers();

		if ($model->load(Yii::$app->request->post())) {
			$model->user_id = \Yii::$app->user->identity->id;
			$model->create_date = date("Y-m-d H:i:s");
			$model->update_date = date("Y-m-d H:i:s");
			$model->save();
			return $this->redirect(['view', 'userid' => $model->user_id]);
		}

		return $this->render('create', [
			'model' => $model,
			'taxnumber' => $taxnumber,
			'type' => $type,
			'typename' => $typename,
		]);
	}

	/**
	 * Updates an existing Customers model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post())) {
			$model->update_date = date("Y-m-d H:i:s");
			$model->save();
			return $this->redirect(['view', 'userid' => $model->user_id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Customers model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Customers model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Customers the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Customers::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	protected function MapData($datas, $fieldId, $fieldName) {
		$obj = [];
		foreach ($datas as $key => $value) {
			array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
		}
		return $obj;
	}

	public function actionGetamphur() {
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$province_id = $parents[0];
				$datas = \common\models\Ampur::find()->where(['changwat_id' => $province_id])->all();
				$out = $this->MapData($datas, 'ampur_id', 'ampur_name');
				return Json::encode(['output' => $out, 'selected' => '']);
				//return ob_get_clean();
			}
		}

		echo Json::encode(['output' => '', 'selected' => '']);
	}

	public function actionGettambon() {
		//\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$amphur_id = $parents[0];
				$datas = \common\models\Tambon::find()->where(['ampur_id' => $amphur_id])->all();
				$out = $this->MapData($datas, 'tambon_id', 'tambon_name');
				return Json::encode(['output' => $out, 'selected' => '']);
				//return;
			}
		}

		echo Json::encode(['output' => '', 'selected' => '']);
	}

	public function actionCheck() {
		$model = new Customers();
		$data['type'] = $model->TypeCustomer();
		return $this->render("check", $data);
	}

	public function actionChecking() {
		$taxnumber = Yii::$app->request->post('taxnumber');
		$sql = "select COUNT(*) AS total from customers where taxnumber = '$taxnumber'";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		if ($rs['total'] > 0) {
			$status = "1";
		} else {
			$status = "0";
		}
		return $status;
	}

	public function actionMap($id) {
		$data['customer_id'] = $id;
		$data['userid'] = \Yii::$app->user->identity->id;
		return $this->renderPartial('map', $data);
	}

	public function actionAddlocation($customer_id, $cusname, $lat, $long, $zoom, $user_id) {
		$sqlCheck = "select count(*) AS total from location where customer_id = '$customer_id' ";
		$count = Yii::$app->db->createCommand($sqlCheck)->queryOne()['total'];
		if ($count > 0) {
			$columns = array(
				"name" => $cusname,
				"lat" => $lat,
				"long" => $long,
				"zoom" => $zoom,
			);
			Yii::$app->db->createCommand()
				->update("location", $columns, "customer_id='$customer_id'")
				->execute();
		} else {
			$columns = array(
				"customer_id" => $customer_id,
				"name" => $cusname,
				"lat" => $lat,
				"long" => $long,
				"zoom" => $zoom,
			);
			Yii::$app->db->createCommand()
				->insert("location", $columns)
				->execute();
		}
		return $this->redirect(Yii::$app->urlManager->createUrl(['customer/customers/view', 'userid' => $user_id]));
	}

	public function actionPromise(){
		$user_id = \Yii::$app->user->identity->id;

		$sql = "select f.filename 
				from customers c inner join promise p on c.id = p.customerid
				inner join promisefile f on p.id = f.promiseid
				where c.user_id = '$user_id' and p.active = '1' and p.status = '2'";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		$data['promise'] = $rs;
		return $this->render('promise',$data);
	}

}

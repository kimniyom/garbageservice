<?php

namespace app\modules\customer\controllers;

use app\modules\customer\models\Customer;
use app\modules\customer\models\CustomerSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller {

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
	 * Lists all Customer models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new CustomerSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Customer model.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionView($id) {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Customer model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Customer();

		if ($model->load(Yii::$app->request->post())) {
			$model->CREATE_DATE = date("Y-m-d H:i:s");
			$model->UPDATE_DATE = date("Y-m-d H:i:s");
			$model->UPDATE_DATE = date("Y-m-d H:i:s");
			$model->save();
			return $this->redirect(['view', 'id' => $model->ID]);
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * Updates an existing Customer model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->ID]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
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
				$datas = \app\models\Ampur::find()->where(['changwat_id' => $province_id])->all();
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
				$datas = \app\models\Tambon::find()->where(['ampur_id' => $amphur_id])->all();
				$out = $this->MapData($datas, 'tambon_id', 'tambon_name');
				return Json::encode(['output' => $out, 'selected' => '']);
				//return;
			}
		}

		echo Json::encode(['output' => '', 'selected' => '']);
	}

	public function actionGetzipcode() {
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$district_id = $parents[0];
				$datas = \app\models\Zipcodes::find()->where(['district_id' => $district_id])->all();
				$out = $this->MapData($datas, 'zipcode', 'zipcode');
				echo Json::encode(['output' => $out, 'selected' => '']);
				return;
			}
		}

		echo Json::encode(['output' => '', 'selected' => '']);
	}

	/**
	 * Deletes an existing Customer model.
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
	 * Finds the Customer model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Customer the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Customer::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

}

<?php

namespace app\modules\roundgarbage\controllers;

use app\modules\roundgarbage\models\Roundgarbage;
use app\modules\roundgarbage\models\RoundgarbageSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RoundgarbageController implements the CRUD actions for Roundgarbage model.
 */
class RoundgarbageController extends Controller {
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
	 * Lists all Roundgarbage models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new RoundgarbageSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Roundgarbage model.
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
	 * Creates a new Roundgarbage model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Roundgarbage();

		if ($model->load(Yii::$app->request->post())) {
			$number = Roundgarbage::find()
				->where(['customerid' => $model->customerid, 'promiseid' => $model->promiseid])
				->orderBy(['round' => SORT_DESC])->one();
			$model->round = $number === null ? 1 : $number->round + 1;
			if ($model->save()) {
				return $this->redirect(['index']);
			}
		}

		return $this->render('create', [
			'model' => $model,
		]);
	}

	public function actionSetround($promise) {
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

		/*
			        $mweek = rangweek(2019, 07);
			        $cm = count($mweek);

			        echo $mweek[2][1];
		*/
	}

	function rangweek($year, $month) {
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
		return $mweek;
	}

	/**
	 * Updates an existing Roundgarbage model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		}

		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * Deletes an existing Roundgarbage model.
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
	 * Finds the Roundgarbage model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Roundgarbage the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Roundgarbage::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}
}

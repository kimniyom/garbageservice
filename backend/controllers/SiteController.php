<?php

namespace backend\controllers;

use common\models\LoginForm;
use app\modules\customer\models\Customers;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller {
	public $enableCsrfValidation = false;
	/**
	 * {@inheritdoc}
	 */
	//public $layout = "template";
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'actions' => ['login', 'error','getlocation'],
						'allow' => true,
					],
					[
						'actions' => ['logout', 'index'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
		$customerModel = new Customers();
		$data['customernonapprove'] = $customerModel->Countnonactive();
		return $this->render('index',$data);
	}

	/**
	 * Login action.
	 *
	 * @return string
	 */
	public function actionLogin() {
		if (!Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			$model->password = '';

			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	public function actionGetlocation(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$sql = "select l.*,c.company from location l inner join customers c on l.customer_id = c.id";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		$json_data = array();
		foreach($rs as $row):
			$json_data[] = array(
            "name" => $row['company'],
            "lat" => $row['lat'],
            "long" => $row['long']                      
        );
		endforeach;
		return json_encode($json_data);
	}

	/**
	 * Logout action.
	 *
	 * @return string
	 */
	public function actionLogout() {
		Yii::$app->user->logout();
		$this->redirect(Yii::$app->urlManagerFrontend->getBaseUrl());
	}

}

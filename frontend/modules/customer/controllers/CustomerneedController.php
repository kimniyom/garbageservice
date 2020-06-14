<?php

namespace app\modules\customer\controllers;

use Yii;
use app\modules\customer\models\Customerneed;
use app\modules\customer\models\CustomerneedSearch;
use yii\web\Controller;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\captcha\CaptchaAction;

/**
 * CustomerneesController implements the CRUD actions for Customerneed model.
 */
class CustomerneedController extends Controller {

    public $layout = '@app/views/layouts/template';

    /**
     * {@inheritdoc}
     */
    /*
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
     */
    public function actions() {

        //$this->layout = $this->setting['layout'];

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            //'fixedVerifyCode' => YII_ENV_TEST ? '42' : null,
            ],
        ];
    }

    /**
     * Lists all Customerneed models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CustomerneedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customerneed model.
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
     * Creates a new Customerneed model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Customerneed();

        if ($model->load(Yii::$app->request->post())) {
            $model->d_update = date("Y-m-d H:i:s");
            $model->status = 0;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customerneed model.
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
     * Deletes an existing Customerneed model.
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
     * Finds the Customerneed model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customerneed the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Customerneed::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}

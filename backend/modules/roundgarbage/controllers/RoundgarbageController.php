<?php

namespace app\modules\roundgarbage\controllers;

use Yii;
use app\modules\roundgarbage\models\Roundgarbage;
use app\modules\roundgarbage\models\RoundgarbageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoundgarbageController implements the CRUD actions for Roundgarbage model.
 */
class RoundgarbageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
    public function actionIndex()
    {
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Roundgarbage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Roundgarbage();
        
        if ($model->load(Yii::$app->request->post()))
        {   
            $number = Roundgarbage::find()
            ->where(['customerid'=>$model->customerid,'promiseid'=>$model->promiseid])
            ->orderBy(['round'=>SORT_DESC])->one();
            $model->round = $number === null ?1:$number->round+1;
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Roundgarbage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Roundgarbage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

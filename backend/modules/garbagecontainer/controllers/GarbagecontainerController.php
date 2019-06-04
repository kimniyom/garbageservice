<?php

namespace app\modules\garbagecontainer\controllers;

use Yii;
use app\modules\garbagecontainer\models\Garbagecontainer;
use app\modules\garbagecontainer\models\GarbagecontainerSearch;
use app\modules\garbagecontainer\models\Imgcontain;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GarbagecontainerController implements the CRUD actions for Garbagecontainer model.
 */
class GarbagecontainerController extends Controller
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
     * Lists all Garbagecontainer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GarbagecontainerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Garbagecontainer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelImg = Imgcontain::find()->where(['garbagecontainer_id' => $id])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelImg' => $modelImg,
        ]);
    }

    /**
     * Creates a new Garbagecontainer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Garbagecontainer();
        $modelImg = new Imgcontain(); 
        $modelImg->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelImg->image = UploadedFile::getInstance($modelImg,'image');
            if($modelImg->image && $modelImg->validate())
            {
                $numRand = mt_rand();
                $dateUpload = date('YmdHis');
                $path = '../uploads/containner/gallerry/'.$dateUpload.$numRand.'.'.$modelImg->image->extension;
                $modelImg->garbagecontainer_id = $model->id;
                $modelImg->image->name = $dateUpload.$numRand.'.'.$modelImg->image->extension;

                if($modelImg->save() && $modelImg->image->saveAs($path)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            
        }

        return $this->render('create', [
            'model' => $model,
            'modelImg'=> $modelImg,
        ]);
    }

    /**
     * Updates an existing Garbagecontainer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $path = '../uploads/containner/gallerry/';
        $modelImg =  Imgcontain::find()->where(['garbagecontainer_id' => $id])->one();
        $oldImage = $modelImg?$path.$modelImg->image:"";
       

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $modelImg->image = UploadedFile::getInstance($modelImg,'image');

            if($modelImg->image)
            {
                if($modelImg->validate())
                {
                    $numRand = mt_rand();
                    $dateUpload = date('YmdHis');
                    $path = $path.$dateUpload.''.$numRand.'.'.$modelImg->image->extension;
                    $modelImg->garbagecontainer_id = $model->id;
                    $modelImg->image->name = $dateUpload.$numRand.'.'.$modelImg->image->extension;

                    if($modelImg->save() && $modelImg->image->saveAs($path) && unlink($oldImage)){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
            else{
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'modelImg'=> $modelImg,
            'oldImage'=> $oldImage,
        ]);
    }

    /**
     * Deletes an existing Garbagecontainer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       
        $modelImg = Imgcontain::find()->where(['garbagecontainer_id' => $id])->one();
        $path = '../uploads/containner/gallerry/';

        if($modelImg && file_exists($path.$modelImg->image))
        {
            if(unlink($path.$modelImg->image) && $modelImg->delete())
            {
                $this->findModel($id)->delete();
                return $this->redirect(['index']);
            }
        }
        else{
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Garbagecontainer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Garbagecontainer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Garbagecontainer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

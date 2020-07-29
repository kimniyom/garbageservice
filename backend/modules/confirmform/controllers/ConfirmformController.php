<?php

namespace app\modules\confirmform\controllers;

use Yii;
use app\models\Confirmform;
use app\models\ConfirmformSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Customers;
use app\models\ConfirmformPayment;
use app\models\ConfirmformMethodpayment;
/**
 * ConfirmformController implements the CRUD actions for Confirmform model.
 */
class ConfirmformController extends Controller
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
     * Lists all Confirmform models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Confirmform();
        $data['datas'] = $model->geConfirmformAll();
        return $this->render('index', $data);
    }

    /**
     * Displays a single Confirmform model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = new Confirmform();
        $data['datas'] = $model->geConfirmformById($id);
        
        $data['payment'] = ConfirmformPayment::findOne(['id'=>$data['datas']['paymentschedule']]);
        $data['method'] = ConfirmformMethodpayment::findOne(['id'=>$data['datas']['methodpeyment']]);
        return $this->render('view', $data);
    }

    public function actionBeforecreate()
    {
        $customer = Customers::find()->where(['flag' => 1, 'approve' => 'Y'])->all();
        return $this->render('beforecreate',[
            'customer' => $customer
        ]);
    }

    /**
     * Creates a new Confirmform model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($customerid)
    {
        $model = new Confirmform();
        $model->customerid = $customerid;
        $model->status = 1;
       
        if ($model->load(Yii::$app->request->post())) 
        {
            $confirmformnumber = Confirmform::find()->orderBy('confirmformnumber DESC')->one();
            if($confirmformnumber == null)
            {
                $model->confirmformnumber = "ICP00001";
            }
            else{
                $number =  str_replace("ICP","",$confirmformnumber->confirmformnumber);
                $model->confirmformnumber = "ICP".str_pad(intval($number) + 1, 5, "0", STR_PAD_LEFT);
            }
           
           
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
     * Updates an existing Confirmform model.
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
     * Deletes an existing Confirmform model.
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
     * Finds the Confirmform model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Confirmform the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Confirmform::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIscustomeractive() {
        $customerid = Yii::$app->request->post('customerid');
        $isReccord = 1;
        $rs = Customers::find()->where("id = '$customerid' and approve = 'Y' ")->count();
        if ($rs > 0) {
            $isReccord = 0;
        }
        return $isReccord;
    }
}

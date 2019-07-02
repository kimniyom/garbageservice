<?php

namespace app\modules\promise\controllers;

use Yii;
use app\modules\promise\models\Promise;
use app\modules\promise\models\PromiseSearch;
use common\models\Customers;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use app\models\Config;

/**
 * PromiseController implements the CRUD actions for Promise model.
 */
class PromiseController extends Controller
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
     * Lists all Promise models.
     * @return mixed
     */
    public function actionIndex()
    {
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
    public function actionView($id, $customerid)
    {
        $rs = $this->getPromise($id, $customerid);
      
        return $this->render('view', [
            'model' => $rs,
        ]);
    }

    public function actionBeforecreate()
    {
        $customer = Customers::find()->where(['flag'=>1,'approve'=>'Y'])->all();
        return $this->render('beforecreate',[
            'customer' => $customer,
        ]);
    }

    /**
     * Creates a new Promise model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($customerid)
    {
        $model = new Promise();
        $model->customerid = $customerid;
        $model->createat = date('Y-m-d');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'customerid' => $model->customerid]);
        }

        return $this->render('create', [
            'model' => $model,
            'customer' => $this->getCustomer($customerid),
        ]);
    }

    /**
     * Updates an existing Promise model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param integer $customerid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $customerid)
    {
        $model = $this->findModel($id, $customerid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'customerid' => $model->customerid]);
        }

        return $this->render('update', [
            'model' => $model,
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
    public function actionDelete($id, $customerid)
    {
        $this->findModel($id, $customerid)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetdoc($id, $customerid)
    {
        
        $rs = $this->getPromise($id, $customerid);
        Settings::setTempDir(Yii::getAlias('@webroot').'/web/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot').'/web/doc/templetpromise.docx'); //Path ของ template ที่สร้างเอาไว้
        $Config = new Config();
        $templateProcessor->setValue(
            [
                'id',
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
                'long'
            ],
            [
                $rs['id'],
                $rs['customerid'],
                $Config->thaidate($rs['promisedatebegin']),
                $Config->thaidate($rs['promisedateend']),
                $rs['recivetype']==0?'รายครั้ง':'รายเดือน',
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

        $templateProcessor->saveAs(Yii::getAlias('@webroot').'/web/doc/promise.docx');
        Yii::$app->response->sendFile(Yii::getAlias('@webroot').'/web/doc/promise.docx');
        
        //clear temp
        $files = glob(Yii::getAlias('@webroot').'/web/temp/*'); 
        foreach($files as $file){ 
        if(is_file($file))
            unlink($file); 
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
    protected function findModel($id, $customerid)
    {
        if (($model = Promise::findOne(['id' => $id, 'customerid' => $customerid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getCustomer($customerid)
    {
        if (($model = Customers::findOne(['id' => $customerid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getPromise($id, $customerid)
    {
        $sql = "
                SELECT
                    promise.id,
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
                    location.long
                    FROM
                    promise
                INNER JOIN customers ON promise.customerid = customers.id
                INNER JOIN changwat ON customers.changwat = changwat.changwat_id
                INNER JOIN ampur ON customers.ampur = ampur.ampur_id
                INNER JOIN tambon ON customers.tambon = tambon.tambon_id
                INNER JOIN location ON promise.customerid = location.customer_id
                WHERE 
                    customers.flag = 1 
                    AND customers.approve = 'Y'
                    AND promise.id = '{$id}'
                    AND promise.customerid = {$customerid}

        ";
       
        return Yii::$app->db->createCommand($sql)->queryOne();
    }

    public function actionIscustomerexpired()
    {
        $customerid = Yii::$app->request->post('customerid');
        $isReccord = 0;
        $rs = Promise::find()->where(['customerid' => $customerid, 'status' => '0', 'active'=>'0'])->count();
        if($rs > 0) 
        {         
            $isReccord = 1;
        }
        return $isReccord;   
    }
                    
    
}

<?php

namespace app\modules\datekeep\controllers;

use Yii;
use app\models\Datekeep;
use app\models\DatekeepSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\promise\models\Promise;
use yii\helpers\Json;

/**
 * DatekeepController implements the CRUD actions for Datekeep model.
 */
class DatekeepController extends Controller {

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

    public function actionBeforedatekeep() {
        $promise = Promise::find()->where(['active' => 1, 'status' => 2])->all();
        return $this->render('beforedatekeep', [
                    'promise' => $promise,
        ]);
    }

    /**
     * Lists all Datekeep models.
     * @return mixed
     */
    public function actionIndex($promiseid) {
        $promise = $this->getPromise($promiseid);
        $data['model'] = Datekeep::findAll(['promiseid' => $promiseid]);
        $data['promiseid'] = $promiseid;

        return $this->render('_promisedetail', [
                    'promise' => $promise,
                    'data' => $data,
                    'render' => 'index',
        ]);
    }

    /**
     * Displays a single Datekeep model.
     * @param integer $promiseid
     * @param string $datekeep
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $promiseid = \Yii::$app->request->post('promiseId');
        $id = \Yii::$app->request->post('id');
        $promise = $this->getPromise($promiseid);
        $data['model'] = $this->findModel($id);
        $day = $data['model']['datekeep'];
        $dayname = Yii::$app->db->createCommand("SELECT DAYNAME('".$day."') AS dayname")->queryOne()['dayname'];
        return $this->renderPartial('view', [
                    'promise' => $promise,
                    'data' => $data,
                    'dayname' => $dayname,
                    //'render' => 'view',
        ]);
    }

    /**
     * Creates a new Datekeep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($promiseid) {
        $promise = $this->getPromise($promiseid);
        $model = new Datekeep();
        $model->promiseid = $promiseid;
        $model->status = 0;
        $data['model'] = $model;
        if ($data['model']->load(Yii::$app->request->post()) && $data['model']->save()) {
            return $this->redirect(['index', 'promiseid' => $data['model']->promiseid, 'datekeep' => $data['model']->datekeep]);
        }

        return $this->render('_promisedetail', [
                    'promise' => $promise,
                    'data' => $data,
                    'render' => 'create',
        ]);
    }

    /**
     * Updates an existing Datekeep model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $promiseid
     * @param string $datekeep
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($promiseid, $datekeep) {
        $promise = $this->getPromise($promiseid);
        $model = $this->findModel($promiseid, $datekeep);
        $data['model'] = $model;
        if ($data['model']->load(Yii::$app->request->post()) && $data['model']->save()) {
            return $this->redirect(['index', 'promiseid' => $data['model']->promiseid, 'datekeep' => $data['model']->datekeep]);
        }

        return $this->render('_promisedetail', [
                    'promise' => $promise,
                    'data' => $data,
                    'render' => 'update'
        ]);
    }

    /**
     * Deletes an existing Datekeep model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $promiseid
     * @param string $datekeep
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $id = \Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
                ->delete("datekeep","id = '$id'")
                ->execute();
        /*
        $model = $this->findModel($id);
        if($model->delete())
        {
            $promise = $this->getPromise($promiseid);
            $data['model'] =  Datekeep::findAll(['promiseid'=>$promiseid]);
            $data['promiseid'] = $promiseid;
        
            return $this->render('_promisedetail', [
                'promise'=> $promise,
                'data' => $data,
                'render'=>'index',
                
            ]);
        }
         * 
         */
            
    }

    /**
     * Finds the Datekeep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $promiseid
     * @param string $datekeep
     * @return Datekeep the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Datekeep::findOne([ 'id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getPromise($id) {
        $sql = "
                SELECT
                promise.id,
                    promise.promisenumber,
                    promise.customerid,
                    promise.promisedatebegin,
		    promise.promisedateend,
		    promise.createat,
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
                    promise.vat,
                    promise.deposit,
                    promise.yearunit,
                    promise.unitprice,
                    promise.distcountpercent,
                    promise.distcountbath,
                    promise.total,
                    promise.fine,
                    promise.contracktor,
                    promise.payment,
                    promise.vattype,
                    customers.company,
                    customers.taxnumber,
		    customers.address,
		    customers.timework,
            customers.zipcode,
            customers.grouptype,
                    customers.manager,
                    CONCAT(customers.tel,',',customers.telephone) AS tels,
                    customers.tel,
                    customers.telephone,
					customers.remark,
					customers.typeregister,
                    changwat.changwat_name as changwat,
                    customers.changwat as changwat_id,
                    ampur.ampur_name as ampur,
                    tambon.tambon_name as tambon,
                    location.lat,
                    location.long,
                    promise.dayinweek,
					promise.weekinmonth,
					promise.employer1,
					promise.employer2,
					promise.witness1,
                    promise.witness2,
                    packagepayment.payment as textpayment,
					maspackage.package,
                                        promise.flag
                FROM
                    promise
                INNER JOIN customers ON promise.customerid = customers.id
                INNER JOIN changwat ON customers.changwat = changwat.changwat_id
                INNER JOIN ampur ON customers.ampur = ampur.ampur_id
                INNER JOIN tambon ON customers.tambon = tambon.tambon_id
                LEFT JOIN location ON promise.customerid = location.customer_id
                LEFT JOIN maspackage ON promise.recivetype = maspackage.package
				LEFT JOIN packagepayment ON promise.payment = packagepayment.id
                WHERE
                    customers.flag = 1
                    AND customers.approve = 'Y'
                    AND promise.id = '{$id}'";

        return Yii::$app->db->createCommand($sql)->queryOne();
    }

    public function actionJsoncalendar($promiseid) {
        $times = Datekeep::findAll(['promiseid' => $promiseid]);

        $events = array();
        
        foreach ($times AS $time){
          //Testing
          $Event = new \yii2fullcalendar\models\Event();
          $Event->id = $time->id;
          $Event->title = "เข้าจัดเก็บ";
          $Event->start = $time->datekeep;
          $Event->end = $time->datekeep;
          $events[] = $Event;
        }

        header('Content-type: application/json');
        return Json::encode($events);

        //Yii::$app->end();
    }

    public function actionSetdatekeep()
    {
        $promiseid = Yii::$app->request->post('promiseid');
        $datekeep = Yii::$app->request->post('datekeep');

        $model = new Datekeep();
        $model->promiseid = $promiseid;
        $model->datekeep = $datekeep;
        $model->status = 0 ;

        if($model->save())
        {
            return 1;
        }
        else{
            return 0;
        }
      
       
    }

}

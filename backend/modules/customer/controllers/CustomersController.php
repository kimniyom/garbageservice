<?php

namespace app\modules\customer\controllers;

use app\modules\customer\models\Customers;
use app\modules\customer\models\CustomersSearch;
use app\models\Location;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomersController extends Controller {

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
        $searchModel = new CustomersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $sql = "select * from location where customer_id = '" . $id . "'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'location' => $rs,
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate() {
      $model = new Customers();

      if ($model->load(Yii::$app->request->post())) {
      $model->create_date = date("Y-m-d H:i:s");
      $model->update_date = date("Y-m-d H:i:s");
      $model->save();

      return $this->redirect(['view', 'id' => $model->id]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }
     */
    public function actionCreate($taxnumber, $user) {
        $model = new Customers();
        $location = new Location();
        if ($model->load(Yii::$app->request->post()) && $location->load(Yii::$app->request->post())) {

            //$model->user_id = \Yii::$app->user->identity->id;
            $model->user_id = $user;
            $model->customercode = $this->getNextId();
            $model->create_date = date("Y-m-d H:i:s");
            $model->update_date = date("Y-m-d H:i:s");
            $model->save();

            $location->customer_id = $model->id;
            $location->name = $model->company;
            $location->zoom = 13;
            $location->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
                    'taxnumber' => $taxnumber,
                    'location' => $location,
        ]);
    }

    public function getNextId() {
        //ตัวอย่างหากต้องการ SN59-00001
        $lastRecord = Customers::find()->where(['like', 'customercode', 'C'])->orderBy(['id' => SORT_DESC])->one(); //หาตัวล่าสุดก่อน
        if ($lastRecord) {

            $digit = explode('C', $lastRecord->customercode);

            $lastDigit = ((int) $digit[1]); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
            $lastDigit++; //เพิ่ม 1
            $lastDigit = str_pad($lastDigit, 5, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
        } else {
            $lastDigit = '00001';
        }

        return 'C' . $lastDigit;
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
        $location = Location::findOne(['customer_id' => $id]);

        if ($model->load(Yii::$app->request->post()) && $model->save() && $location->load(Yii::$app->request->post()) && $location->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'location' => $location,
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

    public function actionCustomernonapprove() {
        $sql = "select c.*,t.typename
				from customers c inner join typecustomer t on c.type = t.id
				where c.approve = 'N'";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $rs;
        return $this->render('customernonapprove', $data);
    }

    public function actionConfirmcustomer() {
        $id = Yii::$app->request->post('id');
        $columns = array("approve" => 'Y');
        Yii::$app->db->createCommand()
                ->update("customers", $columns, "id = '$id'")
                ->execute();
    }

    public function actionCheck() {
        $model = new Customers();
        //$data['type'] = $model->TypeCustomer();
        $sql = "SELECT * FROM `user` u
				WHERE u.id NOT IN(SELECT user_id FROM customers)
				AND u.`status` != 'A'";
        $data['user'] = Yii::$app->db->createCommand($sql)->queryAll();
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

}

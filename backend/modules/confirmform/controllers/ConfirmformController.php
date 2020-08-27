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
use app\models\Customerneed;
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
        
        $sql = "
                SELECT 
                    customerneed.id,
                    customerneed.customername
                FROM customerneed
                LEFT JOIN confirmform ON customerneed.id = confirmform.customerneedid
                WHERE confirmform.id IS NULL AND customerneed.`status` = 1
        ";
        $customerneed = Yii::$app->db->createCommand($sql)->queryAll();
                   
        return $this->render('beforecreate',[
            'customerneed' => $customerneed
        ]);
    }

    /**
     * Creates a new Confirmform model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($customerneedid)
    {
        $model = new Confirmform();
        $model->customerneedid = $customerneedid;
        $model->status = 1;
        $need = Customerneed::findOne(['id'=>$customerneedid]);
       
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
           'a'=> "a",
            'need' => $need,
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

     public function actionPertimepay() {
        $sql = "
        SELECT
            invoice_pertime.*, CONCAT(
                '(Invoice #',
                invoice_pertime.invoicenumber,
                ') ',
                c.customername,
                ' (จำนวน ',
                invoice_pertime.total,
                ' .-)'
            ) AS orders,
            confirmform.confirmformnumber,
            c.customername,
            r.round AS roundmoney,
            c.contact
        FROM
            invoice_pertime
        INNER JOIN confirmform  ON invoice_pertime.confirmid = confirmform.id
        INNER JOIN customerneed c ON confirmform.customerneedid = c.id
        LEFT JOIN roundmoney_pertime r ON invoice_pertime.round = r.id
        WHERE
            invoice_pertime.`status` = '0'
    
        ";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        $data['pertime'] = $rs;
        return $this->render('pertimepay', $data);
    }

    public function actionConfirminvoice($id) {
        $data['bank'] = $this->getBookbank();
        $sql = "SELECT *
                    FROM invoice i
                    WHERE i.id = '$id'";
        $data['id'] = $id;
        $data['order'] = Yii::$app->db->createCommand($sql)->queryOne();
        $data['bank'] = $this->getBookbank();
        return $this->render('confirminvoice', $data);
    }

    public function getBookbank() {
        $sql = "SELECT b.*,CONCAT(k.bankname,' เลขบัญชี ' ,b.bookbanknumber) AS bname,k.bankname,k.bank_img
              FROM bookbank b INNER JOIN bank k On b.bank = k.id ";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function actionSaveconfirmorder() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $dateservice = $_POST['dateservice'];
            $timeservice = $_POST['timeservice'];
            $comment = $_POST['comment'];

            if ($_FILES['inputFile']['name']) {
                $fileExt = pathinfo($_FILES["inputFile"]["name"], PATHINFO_EXTENSION);
                $fileName = date('dmYHis') . md5($_FILES["inputFile"]["name"]) . "." . $fileExt;
                $filePath = "../uploads/slip/" . $fileName;
                move_uploaded_file($_FILES["inputFile"]["tmp_name"], $filePath);
                $columns = array(
                    "slip" => $fileName,
                    "dateconfirm" => date("Y-m-d H:i:s")
                );

                Yii::$app->db->createCommand()
                        ->update("invoice_pertime", $columns, "id = '$id'")
                        ->execute();
                echo "success";
            } else {
                $columns = array(
                    "dateservice" => $dateservice,
                    "timeservice" => $timeservice,
                    "comment" => $comment,
                    "bank" => $_POST['bank'],
                    "status" => 1,
                    "dateconfirm" => date("Y-m-d H:i:s"),
                    "typepayment" => 2,
                    "userid" => Yii::$app->user->id
                );
                Yii::$app->db->createCommand()
                        ->update("invoice_pertime", $columns, "id = '$id'")
                        ->execute();
                echo "success";
            }
        }
    }
}

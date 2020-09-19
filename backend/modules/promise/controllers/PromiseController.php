<?php

namespace app\modules\promise\controllers;

use app\models\Config;
use app\modules\promise\models\Promise;
use app\modules\promise\models\Promisefile;
use app\modules\promise\models\PromiseSearch;
use common\models\Customers;
use kartik\mpdf\Pdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\helpers\Json;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PromiseController implements the CRUD actions for Promise model.
 */
class PromiseController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                //'cancelpromise' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Promise models.
     * @return mixed
     */
    public function actionIndex($group = "", $groupname = "") {
        $searchModel = new PromiseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$promise = Promise::find()->where([''])->all();
        $promise = $this->getCustomertInGroup($group);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'promise' => $promise,
                    'groupname' => $groupname,
                    'group' => $group
        ]);
    }

    function getCustomertInGroup($group) {
        $sql = "SELECT p.*
                    FROM promise p INNER JOIN customers c ON p.customerid = c.id
                    WHERE c.grouptype = '$group' AND (p.upper = '' OR p.upper is null) ORDER BY p.status,p.createat ASC ";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * Displays a single Promise model.
     * @param string $id
     * @param integer $customerid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $data['model'] = $this->getPromise($id);
        $data['roundmoney'] = $this->getRoundMoney($id);
        $data['roundgarbage'] = $this->getRoundGarbage($id);
        return $this->render('view', $data);
    }

    function getRoundGarbage($id) {
        $sql = "select * from roundgarbage where promiseid = '$id' order by id asc";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function getRoundMoney($id) {
        $sql = "select * from roundmoney where promiseid = '$id'";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    public function actionBeforecreate($group) {
        $customer = Customers::find()->where(['flag' => 1, 'approve' => 'Y', 'grouptype' => $group])->all();
        return $this->render('beforecreate', [
                    'customer' => $customer,
        ]);
    }

    /**
     * Creates a new Promise model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($customerid) {
        $conFig = new Config();
        $model = new Promise();
        $model->customerid = $customerid;
//$model->createat = date('Y-m-d');
        $model->promisenumber = $this->getNextId("promise", "promisenumber", 5);
        $error = "";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->recivetype == 1 || $model->recivetype == 3 || $model->recivetype == 2) {
//$week = $model->weekinmonth;
//$weekround = implode(",", $week);
//$model->weekinmonth = $weekround;
//$countWeek = count($week);
//if ($model->levy != $countWeek) {
//$error = "จำนวนครั้งที่จัดเก็บไม่เท่ากัน..!";
//} else {
                if ($model->save()) {
                    $this->actionSetmonth($model->id, $customerid, $model->yearunit, $model->promisedatebegin, $model->promisedateend, $model->rate);
                    return $this->redirect(['view', 'id' => $model->id]);
                }

//}
            } else {
                if ($model->save()) {
                    $this->actionSetmonth($model->id, $customerid, $model->yearunit, $model->promisedatebegin, $model->promisedateend, $model->rate);
                    return $this->redirect(['view', 'id' => $model->id]);
                }

                /*
                  $model->save();
                  return $this->redirect(['view', 'id' => $model->id]);
                 */
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'customer' => $this->getCustomer($customerid),
                    'error' => $error,
        ]);
    }

    public function getNextId() {
//ตัวอย่างหากต้องการ SN59-00001
        $lastRecord = Promise::find()->where(['like', 'promisenumber', 'IC'])->orderBy(['id' => SORT_DESC])->one(); //หาตัวล่าสุดก่อน
        if ($lastRecord) {
            $digit = explode('IC', $lastRecord->promisenumber);
            $lastDigit = ((int) $digit[1]); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
            $lastDigit++; //เพิ่ม 1
            $lastDigit = str_pad($lastDigit, 5, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
        } else {
            $lastDigit = '00001';
        }

        return 'IC' . $lastDigit;
    }

    public function actionSetmonth($promiseID, $customerID, $promiesYear, $dateStart, $dateEnd, $priceMonth) {
        if ($promiesYear == "") {
            $promiesYear = 1;
        }

        $dStart = substr($dateStart, 0, 7) . "-01";
        $dEtart = substr($dateEnd, 0, 7) . "-30";
        /*
          $d1 = new \DateTime('2020-08-01');
          $d2 = new \DateTime('2021-09-30');

          $interval = $d2->diff($d1);
          echo $interval->format('%m');
          exit();

          $dStart = substr($dateStart, 0, 7) . "-01";
          $dEtart = substr($dateEnd, 0, 7) . "-30";
          $datetime1 = date_create($dStart);
          $datetime2 = date_create($dEtart);
          $interval = date_diff($datetime1, $datetime2);
          $month = $interval->format('%m');
         */
        $sqlMonth = "SELECT (TIMESTAMPDIFF(MONTH,'$dStart','$dEtart')) AS mTotal";

        $month = Yii::$app->db->createCommand($sqlMonth)->queryOne()['mTotal'];

        //$month =

        $total_month = ($month + 1); //เอามาบวก 1 เพื่อให้ต้วแปร i เริ่มต้นที่ 1 เพราะปกติตัวแปรอาเรย์จะเริ่มต้นที่ 0
        $pay = $priceMonth;
        $j = 0;
        for ($i = 1; $i <= $total_month; $i++) {
            $j = $i - 1; //เริ่มเก็บเดือนที่เริ่มสัญญา ถ้า เริ่มเก็บเดือนถัดไปให้เรียกใช้ i
            $myDate = date("Y-m-d", strtotime(date($dateStart, strtotime(date("Y-m-d"))) . "+$j month"));
            /*
              echo "<pre>";
              echo " งวดที่ " . $i;
              echo " กำหนดชำระ ";
              $datekeep = date('Y-m-d', strtotime($myDate));
              echo "<b>";
              echo " จำนวน " . number_format($pay, 2) . " บาท";
              echo "</b>";
              echo "</pre>";
             */
            $datekeep = date('Y-m-d', strtotime($myDate));
            $columns = array(
                "customerid" => $customerID,
                "promiseid" => $promiseID,
                "datekeep" => $datekeep,
                "round" => $i,
                "amount" => $pay,
            );

            Yii::$app->db->createCommand()
                    ->insert("roundmoney", $columns)
                    ->execute();
        }
    }

    /**
     * Updates an existing Promise model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @param integer $customerid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
//$model->weekinmonth = explode(",", $model->weekinmonth);
        $error = "";
        if ($model->load(Yii::$app->request->post())) {
//$week = $model->weekinmonth;
//$weekround = implode(",", $week);
//$model->weekinmonth = $weekround;

            if ($model->recivetype == 1 || $model->recivetype == 3 || $model->recivetype == 2) {
//$countWeek = count($week);
//if ($model->levy != $countWeek) {
//$error = "จำนวนครั้งที่จัดเก็บไม่เท่ากัน..!";
//} else {
//ถ้าแบ่งจ่ายรายเดือนจะคำนวณหาวันที่ต้องชำระเงินในแต่ละเดือน
//if ($model->payment == 0) {
                $id = $model->id;
                Yii::$app->db->createCommand()
                        ->delete("roundmoney", "promiseid = '$id'")
                        ->execute();

                $this->actionSetmonth($model->id, $model->customerid, $model->yearunit, $model->promisedatebegin, $model->promisedateend, $model->rate);
//}

                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
//}
            } else {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'customer' => $this->getCustomer($model->customerid),
                    'error' => $error,
        ]);
    }

    public function actionUpdatesubpromise($id) {
        $model = $this->findModel($id);
        $error = "";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->recivetype == 1 || $model->recivetype == 3 || $model->recivetype == 2) {

                $id = $model->id;
                Yii::$app->db->createCommand()
                        ->delete("roundmoney", "promiseid = '$id'")
                        ->execute();

                $this->actionSetmonth($model->id, $model->customerid, $model->yearunit, $model->promisedatebegin, $model->promisedateend, $model->rate);
                $model->save();

                $columns = array(
                    "createat" => $model->createat,
                    "promisedatebegin" => $model->promisedatebegin,
                    "promisedateend" => $model->promisedateend,
                    "recivetype" => $model->recivetype,
                    "unitprice" => $model->unitprice,
                    "status" => 2
                );
                Yii::$app->db->createCommand()
                        ->update("promise", $columns, "upper = '$id'")
                        ->execute();

                return $this->redirect(['viewsubpromise', 'id' => $model->id]);
            } else {
                $model->save();
                return $this->redirect(['viewsubpromise', 'id' => $model->id]);
            }
        }

        return $this->render('updatesubpromise', [
                    'model' => $model,
                    'customer' => $this->getCustomer($model->customerid),
                    'error' => $error,
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
    public function actionDelete($id) {

        $sql = "select p.*,g.id,g.groupcustomer
                from promise p inner join customers c on p.customerid = c.id inner join groupcustomer g on c.grouptype = g.id ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        Yii::$app->db->createCommand()
                ->delete("roundgarbage", "promiseid = '$id'")
                ->execute();

        Yii::$app->db->createCommand()
                ->delete("roundmoney", "promiseid = '$id'")
                ->execute();

        $this->findModel($id)->delete();
        Yii::$app->db->createCommand()
                ->delete("promise", "upper = '$id'")
                ->execute();

        $promiseFile = PromiseFile::findOne(['promiseid' => $id]);
        if ($promiseFile) {
            $path = Yii::getAlias('@webroot') . "/../uploads/promise/pdf/" . $promiseFile->filename;
            if (is_file($path)) {
                if (unlink($path)) {
                    $promiseFile->delete();
                }
            }
        }

        return $this->redirect(['index', 'group' => $rs['id'], 'groupname' => $rs['groupcustomer']]);
    }

    public function actionCancelpromise($id, $status) {
        $model = Promise::findOne(['id' => $id]);
        $model->status = $status;
        $model->active = '0';

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $this->setCancelPromise($id);
            return $this->redirect(['index']);
        }

        return $this->renderAjax('_modalcancel', [
                    'model' => $model,
        ]);
    }

    function setCancelPromise($promiseId) {
        if ($promiseId) {
//อัพเดทรอบจัดเก็บให้เป็นสถานะยกเลิกสัญญาด้วย
            $columns = array(
                "status" => 3,
                "datekeep" => date("Y-m-d")
            );
            Yii::$app->db->createCommand()
                    ->update("roundmoney", $columns, "promiseid='$promiseId' and status = '0'")
                    ->execute();

            $updatSubpromise = array(
                "status" => 4,
                "active" => 0
            );
            Yii::$app->db->createCommand()
                    ->update("promise", $updatSubpromise, "upper='$promiseId'")
                    ->execute();
        }
    }

    public function actionGetdoc($id, $customerid) {

        $rs = $this->getPromise($id, $customerid);
        Settings::setTempDir(Yii::getAlias('@webroot') . '/web/temp/'); //Path ของ Folder temp ที่สร้างเอาไว้
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . '/web/doc/templetpromise.docx'); //Path ของ template ที่สร้างเอาไว้
        $Config = new Config();
        $templateProcessor->setValue(
                [
            'promisenumber',
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
            'long',
                ], [
            $rs['promisenumber'],
            $rs['customerid'],
            $Config->thaidate($rs['promisedatebegin']),
            $Config->thaidate($rs['promisedateend']),
            $rs['recivetype'] == 0 ? 'รายครั้ง' : 'รายเดือน',
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

        $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/web/doc/promise.docx');
        Yii::$app->response->sendFile(Yii::getAlias('@webroot') . '/web/doc/promise.docx');

//clear temp
        $files = glob(Yii::getAlias('@webroot') . '/web/temp/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
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
    protected function findModel($id) {
        if (($model = Promise::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getCustomer($customerid) {
//Update 2020-08-19 By Kimniyom
        $sql = "
                SELECT
                    customers.*,
                    changwat.changwat_name as changwat,
                    ampur.ampur_name as ampur,
                    tambon.tambon_name as tambon,
                    user.username,
                    c.groupcustomer as groupcus
                    FROM customers
                INNER JOIN changwat ON customers.changwat = changwat.changwat_id
                INNER JOIN ampur ON customers.ampur = ampur.ampur_id
                INNER JOIN tambon ON customers.tambon = tambon.tambon_id
                LEFT JOIN user ON customers.user_id = user.id
                INNER JOIN groupcustomer c ON customers.grouptype = c.id
                WHERE
                    customers.flag = 1
                    AND customers.approve = 'Y'
                    AND customers.id = '{$customerid}' ";

        return Yii::$app->db->createCommand($sql)->queryOne();

        /*
          if (($model = Customers::findOne(['id' => $customerid])) !== null) {
          return $model;
          }
         */
//throw new NotFoundHttpException('The requested page does not exist.');
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

    public function actionIscustomerexpired() {
        $customerid = Yii::$app->request->post('customerid');
        $isReccord = 0;
        $rs = Promise::find()->where("customerid = '$customerid' and status != '0' and active = '1'")->count();
        $customerDetail = \Yii::$app->db->createCommand("select c.*,g.groupcustomer as groupcus from customers c inner join groupcustomer g on c.grouptype = g.id where c.id = '$customerid'")->queryOne();
        if ($rs > 0) {
            $isReccord = 1;
        }
        $json = array(
            "status" => $isReccord,
            'customer' => $customerDetail
        );
//print_r($customerDetail);
        return json_encode($json);
    }

    public function actionSetstatus() {
        $id = Yii::$app->request->post('id');
        $status = Yii::$app->request->post('status');
        $model = Promise::findOne(['id' => $id]);
        $model->status = $status;

        return $model->save();
    }

    public function actionUploadpromise($id, $customerid) {
        $model = $this->getPromise($id, $customerid);
        $promise = Promise::findOne(['id' => $id]);
        $promisefile = Promisefile::find()->where(['promiseid' => $id, 'status' => 1])->one();

        if ($promisefile == null) {
            $promisefile = new Promisefile();
        }

        if ($promisefile->load(Yii::$app->request->post())) {

            $promisefile->filename = UploadedFile::getInstance($promisefile, 'filename');
            $promisefile->promiseid = $id;
            $promisefile->uploadby = Yii::$app->user->id;
            $promisefile->dateupload = date('Y-m-d H:i');
            $promisefile->status = 1;

            if ($promisefile->filename && $promisefile->validate() && ($promise->promisenumber === str_replace(".pdf", "", $promisefile->filename))) 
            {
                $path = '../uploads/promise/pdf/' . $promise->promisenumber . '.' . $promisefile->filename->extension;
                $promisefile->promiseid = $id;
                $promisefile->filename->name = $promise->promisenumber . '.' . $promisefile->filename->extension;

                if ($promisefile->save() && $promisefile->filename->saveAs($path)) {
                    $promise->status = '2';

                    $promise->save(false);
                    if ($model['flag'] == 1) {
                        return $this->redirect(['viewsubpromise',
                                    'id' => $id,
                                    'customerid' => $customerid,
                        ]);
                    } else {
                        return $this->redirect(['view',
                                    'id' => $id,
                                    'customerid' => $customerid,
                        ]);
                    }
                }
            } else {
                $promisefile->addError("filename", 'ชื่อไฟล์ไม่ใช่ชื่อเดียวกับเลขที่สัญญา');
            }
        }

        return $this->render('uploadpromise', [
                    'model' => $model,
                    'promisefile' => $promisefile,
        ]);
    }

    public function actionGetpromisepdf($promisenumber) {
        $path = Yii::getAlias('@webroot') . '/../uploads/promise/pdf/' . $promisenumber . '.pdf';

        if (is_file($path)) {
            Yii::$app->response->sendFile($path);
        }
    }

    public function actionPdfpreview($id, $promisenumber) {
        $model = $this->getPromise($id);
        $content = $this->renderPartial('promisetype/_promise', ['model' => $model]);
        $footer = $this->renderPartial('promisetype/_promisefootter', ['model' => $model]);
        $header = $this->renderPartial('promisetype/_promiseheader', ['model' => $model]);

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => 'th',
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => [
                'title' => 'Krajee Report Title',
                'defaultheaderline' => 0,
                'defaultfooterline' => 0,
            ],
            //'filename' => $promisenumber,
            'filename' => $promisenumber . ".pdf",
            // call mPDF methods on the fly
            'methods' => [
                //'SetHeader'=>['Krajee Report Header'],
                //'SetFooter' => ['[บริษัท ไอซี{PAGENO}'],
                'SetFooter' => $footer,
                'SetHeader' => $header,
            ],
        ]);

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $pdf->options['fontDir'] = array_merge($fontDirs, [
            Yii::getAlias('@webroot') . '/web/fonts/thsarabun/',
        ]);

        $pdf->options['fontdata'] = $fontData + [
            'sarabun' => [
                'R' => 'THSarabun.ttf',
            ],
        ];

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionSetroundgarbage($promiseID, $promiesYear, $dateStart, $round, $weekinmonth, $dayinweek) {
        $month = ($promiesYear * 12);
        $total_month = $month + 1; //เอามาบวก 1 เพื่อให้ต้วแปร i เริ่มต้นที่ 1 เพราะปกติตัวแปรอาเรย์จะเริ่มต้นที่ 0
        $j = 0;
        for ($i = 1; $i < $total_month; $i++) {
            $j = $i - 1; //เริ่มเก็บเดือนที่เริ่มสัญญา ถ้า เริ่มเก็บเดือนถัดไปให้เรียกใช้ i
            $myDate = date("Y-m-d", strtotime(date($dateStart, strtotime(date("Y-m-d"))) . "+$j month"));

//echo "<pre>";
//echo " งวดที่ " . $i;
//echo " เดือนที่ต้องจัดเก็บ ";
            $datekeep = date('Y-m-d', strtotime($myDate));
            $yearRound = substr($datekeep, 0, 4);
            $monthRound = substr($datekeep, 5, 2);
//echo "</pre>";

            $roundNumber = $round; //เดือนละกี่รอบรอบ
            $weekInmonth = explode(",", $weekinmonth); //อาทิตย์ที่จะให้จัดเก็บ
            $dayInweek = $dayinweek; //วันใน week ที่ให้จัดเก็บเก็บเป็นตัวเลข 0 = วันจันทร์
//$sqlRound = "select MONTH(datekeep) as m,YEAR(datekeep) as y from roundmoney where promiseid = '$promise' ";
//$result = Yii::$app->db->createCommand($sqlRound)->queryAll();
//foreach ($result as $rs):
//if (strlen($rs['m']) < 2) {$month = '0' . $rs['m'];} else { $month = $rs['m'];}
//$year = $rs['y'];
            echo $yearRound . "-" . (int) $monthRound . "<hr/>";
            $Round = $this->rangweek(2019, (int) $monthRound);
//print_r($Round);
            foreach ($weekInmonth as $key):
//$Round['สัปดาห์ในที่']['วันในสัปดาห์']
                $week = ($key - 1);
//echo $week . "<br/>";
//$Round[$week];
                echo $Round[$week][$dayInweek] . "<br/>";
            endforeach;
//endforeach;
//$datekeep = date('Y-m-d', strtotime($myDate));
            /*
              $columns = array(
              "customerid" => $customerID,
              "promiseid" => $promiseID,
              "datekeep" => $datekeep,
              "round" => $i,
              );

              Yii::$app->db->createCommand()
              ->insert("roundmoney", $columns)
              ->execute();
             */
        }

        /*
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
         */
    }

    public function actionRangweek() {
//$year, $month
        $year = '2019';
        $month = '11';
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
        print_r($mweek);
    }

    public function actionGetweek() {
        $mm = 11;
        $yy = 2019;
        $startdate = date($yy . "-" . $mm . "-01");
        $current_date = date('Y-m-t');
        $ld = cal_days_in_month(CAL_GREGORIAN, $mm, $yy);
        $lastday = $yy . '-' . $mm . '-' . $ld;
        $start_date = date('Y-m-d', strtotime($startdate));
        $end_date = date('Y-m-d', strtotime($lastday));
        $end_date1 = date('Y-m-d', strtotime($lastday . " + 6 days"));
        $count_week = 0;
        $week_array = array();

        for ($date = $start_date; $date <= $end_date1; $date = date('Y-m-d', strtotime($date . ' + 7 days'))) {
            $getarray = $this->getWeekDates($date, $start_date, $end_date);
            echo "<br>";
            $week_array[] = $getarray;
            echo "\n";
            $count_week++;
        }

// its give the number of week for the given month and year
        echo $count_week;
//print_r($week_array);

        /*
          for ($i = 0; $i < $count_week; $i++) {
          $start = $week_array[$i]['ssdate'];
          echo "--";

          $week_array[$i]['eedate'];
          echo "<br>";
          }
         */
    }

    function getWeekDates($date, $start_date, $end_date) {
        $week = date('W', strtotime($date));
        $year = date('Y', strtotime($date));
        $from = date("Y-m-d", strtotime("{$year}-W{$week}+1"));
        if ($from < $start_date) {
            $from = $start_date;
        }

        $to = date("Y-m-d", strtotime("{$year}-W{$week}-6"));
        if ($to > $end_date) {
            $to = $end_date;
        }

        $array1 = array(
            "ssdate" => $from,
            "eedate" => $to,
        );

        return $array1;
// echo "Start Date-->".$from."End Date -->".$to;
    }

    public function actionPromisenearexpire() {
        $sql = "SELECT
					promise.id,
					promise.promisenumber,
					promise.promisedateend,
					customers.company,
					customers.manager,
					customers.tel,
					customers.telephone,
                    promise.promisedatebegin,
                    promise.createat
				FROM promise
				INNER JOIN customers ON promise.customerid = customers.id
				WHERE DATEDIFF(promisedateend, NOW()) < 30
				AND promise.`status` = 2";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        $data['promise'] = $rs;
        return $this->render('promisenearexpire', $data);
    }

    public function actionPromisewaitapprove() {
        $sql = "SELECT
					promise.id ,
					promise.promisenumber,
					promise.promisedateend,
					customers.company,
					customers.manager,
					customers.tel,
					customers.telephone,
                    promise.promisedatebegin,
                    promise.createat
				FROM promise
				INNER JOIN customers ON promise.customerid = customers.id
				WHERE promise.status = '1'";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        $data['promise'] = $rs;
        return $this->render('promisewaitapprove', $data);
    }

    /*
      public function actionPromisepay() {
      $sql = "SELECT
      promise.id ,
      promise.promisenumber,
      promise.promisedateend,
      customers.company,
      customers.manager,
      customers.tel,
      customers.telephone
      FROM promise
      INNER JOIN customers ON promise.customerid = customers.id
      WHERE promise.checkmoney = '1'";
      $rs = Yii::$app->db->createCommand($sql)->queryAll();
      $data['promise'] = $rs;
      return $this->render('promisepay', $data);
      }
     */

    //News Modify By Kimniyom 2020-08-21
    public function actionPromisepay() {
        $sql = "SELECT i.*,CONCAT('(Invoice #',i.invoicenumber,') ',c.company,' (จำนวน ',i.total,' .-)') as orders,
					p.promisenumber,c.company,r.round as roundmoney,
                                        c.manager
					FROM invoice i INNER JOIN promise p ON i.promise = p.id
					INNER JOIN customers c ON p.customerid = c.id
					LEFT JOIN roundmoney r ON i.round = r.id
					WHERE i.`status` = '0' AND i.typepayment = '2'";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        $data['promise'] = $rs;
        return $this->render('promisepay', $data);
    }

    public function actionPromisetype() {
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $packege_id = $parents[0];
                $datas = \app\models\Packagepayment::find()->where(['packege' => $packege_id])->all();
                $out = $this->MapData($datas, 'id', 'payment');
                return Json::encode(['output' => $out, 'selected' => '']);
                //return ob_get_clean();
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function MapData($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    public function actionGetpayment() {
        $id = Yii::$app->request->post('id');
        $data = \app\models\Packagepayment::find()->where(['id' => $id])->One();
        return $data['distcount'];
    }

    public function actionCreatesubpromise($customerid, $flag) {
        $conFig = new Config();
        $model = new Promise();
        $model->customerid = $customerid;
//$model->createat = date('Y-m-d');
        $model->flag = $flag;
        $model->promisenumber = $this->getNextId("promise", "promisenumber", 5);
        $error = "";
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->actionSetmonth($model->id, $customerid, $model->yearunit, $model->promisedatebegin, $model->promisedateend, $model->rate);
                return $this->redirect(['viewsubpromise', 'id' => $model->id]);
            }
        }

        return $this->render('createsubpromise', [
                    'model' => $model,
                    'customer' => $this->getCustomer($customerid),
                    'error' => $error,
        ]);
    }

    public function actionViewsubpromise($id) {
        $checkSub = Yii::$app->db->createCommand("select count(*) as total from promise where upper = '$id'")->queryOne();
        $data['customer'] = Customers::find()->where(['flag' => 1, 'approve' => 'Y', 'grouptype' => 4])->all();
        $data['list'] = $this->getListSub($id);

        $data['checksub'] = $checkSub['total'];
        $data['model'] = $this->getPromise($id);
        $data['roundmoney'] = $this->getRoundMoney($id);
        $data['roundgarbage'] = $this->getRoundGarbage($id);
        return $this->render('viewsubpromise', $data);
    }

    function getListSub($id) {
        $sql = "SELECT p.id as promiseId,p.promisenumber,c.*,cw.changwat_name,a.ampur_name,t.tambon_name
                    FROM promise p INNER JOIN customers c ON p.customerid = c.id
                    INNER JOIN changwat cw ON c.changwat = cw.changwat_id
                    INNER JOIN ampur a ON c.ampur = a.ampur_id
                    INNER JOIN tambon t ON c.tambon = t.tambon_id
                    WHERE p.upper = '$id'";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function actionGetcustomer() {
        $cusId = Yii::$app->request->post('cusId');
        $result = Customers::findOne(['id' => $cusId]);
        $str = "";
        $str .= "<input type='hidden' id='custometId' value='" . $result['id'] . "'/>";
        $str .= "<ul class='list-group'>";
        $str .= "<li class='list-group-item'>" . $result['company'] . "</li>";
        $str .= "<li class='list-group-item'>Address. " . $result['address'] . "</li>";
        $str .= "<li class='list-group-item'>Tel. " . $result['tel'] . " " . $result['telephone'] . "</li>";
        $str .= "</ul>";
        echo $str;
    }

    public function actionAddsubpromise() {
        $customerid = Yii::$app->request->post('custometId');
        $sql = "SELECT IFNULL(COUNT(*),0) AS total
                    FROM promise p
                    WHERE p.customerid ='$customerid' AND p.`status` IN('1','2')";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        if ($rs['total'] <= 0) {
            $columns = array(
                "promisenumber" => $this->getNextId("promise", "promisenumber", 5),
                "customerid" => $customerid,
                "upper" => Yii::$app->request->post('upper'),
                "createat" => Yii::$app->request->post('createat'),
                "promisedatebegin" => Yii::$app->request->post('promisedatebegin'),
                "promisedateend" => Yii::$app->request->post('promisedateend'),
                "recivetype" => Yii::$app->request->post('recivetype'),
                "unitprice" => Yii::$app->request->post('unitprice'),
                "status" => 2,
                "etc" => "ลูกข่าย",
                "flag" => 0
            );
            Yii::$app->db->createCommand()
                    ->insert("promise", $columns)
                    ->execute();
        } else {
            echo "1";
        }
    }

    public function actionDeletesubpromise() {
        $id = Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
                ->delete("promise", "id = '$id'")
                ->execute();
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
                /*
                  $columns = array(
                  "slip" => $fileName,
                  "dateconfirm" => date("Y-m-d H:i:s")
                  );
                 */
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
                        ->update("invoice", $columns, "id = '$id'")
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
                        ->update("invoice", $columns, "id = '$id'")
                        ->execute();
                echo "success";
            }
        }
    }

    public function actionApprovepromise() {
        $id = Yii::$app->request->post('id');

        //Stop Service
        $sql = "SELECT m.id,LEFT(m.datekeep,7) AS dm,IFNULL(Q.total,0) AS total
                FROM roundmoney m LEFT JOIN
                (
                        SELECT LEFT(r.datekeep,7) AS mn,COUNT(*) AS total
                        FROM roundgarbage r
                        WHERE r.promiseid = '$id'
                        GROUP BY LEFT(r.datekeep,7)
                ) Q ON LEFT(m.datekeep,7) = Q.mn
                WHERE m.promiseid = '$id' ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($result as $rs):
            if ($rs['total'] <= 0) {
                $ids = $rs['id'];
                Yii::$app->db->createCommand()
                        ->update("roundmoney", array("status" => 4), "id = '$ids'")
                        ->execute();
            }
        endforeach;

        Yii::$app->db->createCommand()
                ->update("promise", array("status" => 0), "id = '$id'")
                ->execute();
    }

}

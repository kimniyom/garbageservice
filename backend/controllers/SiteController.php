<?php

namespace backend\controllers;

use common\models\LoginForm;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UrlManager;

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
                        'actions' => ['login', 'error', 'getlocation'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'setuser'],
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
    //$countCheckInvoice = $promiseModel->countCheckInvoice();
    //$customerbetweenpromise
    public function actionIndex() {
        $customerModel = new Customers();
        $promiseModel = new Promise();
        $data['customernonapprove'] = $customerModel->Countnonactive();
        $data['promisenearexpire'] = $promiseModel->Countnearexpire();
        $data['promisewaitapprove'] = $promiseModel->Countwaitapprove();
        $data['customerbetweenpromise'] = $customerModel->Countbetweenpromise();
        $data['promiseall'] = $promiseModel->Countpromiseall();
        $data['promiseusing'] = $promiseModel->Countpromiseusing();
        $data['promisepay'] = $promiseModel->countCheckInvoice();
        $result = $this->chartGroup();
        $Carry = array();
        $sum = 0;
        foreach ($result as $rs):
            $Carry[] = "['" . $rs['groups'] . "'," . $rs['TOTAL'] . "]";
            $sum = $sum + $rs['TOTAL'];
        endforeach;
        $data['sumcoustomer'] = $sum;
        $data['chartgroup'] = implode(",", $Carry);
        return $this->render('index', $data);
    }

    function chartGroup() {
        $sql = "SELECT IFNULL(g.groupcustomer,'ไม่ได้กำหนดกลุ่ม') AS groups,Q.TOTAL
            FROM groupcustomer g
            RIGHT JOIN
            (
            SELECT c.grouptype,COUNT(*) AS TOTAL
            FROM customers c
            GROUP BY c.grouptype
            ) Q ON g.id = Q.grouptype ";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        $this->redirect(Yii::$app->urlManagerFrontend->createUrl('index.php?r=site'));
        //exit(0);
        /*
          if (!Yii::$app->user->isGuest) {
          return $this->goHome();
          }

          $model = new LoginForm();
          if ($model->load(Yii::$app->request->post()) && $model->login()) {
          return $this->goBack();
          } else {
          $this->redirect($this->urlManagerFrontend(['site/index']));
          exit(0);

          $model->password = '';

          return $this->render('login', [
          'model' => $model,
          ]);

          }
         *
         */
    }

    public function actionGetlocation() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "select l.lat,l.`long`,c.company,c.address,p.changwat_name,a.ampur_name,t.tambon_name
                    from location l inner join customers c on l.customer_id = c.id
                    INNER JOIN changwat p ON c.changwat = p.changwat_id
                    INNER JOIN ampur a ON c.ampur = a.ampur_id
                    INNER JOIN tambon t ON c.tambon = t.tambon_id
                    WHERE l.lat != '' ";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        $json_data = array();
        foreach ($rs as $row):
            $json_data[] = array(
                "name" => $row['company'],
                "lat" => $row['lat'],
                "long" => $row['long'],
                "address" => $row['address'] . " ต. " . $row['tambon_name'] . " อ. " . $row['ampur_name'] . " จ. " . $row['changwat_name']
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

    public function actionSetuser() {
        $result = \common\models\Customers::find()->all();
        foreach ($result as $rs):
            //echo $rs['customercode'] . " => " . Yii::$app->getSecurity()->generatePasswordHash($rs['customercode']) . "<br/>";
            $columns = array(
                "username" => $rs['customercode'],
                "email" => $rs['customercode'] . "@gmail.com",
                "password_hash" => Yii::$app->getSecurity()->generatePasswordHash($rs['customercode']),
                "confirmed_at" => "1596438578",
                "created_at" => "1596438578",
                "updated_at" => "1596438578",
                "status" => "U"
            );

            Yii::$app->db->createCommand()
                    ->insert("user", $columns)
                    ->execute();
        endforeach;
        return "sessecc";
        //Yii::$app->getSecurity()->generatePasswordHash("C00004");
    }

}

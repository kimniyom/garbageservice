<?php

namespace app\modules\roundgarbage\controllers;

use app\modules\roundgarbage\models\Roundgarbage;
use app\modules\roundgarbage\models\RoundgarbageSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;
use app\models\Config;

/**
 * RoundgarbageController implements the CRUD actions for Roundgarbage model.
 */
class RoundgarbageController extends Controller {

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
     * Lists all Roundgarbage models.
     * @return mixed
     */
    public function actionIndex() {
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
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Roundgarbage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Roundgarbage();

        if ($model->load(Yii::$app->request->post())) {
            $number = Roundgarbage::find()
                            ->where(['customerid' => $model->customerid, 'promiseid' => $model->promiseid])
                            ->orderBy(['round' => SORT_DESC])->one();
            $model->round = $number === null ? 1 : $number->round + 1;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionSetround($promise) {
        $roundNumber = 2; //เดือนละ 2 รอบ
        $weekInmonth = array('1'); //อาทิตย์ที่จะให้จัดเก็บ
        $dayInweek = 6; //วันใน week ที่ให้จัดเก็บเก็บเป็นตัวเลข 0 = วันจันทร์

        $sqlRound = "select MONTH(datekeep) as m,YEAR(datekeep) as y from roundmoney where promiseid = '$promise' ";
        $result = Yii::$app->db->createCommand($sqlRound)->queryAll();
        foreach ($result as $rs):
            if (strlen($rs['m']) < 2) {
                $month = '0' . $rs['m'];
            } else {
                $month = $rs['m'];
            }
            $year = $rs['y'];
            echo $year . "-" . $month . "<hr/>";
            $Round = $this->rangweek($year, $month);
            foreach ($weekInmonth as $key):
                //$Round['สัปดาห์ในที่']['วันในสัปดาห์']
                $week = ($key - 1);
                echo $Round[$week][$dayInweek] . "<br/>";
            endforeach;
        endforeach;

        /*
          $mweek = rangweek(2019, 07);
          $cm = count($mweek);

          echo $mweek[2][1];
         */
    }

    function rangweek($year, $month) {
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
        return $mweek;
    }

    /**
     * Updates an existing Roundgarbage model.
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
     * Deletes an existing Roundgarbage model.
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
     * Finds the Roundgarbage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roundgarbage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Roundgarbage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCalendar() {
        return $this->render("calendar");
    }

    public function actionJsoncalendar() {
        //$times = Datekeep::findAll(['promiseid' => $promiseid]);
        $sql = "SELECT d.datekeep,count(*) AS total
                    FROM datekeep d
                    GROUP BY d.datekeep ";
        $times = \Yii::$app->db->createCommand($sql)->queryAll();
        $events = array();
        $i = 1;
        foreach ($times AS $time) {
            if ($time['datekeep'] == date("Y-m-d")) {
                $color = "success";
            } else {
                $color = "red";
            }
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $i++;
            $Event->title = "เข้าจัดเก็บวันนี้ " . $time['total'] . " แห่ง";
            $Event->start = $time['datekeep'];
            $Event->end = $time['datekeep'];
            $Event->color = $color;
            $events[] = $Event;
        }

        header('Content-type: application/json');
        return Json::encode($events);

        //Yii::$app->end();
    }

    public function actionGetevent() {
        $datekeep = Yii::$app->request->post('datekeep');
        $Config = new Config();
        $day = Yii::$app->db->createCommand("SELECT DAYNAME('" . $datekeep . "') AS dayname")->queryOne()['dayname'];
        $data['dayname'] = "<center>วัน " . $Config->dayInweekKeyFull($day) . " ที่ " . $Config->thaidate($datekeep) . "<c/enter>";
        $data['filename'] = "รายชื่อลูกค้าที่เข้าจัดเก็บ(วัน_" . $Config->dayInweekKeyFull($day) . "_ที่_" . $Config->thaidate($datekeep) . ")";
        $data['customer'] = $this->EventAll($datekeep);
        return $this->renderPartial("viewevent", $data);
    }

    function EventAll($datekeep) {
        $sql = "SELECT c.company,c.address,t.tambon_name,a.ampur_name,cw.changwat_name,c.tel,c.telephone
                    FROM datekeep d INNER JOIN promise p ON d.promiseid = p.id
                    INNER JOIN customers c ON p.customerid = c.id
                    INNER JOIN changwat cw ON c.changwat = cw.changwat_id
                    INNER JOIN ampur a ON c.ampur = a.ampur_id
                    INNER JOIN tambon t ON c.tambon = t.tambon_id
                    WHERE d.datekeep = '$datekeep'";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

}

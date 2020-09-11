<?php

namespace app\modules\report\controllers;

use yii\data\SqlDataProvider;

class ReportController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionMonthservicefee() {
        $sql = "
                SELECT
                customers.company,
                promise.id,
                promise.promisenumber,
                promise.promisedatebegin,
                promise.promisedateend,
                (
                    SELECT
                        count(id)
                    FROM
                        `roundmoney`
                    WHERE
                        roundmoney.`promiseid` = promise.id
                    AND `status` IS NULL
                    OR `status` = 0
                    GROUP BY
                        promiseid
                ) AS nopay,
                (
                    SELECT
                        count(id)
                    FROM
                        `roundmoney`
                    WHERE
                        roundmoney.`promiseid` = promise.id
                    AND roundmoney.`status` LIKE '%1%'
                    GROUP BY
                        promiseid
                ) AS payed
                FROM
                    promise
                INNER JOIN customers ON promise.customerid = customers.id
                WHERE
                    promise.`status` LIKE '%2%'
                GROUP BY
                    promise.id
        ";
        $dataProvider = new SqlDataProvider(
                [
            'sql' => $sql,
                ]
        );
        return $this->render('monthservicefee', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRoundmoney($promiseid) {
        $sql = "
            SELECT
                roundmoney.datekeep,
                roundmoney.round,
                roundmoney.amount,
                roundmoney.keepby,
                roundmoney.`status`,
                roundmoney.receiptnumber,
                promise.promisenumber,
                customers.company
            FROM
                roundmoney
            INNER JOIN promise ON roundmoney.promiseid = promise.id
            INNER JOIN customers ON roundmoney.customerid = customers.id
            WHERE
                roundmoney.promiseid = {$promiseid}
        ";
        $dataProvider = new SqlDataProvider(
                [
            'sql' => $sql,
                ]
        );
        return $this->render('roundmoney', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAccruedservicefee() {
        return $this->render('accruedservicefee');
    }

    public function actionCustomerservicefee() {
        return $this->render('customerservicefee');
    }

    public function actionReportworkingarbage($year = "") {
        if ($year != "") {
            $years = $year;
        } else {
            $years = date("Y");
        }
        $data['reportmonth'] = $this->getSumWorkingGarbage($years);
        $chart = array();
        $chartKilo = array();
        foreach ($data['reportmonth'] as $rs):
            $chart[] = $rs['total'];
            $chartKilo[] = ($rs['kilo'] + $rs['kiloover']);
        endforeach;
        $data['chartgarbage'] = implode(",", $chart);
        $data['chartgarbagekilo'] = implode(",", $chartKilo);
        $data['years'] = $years;
        return $this->render("reportworkingarbage", $data);
    }

    function getSumWorkingGarbage($year = "") {
        $sql = "SELECT m.month_th,IFNULL(Q.total,0) AS total,
                        IFNULL(Q.kilo,0) AS kilo,
                        IFNULL(Q.kiloover,0) AS kiloover
                    FROM `month` m
                    LEFT JOIN (
                        SELECT SUBSTR(datekeep,6,2) AS months,
                            COUNT(r.amount) AS total,
                            SUM(r.amount) AS kilo,
                            SUM(r.garbageover) AS kiloover
                        FROM roundgarbage r
                        WHERE LEFT(datekeep,4) = '$year'
                        GROUP BY SUBSTR(datekeep,6,2)
                    ) Q ON m.id = Q.months ORDER BY m.id ASC";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function actionInvoicehistory($year = "") {
        if ($year != "") {
            $years = $year;
        } else {
            $years = date("Y");
        }
        $data['history'] = $this->getInvoice($years);
        $data['years'] = $years;
        return $this->render("invoicehistory", $data);
    }

    function getInvoice($year = "") {
        $sql = "SELECT i.*,c.company
                    FROM invoice i INNER JOIN promise p ON i.promise = p.id
                    INNER JOIN customers c ON p.customerid = c.id
                    WHERE i.`status` = '1' AND LEFT(i.d_update,4) = '$year' ORDER BY i.dateservice DESC";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }
    
    public function actionRoundhistory($year = ""){
        if ($year != "") {
            $years = $year;
        } else {
            $years = date("Y");
        }
        $data['history'] = $this->getRoundHistory($years);
        $data['years'] = $years;
        return $this->render("roundhistory", $data);
    }
    
    function getRoundHistory($year = "") {
        $sql = "SELECT i.*,c.company,p.promisenumber
                    FROM roundgarbage i INNER JOIN promise p ON i.promiseid = p.id
                    INNER JOIN customers c ON p.customerid = c.id
                    WHERE LEFT(i.datekeep,4) = '$year' ORDER BY i.datekeep DESC";
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }
    

}

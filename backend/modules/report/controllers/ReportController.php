<?php

namespace app\modules\report\controllers;

use yii\data\SqlDataProvider;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMonthservicefee()
    {
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
                'sql'=> $sql,
            ]
        );
        return $this->render('monthservicefee',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionRoundmoney($promiseid)
    {
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
                'sql'=> $sql,
            ]
        );
        return $this->render('roundmoney',[
            'dataProvider'=>$dataProvider,
        ]);
    }

    public function actionAccruedservicefee()
    {
        return $this->render('accruedservicefee');
    }

    public function actionCustomerservicefee()
    {
        return $this->render('customerservicefee');
    }



}

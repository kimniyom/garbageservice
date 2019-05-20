<?php

namespace app\modules\report\controllers;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMonthservicefee()
    {
        return $this->render('monthservicefee');
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

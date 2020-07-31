<?php

namespace app\modules\service\controllers;

use app\modules\customer\models\Customers;
use app\models\Confirmform;
use app\models\RoundgarbagePertime;
use Yii;
use app\models\Config;

class ServicepertimeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $customers = Customers::find()
        ->select('customers.id,customers.company')
        ->innerjoin('confirmform', 'customers.id = confirmform.customerid')
        ->where(['confirmform.status'=>1])
        ->all();
        return $this->render('index',['customers'=>$customers]);
    }

    public function actionGetround() {
        $customerId = Yii::$app->request->post('customer_id');
        $confirm = Confirmform::find()->where(['customerid' => $customerId, 'status'=>1])->One();
        $customer = Customers::find()->where(['id' => $customerId])->One();
       
        $str = "";
        $str .= "<b>ลูกค้า " . $customer['company'] . "</b><br/>";
        $str .= "<b>เลขที่แบบยืนยัน " . $confirm['confirmformnumber'] . "</b><br/>";
        $link = Yii::$app->urlManager->createUrl(['service/servicepertime/formsaveround', 'confirmform' => $confirm['id']]);
        $str .= "  <a href='" . $link . "' class='btn btn-success'><i class='fa fa-save'></i> บันทึกรายการ</a> " . "<br/>";
        
        if ($confirm) {
            return $str;
        } else {
            return "ไม่มีการทำสัญญา";
        }
    }

    public function actionFormsaveround($confirmform) {
        $confirm = Confirmform::find()->where(['id' => $confirmform, 'status' => '1'])->One();
        $customer = Customers::find()->where(['id' => $confirm['customerid']])->One();
        $data['confirm'] = $confirm;
        $data['customer'] = $customer;
        return $this->render('formsaveround', $data);
    }

    public function actionSave() {
        //$id = Yii::$app->request->post('id');
        $garbageover = Yii::$app->request->post('garbageover');
        $confirmid = Yii::$app->request->post('confirmid');
        $amount = Yii::$app->request->post('amount');
        $datekeep = Yii::$app->request->post('datekeep');
        $count = Yii::$app->request->post('count');
        $customerid = Yii::$app->request->post('customerid');

        $countInkey = RoundgarbagePertime::find()->where(['confirmid'=>$confirmid])->count();
        
        if($countInkey < $count)
        {
            $columns = array(
                "garbageover" => $garbageover,
                "keepby" => Yii::$app->user->id,
                "amount" => $amount,
                "status" => 1,
                "datekeep" => $datekeep,
                "confirmid" => $confirmid,
                "d_update" => date("Y-m-d H:i:s"),
                "customerid" => $customerid
            );
    
            Yii::$app->db->createCommand()
                    ->insert("roundgarbage_pertime", $columns)
                    ->execute();
            return 0;
        }
        else{
            return 1;
        }
    }

    public function actionGetroundlist() {
        $Config = new Config();
        $confirmid = Yii::$app->request->post('confirmid');
        //$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
        $sql = "SELECT r.*,p.username,f.`name`
                FROM roundgarbage_pertime r 
                INNER JOIN `user` p ON r.keepby = p.id
                LEFT JOIN `profile` f ON p.id = f.user_id
                WHERE r.confirmid = '$confirmid'";
    
        $RoundGarbage = Yii::$app->db->createCommand($sql)->queryAll();
        $i = 0;
        $str = "";
        $str .= "<br/><p class=\"text-danger\">*กรณีที่ลงข้อมูลผิดให้ลบแล้วลงใหม่(ลบได้เฉพาะคนที่บันทึกเท่านั้น)</p>";
        $str .= "<b>ประวัติการจัดเก็บ</b><br/>
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่</th>
						<th style='text-align:right;'>ปริมาณ</th>
						<th style='text-align:right;'>ขยะเกิน</th>
						<th style='text-align:center;'>ผู้บันทึก</th>
						<th style='text-align:center;'></th>";
        $str .= "</tr></thead>";
        $str .= "<tbody>";
        foreach ($RoundGarbage as $rs) {
            $i++;
            $str .= "<tr>";
            $str .= "<td>" . $i . "</td>";
            $str .= "<td>" . $Config->thaidate($rs['datekeep']) . "</td>";
            $str .= "<td style='text-align:right;'>" . $rs['amount'] . " กิโลกรัม</td>";
            $str .= "<td style='text-align:right;'>" . $rs['garbageover'] . " กิโลกรัม</td>";
            $str .= "<td style='text-align:center;'>" . $rs['name'] . "</td>";
            if (Yii::$app->user->id == $rs['keepby']) {
                $str .= "<td style='text-align:center;'><i class='fa fa-trash' onclick='deleteRound(" . $rs['id'] . ")'></i></td>";
            } else {
                $str .= "<td style='text-align:center;'></td>";
            }
            $str .= "</tr>";
        }

        $str .= "</tbody></table>";

        return $str;
    }

    public function getkeeplist($customerid) {
        $Config = new Config();
        //$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
        $sql = "SELECT r.*,p.username,f.`name`
                FROM roundgarbage_pertime r 
                INNER JOIN `user` p ON r.keepby = p.id
                LEFT JOIN `profile` f ON p.id = f.user_id
                WHERE r.customerid = '$customerid' AND r.flag = 0";
    
        $RoundGarbage = Yii::$app->db->createCommand($sql)->queryAll();
        $i = 0;
        $str = "";
        $str .= "<br/><p class=\"text-danger\">*กรณีที่ลงข้อมูลผิดให้ลบแล้วลงใหม่(ลบได้เฉพาะคนที่บันทึกเท่านั้น)</p>";
        $str .= "<b>ประวัติการจัดเก็บ</b><br/>
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่</th>
						<th style='text-align:right;'>ปริมาณ</th>
						<th style='text-align:right;'>ขยะเกิน</th>
						
						";
        $str .= "</tr></thead>";
        $str .= "<tbody>";
        foreach ($RoundGarbage as $rs) {
            $i++;
            $str .= "<tr>";
            $str .= "<td>" . $i . "</td>";
            $str .= "<td>" . $Config->thaidate($rs['datekeep']) . "</td>";
            $str .= "<td style='text-align:right;'>" . $rs['amount'] . " กิโลกรัม</td>";
            $str .= "<td style='text-align:right;'>" . $rs['garbageover'] . " กิโลกรัม</td>";
           
           
            $str .= "</tr>";
        }

        $str .= "</tbody></table>";

        return $str;
    }

    public function actionDeleteround() {
        $id = Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
                ->delete("roundgarbage_pertime", "id = '$id'")
                ->execute();
    }

    public function actionCreatebill($customerId = "")
    {
       
        $sql = "select 
                    c.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',p.changwat_name) as address
                    ,confirm.id as confirmid
                from customers c
		        inner join changwat p on c.changwat = p.changwat_id
		        inner join ampur a on c.ampur = a.ampur_id
		        inner join tambon t on c.tambon = t.tambon_id
                inner join confirmform confirm on c.id = confirm.customerid
                
                where confirm.`status` = '1' ";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $result;
        $data['roundpertime'] = $this->getkeeplist($customerId);
        $data['customerId'] = $customerId;
        return $this->render('createbill', $data);
    }

    public function actionCreatebillpopup() {
        $promiseId = Yii::$app->request->post('promiseid');
        $dateround = Yii::$app->request->post('dateround');
        $round = Yii::$app->request->post('round');
        $id = Yii::$app->request->post('id');
        $data['vat'] = Yii::$app->request->post('vat');
        $data['vattype'] = Yii::$app->request->post('vattype');
        $data['type'] = Yii::$app->request->post('type');
        $typepromise = Yii::$app->request->post('typepromise');

        $Promise = Promise::find()->where(['id' => $promiseId])->One();
        //$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
        $Customer = $this->actionGetcustomer($Promise['customerid']);
        $YearMonth = substr($dateround, 0, 7);
        $sql = "select * from roundgarbage where promiseid = '$promiseId' and LEFT(datekeep,7) = '$YearMonth' and status='1'";
        $data['billdetail'] = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $Customer;
        $data['promise'] = $Promise;
        $data['rounddate'] = $YearMonth;
        $data['round'] = $round;
        $data['id'] = $id;

        $sqlCheckInvoice = "select * from roundmoney where id = '$id' and receiptnumber != ''";
        $Invoice = Yii::$app->db->createCommand($sqlCheckInvoice)->queryOne();
        if (!$Invoice['receiptnumber']) {
            $data['invnumber'] = $this->getNextId();
            $data['status'] = 0;
            $sqlInvoice = "select * from invoice where invoicenumber = '" . $Invoice['receiptnumber'] . "'";
            $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        } else {
            $data['invnumber'] = $Invoice['receiptnumber'];
            $data['status'] = 1;
            $sqlInvoice = "select * from invoice where invoicenumber = '" . $Invoice['receiptnumber'] . "'";
            $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        }
        if ($typepromise == 1) {
            $page = "createbillpopup";
        } else if ($typepromise == 2) {
            $page = "createbillpopuptype2";
        } else {
            $page = "createbillpopuptype3";
        }

        return $this->renderPartial($page, $data);
    }

}

<?php

namespace app\modules\service\controllers;

use app\modules\customer\models\Customers;
use app\models\Confirmform;
use app\models\RoundgarbagePertime;
use app\models\InvoicePertime;
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

    public function getkeeplist($customerid) {
        $Config = new Config();
        $confirm = Confirmform::find()->where(['customerid'=>$customerid,'status'=>1])->one();
        $customer = Customers::find()->where(['id'=>$customerid])->one();
        $sql = "SELECT r.*,p.username,f.`name`
                FROM roundgarbage_pertime r 
                INNER JOIN `user` p ON r.keepby = p.id
                LEFT JOIN `profile` f ON p.id = f.user_id
                WHERE r.customerid = '$customerid' AND r.flag = 0";
    
        $RoundGarbage = Yii::$app->db->createCommand($sql)->queryAll();
        $i = 0;
        $str = "";
        $str .= "<b>ลูกค้า ".$customer->company."</b><br/>";
        $str .= "<b>จำนวนครั้งที่ตกลงเข้าจัดเก็บ ".$confirm->amount."</b><br/>";
        $str .= "<b>แบบยืนยันเลขที่  ".$confirm->confirmformnumber."</b><br/>";
        $str .= "<b>จำนวนเงินทีออกบิลไปแล้ว ".$customer->company."</b><br/>";
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
        if(count($RoundGarbage)>0)
        {
            $confirmid = $confirm->id;
            $str .= '<div>จำนวนเงินที่จะออกบิล<input type="text" class="form-control" id="money"></div>';
            $str .= "<br>";
            $str .= "<div class=\"text-right\"><button class=\"button buntton-info\" onclick=\"popupFormbill('{$confirmid}')\">ออกบิล</button></div>";
        }

        return $str;
    }

    public function actionCreatebillpopup() {
        $confirmid = Yii::$app->request->post('confirmid');
        
        $confirm = Confirmform::find()->where(['id' => $confirmid])->One();
        $Customer = $this->actionGetcustomer($confirm['customerid']);
        
        $sql = "select * from roundgarbage_pertime where confirmid = '$confirmid' and status='1'";
        $data['billdetail'] = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $Customer;
        $data['confirm'] = $confirm;
        $data['money'] = Yii::$app->request->post('money');
        $data['type'] = $Customer['typeregister'];
        
        $sqlCheckInvoice = "select * from roundmoney_pertime where confirmid = '$confirmid' and receiptnumber != '' ORDER BY datekeep DESC LIMIT 1";
        $Invoice = Yii::$app->db->createCommand($sqlCheckInvoice)->queryOne();
        if (!$Invoice['receiptnumber']) {
            $data['invnumber'] = $this->getNextId();
            $data['status'] = 0;
            $sqlInvoice = "select * from invoice_pertime where invoicenumber = '" . $Invoice['receiptnumber'] . "'";
            $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        } else {
            $data['invnumber'] = $this->getNextId();
            $data['status'] = 1;
            $sqlInvoice = "select * from invoice_pertime where invoicenumber = '" . $Invoice['receiptnumber'] . "'";
            $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        }
       

        return $this->renderPartial("_createbillpopup", $data);
    }

    public function actionGetcustomer($customerid) {
        $sql = "SELECT c.company,
            ch.changwat_name,
            a.ampur_name,
            t.tambon_name,
            c.zipcode,c.tel,
            c.taxnumber,
            c.typeregister,
            c.id,
            c.telephone,c.typeregister,c.grouptype,g.groupcustomer,c.flag
				FROM customers c INNER JOIN changwat ch ON c.changwat = ch.changwat_id
				INNER JOIN ampur a ON c.ampur = a.ampur_id
				INNER JOIN tambon t ON c.tambon = t.tambon_id
                INNER JOIN groupcustomer g ON c.grouptype = g.id
				WHERE c.id = '$customerid'";
        return Yii::$app->db->createCommand($sql)->queryOne();
    }

    public function getNextId() {
        //ตัวอย่างหากต้องการ SN59-00001
        $lastRecord = InvoicePertime::find()->where(['like', 'invoicenumber', 'INVP'])->orderBy(['id' => SORT_DESC])->one(); //หาตัวล่าสุดก่อน
        if ($lastRecord) {
            $digit = explode('INVP', $lastRecord->invoicenumber);

            $lastDigit = ((int) $digit[1]); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
            $lastDigit++; //เพิ่ม 1
            $lastDigit = str_pad($lastDigit, 5, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
        } else {
            $lastDigit = '00001';
        }

        return 'INVP' . $lastDigit;
    }

    //บันทึกรายการใบแจ้งหนี้
    public function actionAddinvoice() {
        $invoiceNumber = Yii::$app->request->post('invoiceNumber');
        $confirmid = Yii::$app->request->post('confirmid');
        $total = Yii::$app->request->post('total');
        $dateinvoice = Yii::$app->request->post('dateinvoice');
        $datebill = Yii::$app->request->post('datebill');
        $customerid = Yii::$app->request->post('customerid');
       
      
        $columns = array(
            "invoicenumber" => $invoiceNumber,
            "confirmid" => $confirmid,
            "total" => $total,
            "status" => "0",
            "dateinvoice" => $dateinvoice,
            "datebill" => $datebill,
            "d_update" => date("Y-m-d H:i:s"),
        );

        Yii::$app->db->createCommand()
                ->insert("invoice_pertime", $columns)
                ->execute();

        $columnsInsert = array(
            "receiptnumber" => $invoiceNumber,
            "confirmid" => $confirmid,
            "amount" => $total,
            "status" => "0",
            "customerid" => $customerid,
            "datekeep" => date("Y-m-d"),
            "amount" => $total,
        );
        Yii::$app->db->createCommand()
                ->insert("roundmoney_pertime", $columnsInsert)
                ->execute();
    }
}

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

    public function actionDeleteround() {
        $id = Yii::$app->request->post('id');
        Yii::$app->db->createCommand()
                ->delete("roundgarbage_pertime", "id = '$id'")
                ->execute();
    }

    public function actionCreatebill()
    {
        return $this->render('createbill');
    }

}

<?php

namespace app\modules\service\controllers;

use app\models\Invoice;
use app\models\Config;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;
use app\modules\roundmoney\models\Roundmoney;
use app\modules\roundgarbage\models\Roundgarbage;
use app\modules\car\models\Car;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `service` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        //$data['promise'] = Promise::find()->where(['status' => '2'])->all();
        //$data['customer'] = Customers::find()->all();
        $sql = "SELECT c.id,
            c.company,
            ch.changwat_name,
            a.ampur_name,
            t.tambon_name,
            c.zipcode,c.tel,
            c.taxnumber,
            c.telephone,c.typeregister,c.grouptype,g.groupcustomer,c.flag
				FROM promise p INNER JOIN  customers c ON p.customerid = c.id
INNER JOIN changwat ch ON c.changwat = ch.changwat_id
				INNER JOIN ampur a ON c.ampur = a.ampur_id
				INNER JOIN tambon t ON c.tambon = t.tambon_id
                                INNER JOIN groupcustomer g ON c.grouptype = g.id
					WHERE p.`status` = '2' AND p.flag != '1'";
        $data['customer'] = \Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('index', $data);
    }

    public function actionGetround() {
        $customerId = Yii::$app->request->post('customer_id');
        $Promise = Promise::find()->where(['customerid' => $customerId, 'status' => '2'])->One();
        $Customer = Customers::find()->where(['id' => $customerId])->One();
        //$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
        $str = "<div style='padding:5px;'>";
        $str .= "<b>ลูกค้า " . $Customer['company'] . "</b><br/>";
        $str .= "<b>เลขที่สัญญา " . $Promise['promisenumber'] . "</b><br/>";
        $link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'promise' => $Promise['id']]);
        $str .= "  <br/><a href='" . $link . "' class='btn btn-success btn-lg'><i class='fa fa-save'></i> บันทึกรายการจัดเก็บขยะ</a> " . "</div><br/>";
        /*
          foreach ($RoundGarbage as $rs):
          if ($rs['status'] == 0) {
          $link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $rs['promiseid'], 'round' => $rs['round']]);
          $str .= "รอบที่ => " . $rs['round'] . " วันที่จัดเก็บ => " . $rs['datekeep'] . "  <a href='" . $link . "'><i class='fa fa-save'></i> บันทึกรายการ</a> " . "<br/>";
          } else {
          $str .= "รอบที่ => " . $rs['round'] . " วันที่จัดเก็บ => " . $rs['datekeep'] . " <i class='fa fa-check'></i>" . "<br/>";
          }
          endforeach;
         */
        if ($Promise) {
            return $str;
        } else {
            return "ไม่มีการทำสัญญา";
        }
    }

    function detailCustomer() {

    }

    public function actionFormsaveround($promise) {
        $Promise = Promise::find()->where(['id' => $promise, 'status' => '2'])->One();
        $Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
        $data['promise'] = $Promise;
        $data['customer'] = $Customer;
        $data['promiseid'] = $promise;
        $data['carlist'] = Car::find()->all();
        return $this->render('formsaveround', $data);
    }

    /*
      public function actionFormsaveround($id, $promise, $round) {
      $Promise = Promise::find()->where(['id' => $promise, 'status' => '2'])->One();
      $Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
      $data['promise'] = $Promise;
      $data['customer'] = $Customer;
      $data['promiseid'] = $promise;
      $data['round'] = $round;
      $data['id'] = $id;
      return $this->render('formsaveround', $data);
      }
     */

    public function actionSave() {
        //$id = Yii::$app->request->post('id');
        $garbageover = Yii::$app->request->post('garbageover');
        $promiseid = Yii::$app->request->post('promiseid');
        $amount = Yii::$app->request->post('amount');
        $datekeep = Yii::$app->request->post('datekeep');
        $timekeepin = Yii::$app->request->post('timekeepin');
        $timekeepout = Yii::$app->request->post('timekeepout');
        $car = Yii::$app->request->post('car');
        $comment = Yii::$app->request->post('comment');

        //$Promise = Promise::find()->where(['id' => $promise,'status' => '2'])->One();

        $columns = array(
            "garbageover" => $garbageover,
            "keepby" => Yii::$app->user->id,
            "amount" => $amount,
            "status" => 1,
            "datekeep" => $datekeep,
            "promiseid" => $promiseid,
            "timekeepin" => $timekeepin,
            "timekeepout" => $timekeepout,
            "car" => $car,
            "comment" => $comment,
            "d_update" => date("Y-m-d H:i:s"),
        );

        Yii::$app->db->createCommand()
                ->insert("roundgarbage", $columns)
                ->execute();
        /*
          Yii::$app->db->createCommand()
          ->update("roundgarbage", $columns, "id = '$id'")
          ->execute();
         */
    }

    public function actionMainbill() {
        return $this->render('mainbill');
    }

    public function actionCreatebill($type, $customerId = "") {
        //ออกบิลสำหรับสัญญาที่แบ่งจ่ายรายเดือน
        //$data['promise'] = Promise::find()->where(['status' => '2', 'payment' => '0'])->all();
        $sql = "select c.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',p.changwat_name) as address
                from customers c
		inner join changwat p on c.changwat = p.changwat_id
		inner join ampur a on c.ampur = a.ampur_id
		inner join tambon t on c.tambon = t.tambon_id
                inner join promise pro on c.id = pro.customerid
                INNER JOIN packagepayment pm ON pro.payment = pm.id
                where pro.`status` = '2' and pm.typepayment = 'M'";
        $result = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $result;
        $data['type'] = $type;
        $data['round'] = $this->actionGetroundpromise($customerId);
        $data['customerId'] = $customerId;
        return $this->render('createbill', $data);
    }

    public function actionGetroundpromise($customerId) {
        $Config = new Config();
        //$customerId = Yii::$app->request->post('customer_id');
        $Promise = Promise::find()->where(['customerid' => $customerId, 'status' => '2'])->One();
        $Customer = Customers::find()->where(['id' => $customerId])->One();
        $RoundMoney = Roundmoney::find()->where(['promiseid' => $Promise['id']])->all();

        $sql = "select * from vattype where id = '" . $Customer['typeregister'] . "'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();

        $promiseId = $Promise['id'];
        $typePromise = $Promise['recivetype']; //ประเภทการจ้าง
        $data['vat'] = $Promise['vat']; //เช็คเอา vat  ไม่เอา vat
        $data['typevat'] = $Promise['vattype']; //เช็คเอา vat- +
        $vatBill = $Promise['vat'];
        $typevatBill = $Promise['vattype'];
        if ($Promise['vat'] == 1) {
            $vateBill = "เอา vat";
            if ($typevatBill == 1) {
                $vatText = "รวม Vat";
            } else {
                $vatText = "แยก Vat";
            }
        } else {
            $vateBill = "ไม่เอา vat";
            $vatText = "";
        }
        $str = "<div style='padding:5px;'>";
        $str .= "<b>ลูกค้า " . $Customer['company'] . "</b><br/> ";
        $str .= "<b>สัญญา " . $rs['vattype'] . "</b>";
        $str .= " <b>" . $vateBill . "</b> " . " (" . $vatText . ")";
        if ($Promise['flag'] != 1) {
            $linkPromise = Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $promiseId]);
        } else {
            $linkPromise = Yii::$app->urlManager->createUrl(['promise/promise/viewsubpromise', 'id' => $promiseId]);
        }
        $str .= "<br/><em><a href='" . $linkPromise . "' target='_back'>ข้อมูลสัญญา</a></em></div><hr/>";
        $typeCustomrt = $Customer['typeregister'];
        $str .= "<div class='list-group' style='border:none;'>";
        foreach ($RoundMoney as $rs):
            if (!$rs['receiptnumber']) {
                $link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $rs['promiseid'], 'round' => $rs['round'], 'vat' => $Promise['vat'], 'typevat' => $Promise['vattype']]);
                $dateMonth = '"' . $rs['datekeep'] . '"';
                $round = $rs['round'];
                $id = $rs['id'];
                $str .= "<div class='list-group-item' style='border:none;'>";
                $str .= " เดือน => " . $Config->thaidatemonth($rs['datekeep']) . "  <span class='badge badge-primary badge-pill' id='text-list'><a href='javascript:popupFormbill($promiseId,$dateMonth,$round,$id,$typeCustomrt,$vatBill,$typevatBill,$typePromise)'><i class='fa fa-save'></i> สร้างใบวางบิล</a></span>" . "<br/>";
                $str .= "</div>";
            } else {
                $link = Yii::$app->urlManager->createUrl(['service/default/formsaveround', 'id' => $rs['id'], 'promise' => $promiseId, 'round' => $rs['round'], 'vat' => $Promise['vat'], 'typevat' => $Promise['vattype']]);
                $dateMonth = '"' . $rs['datekeep'] . '"';
                $round = $rs['round'];
                $id = $rs['id'];
                $str .= "<div class='list-group-item' style='border:none;'>";
                $str .= " เดือน => " . $Config->thaidatemonth($rs['datekeep']) . " <span class='badge badge-primary badge-pill' id='text-list'><a href='javascript:popupFormbill($promiseId,$dateMonth,$round,$id,$typeCustomrt,$vatBill,$typevatBill,$typePromise)'><i class='fa fa-check'></i> ใบวางบิล / ใบเสร็จ</a></span>" . "<br/>";
                $str .= "</div>";
            }
        endforeach;
        $str .= "</div>";
        if ($RoundMoney) {
            return $str;
        } else {
            return "ไม่มีรอบจัดเก็บ";
        }
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
        $billdetail = Yii::$app->db->createCommand($sql)->queryAll();
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
            //เก็บเงินรายเดือน
            $page = "createbillpopup";
            $data['billdetail'] = $billdetail;
            $data['page'] = $page;
        } else if ($typepromise == 2) {
            //คิดเป็นกิโล กิโลละ
            if ($Promise['flag'] == 1) {
                //BillsubPromise => โรงบาลที่ทพสัญญามีเครือข่าย
                $data['billdetail'] = $this->getDetailBillSubpromise($promiseId, $YearMonth);
                //echo $data['billdetail'];
                $page = "createbillpopuptype2subpromise";
                $data['page'] = $page;
            } else {
                //คิดเป็นกิโล กิโลละ
                $page = "createbillpopuptype2";
                $data['billdetail'] = $billdetail;
                $data['page'] = $page;
            }
        } else {
            $page = "createbillpopuptype3";
            $data['billdetail'] = $billdetail;
            $data['page'] = $page;
        }

        return $this->renderPartial($page, $data);
    }

    public function actionGetcustomer($customerid) {
        $sql = "SELECT c.company,
            ch.changwat_name,
            a.ampur_name,
            t.tambon_name,
            c.zipcode,c.tel,
            c.taxnumber,
            c.telephone,c.typeregister,c.grouptype,g.groupcustomer,c.flag
				FROM customers c INNER JOIN changwat ch ON c.changwat = ch.changwat_id
				INNER JOIN ampur a ON c.ampur = a.ampur_id
				INNER JOIN tambon t ON c.tambon = t.tambon_id
                                INNER JOIN groupcustomer g ON c.grouptype = g.id
				WHERE c.id = '$customerid'";
        return Yii::$app->db->createCommand($sql)->queryOne();
    }

    function getDetailBillSubpromise($promiseId, $YearMonth) {
        $sql = "SELECT pro.customerid,c.company,pro.id AS promiseid,IFNULL(Q.total,0) AS total
                FROM promise pro
                LEFT JOIN(
                SELECT p.id AS proID,SUM(r.amount * p.unitprice) AS total
                        FROM promise p INNER JOIN roundgarbage r ON p.id = r.promiseid
                        WHERE p.upper = '$promiseId' AND LEFT(r.datekeep,7) = '$YearMonth'
                        GROUP BY p.id
                ) Q ON pro.id = Q.Proid
                INNER JOIN customers c ON pro.customerid = c.id
                WHERE pro.upper = '$promiseId' ";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    //บันทึกรายการใบแจ้งหนี้
    public function actionAddinvoice() {
        $invoiceNumber = Yii::$app->request->post('invoiceNumber');
        $promiseId = Yii::$app->request->post('promiseId');
        $total = Yii::$app->request->post('total');
        $roundId = Yii::$app->request->post('roundId');
        $type = Yii::$app->request->post('type');
        $monthyear = Yii::$app->request->post('monthyear');
        $dateinvoice = Yii::$app->request->post('dateinvoice');
        $datebill = Yii::$app->request->post('datebill');
        $discount = Yii::$app->request->post('discount');
        $deposit = Yii::$app->request->post('deposit');
        $credit = Yii::$app->request->post('credit');
        $year = substr($monthyear, 0, 4);
        $month = substr($monthyear, 5, 2);
        $vat = Yii::$app->request->post('vat');

        $sumdiscount = ($total - $discount); //ราคาหลังหักส่วนลด
        $sumdeposit = ($sumdiscount - $deposit); //ราคาหลังหักค่ามัดจำ
        if ($vat == 1) {//คิด Vat
            $vats = (($sumdeposit * 7) / 100);
        } else {
            $vats = 0;
        }

        $totalfinal = ($sumdeposit + $vats);

        $columns = array(
            "invoicenumber" => $invoiceNumber,
            "promise" => $promiseId,
            "round" => $roundId,
            "total" => $totalfinal,
            "status" => "0",
            "year" => $year,
            "month" => $month,
            "type" => $type,
            "dateinvoice" => $dateinvoice,
            "datebill" => $datebill,
            "discount" => $discount,
            "deposit" => $deposit,
            "credit" => $credit,
            "d_update" => date("Y-m-d H:i:s"),
        );

        Yii::$app->db->createCommand()
                ->insert("invoice", $columns)
                ->execute();

        $columnsUpdate = array(
            "receiptnumber" => $invoiceNumber,
        );
        Yii::$app->db->createCommand()
                ->update("roundmoney", $columnsUpdate, "id = '$roundId'")
                ->execute();
    }

    public function getNextId() {
        //ตัวอย่างหากต้องการ SN59-00001
        $lastRecord = Invoice::find()->where(['like', 'invoicenumber', 'INV'])->orderBy(['id' => SORT_DESC])->one(); //หาตัวล่าสุดก่อน
        if ($lastRecord) {
            $digit = explode('INV', $lastRecord->invoicenumber);

            $lastDigit = ((int) $digit[1]); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
            $lastDigit++; //เพิ่ม 1
            $lastDigit = str_pad($lastDigit, 5, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
        } else {
            $lastDigit = '00001';
        }

        return 'INV' . $lastDigit;
    }

    public function actionGetinvoice() {
        $promiseId = Yii::$app->request->post('promiseid');
        $dateround = Yii::$app->request->post('dateround');
        $id = Yii::$app->request->post('id');
        $invoice = Yii::$app->request->post('invoice');

        $Promise = Promise::find()->where(['id' => $promiseId])->One();
        //$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
        $Customer = $this->actionGetcustomer($Promise['customerid']);
        $YearMonth = substr($dateround, 0, 7);
        $sql = "select * from roundgarbage where promiseid = '$promiseId' and LEFT(datekeep,7) = '$YearMonth' and status='1'";
        $data['billdetail'] = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $Customer;
        $data['type'] = $Customer['typeregister'];
        $data['promise'] = $Promise;
        $data['rounddate'] = $YearMonth;
        $data['id'] = $id;
        $data['invnumber'] = $invoice;
        $Status = Invoice::find()->where(['invoicenumber' => $invoice])->count();
        $data['status'] = $Status;
        $sqlInvoice = "select * from invoice where invoicenumber = '$invoice'";
        $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        $data['vat'] = $Promise['vat'];
        $data['vattype'] = $Promise['vattype'];
        return $this->renderPartial('createbillpopup', $data);
    }

    public function actionGetinvoicetype3() {
        $promiseId = Yii::$app->request->post('promiseid');
        $dateround = Yii::$app->request->post('dateround');
        $id = Yii::$app->request->post('id');
        $invoice = Yii::$app->request->post('invoice');

        $Promise = Promise::find()->where(['id' => $promiseId])->One();
        //$Customer = Customers::find()->where(['id' => $Promise['customerid']])->One();
        $Customer = $this->actionGetcustomer($Promise['customerid']);
        $YearMonth = substr($dateround, 0, 7);
        $sql = "select * from roundgarbage where promiseid = '$promiseId' and LEFT(datekeep,7) = '$YearMonth' and status='1'";
        $data['billdetail'] = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $Customer;
        $data['type'] = $Customer['typeregister'];
        $data['promise'] = $Promise;
        $data['rounddate'] = $YearMonth;
        $data['id'] = $id;
        $data['invnumber'] = $invoice;
        $Status = Invoice::find()->where(['invoicenumber' => $invoice])->count();
        $data['status'] = $Status;
        $sqlInvoice = "select * from invoice where invoicenumber = '$invoice'";
        $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        $data['vat'] = $Promise['vat'];
        $data['vattype'] = $Promise['vattype'];
        return $this->renderPartial('createbillpopuptype3', $data);
    }

    public function actionConfirmorder() {
        $sql = "SELECT i.*,CONCAT('(Invoice #',i.invoicenumber,') ',c.company,' (จำนวน ',i.total,' .-)') as orders,
					p.promisenumber,c.company,r.round as roundmoney
					FROM invoice i INNER JOIN promise p ON i.promise = p.id
					INNER JOIN customers c ON p.customerid = c.id
					LEFT JOIN roundmoney r ON i.round = r.id
					WHERE i.`status` = '2' AND i.typepayment = '1'";
        $data['order'] = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('checkorder', $data);
    }

    public function actionSaveconfirmorder() {
        $id = Yii::$app->request->post('id');
        $dateservice = Yii::$app->request->post('dateservice');
        $timeservice = Yii::$app->request->post('timeservice');
        $comment = Yii::$app->request->post('comment');
        $columns = array(
            "dateservice" => $dateservice,
            "timeservice" => $timeservice,
            "comment" => $comment,
            "status" => 1,
            "d_update" => date("Y-m-d H:i:s"),
            "dateconfirm" => date("Y-m-d H:i:s")
        );

        Yii::$app->db->createCommand()
                ->update("invoice", $columns, "id = '$id'")
                ->execute();
    }

    public function actionCreateinvoiceyear($customerId = "") {
        //ออกบิลสำหรับสัญญาที่เหมาจ่ายแบบรายปี
        //$data['promise'] = Promise::find()->where(['status' => '2', 'payment' => '1'])->all();
        $sql = "select p.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',ch.changwat_name) as address
				from customers c inner join promise p on c.id = p.customerid
				inner join changwat ch on c.changwat = ch.changwat_id
				inner join ampur a on c.ampur = a.ampur_id
				inner join tambon t on c.tambon = t.tambon_id
				inner join packagepayment pm ON p.payment = pm.id
				where pm.typepayment = 'Y' and p.status = '2'";
        $data['customer'] = Yii::$app->db->createCommand($sql)->queryAll();
        $data['round'] = $this->actionGetroundpromiseyear($customerId);
        $data['customerId'] = $customerId;
        //$data['type'] = $type;
        return $this->render('createinvoiceyear', $data);
    }

    public function actionGetroundpromiseyear($customerId) {
        $Config = new Config();
        //$customerId = Yii::$app->request->post('customer_id');
        $Promise = Promise::find()->where(['customerid' => $customerId, 'status' => '2'])->one();
        $Customer = Customers::find()->where(['id' => $customerId])->One();
        $RoundMoney = Roundmoney::find()->where(['promiseid' => $Promise['id']])->all();

        $sql = "select * from vattype where id = '" . $Customer['typeregister'] . "'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();

        $promiseId = $Promise['id'];
        $typePromise = $Promise['recivetype']; //ประเภทการจ้าง
        $data['vat'] = $Promise['vat']; //เช็คเอา vat  ไม่เอา vat
        $data['typevat'] = $Promise['vattype']; //เช็คเอา vat- +
        $vat = $Promise['vat'];
        $typevatBill = $Promise['vattype'];
        if ($vat == 1) {
            $vateBill = "เอา vat";
            if ($typevatBill == 1) {
                $vatText = "(รวม Vat)";
            } else {
                $vatText = "(แยก Vat)";
            }
        } else {
            $vateBill = "ไม่เอา vat";
            $vatText = "";
        }

        $str = "";
        if ($Customer) {
            $str .= "<b>ลูกค้า " . $Customer['company'] . "</b><br/>";
            $linkPromise = Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $promiseId]);
            $str .= "<b>" . $vateBill . " " . $vatText . "</b><br/>";
            $str .= "<em><a href='" . $linkPromise . "' target='_back'>ข้อมูลสัญญา</a></em><br/><br/>";
            //$str .= "<a href='javascript:popupFormbill($promiseId)' class='btn btn-default'><i class='fa fa-save'></i> สร้างใบวางบิล</a>" . "<br/>";
            $str .= "<button type='button' class='btn btn-default' onclick='popupFormbill($promiseId,$vat,$typevatBill)'>สร้างใบวางบิล</button>";
        }
        return $str;
    }

    public function actionCreatebillpopupyear() {
        $promiseId = Yii::$app->request->post('promiseid');
        $data['vat'] = Yii::$app->request->post('vat');
        $data['vatype'] = Yii::$app->request->post('vattype');
        $Promise = Promise::find()->where(['id' => $promiseId])->One();
        $Customer = $this->actionGetcustomer($Promise['customerid']);
        $RoundMoney = Roundmoney::find()->where(['promiseid' => $promiseId])->all();
        $data['billdetail'] = $RoundMoney;
        $data['customer'] = $Customer;
        $data['promise'] = $Promise;
        $data['type'] = $Customer['typeregister'];
        $data['vat'] = $Promise['vat'];
        $data['vattype'] = $Promise['vattype'];
        $sqlCheckInvoice = "select * from invoice where promise = '$promiseId' and invoicenumber != ''";
        $Invoice = Yii::$app->db->createCommand($sqlCheckInvoice)->queryOne();

        $sqlInvoice = "select * from invoice where invoicenumber = '" . $Invoice['invoicenumber'] . "'";
        if (!$Invoice['invoicenumber']) {
            $data['invnumber'] = $this->getNextId();
            $data['status'] = 0;
            $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        } else {
            $data['invnumber'] = $Invoice['invoicenumber'];
            $data['status'] = 1;
            $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        }
        $data['page'] = "createbillpopupyear";
        return $this->renderPartial('createbillpopupyear', $data);
    }

    public function actionGetinvoiceyear() {
        $promiseId = Yii::$app->request->post('promiseid');

        $Promise = Promise::find()->where(['id' => $promiseId])->One();
        $Customer = $this->actionGetcustomer($Promise['customerid']);
        $RoundMoney = Roundmoney::find()->where(['promiseid' => $promiseId])->all();
        $data['billdetail'] = $RoundMoney;
        $data['customer'] = $Customer;
        $data['promise'] = $Promise;
        $data['type'] = $Customer['typeregister'];
        $data['vat'] = $Promise['vat'];
        $data['vattype'] = $Promise['vattype'];
        $sqlCheckInvoice = "select * from invoice where promise = '$promiseId' and invoicenumber != ''";
        $Invoice = Yii::$app->db->createCommand($sqlCheckInvoice)->queryOne();

        $sqlInvoice = "select * from invoice where invoicenumber = '" . $Invoice['invoicenumber'] . "'";

        $data['invnumber'] = $Invoice['invoicenumber'];
        $data['status'] = 1;
        $data['invoicedetail'] = Yii::$app->db->createCommand($sqlInvoice)->queryOne();
        return $this->renderPartial('createbillpopupyear', $data);
    }

    public function actionGetroundlist() {
        $Config = new Config();
        $promiseId = Yii::$app->request->post('promiseid');
        //$RoundGarbage = Roundgarbage::find()->where(['promiseid' => $promiseId])->all();
        $sql = "SELECT r.*,p.username,f.`name`
FROM roundgarbage r INNER JOIN `user` p ON r.keepby = p.id
LEFT JOIN `profile` f ON p.id = f.user_id
WHERE r.promiseid = '$promiseId'";
        $RoundGarbage = Yii::$app->db->createCommand($sql)->queryAll();
        $i = 0;
        $str = "";
        $str .= "<br/><p class=\"text-danger\">*กรณีที่ลงข้อมูลผิดให้ลบแล้วลงใหม่(ลบได้เฉพาะคนที่บันทึกเท่านั้น)</p>";
        $str .= "<b>ประวัติการจัดเก็บ</b><br/>
			<table class='table table-bordered table-striped'>
				<thead>
					<tr>
						<th>#</th>
						<th>วันที่ / เวลา</th>
                                                <th>ทะเบียนรถ</th>
						<th style='text-align:right;'>ปริมาณ</th>
						<th style='text-align:right;'>ขยะเกิน</th>
						<th style='text-align:center;'>ผู้บันทึก</th>
						<th style='text-align:center;'></th>";
        $str .= "</tr></thead>";
        $str .= "<tbody>";
        foreach ($RoundGarbage as $rs) {
            if ($rs['garbageover']) {
                $Gover = $rs['garbageover'];
            } else {
                $Gover = "-";
            }
            $i++;
            $str .= "<tr>";
            $str .= "<td>" . $i . "</td>";
            $str .= "<td>" . $Config->thaidate($rs['datekeep']) . " เข้า " . $rs['timekeepin'] . " ออก " . $rs['timekeepout'] . "</td>";
            $str .= "<td>" . $rs['car'] . "</td>";
            $str .= "<td style='text-align:right;'>" . $rs['amount'] . " กิโลกรัม</td>";
            $str .= "<td style='text-align:right;'>" . $Gover . " กิโลกรัม</td>";
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
                ->delete("roundgarbage", "id = '$id'")
                ->execute();
    }

    public function actionCreateinvoicesixmonth($customerId = "") {
        //ออกบิลสำหรับสัญญาที่เหมาจ่ายราย 6 เดือน
        $sql = "select pro.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',p.changwat_name) as address
                    from customers c
                        inner join changwat p on c.changwat = p.changwat_id
                        inner join ampur a on c.ampur = a.ampur_id
                        inner join tambon t on c.tambon = t.tambon_id
                        inner join promise pro on c.id = pro.customerid
                        INNER JOIN packagepayment pm ON pro.payment = pm.id
                where pro.`status` = '2' and pm.typepayment = 'P'";
        $data['customer'] = Yii::$app->db->createCommand($sql)->queryAll();
        //$data['type'] = $type;
        $data['round'] = $this->actionGetroundpromisesixmonth($customerId);
        $data['customerId'] = $customerId;
        //$data['type'] = $type;

        return $this->render('createinvoicesixmonth', $data);
    }

    public function actionGetroundpromisesixmonth($customerId) {
        $Config = new Config();
        //$customerId = Yii::$app->request->post('customer_id');
        $Promise = Promise::find()->where(['customerid' => $customerId, 'status' => '2'])->one();
        $Customer = Customers::find()->where(['id' => $customerId])->One();
        $RoundMoney = Roundmoney::find()->where(['promiseid' => $Promise['id']])->all();

        $sql = "select * from vattype where id = '" . $Customer['typeregister'] . "'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();

        $promiseId = $Promise['id'];
        $typePromise = $Promise['recivetype']; //ประเภทการจ้าง
        $data['vat'] = $Promise['vat']; //เช็คเอา vat  ไม่เอา vat
        $data['typevat'] = $Promise['vattype']; //เช็คเอา vat- +
        $vatBill = $Promise['vattype'];
        $vat = $Promise['vat'];
        //$typevatBill = $Promise['vattype'];
        if ($vat == 1) {
            $vateBill = "เอา vat";
            if ($vatBill == 1) {
                $vatText = "(รวม Vat)";
            } else {
                $vatText = "(แยก Vat)";
            }
        } else {
            $vateBill = "ไม่เอา vat";
            $vatText = "";
        }

        $str = "";
        if ($RoundMoney) {
            $str .= "<div style='padding:5px;'>";
            $str .= "<b>ลูกค้า " . $Customer['company'] . "</b><br/>";
            $linkPromise = Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $promiseId]);
            $str .= "<b>" . $vateBill . "</b> <b>" . $vatText . "</b>";
            $str .= "<em><a href='" . $linkPromise . "' target='_back'>ข้อมูลสัญญา</a></em></div><br/><br/>";

            //$str .= "<a href='javascript:popupFormbill($promiseId)' class='btn btn-default'><i class='fa fa-save'></i> สร้างใบวางบิล</a>" . "<br/>";
            $str .= "<ul class='list-gorup' style='margin-left:0px; padding-left:0px; border:none;'>";
            $str .= "<li class='list-group-item active' style='border:none; border-radius:0px;'><button type='button' class='btn btn-default' onclick='popupFormbill($promiseId,$vat,$vatBill,$typePromise,1,6)'>สร้างใบวางบิล</button></li>";
            $i = 0;
            foreach ($RoundMoney as $rs):
                $i++;
                if ($i <= 6) {
                    $str .= "<li class='list-group-item'>" . $Config->thaidatemonth($rs['datekeep']) . "</li>";
                }
            endforeach;
            $str .= "<li class='list-group-item active'><button type='button' class='btn btn-default' onclick='popupFormbill($promiseId,$vat,$vatBill,$typePromise,7,12)'>สร้างใบวางบิล</button></li>";
            $b = 0;
            foreach ($RoundMoney as $rs):
                $b++;
                if ($b > 6) {
                    $str .= "<li class='list-group-item' style='border-radius:0px;'>" . $Config->thaidatemonth($rs['datekeep']) . "</li>";
                }
            endforeach;
            $str .= "</ul>";
        } else {
            $str .= "ยังไม่เลือกลูกค้า";
        }
        return $str;
    }

    public function actionCreatebillsixmonth() {
        $Config = new Config();
        $promiseId = Yii::$app->request->post('promiseid');
        $start = Yii::$app->request->post('start');
        $end = Yii::$app->request->post('end');
        $data['vat'] = Yii::$app->request->post('vat');
        $data['vattype'] = Yii::$app->request->post('vattype');
        $typepromise = Yii::$app->request->post('typepromise');
        $data['start'] = $start;
        $data['end'] = $end;

        $StartMonth = \Yii::$app->db->createCommand("select * from roundmoney where promiseid = '$promiseId' and round = '$start'")->queryOne()['datekeep'];
        $EndMonth = \Yii::$app->db->createCommand("select * from roundmoney where promiseid = '$promiseId' and round = '$end'")->queryOne()['datekeep'];
        $data['startmonth'] = $Config->thaidatemonth($StartMonth);
        $data['endmonth'] = $Config->thaidatemonth($EndMonth);
        $Promise = Promise::find()->where(['id' => $promiseId])->One();
        $Customer = $this->actionGetcustomer($Promise['customerid']);

        $sql = "select * from roundmoney where promiseid = '$promiseId' and round BETWEEN '$start' AND '$end'";
        $billdetail = Yii::$app->db->createCommand($sql)->queryAll();
        $data['customer'] = $Customer;
        $data['promise'] = $Promise;

        $sqlCheckInvoice = "select * from roundmoney where promiseid = '$promiseId' and round BETWEEN '$start' AND '$end' and receiptnumber != '' ";
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

        $page = "createbillpopupsixmonth";
        $data['billdetail'] = $billdetail;
        $data['page'] = $page;
        return $this->renderPartial($page, $data);
    }

    //บันทึกรายการใบแจ้งหนี้6เดือน
    public function actionAddinvoicesixmonth() {
        $Config = new Config();
        $invoiceNumber = Yii::$app->request->post('invoiceNumber');
        $promiseId = Yii::$app->request->post('promiseId');
        $total = Yii::$app->request->post('total');
        //$roundId = Yii::$app->request->post('roundId');
        //$type = Yii::$app->request->post('type');
        //$monthyear = Yii::$app->request->post('monthyear');
        $dateinvoice = Yii::$app->request->post('dateinvoice');
        $datebill = Yii::$app->request->post('datebill');
        $discount = Yii::$app->request->post('discount');
        $deposit = Yii::$app->request->post('deposit');
        $credit = Yii::$app->request->post('credit');
        //$year = substr($monthyear, 0, 4);
        //$month = substr($monthyear, 5, 2);
        $start = Yii::$app->request->post('start');
        $end = Yii::$app->request->post('end');
        $vat = Yii::$app->request->post('vat');

        $sumdiscount = ($total - $discount);
        $sumdeposit = ($sumdiscount - $deposit);
        if ($vat == 1) {
            $vats = (($sumdeposit * 7) / 100);
        } else {
            $vats = 0;
        }

        $totalInvoiceFinal = ($sumdeposit + $vats);

        $StartMonth = \Yii::$app->db->createCommand("select * from roundmoney where promiseid = '$promiseId' and round = '$start'")->queryOne()['datekeep'];
        $EndMonth = \Yii::$app->db->createCommand("select * from roundmoney where promiseid = '$promiseId' and round = '$end'")->queryOne()['datekeep'];
        $startmonth = $Config->thaidatemonth($StartMonth);
        $endmonth = $Config->thaidatemonth($EndMonth);

        $columns = array(
            "invoicenumber" => $invoiceNumber,
            "promise" => $promiseId,
            //"round" => $roundId,
            "total" => $totalInvoiceFinal,
            "status" => "0",
            //"year" => $year,
            //"month" => $month,
            //"type" => $type,
            "dateinvoice" => $dateinvoice,
            "datebill" => $datebill,
            "discount" => $discount,
            "deposit" => $deposit,
            "credit" => $credit,
            "comment" => $startmonth . "-" . $endmonth,
            "d_update" => date("Y-m-d H:i:s"),
        );

        Yii::$app->db->createCommand()
                ->insert("invoice", $columns)
                ->execute();

        $columnsUpdate = array(
            "receiptnumber" => $invoiceNumber,
        );
        Yii::$app->db->createCommand()
                ->update("roundmoney", $columnsUpdate, "promiseid = '$promiseId' AND round BETWEEN '$start' AND '$end' ")
                ->execute();
    }

    //บันทึกรายการใบแจ้งหนี้ 1 ปี
    public function actionAddinvoiceyear() {
        $Config = new Config();
        $invoiceNumber = Yii::$app->request->post('invoiceNumber');
        $promiseId = Yii::$app->request->post('promiseId');
        $total = Yii::$app->request->post('total');
        //$roundId = Yii::$app->request->post('roundId');
        //$type = Yii::$app->request->post('type');
        //$monthyear = Yii::$app->request->post('monthyear');
        $dateinvoice = Yii::$app->request->post('dateinvoice');
        $datebill = Yii::$app->request->post('datebill');
        $discount = Yii::$app->request->post('discount');
        $deposit = Yii::$app->request->post('deposit');
        $credit = Yii::$app->request->post('credit');
        //$year = substr($monthyear, 0, 4);
        //$month = substr($monthyear, 5, 2);
        //$start = Yii::$app->request->post('start');
        //$end = Yii::$app->request->post('end');
        $vat = Yii::$app->request->post('vat');

        $sumdiscount = ($total - $discount);
        $sumdeposit = ($sumdiscount - $deposit);
        if ($vat == 1) {
            $vats = (($sumdeposit * 7) / 100);
        } else {
            $vats = 0;
        }

        $totalInvoiceFinal = ($sumdeposit + $vats);

        //$StartMonth = \Yii::$app->db->createCommand("select * from roundmoney where promiseid = '$promiseId' and round = '$start'")->queryOne()['datekeep'];
        //$EndMonth = \Yii::$app->db->createCommand("select * from roundmoney where promiseid = '$promiseId' and round = '$end'")->queryOne()['datekeep'];
        //$startmonth = $Config->thaidatemonth($StartMonth);
        //$endmonth = $Config->thaidatemonth($EndMonth);

        $columns = array(
            "invoicenumber" => $invoiceNumber,
            "promise" => $promiseId,
            //"round" => $roundId,
            "total" => $totalInvoiceFinal,
            "status" => "0",
            //"year" => $year,
            //"month" => $month,
            //"type" => $type,
            "dateinvoice" => $dateinvoice,
            "datebill" => $datebill,
            "discount" => $discount,
            "deposit" => $deposit,
            "credit" => $credit,
            "comment" => "ชำระรายปี",
            "d_update" => date("Y-m-d H:i:s"),
        );

        Yii::$app->db->createCommand()
                ->insert("invoice", $columns)
                ->execute();

        $columnsUpdate = array(
            "receiptnumber" => $invoiceNumber,
        );
        Yii::$app->db->createCommand()
                ->update("roundmoney", $columnsUpdate, "promiseid = '$promiseId' ")
                ->execute();
    }

    public function actionConfirmorderonmonth($groupid = "", $year = "", $month = "") {
        $data['groupId'] = $groupid;
        //$data['customerid'] = $customerid;
        $data['year'] = $year;
        $data['month'] = $month;
        $sql = "select pro.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',p.changwat_name) as address
                    from customers c
                        inner join changwat p on c.changwat = p.changwat_id
                        inner join ampur a on c.ampur = a.ampur_id
                        inner join tambon t on c.tambon = t.tambon_id
                        inner join promise pro on c.id = pro.customerid
                        INNER JOIN packagepayment pm ON pro.payment = pm.id
                        INNER JOIN groupcustomer g ON c.grouptype = g.id
                where pro.`status` = '2' AND g.id = '$groupid'";

        $data['groupcustomer'] = \app\models\Groupcustomer::find()->where(['in', 'id', [2, 3, 4]])->all();
        $data['customer'] = Yii::$app->db->createCommand($sql)->queryAll();
        //$data['customer'] = \common\models\Customers::findAll(['grouptype' => $groupid]);

        return $this->render("confirmorderonmonth", $data);
    }

    public function actionGetroudinmonth() {
        $Config = new Config();
        $promiseModel = new Promise();
        $promise = \Yii::$app->request->post('promise');
        $year = \Yii::$app->request->post('year');
        $month = \Yii::$app->request->post('month');
        $yearMonth = $year . "-" . $month;
        $promiseDetail = $promiseModel::findOne(['id' => $promise]);
        if ($promiseDetail['flag'] == 1) {
            $subgroup = $promiseModel::findAll(['upper' => $promise]);
            $subArr = Array();
            foreach ($subgroup as $rs):
                $subArr[] = "'" . $rs['id'] . "'";
            endforeach;
            $groupPromise = implode(",", $subArr);
            $sql = "select * from roundgarbage where promiseid IN ($groupPromise) AND LEFT(datekeep,7) = '$yearMonth' group by datekeep";
        } else {
            $sql = "select * from roundgarbage where promiseid = '$promise' AND LEFT(datekeep,7) = '$yearMonth'";
        }

        $round = Yii::$app->db->createCommand($sql)->queryAll();
        $str = "";
        if ($round) {
            $str .= "<ul class='list-group' style='border:none;'>";
            if ($promiseDetail['flag'] != 1) {
                foreach ($round as $rs):
                    $id = $rs['id'];
                    $str .= "<li class='list-group-item' style='border:none;cursor: pointer;' onclick='getform($id)'>" . $Config->thaidate($rs['datekeep']) . "</li>";
                endforeach;
            } else {
                foreach ($round as $rs):
                    $datekeep = $rs['datekeep'];
                    $str .= "<li class='list-group-item' style='border:none;cursor: pointer;' onclick='getformsubpromise(\"$datekeep\")'>" . $Config->thaidate($rs['datekeep']) . "</li>";
                endforeach;
            }
            $str .= "</ul>";
        } else {
            $str .= "<div style='text-align:center; padding-top:20px;'>ยังไม่มีรายการจัดเก็บ</div>";
        }

        echo $str;
    }

    public function actionCreateformsendwork() {
        $id = \Yii::$app->request->post('id');
        $promiseid = \Yii::$app->request->post('promiseid');
        $groupcustomer = \Yii::$app->request->post('groupcustomer');
        $promise = Promise::findOne(['id' => $promiseid]);
        $data['groupcustomer'] = $groupcustomer;
        $data['promiseid'] = $promiseid;
        $data['id'] = $id;
        $data['promise'] = $promise;
        $data['customer'] = $this->getcustomerInPromise($promiseid);

        if ($groupcustomer == "2" || $groupcustomer == "4") {//รพ.และรพ.สต
            if ($promise['flag'] == 1) {
                //รพ.ที่มีเครือข่าย
                $data['detail'] = Roundgarbage::findOne(['id' => $id]);
                //$sql = "";
                $page = "sendtypehospitalsubpromise";
            } else {
                //รพ. หรือ รพ.สต.
                $data['detail'] = Roundgarbage::findOne(['id' => $id]);
                $page = "sendtypehospital";
            }
        } else if ($groupcustomer == "3") {
            //บริษัท
            $data['detail'] = Roundgarbage::findOne(['id' => $id]);
            $page = "sendtypecompany";
        }
        //Roundgarbage::findOne(['id' => $id]);
        return $this->renderPartial($page, $data);
    }

    public function actionCreateformsendworksubpromise() {
        $promiseModel = new Promise();
        $promiseid = \Yii::$app->request->post('promiseid');
        $datekeep = \Yii::$app->request->post('datekeep');
        $promise = Promise::findOne(['id' => $promiseid]);
        $data['promiseid'] = $promiseid;
        $data['promise'] = $promise;
        $data['customer'] = $this->getcustomerInPromise($promiseid);
        $data['datekeep'] = $datekeep;
        $subgroup = $promiseModel::findAll(['upper' => $promiseid]);
        $subArr = Array();
        foreach ($subgroup as $rs):
            $subArr[] = "'" . $rs['id'] . "'";
        endforeach;
        $groupPromise = implode(",", $subArr);
        $sql = "select r.*,c.company from roundgarbage r INNER JOIN promise p ON r.promiseid = p.id INNER JOIN customers c ON p.customerid = c.id where promiseid IN ($groupPromise) AND datekeep = '$datekeep' ORDER BY r.id";
        //รพ.ที่มีเครือข่าย
        //echo $sql;
        //exit();
        $data['detail'] = Yii::$app->db->createCommand($sql)->queryAll();
        $data['detailround'] = Yii::$app->db->createCommand($sql)->queryOne();
        $sqlTimeStart = "select r.*,c.company from roundgarbage r INNER JOIN promise p ON r.promiseid = p.id INNER JOIN customers c ON p.customerid = c.id where promiseid IN ($groupPromise) AND datekeep = '$datekeep' ORDER BY timekeepin ASC";
        $data['timekeepin'] = Yii::$app->db->createCommand($sqlTimeStart)->queryOne()['timekeepin'];
        $sqlTimeEnd = "select r.*,c.company from roundgarbage r INNER JOIN promise p ON r.promiseid = p.id INNER JOIN customers c ON p.customerid = c.id where promiseid IN ($groupPromise) AND datekeep = '$datekeep' ORDER BY timekeepout DESC";
        $data['timekeepout'] = Yii::$app->db->createCommand($sqlTimeEnd)->queryOne()['timekeepout'];
        $page = "sendtypehospitalsubpromise";
        return $this->renderPartial($page, $data);
    }

    function getcustomerInPromise($promiseId = "") {
        $sqlCus = "SELECT p.*,c.company
                        FROM promise p INNER JOIN customers c ON p.customerid = c.id
                        WHERE p.id = '$promiseId'";

        return \Yii::$app->db->createCommand($sqlCus)->queryOne();
    }

    public function actionPrint($id, $promiseid, $groupcustomer) {
        $promise = Promise::findOne(['id' => $promiseid]);
        $data['promise'] = $promise;
        $data['customer'] = $this->getcustomerInPromise($promiseid);

        if ($groupcustomer == "2" || $groupcustomer == "4") {//รพ.และรพ.สต
            if ($promise['flag'] == 1) {
                //รพ.เครือข่าย
                $data['detail'] = Roundgarbage::findOne(['id' => $id]);
                $page = "printsendtypesubhospital";
            } else {
                //รพ. หรือ รพ.สต.
                $data['detail'] = Roundgarbage::findOne(['id' => $id]);
                $page = "printsendtypehospital";
            }
        } else if ($groupcustomer == "3") {
            //บริษัท
            $data['detail'] = Roundgarbage::findOne(['id' => $id]);
            $page = "printsendtypecompany";
        }
        //Roundgarbage::findOne(['id' => $id]);
        return $this->renderPartial($page, $data);
    }

    public function actionPrintsubpromise($promiseid, $datekeep) {
        $promiseModel = new Promise();
        //$promiseid = \Yii::$app->request->post('promiseid');
        //$datekeep = \Yii::$app->request->post('datekeep');
        $promise = Promise::findOne(['id' => $promiseid]);
        $data['promiseid'] = $promiseid;
        $data['promise'] = $promise;
        $data['customer'] = $this->getcustomerInPromise($promiseid);
        $data['datekeep'] = $datekeep;
        $subgroup = $promiseModel::findAll(['upper' => $promiseid]);
        $subArr = Array();
        foreach ($subgroup as $rs):
            $subArr[] = "'" . $rs['id'] . "'";
        endforeach;
        $groupPromise = implode(",", $subArr);
        $sql = "select r.*,c.company from roundgarbage r INNER JOIN promise p ON r.promiseid = p.id INNER JOIN customers c ON p.customerid = c.id where promiseid IN ($groupPromise) AND datekeep = '$datekeep' ";
        //รพ.ที่มีเครือข่าย
        $data['detail'] = Yii::$app->db->createCommand($sql)->queryAll();
        $data['detailround'] = Yii::$app->db->createCommand($sql)->queryOne();
        $sqlTimeStart = "select r.*,c.company from roundgarbage r INNER JOIN promise p ON r.promiseid = p.id INNER JOIN customers c ON p.customerid = c.id where promiseid IN ($groupPromise) AND datekeep = '$datekeep' ORDER BY timekeepin ASC";
        $data['timekeepin'] = Yii::$app->db->createCommand($sqlTimeStart)->queryOne()['timekeepin'];
        $sqlTimeEnd = "select r.*,c.company from roundgarbage r INNER JOIN promise p ON r.promiseid = p.id INNER JOIN customers c ON p.customerid = c.id where promiseid IN ($groupPromise) AND datekeep = '$datekeep' ORDER BY timekeepout DESC";
        $data['timekeepout'] = Yii::$app->db->createCommand($sqlTimeEnd)->queryOne()['timekeepout'];
        $page = "printsendtypesubhospital";
        return $this->renderPartial($page, $data);
    }

    public function actionGenformgarbageover($groupid = "", $year = "", $month = "") {
        $data['groupId'] = $groupid;
        //$data['customerid'] = $customerid;
        $data['year'] = $year;
        $data['month'] = $month;
        $sql = "select pro.*,CONCAT(c.company,' ',c.address,' ต.',t.tambon_name,' อ.',a.ampur_name,' จ.',p.changwat_name) as address
                    from customers c
                        inner join changwat p on c.changwat = p.changwat_id
                        inner join ampur a on c.ampur = a.ampur_id
                        inner join tambon t on c.tambon = t.tambon_id
                        inner join promise pro on c.id = pro.customerid
                        INNER JOIN packagepayment pm ON pro.payment = pm.id
                        INNER JOIN groupcustomer g ON c.grouptype = g.id
                where pro.`status` = '2' AND g.id = '$groupid'";

        $data['groupcustomer'] = \app\models\Groupcustomer::find()->where(['in', 'id', [1, 3]])->all();
        $data['customer'] = Yii::$app->db->createCommand($sql)->queryAll();
        //$data['customer'] = \common\models\Customers::findAll(['grouptype' => $groupid]);

        return $this->render("genformgarbageover", $data);
    }

    public function actionGetroudinmonthgarbageover() {
        $Config = new Config();
        $promiseModel = new Promise();
        $promise = \Yii::$app->request->post('promise');
        $year = \Yii::$app->request->post('year');
        $month = \Yii::$app->request->post('month');
        $yearMonth = $year . "-" . $month;
        $promiseDetail = $promiseModel::findOne(['id' => $promise]);
        if ($promiseDetail['flag'] == 1) {
            $subgroup = $promiseModel::findAll(['upper' => $promise]);
            $subArr = Array();
            foreach ($subgroup as $rs):
                $subArr[] = "'" . $rs['id'] . "'";
            endforeach;
            $groupPromise = implode(",", $subArr);
            $sql = "select * from roundgarbage where promiseid IN ($groupPromise) AND LEFT(datekeep,7) = '$yearMonth' group by datekeep";
        } else {
            $sql = "select * from roundgarbage where promiseid = '$promise' AND LEFT(datekeep,7) = '$yearMonth'";
        }

        $round = Yii::$app->db->createCommand($sql)->queryAll();
        $str = "";
        if ($round) {
            $str .= "<ul class='list-group' style='border:none;'>";
            //if ($promiseDetail['flag'] != 1) {
            foreach ($round as $rs):
                $id = $rs['id'];
                $str .= "<li class='list-group-item' style='border:none;cursor: pointer;' onclick='getform($id)'>" . $Config->thaidate($rs['datekeep']) . "</li>";
            endforeach;
            //} else {
            //foreach ($round as $rs):
            //$datekeep = $rs['datekeep'];
            // $str .= "<li class='list-group-item' style='border:none;cursor: pointer;' onclick='getformsubpromise(\"$datekeep\")'>" . $Config->thaidate($rs['datekeep']) . "</li>";
            //endforeach;
            //}
            $str .= "</ul>";
        } else {
            $str .= "<div style='text-align:center; padding-top:20px;'>ยังไม่มีรายการจัดเก็บ</div>";
        }

        echo $str;
    }

    public function actionCreateformgarbageover() {
        $id = \Yii::$app->request->post('id');
        $promiseid = \Yii::$app->request->post('promiseid');
        $groupcustomer = \Yii::$app->request->post('groupcustomer');
        $promise = Promise::findOne(['id' => $promiseid]);
        $data['groupcustomer'] = $groupcustomer;
        $data['promiseid'] = $promiseid;
        $data['id'] = $id;
        $data['promise'] = $promise;
        $data['customer'] = $this->getcustomerInPromise($promiseid);
        //บริษัท
        $data['detail'] = Roundgarbage::findOne(['id' => $id]);
        $page = "overformgarbage";
        //Roundgarbage::findOne(['id' => $id]);
        return $this->renderPartial($page, $data);
    }

    public function actionCheckinvoice() {
        $id = \Yii::$app->request->post('id');
        $data['invoice'] = Invoice::findOne(['id' => $id]);
        //echo $data['invoice']['slip'];
        $path = Yii::getAlias('@web') . "/../uploads/slip/" . $data['invoice']['slip'];
        $data['slip'] = $path;
        return $this->renderPartial("slip", $data);
    }

}

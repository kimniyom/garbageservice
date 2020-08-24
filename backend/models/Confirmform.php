<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confirmform".
 *
 * @property int $id
 * @property string $confirmformnumber เลขที่แบบฟอร์ม
 * @property int $customerneedid รหัสลูกค้า
 * @property int $roundkeep_sunday วันอาทิตย์
 * @property int $roundkeep_monday วันจันทร์
 * @property int $roundkeep_tueday วันอังคาร
 * @property int $roundkeep_wednesday วันพุธ
 * @property int $roundkeep_thursday วันพฤหัส
 * @property int $roundkeep_friday วันศุกร์
 * @property int $roundkeep_saturday วันเสาร์
 * @property string $roundkeep_day วันที่เข้าจัดเก็บขยะ
 * @property int $timeperiod_morning ช่วงเวลาที่เข้าจัดเก็บ ช่วงเช้า
 * @property int $timeperiod_affternoon ช่วงเวลาที่เข้าจัดเก็บ ช่วงบ่าย
 * @property string $timeperiod_time ระบุเวลา
 * @property int $billdoc_originalinvoice ต้นฉบับใบวางบิล/ใบแจ้งหนี้
 * @property int $billdoc_copyofinvoice สำเนาใบวางบิล/ใบแจ้งหนี้
 * @property int $billdoc_originalreceipt ต้นฉบับใบเสร็จรับเงิน/กำกับภาษี
 * @property int $billdoc_copyofreceipt สำเนาใบเสร็จรับเงิน/ใบกำกับภาษี
 * @property int $billdoc_copyofbank สำเนาเลขที่บัญชีธนาคารเพื่อให้ลูกค้าโอนเงิน
 * @property int $billdoc_etc
 * @property string $billdoc_etctext อื่น ๆ ระบุ
 * @property string $cyclekeepmoney รอบการวางบิล/ชำระเงินของลูกค้าของทุกเดือน
 * @property int $paymentschedule กำหนดการชำระเงิน
 * @property int $methodpeyment วิธีการชำระเงิน
 * @property int $senddoc_finance ส่งเอกสารให้บัญชี/การเงิน
 * @property int $senddoc_customer ส่งเอกสารให้ลูกค้า
 * @property string|null $department แผนก/หน่วยงาน
 * @property int|null $amount จำนวนครั้งที่จัดเก็บ 
 * @property int $status สถานะการใช้งาน 1 คือ ยังไม่จบกระบวนการ 2 คือ จบกระบวนการแล้ว
 */
class Confirmform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confirmform';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customerneedid', 'cyclekeepmoney', 'paymentschedule', 'methodpeyment', 'confirmformnumber', 'amount'], 'required'],
            [['customerneedid', 'roundkeep_sunday', 'roundkeep_monday', 'roundkeep_tueday', 'roundkeep_wednesday', 'roundkeep_thursday', 'roundkeep_friday', 'roundkeep_saturday', 'timeperiod_morning', 'timeperiod_affternoon', 'billdoc_originalinvoice', 'billdoc_copyofinvoice', 'billdoc_originalreceipt', 'billdoc_copyofreceipt', 'billdoc_copyofbank', 'billdoc_etc', 'paymentschedule', 'methodpeyment', 'senddoc_finance', 'senddoc_customer', 'amount', 'status'], 'integer'],
            [['roundkeep_day', 'timeperiod_time', 'cyclekeepmoney'], 'safe'],
            [['billdoc_etctext'], 'string'],
            [['confirmformnumber'], 'string', 'max' => 32],
            [['department'], 'string', 'max' => 128], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'confirmformnumber' => 'Confirmformnumber',
            'customerneedid' => 'customerneedid',
            'roundkeep_sunday' => 'วันอาทิตย์',
            'roundkeep_monday' => 'วันจันทร์',
            'roundkeep_tueday' => 'วันอังคาร',
            'roundkeep_wednesday' => 'วันพุธ',
            'roundkeep_thursday' => 'วันพฤหัส',
            'roundkeep_friday' => 'วันศุกร์',
            'roundkeep_saturday' => 'วันเสาร์',
            'roundkeep_day' => 'วันที่เข้าจัดเก็บขยะ',
            'timeperiod_morning' => 'ช่วงเช้า',
            'timeperiod_affternoon' => 'ช่วงบ่าย',
            'timeperiod_time' => 'ระบุเวลา',
            'billdoc_originalinvoice' => '1. ต้นฉบับใบวางบิล/ใบแจ้งหนี้',
            'billdoc_copyofinvoice' => '2. สำเนาใบวางบิล/ใบแจ้งหนี้',
            'billdoc_originalreceipt' => '3. ต้นฉบับใบเสร็จรับเงิน/กำกับภาษี',
            'billdoc_copyofreceipt' => '4. สำเนาใบเสร็จรับเงิน/ใบกำกับภาษี',
            'billdoc_copyofbank' => '5. สำเนาเลขที่บัญชีธนาคารเพื่อให้ลูกค้าโอนเงิน',
            'billdoc_etc' => 'อื่นๆ ระบุ',
            'billdoc_etctext' => '',
            'cyclekeepmoney' => '2. รอบการวางบิล/ชำระเงินของลูกค้าของทุกเดือน ',
            'paymentschedule' => '3. กำหนดการชำระเงิน',
            'methodpeyment' => '4.วิธีการชำระเงิน',
            'senddoc_finance' => 'ส่งเอกสารให้บัญชี/การเงิน',
            'senddoc_customer' => 'ส่งเอกสารให้ลูกค้า',
            'department' => 'ติดต่อ แผนก/หน่วยงาน',
            'amount' => 'จำนวนครั้งที่จัดเก็บ',
        ];
    }

    public function countConfirmform() {
        $sql = "select count(*) as total from confirmform 
                INNER JOIN customerneed c ON confirmform.customerneedid = c.id AND c.status = 1";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    } 

    function geConfirmformAll() {
        $sql = "SELECT
                    co.id,
                    c.customername,
                    c.tel,
                    c.contact,
                    c.dayopen,
                    p.changwat_name,
                    a.ampur_name,
                    t.tambon_name,
                    y.typename,
                    c.location
                FROM
                    confirmform co
                INNER JOIN customerneed c ON co.customerneedid = c.id AND c.status = 1
                INNER JOIN changwat p ON c.changwat = p.changwat_id
                INNER JOIN ampur a ON c.amphur = a.ampur_id
                INNER JOIN tambon t ON c.tambon = t.tambon_id
                INNER JOIN typecustomer y ON c.customrttype = y.id
                ORDER BY
                    co.id ASC
            ";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function geConfirmformById($id) {
        $where = $id == ""? "":" WHERE co.id={$id} ";
        $sql = "SELECT
                    co.*,
                    c.customername,
                    c.tel,
                    c.contact,
                    c.dayopen,
                    c.address,
                    c.zipcode,
                    c.NO,
                    c.location,
                    p.changwat_name,
                    a.ampur_name,
                    t.tambon_name,
                    y.typename
                FROM
                    confirmform co
                INNER JOIN customerneed c ON co.customerneedid = c.id
                INNER JOIN changwat p ON c.changwat = p.changwat_id
                INNER JOIN ampur a ON c.amphur = a.ampur_id
                INNER JOIN tambon t ON c.tambon = t.tambon_id
                INNER JOIN typecustomer y ON c.customrttype = y.id
               
                {$where}
                ORDER BY
                    co.id ASC
            ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs;
    }
}

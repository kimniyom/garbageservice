<?php

namespace app\modules\customer\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $company ชื่อบริษัท
 * @property string $taxnumber เลขถาษี
 * @property string $address ที่อยู่
 * @property string $changwat จังหวัด
 * @property string $ampur อำเภอ
 * @property string $tambon ตำบล
 * @property string $zipcode รหัสไปรษณีย์
 * @property string $manager ผู้จัดการ
 * @property string $tel เบอร์โทรศัพท์
 * @property string $telephone มือถือ
 * @property string $flag การเปิดใช้งาน 0 = Unactive, 1 = Active
 * @property string $create_date วันที่ลงทะเบียน
 * @property string $update_date แก้ไขข้อมูลล่าสุด
 * @property string $approve การยืนยัน Y = Yes N = No
 * @property double $latitude ละติจูด
 * @property double $longitude ลองจิจูด
 * @property string $timework เวลาทำการ
 * @property string $lineid Line id
 * @property string $grouptype ประเภทกลุ่มลูกค้า

 */
class Customers extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            //[['company','address','taxnumber','tel','changwat','ampur','tambon','zipcode','manager','user_id','approve','type','typeregister','grouptype'], 'required'],
            [['company', 'approve'], 'required'],
            //[['company'], 'required'],
            [['flag', 'approve'], 'string'],
            [['create_date', 'update_date', 'timework'], 'safe'],
            //[['latitude', 'longitude'], 'number'],
            [['company', 'address', 'remark'], 'string', 'max' => 255],
            [['taxnumber', 'tel', 'customercode'], 'string', 'max' => 20],
            [['telephone'], 'string', 'min' => 10, 'max' => 10],
            [['changwat', 'ampur', 'tambon'], 'string', 'max' => 10],
            [['zipcode'], 'string', 'max' => 5],
            [['manager'], 'string', 'max' => 100],
            [['lineid'], 'string', 'max' => 128],
            [['user_id', 'type'], 'number'],
            [['typeregister'], 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'company' => 'ชื่อบริษัท/สถานประกอบการ',
            'customercode' => 'เลขที่ใบอนุญาต',
            'taxnumber' => 'เลขที่ใบอนุญาต',
            'typeregister' => 'ประเภทการจดทะเบียน',
            'address' => 'ที่อยู่',
            'changwat' => 'จังหวัด',
            'ampur' => 'อำเภอ/เขต',
            'tambon' => 'ตำบล/แขวง',
            'zipcode' => 'รหัสไปรษณีย์',
            'manager' => 'ชื่อผู้ติดต่อได้สะดวก',
            'tel' => 'เบอร์โทรศัพท์',
            'telephone' => 'มือถือ',
            'flag' => 'การเปิดใช้งาน 0 = Unactive, 1 = Active',
            'create_date' => 'วันที่ลงทะเบียน',
            'update_date' => 'แก้ไขข้อมูลล่าสุด',
            'approve' => 'การยืนยัน',
            'user_id' => 'user',
            'type' => 'ประเภทธุรกิจลูกค้า',
            'remark' => 'หมายเหตุ',
            //'latitude' => 'ละติจูด',
            //'longitude' => 'ลองจิจูด',
            'timework' => 'เวลาทำการ',
            'lineid' => 'Line id',
            'grouptype' => 'ประเภทกลุ่มลูกค้า'
        ];
    }

    public function Countnonactive() {
        $sql = "select count(*) as total from customers where approve = 'N'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    public function TypeCustomer() {
        $sql = "select * from typecustomer";
        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    public function Countbetweenpromise() {
        $sql = "SELECT COUNT(*) AS total
				FROM customers
				INNER JOIN promise ON customers.id = promise.customerid
				WHERE DATEDIFF(promise.promisedateend,NOW())> 0";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    public function getAddress($id = "") {
        $sql = "SELECT c.*,p.changwat_name,a.ampur_name,t.tambon_name
					FROM customers c INNER JOIN changwat p ON c.changwat = p.changwat_id
					INNER JOIN ampur a ON c.ampur = a.ampur_id
					INNER JOIN tambon t ON c.tambon = t.tambon_id
					WHERE c.id = '$id' ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs;
    }

    function getQuotation() {
        $sql = "SELECT c.*,p.changwat_name,a.ampur_name,t.tambon_name,y.typename
                FROM customerneed c INNER JOIN changwat p ON c.changwat = p.changwat_id
                INNER JOIN ampur a ON c.amphur = a.ampur_id
                INNER JOIN tambon t ON c.tambon = t.tambon_id
                INNER JOIN typecustomer y ON c.customrttype = y.id
                WHERE c.`status` = '0' ORDER BY c.id ASC";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function getQuotationAll($status = "") {
        if($status == ""){
            $where = "1=1";
        } else {
            $where = "c.status = '$status'";
        }
        $sql = "SELECT c.*,p.changwat_name,a.ampur_name,t.tambon_name,y.typename
                FROM customerneed c INNER JOIN changwat p ON c.changwat = p.changwat_id
                INNER JOIN ampur a ON c.amphur = a.ampur_id
                INNER JOIN tambon t ON c.tambon = t.tambon_id
                INNER JOIN typecustomer y ON c.customrttype = y.id
                WHERE $where
                ORDER BY c.id ASC";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function countQuotation() {
        $rs = $this->getQuotation();
        return count($rs);
    }

    function getDeatilQuotation($id) {
        $sql = "SELECT c.*,p.changwat_name,a.ampur_name,t.tambon_name,y.typename,y.typename_en,v.vattype,IF(c.vat = '0','ไม่รวม vat','รวม vat') AS vat
                FROM customerneed c INNER JOIN changwat p ON c.changwat = p.changwat_id
                INNER JOIN ampur a ON c.amphur = a.ampur_id
                INNER JOIN tambon t ON c.tambon = t.tambon_id
                INNER JOIN typecustomer y ON c.customrttype = y.id
                INNER JOIN vattype v ON c.typebill = v.id
                WHERE c.id = '$id'
                ORDER BY c.id ASC";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs;
    }

}

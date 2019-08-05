<?php

namespace app\modules\customer\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $company ชื่อบริษัท
 * @property string $taxnumber เลขภาษี
 * @property string $aaddress ที่อยู่
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
			[['company', 'address', 'taxnumber', 'manager', 'tel', 'changwat', 'ampur', 'tambon', 'zipcode'], 'required'],
			[['flag', 'approve'], 'string'],
			[['create_date', 'update_date'], 'safe'],
			[['company', 'address'], 'string', 'max' => 255],
			[['taxnumber', 'tel', 'telephone'], 'string', 'max' => 20],
			[['changwat', 'ampur', 'tambon'], 'string', 'max' => 10],
			[['zipcode'], 'string', 'max' => 5],
			[['manager'], 'string', 'max' => 100],
			[['user_id', 'type'], 'number'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'company' => '* ชื่อ',
			'taxnumber' => '* รหัส',
			'address' => '* ที่อยู่',
			'changwat' => '* จังหวัด',
			'ampur' => '* อำเภอ',
			'tambon' => '* ตำบล',
			'zipcode' => '* รหัสไปรษณีย์',
			'manager' => '* ผู้จัดการ',
			'tel' => '* เบอร์โทรศัพท์',
			'telephone' => 'มือถือ',
			'flag' => 'การเปิดใช้งาน 0 = Unactive, 1 = Active',
			'create_date' => 'วันที่ลงทะเบียน',
			'update_date' => 'แก้ไขข้อมูลล่าสุด',
			'approve' => 'การยืนยัน Y = Yes N = No',
			'user_id' => 'user_id',
			'type' => 'ประเภทลูกค้า',
			'timeworkbegin' => 'เวลาทำการ',
            'timeworkend' => '-',
		];
	}

	public function TypeCustomer() {
		$sql = "select * from typecustomer";
		return Yii::$app->db->createCommand($sql)->queryAll();
	}

	public function Detail($userID) {
		$sql = "SELECT c.*,p.changwat_name,a.ampur_name,t.tambon_name
				FROM customers c INNER JOIN changwat p ON c.changwat = p.changwat_id
				INNER JOIN ampur a ON c.ampur = a.ampur_id
				INNER JOIN tambon t ON c.tambon = t.tambon_id
				WHERE c.user_id = '$userID'";
		return Yii::$app->db->createCommand($sql)->queryOne();
	}
}

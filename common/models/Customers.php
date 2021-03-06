<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $company ชื่อบริษัท
 * @property string $taxnumber เลขภาษีหรือเลขสถานบริการที่บ่งบอกถึงลูกค้ารายนั้น ๆ ห้ามซ้ำ
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
 * @property int $user_id user ใช้เข้าดูข้อมูลของสถานประกอบการนั้น ๆ
 * @property int $type ประเภทลูกค้า
 * @property time $timeworkbegin เวลาทำการเริ่มต้น
 * @property time $timeworkend เวลาเลิกงาน
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['flag', 'approve'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['user_id', 'type'], 'integer'],
            [['company', 'address'], 'string', 'max' => 255],
            [['taxnumber', 'tel', 'telephone'], 'string', 'max' => 20],
            [['changwat', 'ampur', 'tambon'], 'string', 'max' => 10],
            [['zipcode'], 'string', 'max' => 5],
            [['manager'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => 'ชื่อบริษัท',
            'taxnumber' => 'เลขภาษีหรือเลขสถานบริการที่บ่งบอกถึงลูกค้ารายนั้น ๆ ห้ามซ้ำ',
            'address' => 'ที่อยู่',
            'changwat' => 'จังหวัด',
            'ampur' => 'อำเภอ',
            'tambon' => 'ตำบล',
            'zipcode' => 'รหัสไปรษณีย์',
            'manager' => 'ผู้จัดการ',
            'tel' => 'เบอร์โทรศัพท์',
            'telephone' => 'มือถือ',
            'flag' => 'การเปิดใช้งาน 0 = Unactive, 1 = Active',
            'create_date' => 'วันที่ลงทะเบียน',
            'update_date' => 'แก้ไขข้อมูลล่าสุด',
            'approve' => 'การยืนยัน Y = Yes N = No',
            'user_id' => 'user ใช้เข้าดูข้อมูลของสถานประกอบการนั้น ๆ',
            'type' => 'ประเภทลูกค้า',
            'timeworkbegin' => 'เวลาทำการ',
            'timeworkend' => '-',
        ];
    }
}

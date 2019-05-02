<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $company ชื่อบริษัท
 * @property string $taxnumber เลขถาษี
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
            [['company', 'aaddress'], 'string', 'max' => 255],
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
            'company' => 'Company',
            'taxnumber' => 'Taxnumber',
            'aaddress' => 'Aaddress',
            'changwat' => 'Changwat',
            'ampur' => 'Ampur',
            'tambon' => 'Tambon',
            'zipcode' => 'Zipcode',
            'manager' => 'Manager',
            'tel' => 'Tel',
            'telephone' => 'Telephone',
            'flag' => 'Flag',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'approve' => 'Approve',
        ];
    }
}

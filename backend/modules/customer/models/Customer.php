<?php

namespace app\modules\customer\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $ID
 * @property string $CUSTOMERNAME ชื่อลูกค้า
 * @property string $ADDRESS ที่อยู่
 * @property string $OWNER เจ้าของ
 * @property string $MOBILE โทรศัพท์มือถือ
 * @property string $OFFICETEL เบอร์โทรศัพ  ท์
 * @property string $EMAIL อีเมล์
 * @property string $STATUS 1 = ใช้งาน 0 = ไม่ใช้งาน
 * @property string $APPROVE การยืนยัน 0 = ไม่ยืนยัน 1 = ยืนยัน
 * @property string $CHANGWAT จังหวัด
 * @property string $AMPUR อำเภอ
 * @property string $TAMBON ตำบล
 * @property string $ZIPCODE รหัสไปรษณีย์
 * @property string $CREATE_DATE วันที่บันทึก
 * @property string $UPDATE_DATE วันที่แก้ไขข้อมูล
 * @property string $DATE_APPROVE วันที่ยืนยัน
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CUSTOMERNAME','ADDRESS','OWNER','STATUS','APPROVE','MOBILE','EMAIL','CHANGWAT','AMPUR','TAMBON','TAMBON','ZIPCODE'], 'required'],
            [['STATUS', 'APPROVE'], 'string'],
            [['CREATE_DATE', 'UPDATE_DATE', 'DATE_APPROVE'], 'safe'],
            [['CUSTOMERNAME', 'ADDRESS'], 'string', 'max' => 256],
            [['OWNER'], 'string', 'max' => 128],
            [['MOBILE'], 'string', 'min' =>10,'max' => 10],
            [['OFFICETEL'], 'string', 'max' => 15],
            [['EMAIL'], 'string', 'max' => 64],
            [['CHANGWAT', 'AMPUR', 'TAMBON'], 'string', 'max' => 10],
            [[ 'ZIPCODE'], 'string', 'min' =>5,'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CUSTOMERNAME' => 'ชื่อลูกค้า/บริษัท',
            'ADDRESS' => 'ที่อยู่',
            'OWNER' => 'เจ้าของ',
            'MOBILE' => 'โทรศัพท์มือถือ',
            'OFFICETEL' => 'เบอร์โทรศัพท์',
            'EMAIL' => 'อีเมล์',
            'STATUS' => 'สถานะ',
            'APPROVE' => 'การยืนยัน',
            'CHANGWAT' => 'จังหวัด',
            'AMPUR' => 'อำเภอ',
            'TAMBON' => 'ตำบล',
            'ZIPCODE' => 'รหัสไปรษณีย์',
            'CREATE_DATE' => 'วันที่บันทึก',
            'UPDATE_DATE' => 'วันที่แก้ไขข้อมูล',
            'DATE_APPROVE' => 'วันที่ยืนยัน',
        ];
    }
}

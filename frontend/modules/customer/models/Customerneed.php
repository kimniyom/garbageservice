<?php

namespace app\modules\customer\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "customerneed".
 *
 * @property int $id
 * @property string $title เรื่อง
 * @property string $customername ชื่อสถานบริการ/บริษัท
 * @property int $customrttype ประเภทสถานพยาบาล
 * @property string $address ที่ิอยู่
 * @property string $tel เบอร์โทรศัพท์สำนักงาน
 * @property string $contact ชื่อผู้ติดต่อและเบอร์โทรศัพท์
 * @property string $dayopen วัน - เวลา ที่เปิดทำการ
 * @property string $location สถานที่ตั้ง
 * @property int $roundofweek รอบจัดเก็บ (ครั้งต่อสัปดาห์)
 * @property int $roundofmount รวมจำนวนครั้งต่อเดือน
 * @property int $priceofmount ราคาต่อเดือน
 * @property int $priceofyear ราคาต่อปี
 * @property int $typebill ออกบิลในนาม
 * @property int $roundprice รอบการชำระเงิน
 * @property string $detail รายละเอียดอื่น ๆ
 * @property string $d_update วันที่บันทึก
 */
class Customerneed extends \yii\db\ActiveRecord {

    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'customerneed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title', 'customername', 'address', 'contact', 'tel', 'customrttype', 'roundofweek', 'roundofmount', 'priceofmount', 'priceofyear', 'typebill', 'roundprice'], 'required'],
            [['customrttype', 'roundofweek', 'roundofmount', 'priceofmount', 'priceofyear', 'typebill', 'roundprice', 'status'], 'integer'],
            [['detail'], 'string'],
            [['d_update'], 'safe'],
            [['title', 'customername', 'address', 'contact', 'dayopen', 'location'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 20],
                //[['verifyCode'], 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {

        return [
            'id' => 'ID',
            'title' => 'เรื่อง',
            'customername' => 'ชื่อสถานบริการ/บริษัท',
            'customrttype' => 'ประเภทสถานพยาบาล',
            'address' => 'ที่อยู่',
            'tel' => 'เบอร์โทรศัพท์สำนักงาน',
            'contact' => 'ชื่อผู้ติดต่อและเบอร์โทรศัพท์',
            'dayopen' => 'วัน - เวลา ที่เปิดทำการ',
            'location' => 'สถานที่ตั้ง',
            'roundofweek' => 'รอบจัดเก็บ (ครั้งต่อสัปดาห์)',
            'roundofmount' => 'รวมจำนวนครั้งต่อเดือน',
            'priceofmount' => 'ราคาต่อเดือน',
            'priceofyear' => 'ราคาต่อปี',
            'typebill' => 'ออกบิลในนาม',
            'roundprice' => 'รอบการชำระเงิน',
            'detail' => 'รายละเอียดอื่น ๆ',
            'd_update' => 'วันที่บันทึก',
            //'verifyCode' => 'Verification Code',
            'status' => 'status'
        ];
    }

}

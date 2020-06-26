<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customerneed".
 *
 * @property int $id
 * @property string|null $code รหัสลูกค้า
 * @property string|null $title เรื่อง
 * @property string|null $customername ชื่อสถานบริการ/บริษัท
 * @property int|null $customrttype ประเภทสถานพยาบาล
 * @property string|null $address ที่อยู่
 * @property string|null $tel เบอร์โทรศัพท์สำนักงาน
 * @property string|null $contact ชื่อผู้ติดต่อและเบอร์โทรศัพท์
 * @property string|null $dayopen วัน - เวลา ที่เปิดทำการ
 * @property string|null $location สถานที่ตั้ง
 * @property int|null $roundofweek รอบจัดเก็บ (ครั้งต่อสัปดาห์)
 * @property int|null $roundofmount รวมจำนวนครั้งต่อเดือน
 * @property int|null $priceofonetime
 * @property int|null $priceofmount ราคาต่อเดือน
 * @property int|null $priceofyear ราคาต่อปี
 * @property int|null $typebill ออกบิลในนาม 1 = นิติบุคคล 2 = บุคคลธรรมดา
 * @property int|null $roundprice รอบการชำระเงิน
 * @property string|null $detail รายละเอียดอื่น ๆ
 * @property int|null $changwat
 * @property int|null $amphur
 * @property int|null $tambon
 * @property string|null $zipcode
 * @property int|null $status 0 = ยังไม่ดำเนินการ 1 = ดำเนินการทำบเสนอราคาแล้ว 2 = ยกเลิก
 * @property string|null $d_update วันที่บันทึก
 * @property int|null $vat 0 = ไม่รวม vat 1 = รวม vat
 * @property string|null $duedate วันที่กำหนดส่งมอบงาน
 * @property int|null $createdittime เครดิตการชำระเงิน
 * @property int|null $numpoint จำนวนจุดจัดเก็บ
 * @property string|null $locationpoint สถานที่จัดเก็บ
 * @property string|null $NO เลขที่ใบเสนอราคา
 * @property string|null $comment เงื่อนไขใบเสนอราคา
 * @property string|null $payment การชำระเงิน
 */
class Customerneed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customerneed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customrttype', 'roundofweek', 'roundofmount', 'priceofonetime', 'priceofmount', 'priceofyear', 'typebill', 'roundprice', 'changwat', 'amphur', 'tambon', 'status', 'vat', 'createdittime', 'numpoint'], 'integer'],
            [['detail', 'locationpoint', 'comment'], 'string'],
            [['d_update', 'duedate'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['title', 'customername', 'address', 'contact', 'dayopen', 'location', 'payment'], 'string', 'max' => 255],
            [['tel', 'NO'], 'string', 'max' => 20],
            [['zipcode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'title' => 'Title',
            'customername' => 'Customername',
            'customrttype' => 'Customrttype',
            'address' => 'Address',
            'tel' => 'Tel',
            'contact' => 'Contact',
            'dayopen' => 'Dayopen',
            'location' => 'Location',
            'roundofweek' => 'Roundofweek',
            'roundofmount' => 'Roundofmount',
            'priceofonetime' => 'Priceofonetime',
            'priceofmount' => 'Priceofmount',
            'priceofyear' => 'Priceofyear',
            'typebill' => 'Typebill',
            'roundprice' => 'Roundprice',
            'detail' => 'Detail',
            'changwat' => 'Changwat',
            'amphur' => 'Amphur',
            'tambon' => 'Tambon',
            'zipcode' => 'Zipcode',
            'status' => 'Status',
            'd_update' => 'D Update',
            'vat' => 'Vat',
            'duedate' => 'Duedate',
            'createdittime' => 'Createdittime',
            'numpoint' => 'Numpoint',
            'locationpoint' => 'Locationpoint',
            'NO' => 'No',
            'comment' => 'Comment',
            'payment' => 'Payment',
        ];
    }
}

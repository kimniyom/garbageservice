<?php

namespace app\modules\promise\models;

use Yii;

/**
 * This is the model class for table "promise".
 *
 * @property string $promiseid เลขที่สัญญา
 * @property string $place สัญญาทำขึ้น ณ
 * @property string $license เลขที่ใบอนุญาต
 * @property string $promisedatebegin วันเริ่มต้นสัญญา
 * @property string $promisedateend วันสิ้นสุดสัญญา
 * @property string $recivetype 0 = รายครั้ง 1 = รายเดือน    
 * @property int $rate คิดค่าจ้างเหมาในอัตราเดือนละ
 * @property string $ratetext คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)
 * @property int $levy จำนวนครั้งที่จัดเก็บต่อเดือน
 * @property string $employer ผู้ว่าจ้าง
 * @property int $payperyear ค่าจ้างรวมทิ้งสิ้นต่อปี
 * @property string $payperyeartext ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)
 * @property string $homenumber บ้านเลขที่
 * @property int $tambon ตำบล
 * @property int $ampur อำเภอ
 * @property int $changwat จังหวัด
 * @property string $createat วันที่ทำสัญญา
 * @property string $contactname ผู้ประสาน
 * @property string $contactphone เบอร์ติดต่อผู้ประสาน
 */
class Promise extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promise';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['promiseid'], 'required'],
            [['promisedatebegin', 'promisedateend', 'createat'], 'safe'],
            [['recivetype'], 'string'],
            [['rate', 'levy', 'payperyear', 'tambon', 'ampur', 'changwat'], 'integer'],
            [['promiseid', 'place', 'ratetext', 'employer', 'payperyeartext', 'contactname'], 'string', 'max' => 64],
            [['license', 'homenumber'], 'string', 'max' => 32],
            [['contactphone'], 'string', 'max' => 15],
            [['promiseid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'promiseid' => 'เลขที่สัญญา',
            'place' => 'สัญญาทำขึ้น ณ',
            'license' => 'เลขที่ใบอนุญาต',
            'promisedatebegin' => 'วันเริ่มต้นสัญญา',
            'promisedateend' => 'วันสิ้นสุดสัญญา',
            'recivetype' => 'ประเภทการจัดเก็บ',
            'rate' => 'คิดค่าจ้างเหมาในอัตราเดือนละ',
            'ratetext' => 'คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)',
            'levy' => 'จำนวนครั้งที่จัดเก็บต่อเดือน',
            'employer' => 'ผู้ว่าจ้าง',
            'payperyear' => 'ค่าจ้างรวมทิ้งสิ้นต่อปี',
            'payperyeartext' => 'ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)',
            'homenumber' => 'บ้านเลขที่',
            'tambon' => 'ตำบล',
            'ampur' => 'อำเภอ',
            'changwat' => 'จังหวัด',
            'createat' => 'วันที่ทำสัญญา',
            'contactname' => 'ผู้ประสาน',
            'contactphone' => 'เบอร์ติดต่อผู้ประสาน',
        ];
    }
}
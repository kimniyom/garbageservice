<?php

namespace app\modules\promise\models;

use Yii;

/**
 * This is the model class for table "promise".
 *
 * @property string $id เลขที่สัญญา
 * @property int $customerid ลูกค้า
 * @property string $promisedatebegin วันเริ่มต้นสัญญา
 * @property string $promisedateend วันสิ้นสุดสัญญา
 * @property string $recivetype 0 = รายครั้ง 1 = รายเดือน	
 * @property int $rate คิดค่าจ้างเหมาในอัตราเดือนละ
 * @property string $ratetext คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)
 * @property int $levy จำนวนครั้งที่จัดเก็บต่อเดือน
 * @property int $payperyear ค่าจ้างรวมทิ้งสิ้นต่อปี
 * @property string $payperyeartext ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)
 * @property string $createat วันที่ทำสัญญา
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
            [['id', 'customerid'], 'required'],
            [['id'], 'unique', 'message'=>'เลขสัญญาซ้ำ'],
            [['customerid', 'rate', 'levy', 'payperyear'], 'integer'],
            [['promisedatebegin', 'promisedateend', 'createat'], 'safe'],
            [['recivetype'], 'string'],
            [['id', 'ratetext', 'payperyeartext'], 'string', 'max' => 64],
            ['ratetext', 'string'], 
            [['id', 'customerid'], 'unique', 'targetAttribute' => ['id', 'customerid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '* เลขที่สัญญา',
            'customerid' => '* ลูกค้า',
            'promisedatebegin' => '* วันเริ่มต้นสัญญา',
            'promisedateend' => '* วันสิ้นสุดสัญญา',
            'recivetype' => '* ประเภทการจ้าง',
            'rate' => '* คิดค่าจ้างเหมาในอัตราเดือนละ',
            'ratetext' => '* คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)',
            'levy' => '* จำนวนครั้งที่จัดเก็บต่อเดือน',
            'payperyear' => '* ค่าจ้างรวมทิ้งสิ้นต่อปี',
            'payperyeartext' => '* ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)',
            'createat' => 'วันที่ทำสัญญา',
        ];
    }
}

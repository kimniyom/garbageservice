<?php

namespace app\modules\promise\models;

use Yii;

/**
 * This is the model class for table "promise".
 *
 * @property string $promisid เลขที่สัญญา
 * @property string $place สัญญาทำขึ้น ณ
 * @property string $license เลขที่ใบอนุญาต
 * @property string $promisedatebegin วันเริ่มต้นสัญญา
 * @property string $promisedateend วันสิ้นสุดสัญญา
 * @property string $recivetype 0 = รายครั้ง 1 = รายเดือน	
 * @property int $rate คิดค่าจ้างเหมาในอัตราเดือนละ
 * @property int $levy จำนวนครั้งที่จัดเก็บต่อเดือน
 * @property string $homenumber บ้านเลขที่
 * @property int $tambon ตำบล
 * @property int $ampur อำเภอ
 * @property int $changwat จังหวัด
 * @property string $createat วันที่ทำสัญญา
 * @property string $employer ผู้ว่าจ้าง
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
            [['promisid'], 'required'],
            [['promisedatebegin', 'promisedateend', 'createat'], 'safe'],
            [['recivetype'], 'string'],
            [['rate', 'levy', 'tambon', 'ampur', 'changwat'], 'integer'],
            [['promisid', 'place', 'employer'], 'string', 'max' => 64],
            [['license', 'homenumber'], 'string', 'max' => 32],
            [['promisid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'promisid' => 'เลขที่สัญญา',
            'place' => 'สัญญาทำขึ้น ณ',
            'license' => 'เลขที่ใบอนุญาต',
            'promisedatebegin' => 'วันเริ่มต้นสัญญา',
            'promisedateend' => 'วันสิ้นสุดสัญญา',
            'recivetype' => '0 = รายครั้ง 1 = รายเดือน	',
            'rate' => 'คิดค่าจ้างเหมาในอัตราเดือนละ',
            'levy' => 'จำนวนครั้งที่จัดเก็บต่อเดือน',
            'homenumber' => 'บ้านเลขที่',
            'tambon' => 'ตำบล',
            'ampur' => 'อำเภอ',
            'changwat' => 'จังหวัด',
            'createat' => 'วันที่ทำสัญญา',
            'employer' => 'ผู้ว่าจ้าง',
        ];
    }
}

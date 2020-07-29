<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roundgarbage_pertime".
 *
 * @property int $id
 * @property int $customerid รหัสลูกค้า
 * @property int $confirmid เลขที่แบบยืนยันลูกค้า
 * @property string $datekeep วันที่เก็บขยะ
 * @property int $round รอบที่
 * @property int $amount ปริมาณขยะ
 * @property string $keepby ผู้เก็บ
 * @property string $status 1=จัดเก็บแล้ว,0=ยังไม่ได้จัดเก็บ
 * @property int $garbageover ปริมาณขยะเกิน
 * @property string $fineprice ค่าปรับเป็นเงิน
 * @property string $d_update วันที่บันทึก
 * @property int $flag สถานะการชำระเงิน 0 = No 1 = Yes
 * @property int $approve เจ้าหน้าที่ยืนยันรายการ
 * @property string $totalprice รวมค่าใช้จ่ายครั้งนั้น
 */
class RoundgarbagePertime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roundgarbage_pertime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customerid', 'confirmid', 'round', 'amount', 'garbageover', 'flag', 'approve'], 'integer'],
            [['datekeep', 'd_update'], 'safe'],
            [['status'], 'string'],
            [['fineprice', 'totalprice'], 'number'],
            [['keepby'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerid' => 'รหัสลูกค้า',
            'confirmid' => 'เลขที่แบบยืนยันลูกค้า',
            'datekeep' => 'วันที่เก็บขยะ',
            'round' => 'รอบที่',
            'amount' => 'ปริมาณขยะ',
            'keepby' => 'ผู้เก็บ',
            'status' => '1=จัดเก็บแล้ว,0=ยังไม่ได้จัดเก็บ',
            'garbageover' => 'ปริมาณขยะเกิน',
            'fineprice' => 'ค่าปรับเป็นเงิน',
            'd_update' => 'วันที่บันทึก',
            'flag' => 'สถานะการชำระเงิน 0 = No 1 = Yes',
            'approve' => 'เจ้าหน้าที่ยืนยันรายการ',
            'totalprice' => 'รวมค่าใช้จ่ายครั้งนั้น',
        ];
    }
}

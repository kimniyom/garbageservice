<?php

namespace app\modules\roundmoney\models;

use Yii;

/**
 * This is the model class for table "roundmoney".
 *
 * @property int $id
 * @property int $promiseid รหัสสัญญา
 * @property string $datekeep วันที่เก็บเงิน
 * @property int $round รอบที่
 * @property int $amount จำนวนเงิน
 * @property string $keepby ผู้เก็บ
 * @property string $status 1=จัดเก็บแล้ว,0=ยังไม่ได้จัดเก็บ
 * @property string $receiptnumber เลขที่ใบเสร็จ
 */
class Roundmoney extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roundmoney';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['promiseid', 'round', 'amount'], 'integer'],
            [['promiseid', 'round', 'amount', 'datekeep','keepby'], 'required'],
            [['datekeep'], 'safe'],
            [['status'], 'string'],
            [['keepby'], 'string', 'max' => 64],
            [['receiptnumber'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promiseid' => 'เลขที่สัญญา',
            'datekeep' => 'วันที่เก็บเงิน',
            'round' => 'รอบที่',
            'amount' => 'จำนวนเงิน',
            'keepby' => 'ผู้เก็บ',
            'status' => 'สถานะการจัดเก็บ',
            'receiptnumber' => 'เลขที่ใบเสร็จ',
        ];
    }
}

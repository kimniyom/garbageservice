<?php

namespace app\modules\roundgarbage\models;

use Yii;

/**
 * This is the model class for table "roundgarbage".
 *
 * @property int $id
 * @property string $datekeep วันที่เก็บขยะ
 * @property int $round รอบที่
 * @property int $amount ปริมาณขยะ
 * @property string $keepby ผู้เก็บ
 * @property string $status 1=จัดเก็บแล้ว,0=ยังไม่ได้จัดเก็บ
 */
class Roundgarbage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roundgarbage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['round', 'amount'], 'integer'],
            [['datekeep'], 'safe'],
            [['status'], 'string'],
            [['keepby'], 'string', 'max' => 64],
            [['promiseid', 'keepby', 'amount', 'datekeep'], 'required'],
            [['promiseid', 'datekeep'], 'unique', 'targetAttribute' => ['promiseid', 'datekeep']]
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
            'datekeep' => 'วันที่เก็บขยะ',
            'round' => 'รอบที่',
            'amount' => 'ปริมาณขยะ',
            'keepby' => 'ผู้เก็บ',
            'status' => 'สถานะการจัดเก็บขยะ',
        ];
    }
}

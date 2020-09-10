<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datekeep".
 *
 * @property int $id
 * @property int $promiseid ไอดีสัญญา
 * @property string $datekeep วันที่เข้าจัดเก็บ
 * @property int|null $status 0=ยังไม่เข้าจัดเก็บ,1=เข้าจัดเก็บแล้ว
 */
class Datekeep extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'datekeep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['promiseid', 'datekeep'], 'required'],
            [['promiseid', 'status'], 'integer'],
            [['datekeep'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'promiseid' => 'ไอดีสัญญา',
            'datekeep' => 'วันที่เข้าจัดเก็บ',
            'status' => '0=ยังไม่เข้าจัดเก็บ,1=เข้าจัดเก็บแล้ว',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packagepayment".
 *
 * @property int $id
 * @property int $packege ประเภทสัญญา
 * @property string $payment รูปแบบการชำระเงิน
 * @property int $distcount 0 = มีส่วนลด 1 = ไม่มีส่วนลด
 * @property int $keepmont เก็บตามน้ำหนักจริง
 */
class Packagepayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packagepayment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['packege', 'distcount', 'keepmont'], 'integer'],
            [['payment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'packege' => 'Packege',
            'payment' => 'Payment',
            'distcount' => 'Distcount',
            'keepmont' => 'Keepmont',
        ];
    }
}

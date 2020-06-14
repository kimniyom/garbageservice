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
 * @property string $typepayment M = รายเดือน ,P = ราย 6 เดือน,Y = ราย
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
            [['packege', 'distcount'], 'integer'],
            [['payment'], 'string', 'max' => 255],
            [['typepayment'], 'string', 'max' => 1],
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
            'typepayment' => 'Typepayment',
        ];
    }
}

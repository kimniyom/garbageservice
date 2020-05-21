<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packagepayment".
 *
 * @property int $id
 * @property int|null $packege ประเภทสัญญา
 * @property string|null $payment
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
            [['packege'], 'integer'],
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
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confirmform_payment".
 *
 * @property int $id
 * @property string $payment ลูกค้าชำระเงิน
 */
class ConfirmformPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confirmform_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment'], 'required'],
            [['payment'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment' => 'ลูกค้าชำระเงิน',
        ];
    }
}

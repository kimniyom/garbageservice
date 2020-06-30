<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confirmform_methodpayment".
 *
 * @property int $id
 * @property string $method วิธีการชำระเงิน
 */
class ConfirmformMethodpayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confirmform_methodpayment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['method'], 'required'],
            [['method'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'method' => 'วิธีการชำระเงิน',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property string $invoicenumber เลขที่ใบเสร็จ
 * @property int $promise เลขสัญญา
 * @property int $round รอบเก็บเงิน
 * @property string $total จำนวนเงิน
 * @property int $status สถานะการชำระเงิน0 = no 1 = yes
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'promise', 'round', 'status'], 'integer'],
            [['total'], 'number'],
            [['invoicenumber'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoicenumber' => 'เลขที่ใบเสร็จ',
            'promise' => 'เลขสัญญา',
            'round' => 'รอบเก็บเงิน',
            'total' => 'จำนวนเงิน',
            'status' => 'สถานะการชำระเงิน0 = no 1 = yes',
        ];
    }
}

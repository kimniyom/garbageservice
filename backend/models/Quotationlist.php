<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotationlist".
 *
 * @property int $id
 * @property int|null $quotation_id รหัสใบเสนอราคา
 * @property string|null $description รายการ
 * @property string|null $periodoftime รอบการจัดเก็บ
 * @property int|null $quantity จำนวน
 * @property string|null $unit หน่วย
 * @property int|null $priceofmonth ราคาเหมาจ่าย
 */
class Quotationlist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotationlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quotation_id', 'quantity', 'priceofmonth'], 'integer'],
            [['description', 'unit'], 'string', 'max' => 255],
            [['periodoftime'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quotation_id' => 'Quotation ID',
            'description' => 'Description',
            'periodoftime' => 'Periodoftime',
            'quantity' => 'Quantity',
            'unit' => 'Unit',
            'priceofmonth' => 'Priceofmonth',
        ];
    }
}

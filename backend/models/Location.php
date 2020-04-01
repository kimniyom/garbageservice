<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $lat
 * @property string $long
 * @property int $customer_id รหัสลูกค้า
 * @property int $zoom
 * @property string $name ชื่อสถานที่
 * @property string $detail รายละเอียด
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'zoom'], 'integer'],
            [['detail'], 'string'],
            [['lat', 'long'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lat' => 'ละจิจูด',
            'long' => 'ลองจิจูด',
            'customer_id' => 'รหัสลูกค้า',
            'zoom' => 'Zoom',
            'name' => 'ชื่อสถานที่',
            'detail' => 'รายละเอียด',
        ];
    }
}

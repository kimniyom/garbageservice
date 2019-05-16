<?php

namespace app\modules\garbagecontainer\models;

use Yii;

/**
 * This is the model class for table "garbagecontainer".
 *
 * @property int $id ไอดี
 * @property string $code รหัสภาชนะ
 * @property string $garbagecontainer ภาชนะใส่ขยะ
 * @property string $size ขนาดของภาชนะ เช่น 18x20
 * @property string $brand ยี่ห้อ
 * @property string $contain ขนาดบรรจุ เช่น 25 กิโลกรัม / มัด
 * @property string $color สีของภาชนะ
 * @property string $detail รายละเอียดของภาชนะ
 * @property string $price ราคาเก็บต่อชิ้น
 */
class Garbagecontainer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'garbagecontainer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['garbagecontainer'], 'required'],
            [['price'], 'number'],
            [['code', 'size', 'color'], 'string', 'max' => 32],
            [['garbagecontainer', 'brand', 'contain'], 'string', 'max' => 255],
            [['detail'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'garbagecontainer' => 'Garbagecontainer',
            'size' => 'Size',
            'brand' => 'Brand',
            'contain' => 'Contain',
            'color' => 'Color',
            'detail' => 'Detail',
            'price' => 'Price',
        ];
    }
}

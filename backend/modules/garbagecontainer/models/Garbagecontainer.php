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
            [['code'],'unique','message'=>'รหัสภาชนะซ้ำ'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'รหัสสินค้า',
            'garbagecontainer' => 'ประเภทสินค้า',
            'size' => 'ขนาดของสินค้า',
            'brand' => 'ยี่ห้อ',
            'contain' => 'ปริมาณที่สินค้าบรรจุได้',
            'color' => 'สี',
            'detail' => 'รายละเอียด',
            'price' => 'ราคา',
        ];
    }
}

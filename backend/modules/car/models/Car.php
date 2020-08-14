<?php

namespace app\modules\car\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string|null $carnumber ทะเบียนรถ
 * @property string|null $detail รายละเอียด
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carnumber'],'required'],
            [['detail'], 'string'],
            [['carnumber'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'carnumber' => 'ทะเบียนรถ',
            'detail' => 'รายละเอียด',
        ];
    }
}

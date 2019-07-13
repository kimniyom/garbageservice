<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "typecustomer".
 *
 * @property int $id
 * @property string $typename ประเภทลูกค้า
 * @property string $typename_en
 * @property string $codenumber จำนวนความกว้างในการลงข้อมูล
 * @property string $description คำอธิบาย
 */
class Typecustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'typecustomer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typename', 'typename_en', 'description'], 'string', 'max' => 255],
            [['codenumber'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typename' => 'ประเภทลูกค้า',
            'typename_en' => 'Typename En',
            'codenumber' => 'จำนวนความกว้างในการลงข้อมูล',
            'description' => 'คำอธิบาย',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tambon".
 *
 * @property int $tambon_id
 * @property string $tambon_code
 * @property string $tambon_name
 * @property int $ampur_id
 * @property int $changwat_id
 * @property int $geo_id
 *
 * @property Ampur $ampur
 */
class Tambon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tambon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tambon_code', 'tambon_name'], 'required'],
            [['ampur_id', 'changwat_id', 'geo_id'], 'integer'],
            [['tambon_code'], 'string', 'max' => 6],
            [['tambon_name'], 'string', 'max' => 150],
            [['ampur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ampur::className(), 'targetAttribute' => ['ampur_id' => 'ampur_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tambon_id' => 'Tambon ID',
            'tambon_code' => 'Tambon Code',
            'tambon_name' => 'Tambon Name',
            'ampur_id' => 'Ampur ID',
            'changwat_id' => 'Changwat ID',
            'geo_id' => 'Geo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmpur()
    {
        return $this->hasOne(Ampur::className(), ['ampur_id' => 'ampur_id']);
    }
}

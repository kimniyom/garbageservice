<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ampur".
 *
 * @property int $ampur_id
 * @property string $ampur_code
 * @property string $ampur_name
 * @property int $geo_id
 * @property int $changwat_id
 *
 * @property Tambon[] $tambons
 */
class Ampur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ampur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ampur_code', 'ampur_name'], 'required'],
            [['geo_id', 'changwat_id'], 'integer'],
            [['ampur_code'], 'string', 'max' => 4],
            [['ampur_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ampur_id' => 'Ampur ID',
            'ampur_code' => 'Ampur Code',
            'ampur_name' => 'Ampur Name',
            'geo_id' => 'Geo ID',
            'changwat_id' => 'Changwat ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTambons()
    {
        return $this->hasMany(Tambon::className(), ['ampur_id' => 'ampur_id']);
    }
}

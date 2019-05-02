<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zipcodes".
 *
 * @property int $id
 * @property string $tambon_code
 * @property string $zipcode
 */
class Zipcodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zipcodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tambon_code', 'zipcode'], 'required'],
            [['tambon_code'], 'string', 'max' => 6],
            [['zipcode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tambon_code' => 'Tambon Code',
            'zipcode' => 'Zipcode',
        ];
    }
}

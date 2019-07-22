<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maspackage".
 *
 * @property int $id
 * @property string $package
 */
class Maspackage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maspackage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['package'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'package' => 'Package',
        ];
    }
}

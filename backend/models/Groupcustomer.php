<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groupcustomer".
 *
 * @property int $id
 * @property string $groupcustomer กลุ่มลูกค้า
 */
class Groupcustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groupcustomer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupcustomer'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'groupcustomer' => 'Groupcustomer',
        ];
    }
}

<?php

namespace app\modules\promise\models;

use Yii;

/**
 * This is the model class for table "vattype".
 *
 * @property int $id
 * @property string $vattype ประเภทการคิด vat
 */
class Vattype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vattype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vattype'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vattype' => 'ประเภทการคิด vat',
        ];
    }
}

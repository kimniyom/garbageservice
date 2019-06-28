<?php

namespace app\modules\navbar\models;

use Yii;

/**
 * This is the model class for table "subnavbar".
 *
 * @property int $id
 * @property string $subnavbar
 * @property int $navbar
 * @property string $detail
 */
class Subnavbar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subnavbar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subnavbar','detail'],'required'],
            [['navbar'], 'integer'],
            [['detail'], 'string'],
            [['subnavbar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subnavbar' => 'หัวข้อ',
            'navbar' => 'Navbar',
            'detail' => 'รายละเอียด',
        ];
    }
}

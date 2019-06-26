<?php

namespace app\modules\navbar\models;

use Yii;

/**
 * This is the model class for table "navbar".
 *
 * @property int $id
 * @property string $navbar
 * @property int $submenu 0 = ไม่มี sub 1 = มีsub
 * @property string $detail
 */
class Navbar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'navbar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'submenu'], 'integer'],
            [['detail'], 'string'],
            [['navbar'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'navbar' => 'Navbar',
            'submenu' => 'Submenu',
            'detail' => 'Detail',
        ];
    }
}

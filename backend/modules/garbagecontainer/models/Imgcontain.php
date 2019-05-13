<?php

namespace app\modules\garbagecontainer\models;

use Yii;

/**
 * This is the model class for table "imgcontain".
 *
 * @property int $id
 * @property string $image ชื่อรูปภาพ
 * @property int $garbagecontainer_id รูปของภาชนะใส่ขยะ
 */
class Imgcontain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imgcontain';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['garbagecontainer_id'], 'integer'],
            [['image'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'garbagecontainer_id' => 'Garbagecontainer ID',
        ];
    }
}

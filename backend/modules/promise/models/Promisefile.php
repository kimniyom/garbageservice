<?php

namespace app\modules\promise\models;

use Yii;

/**
 * This is the model class for table "promisefile".
 *
 * @property int $id
 * @property string $promiseid เลขที่สัญญา
 * @property string $filename ชื่อไฟล์สัญญญาที่อัพโหลด จะเป็นชื่อเดียวกับเลขสัญญา
 * @property string $dateupload วันที่อัพโหลดไฟล์
 * @property int $uploadby user ที่อัพโหลดไฟล์
 */
class Promisefile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promisefile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['promiseid', 'filename'], 'required'],
            [['dateupload'], 'safe'],
            [['uploadby'], 'integer'],
            [['promiseid', 'filename'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'promiseid' => 'เลขที่สัญญา',
            'filename' => 'ชื่อไฟล์สัญญญาที่อัพโหลด จะเป็นชื่อเดียวกับเลขสัญญา',
            'dateupload' => 'วันที่อัพโหลดไฟล์',
            'uploadby' => 'user ที่อัพโหลดไฟล์',
        ];
    }
}

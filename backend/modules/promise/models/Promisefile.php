<?php

namespace app\modules\promise\models;

use Yii;
use app\modules\promise\models\Promisefile;

/**
 * This is the model class for table "promisefile".
 *
 * @property int $id
 * @property string $promiseid เลขที่สัญญา
 * @property string $filename ชื่อไฟล์สัญญญาที่อัพโหลด จะเป็นชื่อเดียวกับเลขสัญญา
 * @property string $dateupload วันที่อัพโหลดไฟล์
 * @property int $uploadby user ที่อัพโหลดไฟล์
 * @property int $status สถานะการใช้งาน 1 คือ ใช้งาน 2 คือ จบการทำงานแล้ว
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
            [['uploadby', 'status'], 'integer'],
            [['promiseid'], 'string', 'max' => 64],
            [['filename'], 'file', 'extensions' => 'pdf','skipOnEmpty' => true],
            [['filename'], 'required', 'on'=>'create'],
            [['filename'],  function ($attribute, $params, $validator) {
                $model = Promisefile::find()->where(['filename'=>$this->$attribute, 'status'=>1])->one();
                if ($model == null) {
                    $this->addError($attribute, $this->$attribute.' ชื่อไฟล์ที่อัพโหลดไม่ตรงกับเลขที่สัญญา');
                }
            }],
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
            'status' => 'สถานะการใช้งาน 1 คือ ใช้งาน 2 คือ จบการทำงานแล้ว',
        ];
    }

    public function filenamecheck($attribute,$params)
    {
        $model = Promisefile::find()->where(['filename'=>$params['filename'], 'status'=>1])->one();
       
            $this->addError($attribute, 'your password is not strong enough!');
    }
}

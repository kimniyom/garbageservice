<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookbank".
 *
 * @property int $id
 * @property string $bookbanknumber เลขที่บัญชี
 * @property string $bookbankname ชื่อบัญชี
 * @property string $branch สาขา
 * @property int $bank ธนคาร
 */
class Bookbank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookbank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank','bookbanknumber','bookbankname','branch'], 'required'],
            [['id', 'bank'], 'integer'],
            [['bookbanknumber'], 'number'],
            [['bookbanknumber'], 'string','min' => 10,'max' => 10],
            [['bookbankname', 'branch'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bookbanknumber' => 'เลขที่บัญชี',
            'bookbankname' => 'ชื่อบัญชี',
            'branch' => 'สาขา',
            'bank' => 'ธนคาร',
        ];
    }
}

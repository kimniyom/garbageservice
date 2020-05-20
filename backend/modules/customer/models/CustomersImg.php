<?php

namespace app\modules\customer\models;

use Yii;

/**
 * This is the model class for table "customers_img".
 *
 * @property int $id
 * @property int $customerid
 * @property string $filename รูปภาพลูกค้า
 * @property string $dateupload
 * @property int $uploadby
 */
class CustomersImg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customerid', 'dateupload', 'uploadby'], 'required'],
            [['customerid', 'uploadby'], 'integer'],
            [['dateupload'], 'safe'],
            [['filename'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['customerid', 'filename'], 'unique', 'targetAttribute' => ['customerid', 'filename']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerid' => 'Customerid',
            'filename' => 'รูปภาพลูกค้า',
            'dateupload' => 'Dateupload',
            'uploadby' => 'Uploadby',
        ];
    }
}

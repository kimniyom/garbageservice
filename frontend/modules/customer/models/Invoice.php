<?php

namespace app\modules\customer\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property string $invoicenumber เลขที่ใบเสร็จ
 * @property int $promise เลขสัญญา
 * @property int $round รอบเก็บเงิน
 * @property string $total จำนวนเงิน
 * @property int $status สถานะการชำระเงิน0 = no 1 = yes 2 รอการยืนยัน
 * @property string $month ใบวางบิลประจำเดือน
 * @property string $year ปี
 * @property string $d_update วันที่บันทึก
 * @property string $timeservice เวลาชำระเงิน
 * @property string $dateservice วันที่ชำระเงิน
 * @property string $comment comment
 * @property int $type ชนิด 1=รายเดือน2=
 * @property string $dateinvoice วันที่ออกใบแจ้งหนี้
 * @property string $datebill วันที่ออกใบเสร็จ
 * @property int $typeinvoice 0 = ค่ากำจัดขยะติดเชื้อ 1 = ค่าบริการขยะส่วนเกิน
 * @property string $slip หลักฐาน
 * @property int $bank ธนาคารที่โอน
 */
class Invoice extends \yii\db\ActiveRecord {

    public $upload_folder = '../uploads/slip';

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['bank'], 'required'],
                [['promise', 'round', 'status', 'type', 'typeinvoice', 'bank'], 'integer'],
                [['total'], 'number'],
                [['d_update', 'dateservice', 'dateinvoice', 'datebill'], 'safe'],
                [['invoicenumber', 'timeservice'], 'string', 'max' => 10],
                [['month'], 'string', 'max' => 2],
                [['year'], 'string', 'max' => 4],
                [['comment'], 'string', 'max' => 255],
                [['slip'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'invoicenumber' => 'เลขที่ใบเสร็จ',
            'promise' => 'เลขสัญญา',
            'round' => 'รอบเก็บเงิน',
            'total' => 'จำนวนเงิน',
            'status' => 'สถานะการชำระเงิน0 = no 1 = yes 2 รอการยืนยัน',
            'month' => 'ใบวางบิลประจำเดือน',
            'year' => 'ปี',
            'd_update' => 'วันที่บันทึก',
            'timeservice' => 'เวลาชำระเงิน',
            'dateservice' => 'วันที่ชำระเงิน',
            'comment' => 'comment',
            'type' => 'ชนิด 1=รายเดือน2=',
            'dateinvoice' => 'วันที่ออกใบแจ้งหนี้',
            'datebill' => 'วันที่ออกใบเสร็จ',
            'typeinvoice' => '0 = ค่ากำจัดขยะติดเชื้อ 1 = ค่าบริการขยะส่วนเกิน',
            'slip' => 'หลักฐาน',
            'bank' => 'ธนาคารที่โอน',
        ];
    }

    public function upload($model, $attribute) {
        $photo = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if ($photo->saveAs($path . $fileName)) {
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . $this->upload_folder . '/';
    }

    public function getUploadUrl() {
        return Yii::getAlias('@web') . '/' . $this->upload_folder . '/';
    }

    public function getPhotoViewer() {
        return empty($this->slip) ? Yii::getAlias('../images') . '/none.png' : $this->getUploadUrl() . $this->slip;
    }

}

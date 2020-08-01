<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice_pertime".
 *
 * @property int $id
 * @property string|null $invoicenumber เลขที่ใบเสร็จ
 * @property int|null $confirmid เลขสัญญา
 * @property int|null $round ครั้งที่เก็บเงิน
 * @property float|null $total จำนวนเงิน
 * @property int|null $status สถานะการชำระเงิน0 = no 1 = yes 2 รอการยืนยัน
 * @property string|null $month ใบวางบิลประจำเดือน
 * @property string|null $year ปี
 * @property string|null $d_update วันที่บันทึก
 * @property string|null $timeservice เวลาชำระเงิน
 * @property string|null $dateservice วันที่ชำระเงิน
 * @property string|null $comment comment
 * @property int|null $type ชนิด 1=รายเดือน2=
 * @property string|null $dateinvoice วันที่ออกใบแจ้งหนี้
 * @property string|null $datebill วันที่ออกใบเสร็จ
 * @property int|null $typeinvoice 0 = ค่ากำจัดขยะติดเชื้อ 1 = ค่าบริการขยะส่วนเกิน
 * @property string|null $slip หลักฐาน
 * @property int|null $bank ธนาคารที่โอน
 */
class InvoicePertime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice_pertime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['confirmid', 'round', 'status', 'type', 'typeinvoice', 'bank'], 'integer'],
            [['total'], 'number'],
            [['d_update', 'dateservice', 'dateinvoice', 'datebill'], 'safe'],
            [['invoicenumber', 'timeservice'], 'string', 'max' => 10],
            [['month'], 'string', 'max' => 2],
            [['year'], 'string', 'max' => 4],
            [['comment'], 'string', 'max' => 255],
            [['slip'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoicenumber' => 'เลขที่ใบเสร็จ',
            'confirmid' => 'เลขสัญญา',
            'round' => 'ครั้งที่เก็บเงิน',
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
}

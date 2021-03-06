<?php

namespace app\modules\promise\models;

use Yii;

/**
 * This is the model class for table "promise".
 *
 * @property string $id เลขที่สัญญา
 * @property int $customerid ลูกค้า
 * @property string $promisedatebegin วันเริ่มต้นสัญญา
 * @property string $promisedateend วันสิ้นสุดสัญญา
 * @property string $recivetype 0 = รายครั้ง 1 = รายเดือน
 * @property int $rate คิดค่าจ้างเหมาในอัตราเดือนละ
 * @property string $ratetext คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)
 * @property int $levy จำนวนครั้งที่จัดเก็บต่อเดือน
 * @property int $payperyear ค่าจ้างรวมทิ้งสิ้นต่อปี
 * @property string $payperyeartext ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)
 * @property string $createat วันที่ทำสัญญา
 *  @property string $active การใช้งาน 1=ใช้งาน 0=ไม่ใช้
 * @property double $garbageweight ปริมาณขยะ (กิโลกรัม)
 * @property string $status สถานะสัญญา 0=หมดสัญญา, 1=รอยืนยัน, 2=กำลังใช้งาน, 3=กำลังต่อสัญญา
 * @property string $checkmoney สถานะการชำระเงิน 0=ยังไม่ได้ชำระ, 1=ชำระเงินแล้ว
 * @property int $monthunit จำนวนเดือน
 * @property int $yearunit จำนวนปี
 * @property int $deposit มัดจำล่วงหน้า
 * @property int $vattype
 **/
class Promise extends \yii\db\ActiveRecord {
	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return 'promise';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[['customerid', 'promisedatebegin', 'promisedateend', 'garbageweight', 'vat'], 'required'],
			['rate', 'required', 'when' => function ($model) {
				return $model->recivetype == 1;
			}, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
			],
			['payperyear', 'required', 'when' => function ($model) {
				return $model->recivetype == 0;
			}, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 0;
                }",
			],
			[['promisenumber'], 'string'],
			[['customerid', 'rate', 'levy', 'payperyear', 'monthunit', 'yearunit'], 'integer'],
			[['promisedatebegin', 'promisedateend', 'createat'], 'safe'],
			[['recivetype', 'active', 'status', 'checkmoney'], 'string'],
			[['garbageweight', 'deposit', 'vat'], 'number'],
			[['ratetext', 'payperyeartext'], 'string', 'max' => 64],
			['ratetext', 'string'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'promisenumber' => 'เลขที่สัญญา',
			'customerid' => 'ลูกค้า',
			'promisedatebegin' => 'วันเริ่มต้นสัญญา',
			'promisedateend' => 'วันสิ้นสุดสัญญา',
			'recivetype' => 'ประเภทการจ้าง',
			'rate' => 'คิดค่าจ้างเหมาในอัตราเดือนละ',
			'ratetext' => 'คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)',
			'levy' => 'จำนวนครั้งที่จัดเก็บต่อเดือน',
			'payperyear' => 'ค่าจ้างรวมทิ้งสิ้นต่อปี',
			'payperyeartext' => 'ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)',
			'createat' => 'วันที่ทำสัญญา',
			'active' => 'สถานะการใช้งาน',
			'garbageweight' => 'ปริมาณขยะ (กิโลกรัม)',
			'status' => 'สถานะสัญญา',
			'checkmoney' => 'สถานะการชำระเงิน',
			'monthunit' => 'ระยะเวลาสัญญารายเดือน',
			'yearunit' => 'จำนวนปี',
			'deposit' => 'มัดจำล่วงหน้า(เดือน)',
			'vat' => 'vat',
		];
	}
}

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
 * @property string $active การใช้งาน 1=ใช้งาน 0=ไม่ใช้
 * @property double $garbageweight ปริมาณขยะ (กิโลกรัม)
 * @property string $status สถานะสัญญา 0=หมดสัญญา, 1=รอยืนยัน, 2=กำลังใช้งาน, 3=กำลังต่อสัญญา
 * @property string $checkmoney สถานะการชำระเงิน 0=ยังไม่ได้ชำระ, 1=ชำระเงินแล้ว
 * @property int $monthunit จำนวนเดือน
 * @property int $yearunit จำนวนปี
 * @property int $deposit มัดจำล่วงหน้า
 * @property int $vattype
 * @property string $employer1 ผู้ว่าจ้างคนที่ 1
 * @property string $employer2 ผู้ว่าจ้างคนที่ 2
 * @property string $witness1 พยานคนที่ 1
 * @property string #witness2 พยานคนที่ 2
 * @property string #datestartystem วันที่เริ่มต้นสัญญาจริง
 * @property string #dateendsystem วันที่สิ้นสุดสัญญาจริง
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
			[['customerid', 'promisedatebegin', 'promisedateend', 'datestartystem', 'dateendsystem', 'vat', 'unitprice', 'payment'], 'required'],
			['rate', 'required', 'when' => function ($model) {
				return $model->recivetype == 1;
			}, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
			],
			['garbageweight', 'required', 'when' => function ($model) {
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
			['fine', 'required', 'when' => function ($model) {
				return $model->recivetype == 1;
			}, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
			],
			['distcountbath', 'required', 'when' => function ($model) {
				return $model->recivetype == 1;
			}, 'whenClient' => "function (attribute, value) {
				return $('#promise-recivetype').val() == 1;
			}",
			],

			['distcountbath', 'required', 'when' => function ($model) {
				return $model->recivetype == 3;
			}, 'whenClient' => "function (attribute, value) {
				return $('#promise-recivetype').val() == 3;
			}",
			],
			['rate', 'integer', 'when' => function ($model) {
				return $model->recivetype == 1 || $model->recivetype == 3;
			}, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
			],
			['payperyear', 'integer', 'when' => function ($model) {
				return $model->recivetype == 1 || $model->recivetype == 3;
			}, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
			],
			['weekinmonth', 'required', 'when' => function ($model) {
				return $model->recivetype == 1 || $model->recivetype == 3;
			}, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
			],
			['etc', 'required', 'when' => function ($model) {
				return $model->status == '4';
			}],
			[['promisenumber', 'employer1', 'employer2', 'witness1', 'witness2'], 'string'],
			[['customerid', 'rate', 'levy', 'payperyear', 'dayinweek',
				'monthunit', 'yearunit', 'unitprice', 'distcountpercent', 'fine', 'payment'], 'integer'],
			[['promisedatebegin', 'promisedateend', 'createat'], 'safe'],
			[['recivetype', 'active', 'status', 'checkmoney', 'etc'], 'string'],
			[['garbageweight', 'deposit', 'vat'], 'number'],
			[['ratetext', 'payperyeartext'], 'string', 'max' => 64],
			['ratetext', 'string'],
			[['distcountbath', 'total'], 'safe'],
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
			'unitprice' => 'ราคาต่อหน่วย',
			'distcountpercent' => 'ส่วนลด %',
			'distcountbath' => 'ส่วนลด(บาท)',
			'total' => 'ราคาหักส่วนลด',
			'fine' => 'ค่าปรับขยะเกิน(กิโลกรัมละ)',
			'etc' => 'สาเหตุที่ยกเลิกสัญญา',
			'dayinweek' => 'วันที่เข้าจัดเก็บ',
			'weekinmonth' => 'สัปดาห์เข้าจัดเก็บ',
			'payment' => 'การชำระเงิน',
			'employer1'=>'ผู้ว่าจ้างคนที่ 1',
			'employer2'=>'ผู้ว่าจ้างคนที่ 2',
			'witness1'=>'พยานคนที่ 1',
			'witness2'=>'พยานคนที่ 2',
			'datestartystem'=>'วันที่เริ่มต้นสัญญาจริง',
			'dateendsystem'=>'วันที่สิ้นสุดสัญญาจริง'
		];
	}

	public function Countnearexpire()
	{
		$sql = "select count(*) as total from promise where DATEDIFF(promisedateend, NOW()) < 30";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		return $rs['total'];
	}

	public function Countwaitapprove()
	{
		$sql = "select count(*) as total from promise where `status`= '1'";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		return $rs['total'];
	}

	public function Countpromiseall()
	{
		$sql = "select count(*) as total from promise where `status`in ('0','2','4')";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		return $rs['total'];
	}
	
	public function Countpromiseusing()
	{
		$sql = "select count(*) as total from promise where `status`= '2'";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		return $rs['total'];
	}

	public function Countpromisepay()
	{
		$sql = "select count(*) as total from promise where `checkmoney`= '1'";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		return $rs['total'];
	}
	
}

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
 * @property string #vattype
 * @property int|null $contracktor 1=นายนิติพัฒน์ 2 = นายอาทิตย์
 * */
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
            [['customerid', 'promisedatebegin', 'promisedateend', 'vat', 'payment', 'createat', 'contracktor'], 'required'],
            ['payperyear', 'required', 'when' => function ($model) {
                    return $model->recivetype == 3;
                }, 'whenClient' => "function (attribute, value) {
                return $('#promise-recivetype').val() == 3;
            }",
            ],
            ['unitprice', 'required', 'when' => function ($model) {
                    return $model->recivetype == 1;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
            ],
            ['unitprice', 'required', 'when' => function ($model) {
                    return $model->recivetype == 2;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 2;
                }",
            ],
            ['rate', 'required', 'when' => function ($model) {
                    return $model->recivetype == 1;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
            ],
            ['rate', 'required', 'when' => function ($model) {
                    return $model->recivetype == 3;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 3;
                }",
            ],
            ['garbageweight', 'required', 'when' => function ($model) {
                    return $model->recivetype == 1;
                }, 'whenClient' => "function (attribute, value) {
										return $('#promise-recivetype').val() == 1;
								}",
            ],
            ['garbageweight', 'required', 'when' => function ($model) {
                    return $model->recivetype == 3;
                }, 'whenClient' => "function (attribute, value) {
                                    return $('#promise-recivetype').val() == 3;
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
            ['fine', 'required', 'when' => function ($model) {
                    return $model->recivetype == 3;
                }, 'whenClient' => "function (attribute, value) {
                return $('#promise-recivetype').val() == 3;
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
            ['rate', 'number', 'when' => function ($model) {
                    return $model->recivetype == 1 || $model->recivetype == 3;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
            ],
            ['payperyear', 'number', 'when' => function ($model) {
                    return $model->recivetype == 1 || $model->recivetype == 3;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#promise-recivetype').val() == 1;
                }",
            ],
            // ['weekinmonth', 'required', 'when' => function ($model) {
            // 	return $model->recivetype == 1 || $model->recivetype == 3;
            // }, 'whenClient' => "function (attribute, value) {
            //         return $('#promise-recivetype').val() == 1;
            //     }",
            // ],
            ['etc', 'required', 'when' => function ($model) {
                    return $model->status == '4';
                }],
            [['promisenumber', 'employer1', 'employer2', 'witness1', 'witness2'], 'string'],
            [['customerid', 'levy', 'dayinweek',
            'monthunit', 'distcountpercent', 'payment', 'vattype', 'contracktor', 'yearunit'], 'integer'],
            [['promisedatebegin', 'promisedateend', 'createat'], 'safe'],
            [['recivetype', 'active', 'status', 'checkmoney', 'etc'], 'string'],
            [['garbageweight', 'deposit', 'vat' , 'unitprice', 'fine' , 'payperyear'], 'number'],
            [['ratetext', 'payperyeartext'], 'string', 'max' => 64],
            [['rate'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
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
            //'weekinmonth' => 'สัปดาห์เข้าจัดเก็บ',
            'payment' => 'การชำระเงิน',
            'employer1' => 'ผู้ว่าจ้างคนที่ 1',
            'employer2' => 'ผู้ว่าจ้างคนที่ 2',
            'witness1' => 'พยานคนที่ 1',
            'witness2' => 'พยานคนที่ 2',
            'vattype' => 'ประเภท vat',
            'contracktor' => 'ผู้รับจ้าง',
        ];
    }

    public function Countnearexpire() {
        $sql = "select count(*) as total from promise where DATEDIFF(promisedateend, NOW()) < 30";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    public function Countwaitapprove() {
        $sql = "select count(*) as total from promise where `status`= '1'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    public function Countpromiseall() {
        $sql = "select count(*) as total from promise where `status`in ('0','2','4')";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    public function Countpromiseusing() {
        $sql = "select count(*) as total from promise where `status`= '2'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    public function Countpromisepay() {
        $sql = "select count(*) as total from promise where `checkmoney`= '1'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    public function GetststusGarbage($daymonth, $promistid = '') {
        $sql = "SELECT COUNT(*) AS total
        FROM roundgarbage r
        WHERE r.promiseid = '$promistid' AND LEFT(r.datekeep,7) = '$daymonth' ";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['total'];
    }

    function contInvoice() {
        $sql = "SELECT count(*) AS total
                    FROM invoice i INNER JOIN promise p ON i.promise = p.id
                    INNER JOIN customers c ON p.customerid = c.id
                    LEFT JOIN roundmoney r ON i.round = r.id
                    WHERE i.`status` = '2' AND i.typepayment = '1'";
        return Yii::$app->db->createCommand($sql)->queryOne()['total'];
    }

    function countCheckInvoice() {
        $sql = "SELECT count(*) AS total
                    FROM invoice i INNER JOIN promise p ON i.promise = p.id
                    INNER JOIN customers c ON p.customerid = c.id
                    LEFT JOIN roundmoney r ON i.round = r.id
                    WHERE i.`status` = '0' AND i.typepayment = '2'";
        return Yii::$app->db->createCommand($sql)->queryOne()['total'];
    }

    function contInvoiceNonActive() {
        $sql = "SELECT count(*) AS total
                    FROM invoice i INNER JOIN promise p ON i.promise = p.id
                    WHERE i.`status` = '0' AND p.status = '2'";
        return Yii::$app->db->createCommand($sql)->queryOne()['total'];
    }

}

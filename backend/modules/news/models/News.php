<?php

namespace app\modules\news\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $ID
 * @property string $TITLE หัวข้อข่าว
 * @property string $CONTENT รายละเอียด
 * @property string $CREATEAT วันที่บันทึก
 * @property string $UPDATEAT วันที่แก้ไข
 * @property int $CREATEBY ผู้สร้าง
 * @property int $UPDATEBY แก้ไข
 * @property string $ISSHOW 0 = ไม่แสดง 1 = แสดง
 * @property int $CATEGORY ประเภท
 */
class News extends \yii\db\ActiveRecord {
	/**
	 * {@inheritdoc}
	 */
	public static function tableName() {
		return 'news';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules() {
		return [
			[['TITLE', 'CONTENT', 'ISSHOW'], 'required'],
			[['TITLE', 'CONTENT', 'ISSHOW'], 'string'],
			[['CREATEAT', 'UPDATEAT'], 'safe'],
			[['CREATEBY', 'UPDATEBY', 'CATEGORY'], 'integer'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels() {
		return [
			'ID' => 'ID',
			'TITLE' => 'หัวข้อข่าว',
			'CONTENT' => 'รายละเอียด',
			'CREATEAT' => 'วันที่บันทึก',
			'UPDATEAT' => 'วันที่แก้ไข',
			'CREATEBY' => 'ผู้สร้าง',
			'UPDATEBY' => 'แก้ไข',
			'ISSHOW' => 'สถานะ',
			'CATEGORY' => 'ประเภท',
		];
	}

	public function getDetail($id) {
		$sql = "SELECT n.*,u.username AS usercreate,us.username AS userupdate
                FROM news n INNER JOIN `user` u ON n.CREATEBY = u.id
                LEFT JOIN `user` us ON n.UPDATEBY = us.id
                WHERE n.ID = '$id' ";
		return Yii::$app->db->createCommand($sql)->queryOne();
	}

	public function linkuploads() {
		$str = str_replace("backend/", "", Yii::$app->request->baseUrl . '/uploads');
		return $str;
	}
}

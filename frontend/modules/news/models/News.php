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
            'ISSHOW' => '0 = ไม่แสดง 1 = แสดง',
            'CATEGORY' => 'ประเภท',
        ];
    }

    function getAlbum($newID) {
        $sql = "select images from gallery where new_id = '$newID' order by id desc limit 1";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs['images'];
    }

    function getDetail($id){
        $sql = "SELECT n.*,c.`name`
                FROM news n  INNER JOIN newcategories c ON n.CATEGORY = c.id
                WHERE n.ID ='$id' AND c.active = 1";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs;
    }

    function getNewsAll($category){
        if(empty($category)){
            $sql = "select n.*,c.name as category_name from news n inner join newcategories c on n.CATEGORY = c.id";
        } else {
            $sql = "select n.*,c.name from news n inner join newcategories c on n.CATEGORY = c.id WHERE n.CATEGORY = '$category' ";
        }

        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function getNewsAllPagination($category,$offset,$limit){
        if(empty($category)){
            $sql = "select n.*,c.name as category_name from news n inner join newcategories c on n.CATEGORY = c.id";
        } else {
            $sql = "select n.*,c.name from news n inner join newcategories c on n.CATEGORY = c.id WHERE n.CATEGORY = '$category' ";
        }

        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function getCategory($id){
        $sql = "select * from newcategories where id = '$id'";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        return $rs;
    }
}

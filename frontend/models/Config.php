<?php
namespace app\models;
use Yii;

class Config {
	function Urlmap() {
		$key = "AIzaSyDM-VJ53keVzveifGvWs8IJ4ynRtHeuEwU";
		return "http://maps.google.com/maps/api/js?v=3&language=th&callback=initialize&key=" . $key;
	}

	function getMenu(){
		$sql = "select * from navbar";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		return $rs;
	}

	function getSubMenu($id){
		$sql = "select * from subnavbar where navbar = '$id'";
		$rs = Yii::$app->db->createCommand($sql)->queryAll();
		return $rs;
	}
}
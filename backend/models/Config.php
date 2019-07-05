<?php
namespace app\models;
use Yii;

class Config {
	function Urlmap() {
		$key = "AIzaSyDM-VJ53keVzveifGvWs8IJ4ynRtHeuEwU";
		return "http://maps.google.com/maps/api/js?v=3&language=th&callback=initialize&key=" . $key;
	}

	function thaidate($dateformat = "") {
		$year = substr($dateformat, 0, 4);
		$month = substr($dateformat, 5, 2);
		$day = substr($dateformat, 8, 2);
		$thai = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

		if (strlen($dateformat) <= 10) {
			return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543);
		} else {
			return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
		}
	}

	function month_full() {
		$thai_month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return $thai_month;
	}

	function getNextId($table, $field, $number) {
		$sql = "select $field from $table order by id desc  limit 1";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		if ($rs) {
			//$digit = explode('-', $lastRecord->id_case);
			$lastDigit = ((int) $rs[$field]); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
			$lastDigit++; //เพิ่ม 1
			$lastDigit = str_pad($lastDigit, $number, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
		} else {
			$lastDigit = '00001';
		}

		return 'IC' . $lastDigit;

	}

}
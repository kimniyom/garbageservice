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
			$digit = explode("IC", $rs[$field]);
			$lastDigit = ((int) $digit); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
			$lastDigit++; //เพิ่ม 1
			$lastDigit = str_pad($lastDigit, $number, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
		} else {
			$lastDigit = '00001';
		}

		return "IC" . $lastDigit;

	}

	function getCustomerCode($table, $field, $number) {
		$sql = "select $field from $table order by id desc limit 1";
		$rs = Yii::$app->db->createCommand($sql)->queryOne();
		if ($rs) {
			$digit = explode("C", $rs[$field]);
			$lastDigit = ((int) $digit); // เปลี่ยน string เป็น integer สำหรับคำนวณ +1
			$lastDigit++; //เพิ่ม 1
			$lastDigit = str_pad($lastDigit, $number, '0', STR_PAD_LEFT); //ใส่ 0 ข้างหน้าหน่อย
		} else {
			$lastDigit = '00001';
		}

		return "C" . $lastDigit;

	}

	function dayInweek($day) {
		$dayInweek = array(
			'0' => 'จันทร์',
			'1' => 'อังคาร',
			'2' => 'พุธ',
			'3' => 'พฤหัสบดี',
			'4' => 'วันศุกร์',
			'5' => 'วันเสาร์',
			'6' => 'วันอาทิตย์',
		);

		return $dayInweek[$day];
	}

	function Convert($amount_number) {
		$amount_number = number_format($amount_number, 2, ".", "");
		$pt = strpos($amount_number, ".");
		$number = $fraction = "";
		if ($pt === false) {
			$number = $amount_number;
		} else {
			$number = substr($amount_number, 0, $pt);
			$fraction = substr($amount_number, $pt + 1);
		}

		$ret = "";
		$baht = $this->ReadNumber($number);
		if ($baht != "") {
			$ret .= $baht . "บาท";
		}

		$satang = $this->ReadNumber($fraction);
		if ($satang != "") {
			$ret .= $satang . "สตางค์";
		} else {
			$ret .= "ถ้วน";
		}

		return $ret;
	}

	function ReadNumber($number) {
		$position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
		$number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
		$number = $number + 0;
		$ret = "";
		if ($number == 0) {
			return $ret;
		}

		if ($number > 1000000) {
			$ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
			$number = intval(fmod($number, 1000000));
		}

		$divider = 100000;
		$pos = 0;
		while ($number > 0) {
			$d = intval($number / $divider);
			$ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
			((($divider == 10) && ($d == 1)) ? "" :
				((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
			$ret .= ($d ? $position_call[$pos] : "");
			$number = $number % $divider;
			$divider = $divider / 10;
			$pos++;
		}
		return $ret;
	}

}
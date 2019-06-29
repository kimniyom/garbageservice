<?php
namespace app\models;

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
}
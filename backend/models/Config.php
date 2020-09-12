<?php

namespace app\models;

use Yii;

class Config {

    function Urlmap() {
        //$key = "AIzaSyDM-VJ53keVzveifGvWs8IJ4ynRtHeuEwU";
        //return "http://maps.google.com/maps/api/js?v=3&language=th&callback=initialize&key=" . $key;
        return "https://api.longdo.com/map/?key=6d4cb793d13a99df240e6e27ebd4f211";
    }

    function thaidate($dateformat = "") {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        $day = substr($dateformat, 8, 2);
        $thai = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        if (strlen($dateformat) <= 10) {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ((int) $year + 543);
        } else {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ((int) $year + 543) . " " . substr($dateformat, 10);
        }
    }

    function thaidateFull($dateformat = "") {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        $day = substr($dateformat, 8, 2);
        $thai = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

        if (strlen($dateformat) <= 10) {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543);
        } else {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
        }
    }

    function thaidatemonth($dateformat = "") {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        //$day = substr($dateformat, 8, 2);
        $thai = Array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

        if (strlen($dateformat) <= 10) {
            return $thaidate = $thai[(int) $month] . " " . ($year + 543);
        } else {
            return $thaidate = $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
        }
    }

    function month_full() {
        $thai_month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $thai_month;
    }

    function month_shot() {
        $thai_month = Array(
            "01" => "ม.ค.",
            "02" => "ก.พ.",
            "03" => "มี.ค.",
            "04" => "เม.ย.",
            "05" => "พ.ค.",
            "06" => "มิ.ย.",
            "07" => "ก.ค.",
            "08" => "ส.ค.",
            "09" => "ก.ย.",
            "10" => "ต.ค.",
            "11" => "พ.ย.",
            "12" => "ธ.ค.",
        );
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

    function dayInweekKeyFull($day) {
        $dayInweek = array(
            'Monday' => 'จันทร์',
            'Tuesday' => 'อังคาร',
            'Wednesday' => 'พุธ',
            'Thursday' => 'พฤหัสบดี',
            'Friday' => 'วันศุกร์',
            'Saturday' => 'วันเสาร์',
            'Sunday' => 'วันอาทิตย์',
        );

        return $dayInweek[$day];
    }

    function Convert($amount_number = "") {
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

        if ($ret == "ถ้วน") {
            $ret = "ศูนย์บาทถ้วน";
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

    function getDiscount($payment) {
        $sql = "select distcount from packagepayment  where id = {$payment}";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        if ($rs) {

            return $rs['distcount'];
        }
        return "";
    }

    function getPaymentMonth($payment) {
        $sql = "select typepayment from packagepayment  where id = {$payment}";
        $rs = Yii::$app->db->createCommand($sql)->queryOne();
        if ($rs) {

            return $rs['typepayment'];
        }
        return "";
    }

    function getStatusPromise($status) {
        //สถานะสัญญา 0=หมดสัญญา, 1=รอยืนยัน, 2=กำลังใช้งาน, 3=กำลังต่อสัญญา ,4=ยกเลิกสัญา
        if ($status == "0") {
            $Textstatus = "<font class='text-success'><i class='fa fa-check'></i> หมดสัญญา / สิ้นสุดสัญญา</font>";
        } else if ($status == "1") {
            $Textstatus = "<font style='color:orange;'><i class='fa fa-info'></i> รอยืนยัน</font>";
        } else if ($status == "2") {
            $Textstatus = "<font style='color:green;'><i class='fa fa-check-square-o'></i> กำลังใช้งาน</font>";
        } else if ($status == "3") {
            $Textstatus = "<font class='text-info'><i class='fa fa-pencil'></i> กำลังต่อสัญญา</font>";
        } else if ($status == "4") {
            $Textstatus = "<font class='text-danger'><i class='fa fa-remove'></i> ยกเลิกสัญา</font>";
        } else {
            $Textstatus = "-";
        }

        return $Textstatus;
    }

}

<?php

namespace app\models;

use Yii;

class Config {

    function Urlmap() {
        //$key = "AIzaSyDM-VJ53keVzveifGvWs8IJ4ynRtHeuEwU";
        //return "http://maps.google.com/maps/api/js?v=3&language=th&callback=initialize&key=" . $key;
        return "https://api.longdo.com/map/?key=6d4cb793d13a99df240e6e27ebd4f211";
    }

    function getMenu() {
        $sql = "select * from navbar";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function getSubMenu($id) {
        $sql = "select * from subnavbar where navbar = '$id'";
        $rs = Yii::$app->db->createCommand($sql)->queryAll();
        return $rs;
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

}

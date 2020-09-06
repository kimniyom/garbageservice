/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : garbagedb

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 06/09/2020 14:04:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for promise
-- ----------------------------
DROP TABLE IF EXISTS `promise`;
CREATE TABLE `promise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promisenumber` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขที่สัญญา',
  `customerid` int(11) NOT NULL COMMENT 'ลูกค้า',
  `promisedatebegin` date DEFAULT NULL COMMENT 'วันเริ่มต้นสัญญา',
  `promisedateend` date DEFAULT NULL COMMENT 'วันสิ้นสุดสัญญา',
  `recivetype` int(11) DEFAULT NULL COMMENT 'ประเภทการจัดเก็บ',
  `rate` decimal(11,2) DEFAULT NULL COMMENT 'คิดค่าจ้างเหมาในอัตราเดือนละ',
  `ratetext` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'คิดค่าจ้างเหมาในอัตราเดือนละ (ตัวอักษร)',
  `levy` int(11) DEFAULT NULL COMMENT 'จำนวนครั้งที่จัดเก็บต่อเดือน',
  `payperyear` int(255) DEFAULT NULL COMMENT 'ค่าจ้างรวมทิ้งสิ้นต่อปี',
  `payperyeartext` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ค่าจ้างรวมทิ้งสิ้นต่อปี (ตัวอักษร)',
  `createat` date DEFAULT NULL COMMENT 'วันที่ทำสัญญา',
  `active` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '1' COMMENT 'การใช้งาน 1=ใช้งาน 0=ไม่ใช้',
  `garbageweight` double DEFAULT NULL COMMENT 'ปริมาณขยะ (กิโลกรัมกนณีเก็บเป็นรายครั้ง)',
  `status` enum('0','1','2','3','4') COLLATE utf8_unicode_ci DEFAULT '1' COMMENT 'สถานะสัญญา 0=หมดสัญญา, 1=รอยืนยัน, 2=กำลังใช้งาน, 3=กำลังต่อสัญญา ,4=ยกเลิกสัญา',
  `checkmoney` enum('0','1') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สถานะการชำระเงิน 0=ยังไม่ได้ชำระ, 1=ชำระเงินแล้ว',
  `monthunit` int(11) DEFAULT NULL COMMENT 'จำนวนเดือน',
  `yearunit` int(11) DEFAULT NULL COMMENT 'จำนวนปี(ที่ทำสัญญา)',
  `deposit` int(2) DEFAULT NULL COMMENT 'มัดจำล่วงหน้า(เดือน)',
  `vat` int(11) DEFAULT '0' COMMENT '0 = ไม่มี vat 1 = มี vat',
  `unitprice` int(11) DEFAULT NULL COMMENT 'ราคาต่อหน่วย',
  `distcountpercent` int(3) DEFAULT '0' COMMENT 'ส่วนลด %',
  `distcountbath` decimal(7,2) DEFAULT '0.00' COMMENT 'ส่วนลด(บาท)',
  `total` decimal(7,2) DEFAULT NULL COMMENT 'ราคาหลังหักส่วนลด(บาท)',
  `fine` int(10) DEFAULT NULL COMMENT 'ค่าปรับกรณีเก็บเกิน(กิโลกรัมละ)',
  `etc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุที่ยกเลิกสัญญา',
  `dayinweek` int(11) DEFAULT NULL COMMENT 'วันในสัปดาห์ที่จัดเก็บ',
  `weekinmonth` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สัปดาห์ในเดือนที่จัดเก็บ',
  `payment` int(1) DEFAULT '0' COMMENT 'ประเภทการชำระเงิน 0 = แบ่งจ่ายรายเดือน,รายครั้ง 1 = จ่ายทั้งหมดครั้งเดียว',
  `employer1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผู้ว่าจ้างคนที่ 1',
  `employer2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผู้ว่าจ้างคนที่ 2',
  `witness1` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'พยานคนที่ 1',
  `witness2` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'พยานคนที่ 2',
  `vattype` int(11) DEFAULT '1' COMMENT ' 1=รวมvat,2=ไม่รวมvat',
  `flag` int(1) DEFAULT '0' COMMENT '1 = ทำสัญญาให้เครือข่าย',
  `upper` int(11) DEFAULT NULL COMMENT 'แม่ข่ายที่ออกสัญญาให้กับลูกข่าย',
  `contracktor` int(11) DEFAULT NULL COMMENT '1=นายนิติพัฒน์ 2 = นายอาทิตย์',
  PRIMARY KEY (`id`),
  KEY `customerid` (`customerid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ตารางสัญญาจ้าง';

SET FOREIGN_KEY_CHECKS = 1;

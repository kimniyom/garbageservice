/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-08-21 18:21:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `confirmform`
-- ----------------------------
DROP TABLE IF EXISTS `confirmform`;
CREATE TABLE `confirmform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `confirmformnumber` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขที่แบบฟอร์ม',
  `customerneedid` int(11) NOT NULL COMMENT 'รหัสใบเสนอราคา',
  `roundkeep_sunday` tinyint(6) DEFAULT NULL COMMENT 'วันอาทิตย์',
  `roundkeep_monday` tinyint(6) DEFAULT NULL COMMENT 'วันจันทร์',
  `roundkeep_tueday` tinyint(6) DEFAULT NULL COMMENT 'วันอังคาร',
  `roundkeep_wednesday` tinyint(6) DEFAULT NULL COMMENT 'วันพุธ',
  `roundkeep_thursday` tinyint(6) DEFAULT NULL COMMENT 'วันพฤหัส',
  `roundkeep_friday` tinyint(6) DEFAULT NULL COMMENT 'วันศุกร์',
  `roundkeep_saturday` tinyint(6) DEFAULT NULL COMMENT 'วันเสาร์',
  `roundkeep_day` date DEFAULT NULL COMMENT 'วันที่เข้าจัดเก็บขยะ',
  `timeperiod_morning` tinyint(11) DEFAULT NULL COMMENT 'ช่วงเวลาที่เข้าจัดเก็บ ช่วงเช้า',
  `timeperiod_affternoon` tinyint(6) DEFAULT NULL COMMENT 'ช่วงเวลาที่เข้าจัดเก็บ ช่วงบ่าย',
  `timeperiod_time` time DEFAULT NULL COMMENT 'ระบุเวลา',
  `billdoc_originalinvoice` tinyint(6) DEFAULT NULL COMMENT 'ต้นฉบับใบวางบิล/ใบแจ้งหนี้',
  `billdoc_copyofinvoice` tinyint(6) DEFAULT NULL COMMENT 'สำเนาใบวางบิล/ใบแจ้งหนี้',
  `billdoc_originalreceipt` tinyint(6) DEFAULT NULL COMMENT 'ต้นฉบับใบเสร็จรับเงิน/กำกับภาษี',
  `billdoc_copyofreceipt` tinyint(6) DEFAULT NULL COMMENT 'สำเนาใบเสร็จรับเงิน/ใบกำกับภาษี',
  `billdoc_copyofbank` tinyint(6) DEFAULT NULL COMMENT 'สำเนาเลขที่บัญชีธนาคารเพื่อให้ลูกค้าโอนเงิน',
  `billdoc_etc` tinyint(6) DEFAULT NULL,
  `billdoc_etctext` text COLLATE utf8_unicode_ci COMMENT 'อื่น ๆ ระบุ',
  `cyclekeepmoney` date NOT NULL COMMENT 'รอบการวางบิล/ชำระเงินของลูกค้าของทุกเดือน',
  `paymentschedule` int(11) NOT NULL COMMENT 'กำหนดการชำระเงิน',
  `methodpeyment` int(11) NOT NULL COMMENT 'วิธีการชำระเงิน',
  `senddoc_finance` tinyint(11) DEFAULT NULL COMMENT 'ส่งเอกสารให้บัญชี/การเงิน',
  `senddoc_customer` tinyint(4) DEFAULT NULL COMMENT 'ส่งเอกสารให้ลูกค้า',
  `department` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'แผนก/หน่วยงาน',
  `amount` int(11) DEFAULT NULL COMMENT 'จำนวนครั้งที่จัดเก็บ',
  `status` tinyint(4) DEFAULT NULL COMMENT 'สถานะการใช้งาน 1 คือ ยังไม่จบกระบวนการ 2 คือ จบกระบวนการแล้ว',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confirmform
-- ----------------------------
INSERT INTO `confirmform` VALUES ('1', 'ICP00001', '1', '1', '0', '0', '0', '0', '0', '0', null, '0', '0', null, '1', '0', '0', '0', '0', '0', '', '2020-08-20', '1', '1', '1', '0', 'ฝ่ายบุคคล', '2', '1');

-- ----------------------------
-- Table structure for `confirmform_methodpayment`
-- ----------------------------
DROP TABLE IF EXISTS `confirmform_methodpayment`;
CREATE TABLE `confirmform_methodpayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'วิธีการชำระเงิน',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confirmform_methodpayment
-- ----------------------------
INSERT INTO `confirmform_methodpayment` VALUES ('1', 'โอนเงินเข้าบัญชีธนาคาร');
INSERT INTO `confirmform_methodpayment` VALUES ('2', 'จ่ายเช็ค/เงินสด');

-- ----------------------------
-- Table structure for `confirmform_payment`
-- ----------------------------
DROP TABLE IF EXISTS `confirmform_payment`;
CREATE TABLE `confirmform_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ลูกค้าชำระเงิน',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confirmform_payment
-- ----------------------------
INSERT INTO `confirmform_payment` VALUES ('1', 'ชำระพร้อมกับวันที่เข้าจัดเก็บ');
INSERT INTO `confirmform_payment` VALUES ('2', 'ชำระภายใน 30 วัน');

-- ----------------------------
-- Table structure for `invoice_pertime`
-- ----------------------------
DROP TABLE IF EXISTS `invoice_pertime`;
CREATE TABLE `invoice_pertime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoicenumber` varchar(10) DEFAULT NULL COMMENT 'เลขที่ใบเสร็จ',
  `confirmid` int(11) DEFAULT NULL COMMENT 'เลขสัญญา',
  `round` int(10) DEFAULT NULL COMMENT 'ครั้งที่เก็บเงิน',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนเงิน',
  `status` int(1) DEFAULT '0' COMMENT 'สถานะการชำระเงิน0 = no 1 = yes 2 รอการยืนยัน',
  `month` varchar(2) DEFAULT NULL COMMENT 'ใบวางบิลประจำเดือน',
  `year` varchar(4) DEFAULT NULL COMMENT 'ปี',
  `d_update` timestamp NULL DEFAULT NULL COMMENT 'วันที่บันทึก',
  `timeservice` varchar(10) DEFAULT NULL COMMENT 'เวลาชำระเงิน',
  `dateservice` date DEFAULT NULL COMMENT 'วันที่ชำระเงิน',
  `comment` varchar(255) DEFAULT NULL COMMENT 'comment',
  `type` int(11) DEFAULT NULL COMMENT 'ชนิด 1=รายเดือน2=',
  `dateinvoice` date DEFAULT NULL COMMENT 'วันที่ออกใบแจ้งหนี้',
  `datebill` date DEFAULT NULL COMMENT 'วันที่ออกใบเสร็จ',
  `typeinvoice` int(1) DEFAULT NULL COMMENT '0 = ค่ากำจัดขยะติดเชื้อ 1 = ค่าบริการขยะส่วนเกิน',
  `slip` varchar(100) DEFAULT NULL COMMENT 'หลักฐาน',
  `bank` int(3) DEFAULT NULL COMMENT 'ธนาคารที่โอน',
  `discount` decimal(10,0) DEFAULT '0' COMMENT 'ส่วนลด',
  `deposit` decimal(10,0) DEFAULT NULL COMMENT 'มัดจำ',
  `credit` int(11) DEFAULT NULL COMMENT 'เครดิตวันชำระเงิน',
  `checkdateinvoice` int(11) DEFAULT NULL COMMENT '1 = invoice เอาวันที่',
  `checkdatebill` int(11) DEFAULT NULL COMMENT '1 = bill เอาวันที่',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บใบแจ้งหนี้ / ใบเสร็จ';

-- ----------------------------
-- Records of invoice_pertime
-- ----------------------------

-- ----------------------------
-- Table structure for `roundgarbage_pertime`
-- ----------------------------
DROP TABLE IF EXISTS `roundgarbage_pertime`;
CREATE TABLE `roundgarbage_pertime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerneedid` int(11) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `confirmid` int(11) DEFAULT NULL COMMENT 'เลขที่แบบยืนยันลูกค้า',
  `datekeep` date DEFAULT NULL COMMENT 'วันที่เก็บขยะ',
  `round` int(11) DEFAULT NULL COMMENT 'รอบที่',
  `amount` int(11) DEFAULT NULL COMMENT 'ปริมาณขยะ',
  `keepby` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผู้เก็บ',
  `status` enum('1','0') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '1=จัดเก็บแล้ว,0=ยังไม่ได้จัดเก็บ',
  `garbageover` int(7) DEFAULT NULL COMMENT 'ปริมาณขยะเกิน',
  `fineprice` decimal(10,2) DEFAULT NULL COMMENT 'ค่าปรับเป็นเงิน',
  `d_update` timestamp NULL DEFAULT NULL COMMENT 'วันที่บันทึก',
  `flag` int(1) DEFAULT '0' COMMENT 'สถานะการชำระเงิน 0 = No 1 = Yes',
  `approve` int(3) DEFAULT NULL COMMENT 'เจ้าหน้าที่ยืนยันรายการ',
  `totalprice` decimal(10,2) DEFAULT '0.00' COMMENT 'รวมค่าใช้จ่ายครั้งนั้น',
  `car` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รถเก็บขยะ',
  `timekeepin` time DEFAULT NULL COMMENT 'เวลาเข้าเก็บ',
  `timekeepout` time DEFAULT NULL COMMENT 'เวลาออก',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ตารางรอบการเก็บขยะ';

-- ----------------------------
-- Records of roundgarbage_pertime
-- ----------------------------
INSERT INTO `roundgarbage_pertime` VALUES ('1', '1', '1', '2020-08-20', null, '20', '2', '1', '0', null, '2020-08-20 06:17:27', '0', null, '0.00', 'กง-10100 ปทุมธานี', '11:15:00', '11:15:00');
INSERT INTO `roundgarbage_pertime` VALUES ('2', '1', '1', '2020-08-21', null, '30', '2', '1', null, null, '2020-08-21 09:57:12', '0', null, '0.00', 'กง-10100 ปทุมธานี', '14:57:00', '14:57:00');

-- ----------------------------
-- Table structure for `roundmoney_pertime`
-- ----------------------------
DROP TABLE IF EXISTS `roundmoney_pertime`;
CREATE TABLE `roundmoney_pertime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerneedid` int(11) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `confirmid` int(11) DEFAULT NULL COMMENT 'เลขที่แบบยืนยัน',
  `datekeep` date DEFAULT NULL COMMENT 'วันที่เก็บเงิน',
  `round` int(11) DEFAULT NULL COMMENT 'รอบที่',
  `amount` int(11) DEFAULT NULL COMMENT 'จำนวนเงิน',
  `keepby` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผู้เก็บ',
  `status` enum('1','3','0') COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '1=จัดเก็บแล้ว,0=ยังไม่ได้จัดเก็บ,3 = สัญญายกเลิก',
  `receiptnumber` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เลขที่ใบเสร็จ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='รอบการเก็บเงิน';

-- ----------------------------
-- Records of roundmoney_pertime
-- ----------------------------

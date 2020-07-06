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

 Date: 06/07/2020 15:27:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for confirmform
-- ----------------------------
DROP TABLE IF EXISTS `confirmform`;
CREATE TABLE `confirmform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `confirmformnumber` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เลขที่แบบฟอร์ม',
  `customerid` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `typeform` int(11) NOT NULL COMMENT 'ประเภทฟอร์ม',
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of confirmform
-- ----------------------------
BEGIN;
INSERT INTO `confirmform` VALUES (1, NULL, 10, 0, 1, 1, 1, 1, 1, 1, 1, '2020-06-30', 1, 1, '15:26:00', 1, 1, 1, 1, 1, 1, 'กหดกหดกห', '2020-07-01', 1, 1, 1, 1, 'ฝ่ายบุคคล');
INSERT INTO `confirmform` VALUES (2, NULL, 10, 0, 1, 1, 0, 0, 0, 0, 0, '2020-06-30', 1, 0, '15:12:00', 1, 1, 0, 0, 0, 0, '', '2020-06-30', 1, 1, 1, 1, NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

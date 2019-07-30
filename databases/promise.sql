/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : 127.0.0.1
 Source Database       : garbagedb

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 07/30/2019 10:06:43 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `promise`
-- ----------------------------
DROP TABLE IF EXISTS `promise`;
CREATE TABLE `promise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promisenumber` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขที่สัญญา',
  `customerid` int(11) NOT NULL COMMENT 'ลูกค้า',
  `promisedatebegin` date DEFAULT NULL COMMENT 'วันเริ่มต้นสัญญา',
  `promisedateend` date DEFAULT NULL COMMENT 'วันสิ้นสุดสัญญา',
  `recivetype` int(11) DEFAULT NULL COMMENT 'ประเภทการจัดเก็บ',
  `rate` int(11) DEFAULT NULL COMMENT 'คิดค่าจ้างเหมาในอัตราเดือนละ',
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
  `distcountpercent` int(3) DEFAULT NULL COMMENT 'ส่วนลด %',
  `distcountbath` decimal(7,2) DEFAULT NULL COMMENT 'ส่วนลด(บาท)',
  `total` decimal(7,2) DEFAULT NULL COMMENT 'ราคาหลังหักส่วนลด(บาท)',
  `fine` int(10) DEFAULT NULL COMMENT 'ค่าปรับกรณีเก็บเกิน(กิโลกรัมละ)',
  `etc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุที่ยกเลิกสัญญา',
  `dayinweek` int(11) DEFAULT NULL COMMENT 'วันในสัปดาห์ที่จัดเก็บ',
  `weekinmonth` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'สัปดาห์ในเดือนที่จัดเก็บ',
  `payment` int(1) DEFAULT '0' COMMENT 'ประเภทการชำระเงิน 0 = แบ่งจ่ายรายเดือน,รายครั้ง 1 = จ่ายทั้งหมดครั้งเดียว',
  PRIMARY KEY (`id`),
  KEY `customerid` (`customerid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ตารางสัญญาจ้าง';

-- ----------------------------
--  Records of `promise`
-- ----------------------------
BEGIN;
INSERT INTO `promise` VALUES ('7', 'IC00002', '1', '2019-07-15', '2019-10-30', '1', '1000', null, '1', null, null, '2019-07-07', '1', '100', '1', null, null, '1', '2', '1', null, null, null, null, null, null, null, null, '0'), ('8', 'IC00002', '5', '2019-07-14', '2019-07-31', '1', '1000', null, '1', null, null, '2019-07-13', '1', '100', '1', null, null, '1', '1', '0', null, null, null, null, null, null, null, null, '0'), ('9', 'IC00002', '7', '2019-07-23', '2020-07-23', '1', '100', null, '1', '1116', null, '2019-07-23', '1', '10', '1', null, null, '1', null, '1', '100', '5', '55.80', '1060.20', '15', null, null, null, '0'), ('10', 'IC00003', '4', '2019-08-01', '2020-07-31', '3', '1000', null, '2', '11160', null, '2019-07-23', '1', null, '2', null, null, '1', null, '1', '500', '10', '1116.00', '10044.00', null, null, null, null, '0'), ('11', 'IC00004', '3', '2019-08-01', '2020-07-31', '1', '400', null, '2', '4800', null, '2019-07-25', '1', '10', '1', null, null, '1', null, '0', '200', '10', '480.00', '4320.00', '15', null, '1', '1,2', '0'), ('12', 'IC00005', '2', '2019-08-01', '2020-07-31', '1', '460', null, '2', '5520', null, '2019-07-25', '1', '20', '1', null, null, '1', null, '0', '230', '0', '0.00', '5520.00', '15', null, '3', '1,4', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

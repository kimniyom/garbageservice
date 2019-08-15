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

 Date: 08/15/2019 15:53:57 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `roundgarbage`
-- ----------------------------
DROP TABLE IF EXISTS `roundgarbage`;
CREATE TABLE `roundgarbage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `promiseid` int(11) DEFAULT NULL COMMENT 'เลขที่สัญญา',
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ตารางรอบการเก็บขยะ';

-- ----------------------------
--  Records of `roundgarbage`
-- ----------------------------
BEGIN;
INSERT INTO `roundgarbage` VALUES ('1', null, '10', '2019-07-29', '1', '21', '2', '1', null, null, '2019-08-15 15:26:33', '0', null, '0.00'), ('2', null, '10', '2019-07-19', '2', '10', '2', '1', null, null, '2019-08-15 15:29:44', '0', null, '0.00'), ('3', null, '10', '2019-08-31', '3', null, null, '0', null, null, null, '0', null, '0.00'), ('4', null, '10', '2019-09-20', '4', null, null, '0', null, null, null, '0', null, '0.00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

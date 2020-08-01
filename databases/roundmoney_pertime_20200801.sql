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

 Date: 01/08/2020 15:33:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for roundmoney_pertime
-- ----------------------------
DROP TABLE IF EXISTS `roundmoney_pertime`;
CREATE TABLE `roundmoney_pertime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `confirmid` int(11) DEFAULT NULL COMMENT 'เลขที่แบบยืนยัน',
  `datekeep` date DEFAULT NULL COMMENT 'วันที่เก็บเงิน',
  `round` int(11) DEFAULT NULL COMMENT 'รอบที่',
  `amount` int(11) DEFAULT NULL COMMENT 'จำนวนเงิน',
  `keepby` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผู้เก็บ',
  `status` enum('1','3','0') COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '1=จัดเก็บแล้ว,0=ยังไม่ได้จัดเก็บ,3 = สัญญายกเลิก',
  `receiptnumber` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เลขที่ใบเสร็จ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=554 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='รอบการเก็บเงิน';

SET FOREIGN_KEY_CHECKS = 1;

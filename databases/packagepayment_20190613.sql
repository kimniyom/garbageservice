/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-06-14 11:31:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `packagepayment`
-- ----------------------------
DROP TABLE IF EXISTS `packagepayment`;
CREATE TABLE `packagepayment` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `packege` int(3) DEFAULT NULL COMMENT 'ประเภทสัญญา',
  `payment` varchar(255) DEFAULT '' COMMENT 'รูปแบบการชำระเงิน',
  `distcount` int(1) DEFAULT '0' COMMENT '0 = มีส่วนลด 1 = ไม่มีส่วนลด',
  `typepayment` char(1) DEFAULT NULL COMMENT 'M = รายเดือน ,P = ราย 6 เดือน,Y = ราย',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='การชำระเงิน';

-- ----------------------------
-- Records of packagepayment
-- ----------------------------
INSERT INTO `packagepayment` VALUES ('1', '1', 'แบ่งจ่ายรายเดือน', '0', 'M');
INSERT INTO `packagepayment` VALUES ('2', '2', 'แบ่งจ่ายรายเดือน / รายครั้ง', '0', 'M');
INSERT INTO `packagepayment` VALUES ('3', '3', 'แบ่งจ่ายรายเดือน', '0', 'M');
INSERT INTO `packagepayment` VALUES ('5', '3', 'จ่ายราย 6 เดือน', '0', 'P');
INSERT INTO `packagepayment` VALUES ('6', '3', 'เหมาจ่ายรายปี', '1', 'Y');
INSERT INTO `packagepayment` VALUES ('7', '1', 'รายครั้ง / เหมา', '1', 'Y');

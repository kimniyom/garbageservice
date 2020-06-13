/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-06-13 11:37:26
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
  `keepmont` int(11) DEFAULT NULL COMMENT 'เก็บตามน้ำหนักจริง',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='การชำระเงิน';

-- ----------------------------
-- Records of packagepayment
-- ----------------------------
INSERT INTO `packagepayment` VALUES ('1', '1', 'แบ่งจ่ายรายเดือน', '0', '1');
INSERT INTO `packagepayment` VALUES ('2', '2', 'แบ่งจ่ายรายเดือน / รายครั้ง', '0', '0');
INSERT INTO `packagepayment` VALUES ('3', '3', 'แบ่งจ่ายรายเดือน', '0', '1');
INSERT INTO `packagepayment` VALUES ('5', '3', 'จ่ายราย 6 เดือน', '0', '0');
INSERT INTO `packagepayment` VALUES ('6', '3', 'เหมาจ่ายรายปี', '1', '0');
INSERT INTO `packagepayment` VALUES ('7', '1', 'รายครั้ง / เหมา', '1', '0');

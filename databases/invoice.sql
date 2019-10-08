/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-10-09 01:31:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `invoice`
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoicenumber` varchar(10) DEFAULT NULL COMMENT 'เลขที่ใบเสร็จ',
  `promise` int(11) DEFAULT NULL COMMENT 'เลขสัญญา',
  `round` int(10) DEFAULT NULL COMMENT 'รอบเก็บเงิน',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนเงิน',
  `status` int(1) DEFAULT '0' COMMENT 'สถานะการชำระเงิน0 = no 1 = yes',
  `month` varchar(2) DEFAULT NULL COMMENT 'ใบวางบิลประจำเดือน',
  `year` varchar(4) DEFAULT NULL COMMENT 'ปี',
  `d_update` timestamp NULL DEFAULT NULL COMMENT 'วันที่บันทึก',
  `timeservice` varchar(10) DEFAULT NULL COMMENT 'เวลาชำระเงิน',
  `dateservice` date DEFAULT NULL COMMENT 'วันที่ชำระเงิน',
  `comment` varchar(255) DEFAULT NULL COMMENT 'comment',
  `type` int(11) DEFAULT NULL COMMENT 'ชนิด 1=รายเดือน2=',
  `dateinvoice` date DEFAULT NULL COMMENT 'วันที่ออกใบแจ้งหนี้',
  `datebill` date DEFAULT NULL COMMENT 'วันที่ออกใบเสร็จ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บใบแจ้งหนี้ / ใบเสร็จ';

-- ----------------------------
-- Records of invoice
-- ----------------------------
INSERT INTO `invoice` VALUES ('1', 'INV00001', '10', '109', '1000.00', '1', null, null, '2019-08-29 14:40:39', '14:40', '2019-08-29', 'ชำระค่าบริการ', null, null, null);
INSERT INTO `invoice` VALUES ('2', 'INV00002', '13', '145', '250.00', '0', '09', '2019', null, null, null, null, null, null, null);
INSERT INTO `invoice` VALUES ('3', 'INV00003', '7', '52', '200.00', '1', '10', '2019', '2019-09-07 06:02:17', '11:01', '2019-09-07', 'ยืนยันการโอน', null, null, null);
INSERT INTO `invoice` VALUES ('4', 'INV00004', '15', '169', '200.00', '0', '09', '2019', '2019-09-07 09:43:03', null, null, null, null, null, null);
INSERT INTO `invoice` VALUES ('5', 'INV00005', '16', '181', '150.00', '1', '09', '2019', '2019-09-07 10:03:45', '14:56', '2019-09-08', '', null, null, null);
INSERT INTO `invoice` VALUES ('7', 'INV00006', '18', '206', '1000.00', '1', '11', '2019', '2019-09-07 13:12:23', '18:11', '2019-09-07', 'ชำระเงินเดือนตุลา พฤศจิ', null, null, null);
INSERT INTO `invoice` VALUES ('8', 'INV00007', '7', '49', '200.00', '0', '07', '2019', '2019-10-08 20:25:59', null, null, null, null, null, '2019-10-08');

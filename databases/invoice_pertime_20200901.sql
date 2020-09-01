/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-09-01 14:28:22
*/

SET FOREIGN_KEY_CHECKS=0;

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
  `dateconfirm` datetime DEFAULT NULL COMMENT 'วันที่เจ้าหน้าที่ยืนยัน',
  `typepayment` int(11) DEFAULT NULL COMMENT 'ประเภทยืนยัน 1 = ผ่านระบบ 2 ผ่านช่องทางอื่น ๆ',
  `userid` int(11) DEFAULT NULL COMMENT 'รหัสเจ้าหน้าที่ยืนยัน',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บใบแจ้งหนี้ / ใบเสร็จ';

-- ----------------------------
-- Records of invoice_pertime
-- ----------------------------
INSERT INTO `invoice_pertime` VALUES ('5', 'INVP00001', '4', null, '214.00', '0', null, null, '2020-08-31 13:34:58', null, null, null, null, '2020-08-31', '2020-08-31', null, null, null, '10', '20', '30', null, null, null, null, null);
INSERT INTO `invoice_pertime` VALUES ('6', 'INVP00002', '6', null, '107.00', '0', null, null, '2020-09-01 09:23:25', null, null, null, null, '2020-09-01', '2020-09-01', null, '01092020092440d90de65e7347dcbf5ed3feb02ba6714d.png', null, '0', '0', null, null, null, '2020-09-01 09:24:40', null, null);

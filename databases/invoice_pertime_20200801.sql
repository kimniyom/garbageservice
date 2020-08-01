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

 Date: 01/08/2020 15:32:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for invoice_pertime
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บใบแจ้งหนี้ / ใบเสร็จ';

SET FOREIGN_KEY_CHECKS = 1;

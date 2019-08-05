/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-08-05 14:01:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `customers`
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) DEFAULT NULL COMMENT 'ชื่อบริษัท',
  `taxnumber` varchar(20) DEFAULT NULL COMMENT 'เลขภาษีหรือเลขสถานบริการที่บ่งบอกถึงลูกค้ารายนั้น ๆ ห้ามซ้ำ',
  `address` varchar(255) DEFAULT NULL COMMENT 'ที่อยู่',
  `changwat` varchar(10) DEFAULT NULL COMMENT 'จังหวัด',
  `ampur` varchar(10) DEFAULT NULL COMMENT 'อำเภอ',
  `tambon` varchar(10) DEFAULT NULL COMMENT 'ตำบล',
  `zipcode` varchar(5) DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
  `manager` varchar(100) DEFAULT NULL COMMENT 'ผู้จัดการ',
  `tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `telephone` varchar(20) DEFAULT NULL COMMENT 'มือถือ',
  `flag` enum('1','0') DEFAULT '1' COMMENT 'การเปิดใช้งาน 0 = Unactive, 1 = Active',
  `create_date` timestamp NULL DEFAULT NULL COMMENT 'วันที่ลงทะเบียน',
  `update_date` timestamp NULL DEFAULT NULL COMMENT 'แก้ไขข้อมูลล่าสุด',
  `approve` enum('N','Y') DEFAULT 'N' COMMENT 'การยืนยัน Y = Yes N = No',
  `user_id` int(11) DEFAULT NULL COMMENT 'user ใช้เข้าดูข้อมูลของสถานประกอบการนั้น ๆ',
  `type` int(1) DEFAULT NULL COMMENT 'ประเภทลูกค้า',
  `customercode` varchar(10) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `typeregister` int(11) DEFAULT NULL COMMENT 'ประเภทการจดทะเบียน',
  `timeworkbegin` time DEFAULT NULL COMMENT 'เวลาทำการเริ่มต้น',
  `timeworkend` time DEFAULT NULL COMMENT 'เวลาเลิกงาน',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='ตารางลูกค้า';

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', 'รพ.สต.บ้านนันธิดา', '10722', '122 ม.7', '4', '66', '353', '17202', 'นางรัตนา บุญหล่นทับ', '0800292829', '0800260943', '1', '2019-06-19 15:00:35', '2019-06-20 12:04:10', 'Y', '3', '1', 'C00001', 'ทาง “ผู้รับจ้าง” จะเข้าดำเนินการจัดเก็บขยะมูลฝอยติดเชื้อให้กับ “ผู้ว่าจ้าง” หลังจากทำสัญญาแล้วประมาณ 123', null, null, null);
INSERT INTO `customers` VALUES ('2', '12112212', '12121', '121212', '4', '70', '391', '53000', 'มานพ', '0800292829', '0800292029', '1', '2019-07-04 09:57:56', '2019-07-04 09:57:56', 'Y', '28', '1', 'C00002', null, null, null, null);
INSERT INTO `customers` VALUES ('3', 'ssssss', '1123213213213', 'ssssssss', '1', '2', '14', '12000', 'AAA AAA', '0800020232', '', '1', '2019-07-07 11:50:16', '2019-07-07 11:50:16', 'Y', '10', '1', 'C00003', null, null, null, null);
INSERT INTO `customers` VALUES ('4', '34434', '1132132121321', '343', '4', '68', '376', '12000', 'AAA AAA', '092-8445854', '0800260943', '1', '2019-07-13 19:54:14', '2019-07-13 19:54:14', 'Y', '2', '1', 'C00004', null, null, null, null);
INSERT INTO `customers` VALUES ('7', 'ssssss', '1454545645454', 'trtret', '2', '53', '262', '12121', '1212121212221212', '0800020232', '', '1', '2019-07-13 20:59:38', '2019-07-13 20:59:38', 'Y', '2', '1', 'C00005', 'ๅ/ๅ/ๅ/ๅ', null, null, null);
INSERT INTO `customers` VALUES ('10', 'โรงพยาบาลลำปาง', '1234567891234', '581 ', '1', '1', '2', '52000', 'วิริยะ', '0800292829', '0899975661', '1', '2019-08-05 08:49:45', '2019-08-05 08:49:45', 'Y', '13', '1', 'C00006', 'ทดสอบหมายเหตุ', '1', '09:50:00', '18:50:00');

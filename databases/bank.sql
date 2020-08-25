/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-08-26 02:05:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bank`
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `bankname` varchar(255) DEFAULT NULL,
  `bank_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank
-- ----------------------------
INSERT INTO `bank` VALUES ('1', 'กรุงเทพ Bangkok Bank', 'BBL.jpg');
INSERT INTO `bank` VALUES ('2', 'กรุงไทย Krung Thai Bank', 'KTB.jpg');
INSERT INTO `bank` VALUES ('3', 'กรุงศรีอยุธยา Bank of Ayudhaya', 'KUNG.jpg');
INSERT INTO `bank` VALUES ('4', 'กสิกรไทย KasikornBank', 'KBANK.jpg');
INSERT INTO `bank` VALUES ('6', 'ซิติแบงก์ Citibank', 'CITY.jpg');
INSERT INTO `bank` VALUES ('7', 'ทหารไทย Thai Military Bank', 'TMB.jpg');
INSERT INTO `bank` VALUES ('8', 'ทิสโก้ Thai Investment and Securities Company Bank', 'TESCO.jpg');
INSERT INTO `bank` VALUES ('9', 'ไทย BankThai', 'THAI.jpg');
INSERT INTO `bank` VALUES ('10', 'ไทยพาณิชย์ Siam Commercial Bank', 'SCB.jpg');
INSERT INTO `bank` VALUES ('11', 'ธนชาต Thanachart Bank', 'TC.jpg');
INSERT INTO `bank` VALUES ('13', 'ยูโอบี United Overseas Bank, Thailand', 'UOB.jpg');
INSERT INTO `bank` VALUES ('17', 'เอสเอ็มอี (SME) SME Bank of Thailand', 'SME.jpg');
INSERT INTO `bank` VALUES ('18', 'ธกส. Bank for Agriculture and Agricultural Cooperatives', 'YKS.jpg');
INSERT INTO `bank` VALUES ('20', 'ออมสิน Government Saving Bank', 'AOM.jpg');
INSERT INTO `bank` VALUES ('22', 'อิสลามแห่งประเทศไทย Islamic Bank of Thailand', 'ISARAM.jpg');

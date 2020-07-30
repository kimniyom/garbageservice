/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-07-30 14:38:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `promisefile`
-- ----------------------------
DROP TABLE IF EXISTS `promisefile`;
CREATE TABLE `promisefile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promiseid` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขที่สัญญา',
  `filename` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อไฟล์สัญญญาที่อัพโหลด จะเป็นชื่อเดียวกับเลขสัญญา',
  `dateupload` datetime DEFAULT NULL COMMENT 'วันที่อัพโหลดไฟล์',
  `uploadby` int(11) DEFAULT NULL COMMENT 'user ที่อัพโหลดไฟล์',
  `status` tinyint(4) DEFAULT NULL COMMENT 'สถานะการใช้งาน 1 คือ ใช้งาน 2 คือ จบการทำงานแล้ว',
  PRIMARY KEY (`id`,`promiseid`,`filename`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ตารางเก็บไฟล์อัพโหลดสัญญา';

-- ----------------------------
-- Records of promisefile
-- ----------------------------
INSERT INTO `promisefile` VALUES ('1', '2', 'IC00001.pdf', '2020-05-23 22:44:00', '2', null);
INSERT INTO `promisefile` VALUES ('2', '3', 'IC00002.pdf', '2020-05-24 19:47:00', '2', null);
INSERT INTO `promisefile` VALUES ('3', '5', 'IC00004.pdf', '2020-06-02 18:41:00', '2', null);
INSERT INTO `promisefile` VALUES ('4', '4', 'IC00003.pdf', '2020-06-03 11:09:00', '2', null);
INSERT INTO `promisefile` VALUES ('8', '6', 'IC00005.pdf', '2020-07-29 11:41:00', '2', null);
INSERT INTO `promisefile` VALUES ('20', '10', 'IC00006.pdf', '2020-07-30 09:37:00', '2', '1');

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-05-20 11:31:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `customers_img`
-- ----------------------------
DROP TABLE IF EXISTS `customers_img`;
CREATE TABLE `customers_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NOT NULL,
  `filename` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รูปภาพลูกค้า',
  `dateupload` datetime NOT NULL,
  `uploadby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customerid` (`customerid`,`filename`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers_img
-- ----------------------------
INSERT INTO `customers_img` VALUES ('8', '1515', '1515.jpg', '2020-05-20 11:30:34', '2');

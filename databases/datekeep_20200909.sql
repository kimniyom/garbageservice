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

 Date: 09/09/2020 22:59:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for datekeep
-- ----------------------------
DROP TABLE IF EXISTS `datekeep`;
CREATE TABLE `datekeep` (
  `promiseid` int(11) NOT NULL COMMENT 'ไอดีสัญญา',
  `title` varchar(64) NOT NULL COMMENT 'ข้อความแสดง',
  `datekeep` date NOT NULL COMMENT 'วันที่เข้าจัดเก็บ',
  `dateend` date NOT NULL COMMENT 'วันสิ้นสุดการจัดเก็บ',
  `status` int(11) DEFAULT NULL COMMENT '0=ยังไม่เข้าจัดเก็บ,1=เข้าจัดเก็บแล้ว',
  PRIMARY KEY (`promiseid`,`datekeep`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datekeep
-- ----------------------------
BEGIN;
INSERT INTO `datekeep` VALUES (3, '???????', '2020-09-01', '0000-00-00', 0);
INSERT INTO `datekeep` VALUES (3, '???????', '2020-09-09', '0000-00-00', 0);
INSERT INTO `datekeep` VALUES (3, '???????', '2020-09-12', '0000-00-00', 0);
INSERT INTO `datekeep` VALUES (3, '??', '2020-09-30', '0000-00-00', 0);
INSERT INTO `datekeep` VALUES (4, '', '2020-09-11', '0000-00-00', 0);
INSERT INTO `datekeep` VALUES (4, '', '2020-09-24', '0000-00-00', 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

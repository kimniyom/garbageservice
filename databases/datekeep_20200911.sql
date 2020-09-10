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

 Date: 11/09/2020 06:21:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for datekeep
-- ----------------------------
DROP TABLE IF EXISTS `datekeep`;
CREATE TABLE `datekeep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promiseid` int(11) NOT NULL COMMENT 'ไอดีสัญญา',
  `datekeep` date NOT NULL COMMENT 'วันที่เข้าจัดเก็บ',
  `status` int(11) DEFAULT NULL COMMENT '0=ยังไม่เข้าจัดเก็บ,1=เข้าจัดเก็บแล้ว',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of datekeep
-- ----------------------------
BEGIN;
INSERT INTO `datekeep` VALUES (40, 3, '2020-09-01', 0);
INSERT INTO `datekeep` VALUES (41, 3, '2020-09-02', 0);
INSERT INTO `datekeep` VALUES (42, 3, '2020-09-03', 0);
INSERT INTO `datekeep` VALUES (43, 3, '2020-09-04', 0);
INSERT INTO `datekeep` VALUES (44, 3, '2020-09-18', 0);
INSERT INTO `datekeep` VALUES (45, 3, '2020-09-17', 0);
INSERT INTO `datekeep` VALUES (47, 3, '2020-09-11', 0);
INSERT INTO `datekeep` VALUES (48, 3, '2020-09-12', 0);
INSERT INTO `datekeep` VALUES (49, 3, '2020-09-19', 0);
INSERT INTO `datekeep` VALUES (50, 3, '2020-09-05', 0);
INSERT INTO `datekeep` VALUES (56, 3, '2020-09-14', 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;

/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-04-29 01:56:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1556452023');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1556452026');
INSERT INTO `migration` VALUES ('m140209_132017_init', '1556452556');
INSERT INTO `migration` VALUES ('m140403_174025_create_account_table', '1556452556');
INSERT INTO `migration` VALUES ('m140504_113157_update_tables', '1556452557');
INSERT INTO `migration` VALUES ('m140504_130429_create_token_table', '1556452558');
INSERT INTO `migration` VALUES ('m140830_171933_fix_ip_field', '1556452558');
INSERT INTO `migration` VALUES ('m140830_172703_change_account_table_name', '1556452558');
INSERT INTO `migration` VALUES ('m141222_110026_update_ip_field', '1556452558');
INSERT INTO `migration` VALUES ('m141222_135246_alter_username_length', '1556452558');
INSERT INTO `migration` VALUES ('m150614_103145_update_social_account_table', '1556452558');
INSERT INTO `migration` VALUES ('m150623_212711_fix_username_notnull', '1556452558');
INSERT INTO `migration` VALUES ('m151218_234654_add_timezone_to_profile', '1556452559');
INSERT INTO `migration` VALUES ('m160929_103127_add_last_login_at_to_user_table', '1556452559');
INSERT INTO `migration` VALUES ('m190124_110200_add_verification_token_column_to_user_table', '1556452026');

-- ----------------------------
-- Table structure for `profile`
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', null, null, null, null, null, null, null, null);
INSERT INTO `profile` VALUES ('2', null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `social_account`
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of social_account
-- ----------------------------

-- ----------------------------
-- Table structure for `token`
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', 'jXqi21VJ9WqiiXpuRgM2bOYx4AbB_mS9', '1556453027', '0');
INSERT INTO `token` VALUES ('2', 'EFeLmaebqMbMRjlI17YXi-MMz8jXG1UZ', '1556476857', '0');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'kimniyom', 'kimniyomclub@hotmail.com', '$2y$12$wdb0dOW2hA5pZAlKhhUIxOaXv.7hVjTtde/Y8691zzhhSrFRLzeKi', 'ZZAuY9wCJptMlmuWCZKRg0DUcovrQKkl', null, null, null, '::1', '1556453027', '1556453027', '0', '1556476835');
INSERT INTO `user` VALUES ('2', 'admin', 'admin@hotmail.com', '$2y$12$ZHSYDc.CNOI0qm8G2iBuDOirXM.x8TIXb00gf04KRcpLTkbn13fMK', 'tkgvzL8RuoCU7ARPO0xSCuXMbCnaxBvi', null, null, null, '::1', '1556476857', '1556476857', '0', null);

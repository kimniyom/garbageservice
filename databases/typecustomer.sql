/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : garbagedb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-10-18 11:51:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `typecustomer`
-- ----------------------------
DROP TABLE IF EXISTS `typecustomer`;
CREATE TABLE `typecustomer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `typename` varchar(255) DEFAULT NULL COMMENT 'ประเภทลูกค้า',
  `typename_en` varchar(255) DEFAULT NULL,
  `codenumber` varchar(20) DEFAULT NULL COMMENT 'จำนวนความกว้างในการลงข้อมูล',
  `description` varchar(255) DEFAULT NULL COMMENT 'คำอธิบาย',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บประเภทลูกค้า';

-- ----------------------------
-- Records of typecustomer
-- ----------------------------
INSERT INTO `typecustomer` VALUES ('1', 'บริษัท', 'Company', '13', 'ใช้เลขเสียภาษี 13 หลัก');
INSERT INTO `typecustomer` VALUES ('2', 'โรงพยาบาลรัฐ', 'Government  Hospital', null, null);
INSERT INTO `typecustomer` VALUES ('3', 'โรงพยาบาลส่งเสริมสุขภาพตำบล', 'Public Health Center', null, null);
INSERT INTO `typecustomer` VALUES ('4', 'โรงพยาบาลเอกชน', 'Private Hospital', null, null);
INSERT INTO `typecustomer` VALUES ('5', 'คลินิก/โพลีคลินิค/สหคลินิค/คลินิกเวชกรรมทั่วไป', 'Clinic/Medical Clinic', null, null);
INSERT INTO `typecustomer` VALUES ('6', 'คลินิคเฉพาะทาง หู ตา คอ จมูก', 'Speciality Clinic', null, null);
INSERT INTO `typecustomer` VALUES ('7', 'โรงงานอุตสาหกรรม/บริษัทเอกชน', 'Factory Industrial', null, null);
INSERT INTO `typecustomer` VALUES ('8', 'สถาบันการศึกษา', 'Education Institution', null, null);
INSERT INTO `typecustomer` VALUES ('9', 'เทศบาล/ อบต.', 'Municipality', null, null);
INSERT INTO `typecustomer` VALUES ('10', 'ร้านสัก/ร้านเสริมสวย/ศัลยกรรม', 'Beauty Salon', null, null);
INSERT INTO `typecustomer` VALUES ('11', 'ศูนย์การแพทย์/สาธารณสุข', 'Medical Center / Public Health', null, null);
INSERT INTO `typecustomer` VALUES ('12', 'เรือนจำ', 'Prison', null, null);
INSERT INTO `typecustomer` VALUES ('13', 'คลินิกทันตกรรม', 'Dentist Clinic', null, null);
INSERT INTO `typecustomer` VALUES ('14', 'คลินิคแพทย์แผนไทย / แผนจีน', 'Thai traditional medicine', null, null);
INSERT INTO `typecustomer` VALUES ('15', 'คลินิกการพยาบาลและการผดุงครรภ์', 'Nursing and Midwifery', null, null);
INSERT INTO `typecustomer` VALUES ('16', 'โรงพยาบาลสัตว์/ คลินิกรักษาสัตว์/ สัตว์แพทย์', 'Animal  Hospital', null, null);
INSERT INTO `typecustomer` VALUES ('17', 'เทคนิคการแพทย์', 'Lab', null, null);
INSERT INTO `typecustomer` VALUES ('18', 'กายภาพบำบัด', 'Physical Therapy Center', null, null);
INSERT INTO `typecustomer` VALUES ('19', 'อื่นๆ', 'Other', null, null);
INSERT INTO `typecustomer` VALUES ('20', 'การพยาบาล', null, null, null);
INSERT INTO `typecustomer` VALUES ('21', 'คลินิก', null, null, null);
INSERT INTO `typecustomer` VALUES ('22', 'คลินิกกายภาพบำบัด', null, null, null);
INSERT INTO `typecustomer` VALUES ('23', 'คลินิกการพยาบาลและผดุงครรภ์', null, null, null);
INSERT INTO `typecustomer` VALUES ('24', 'คลินิกการแพทย์แผนจีน', null, null, null);
INSERT INTO `typecustomer` VALUES ('25', 'คลินิกสัตว์ ', null, null, null);
INSERT INTO `typecustomer` VALUES ('26', 'คลินิกเฉพาะทางด้านเวชกรรม', null, null, null);
INSERT INTO `typecustomer` VALUES ('27', 'คลินิกเทคนิคการแพทย์ ', null, null, null);
INSERT INTO `typecustomer` VALUES ('28', 'คลินิกเวชกรรม', null, null, null);
INSERT INTO `typecustomer` VALUES ('29', 'คลินิกแพทย์แผนไทย', null, null, null);
INSERT INTO `typecustomer` VALUES ('30', 'ความงาม', null, null, null);
INSERT INTO `typecustomer` VALUES ('31', 'ทันตกรรม', null, null, null);
INSERT INTO `typecustomer` VALUES ('32', 'ทั่วไปฯ', null, null, null);
INSERT INTO `typecustomer` VALUES ('33', 'บริษัท,โรงงาน', null, null, null);
INSERT INTO `typecustomer` VALUES ('34', 'บริษัทเอกชน', null, null, null);
INSERT INTO `typecustomer` VALUES ('35', 'ผดุงครรภ์', null, null, null);
INSERT INTO `typecustomer` VALUES ('36', 'มหาวิทยาลัย', null, null, null);
INSERT INTO `typecustomer` VALUES ('37', 'รพ.', null, null, null);
INSERT INTO `typecustomer` VALUES ('38', 'รพ.สต.', null, null, null);
INSERT INTO `typecustomer` VALUES ('39', 'รพ.สัตว์', null, null, null);
INSERT INTO `typecustomer` VALUES ('40', 'รักษาสัตว์', null, null, null);
INSERT INTO `typecustomer` VALUES ('41', 'ร้านสัก', null, null, null);
INSERT INTO `typecustomer` VALUES ('42', 'สหคลินิก', null, null, null);
INSERT INTO `typecustomer` VALUES ('43', 'สัตว์แพทย์', null, null, null);
INSERT INTO `typecustomer` VALUES ('44', 'ห้องพยาบาล', null, null, null);
INSERT INTO `typecustomer` VALUES ('45', 'ห้องพยาบาล(โรงงาน)', null, null, null);
INSERT INTO `typecustomer` VALUES ('46', 'เฉพาะทาง', null, null, null);
INSERT INTO `typecustomer` VALUES ('47', 'เทคนิคฯ', null, null, null);
INSERT INTO `typecustomer` VALUES ('48', 'เทศบาล', null, null, null);
INSERT INTO `typecustomer` VALUES ('49', 'เวชกรรม', null, null, null);
INSERT INTO `typecustomer` VALUES ('50', 'แผน', null, null, null);
INSERT INTO `typecustomer` VALUES ('51', 'แผนจีน', null, null, null);
INSERT INTO `typecustomer` VALUES ('52', 'แผนไทย', null, null, null);
INSERT INTO `typecustomer` VALUES ('53', 'แล็บ', null, null, null);
INSERT INTO `typecustomer` VALUES ('54', 'โรงพยาบาลสัตว์ ', null, null, null);

/*
Navicat MySQL Data Transfer

Source Server         : PHP
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : symfony

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-09-30 17:36:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Family', 'Family', '0', '2016-09-30 15:56:59', '2016-09-30 15:57:01');
INSERT INTO `category` VALUES ('2', 'Relax', 'This is relax', '0', '2016-09-30 12:04:08', '2016-09-30 12:04:08');

-- ----------------------------
-- Table structure for todo
-- ----------------------------
DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of todo
-- ----------------------------
INSERT INTO `todo` VALUES ('1', 'Pickup Kids', 'Family', 'Pick up the kids from school', 'Normal', '2016-09-30 13:18:00', '2016-09-30 10:26:01', '2016-09-30 10:26:01');
INSERT INTO `todo` VALUES ('2', 'Making With Team', 'Work', 'Work with my team', 'Normal', '2016-09-30 13:18:40', '2016-09-30 13:18:40', '2016-09-30 13:18:40');
INSERT INTO `todo` VALUES ('3', 'Sleep', 'Personal', 'Go to sleep', 'High', '2016-09-04 08:07:00', '2016-09-30 09:14:45', '2016-09-30 09:14:45');
INSERT INTO `todo` VALUES ('6', 'Do HomeWork', 'School', 'Do my homework', 'Normal', '2016-09-03 00:00:00', '2016-09-30 09:18:14', '2016-09-30 09:18:14');
INSERT INTO `todo` VALUES ('7', 'Running', 'Sports', 'Go to run', 'Normal', '2016-05-08 14:12:00', '2016-09-30 09:46:53', '2016-09-30 09:46:53');
INSERT INTO `todo` VALUES ('9', 'Watching TV', 'Relax', 'Go to Watching TV', 'Low', '2015-05-05 14:30:00', '2016-09-30 10:01:39', '2016-09-30 10:01:39');
INSERT INTO `todo` VALUES ('13', 'Go to park', 'Relax', 'Go to Park', 'Normal', '2016-10-05 09:10:00', '2016-09-30 10:37:35', '2016-09-30 10:37:35');

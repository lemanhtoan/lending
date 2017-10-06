/*
Navicat MySQL Data Transfer

Source Server         : Localhost MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : lending

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-10-06 17:11:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES ('1', 'dataLogo', '1507282566_logo-min.png', '2017-06-06 17:11:33', '2017-10-06 09:36:06');
INSERT INTO `settings` VALUES ('10', 'dataHotline', '024.3237.3333', '2017-06-09 16:42:11', '2017-10-06 09:35:17');
INSERT INTO `settings` VALUES ('13', 'emailsupport', 'toanktv.it@gmail.com', '2017-10-06 09:46:40', '2017-10-06 09:46:40');
INSERT INTO `settings` VALUES ('14', 'mainbg', '#ff0000', '2017-10-06 09:54:24', '2017-10-06 10:03:07');
INSERT INTO `settings` VALUES ('15', 'maincolor', '#0000ff', '2017-10-06 09:54:27', '2017-10-06 10:03:14');
INSERT INTO `settings` VALUES ('16', 'laisuat', '3', '2017-10-06 09:54:33', '2017-10-06 10:06:06');
INSERT INTO `settings` VALUES ('17', 'maxverified', '40000000', '2017-10-06 09:54:43', '2017-10-06 10:06:36');
INSERT INTO `settings` VALUES ('18', 'footer', '<p>Footer content dynamic</p>\r\n', '2017-10-06 09:57:04', '2017-10-06 10:06:47');
INSERT INTO `settings` VALUES ('19', 'maxqty', '3', '2017-10-06 09:57:28', '2017-10-06 09:57:28');
INSERT INTO `settings` VALUES ('20', 'dayredm', '7', '2017-10-06 09:57:33', '2017-10-06 10:06:23');
INSERT INTO `settings` VALUES ('21', 'tygiaUV', '22.87', '2017-10-06 09:57:37', '2017-10-06 10:06:12');
INSERT INTO `settings` VALUES ('22', 'daylost', '15', '2017-10-06 09:58:34', '2017-10-06 10:06:18');

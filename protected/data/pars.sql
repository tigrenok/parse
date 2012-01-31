/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50140
Source Host           : localhost:3306
Source Database       : pars

Target Server Type    : MYSQL
Target Server Version : 50140
File Encoding         : 65001

Date: 2012-02-01 02:19:05
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `assignments`
-- ----------------------------
DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of assignments
-- ----------------------------
INSERT INTO `assignments` VALUES ('Administrator', '1', '', 's:0:\"\";');

-- ----------------------------
-- Table structure for `itemchildren`
-- ----------------------------
DROP TABLE IF EXISTS `itemchildren`;
CREATE TABLE `itemchildren` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of itemchildren
-- ----------------------------
INSERT INTO `itemchildren` VALUES ('Administrator', 'AdminTask');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'ContentCreate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'ContentDelete');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'ContentIndex');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'ContentUpdate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'ContentView');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'LawCreate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'LawDelete');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'LawIndex');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'LawUpdate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'LawView');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SiteCaptcha');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SiteError');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SiteIndex');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitePage');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitesCreate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitesDelete');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitesError');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitesIndex');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitesParse');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitesUpdate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'SitesView');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ActivationActivation');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@AdminAdmin');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@AdminCreate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@AdminDelete');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@AdminUpdate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@AdminView');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@DefaultIndex');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@LogoutLogout');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileChangepassword');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileEdit');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileFieldAdmin');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileFieldCreate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileFieldDelete');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileFieldUpdate');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileFieldView');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@ProfileProfile');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@RecoveryRecovery');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@RegistrationCaptcha');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@RegistrationRegistration');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@UserIndex');
INSERT INTO `itemchildren` VALUES ('AdminTask', 'user@UserView');

-- ----------------------------
-- Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES ('Administrator', '2', null, null, null);
INSERT INTO `items` VALUES ('AdminTask', '1', 'Правила Админа', '', 's:0:\"\";');
INSERT INTO `items` VALUES ('ContentView', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('ContentCreate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('ContentUpdate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('ContentDelete', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('ContentIndex', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('LawIndex', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('LawView', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('LawCreate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('LawUpdate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('LawDelete', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SiteCaptcha', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitePage', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SiteIndex', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitesView', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitesCreate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitesUpdate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitesParse', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitesDelete', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitesIndex', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ActivationActivation', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@AdminAdmin', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@AdminView', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@AdminCreate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@AdminUpdate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@AdminDelete', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileProfile', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileEdit', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileChangepassword', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileFieldView', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileFieldCreate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileFieldUpdate', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileFieldDelete', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@ProfileFieldAdmin', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@RecoveryRecovery', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@RegistrationCaptcha', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@RegistrationRegistration', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@UserView', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@UserIndex', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@DefaultIndex', '0', '', '', 's:0:\"\";');
INSERT INTO `items` VALUES ('SiteError', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('SitesError', '0', null, null, 'N;');
INSERT INTO `items` VALUES ('user@LogoutLogout', '0', null, null, 'N;');

-- ----------------------------
-- Table structure for `tbl_content`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_content`;
CREATE TABLE `tbl_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `date_public` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `parse_site` varchar(255) DEFAULT NULL,
  `date_parse` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_content
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_law`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_law`;
CREATE TABLE `tbl_law` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `list_law` varchar(255) DEFAULT NULL,
  `title_law` varchar(500) DEFAULT NULL,
  `date_law` varchar(500) DEFAULT NULL,
  `autor_law` varchar(500) DEFAULT NULL,
  `img_law` varchar(500) DEFAULT NULL,
  `content_law` varchar(500) DEFAULT NULL,
  `type` enum('one','list') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_law
-- ----------------------------
INSERT INTO `tbl_law` VALUES ('1', 'vk parse law', '', 'div[class=top_header]', '', '', 'div[id^=wpt-] img', 'div[id^=wpt-]', 'one');

-- ----------------------------
-- Table structure for `tbl_law_fields`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_law_fields`;
CREATE TABLE `tbl_law_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `law_id` int(11) DEFAULT NULL,
  `attr` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_law_fields
-- ----------------------------
INSERT INTO `tbl_law_fields` VALUES ('1', '1', '1', 'content_law', 'hjkhjksdfsdf');
INSERT INTO `tbl_law_fields` VALUES ('8', '1', '1', 'title_law', 'hjkhjk');

-- ----------------------------
-- Table structure for `tbl_law_fields_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_law_fields_type`;
CREATE TABLE `tbl_law_fields_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_law_fields_type
-- ----------------------------
INSERT INTO `tbl_law_fields_type` VALUES ('1', 'replase');

-- ----------------------------
-- Table structure for `tbl_migration`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_migration`;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_migration
-- ----------------------------
INSERT INTO `tbl_migration` VALUES ('m000000_000000_base', '1327676671');

-- ----------------------------
-- Table structure for `tbl_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles`;
CREATE TABLE `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles
-- ----------------------------
INSERT INTO `tbl_profiles` VALUES ('1');

-- ----------------------------
-- Table structure for `tbl_profiles_fields`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles_fields`;
CREATE TABLE `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles_fields
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_sites`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sites`;
CREATE TABLE `tbl_sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `law_id` int(11) DEFAULT NULL,
  `coding` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_sites
-- ----------------------------
INSERT INTO `tbl_sites` VALUES ('1', 'http://vkontakte.ru/sleeva', 'vk parse', '1', 'CP1251');

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', '1261146094', '1328048032', '1', '1');

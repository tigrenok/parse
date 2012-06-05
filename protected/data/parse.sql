/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50522
Source Host           : localhost:3306
Source Database       : pars

Target Server Type    : MYSQL
Target Server Version : 50522
File Encoding         : 65001

Date: 2012-06-03 14:57:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_coding`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_coding`;
CREATE TABLE `tbl_coding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `value` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_coding
-- ----------------------------
INSERT INTO `tbl_coding` VALUES ('1', 'utf 8', 'UTF-8');
INSERT INTO `tbl_coding` VALUES ('2', 'windows 1251', 'CP1251');

-- ----------------------------
-- Table structure for `tbl_content`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_content`;
CREATE TABLE `tbl_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text,
  `date_parse_time` varbinary(30) DEFAULT NULL,
  `date_public` datetime DEFAULT NULL,
  `stop` varchar(255) DEFAULT NULL,
  `date_parse` datetime DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
  `stop` varchar(255) DEFAULT NULL,
  `law_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_law
-- ----------------------------
INSERT INTO `tbl_law` VALUES ('1', 'Контакт', 'id', '3');
INSERT INTO `tbl_law` VALUES ('2', 'Контакт мой', 'id', '3');
INSERT INTO `tbl_law` VALUES ('3', 'Одиночка тест', 'id', '2');
INSERT INTO `tbl_law` VALUES ('4', 'ithappens одиночка', 'id', '2');
INSERT INTO `tbl_law` VALUES ('5', 'Хабр статьи', 'id', '2');
INSERT INTO `tbl_law` VALUES ('6', 'Хабр', 'id', '4');
INSERT INTO `tbl_law` VALUES ('7', 'ithappens ссылки', 'id', '1');
INSERT INTO `tbl_law` VALUES ('8', 'Хабр блоки', '', '3');
INSERT INTO `tbl_law` VALUES ('9', 'Хабр ссылки', '', '1');

-- ----------------------------
-- Table structure for `tbl_law_field`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_law_field`;
CREATE TABLE `tbl_law_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `law_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `fn` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_law_field
-- ----------------------------
INSERT INTO `tbl_law_field` VALUES ('1', '1', '2', 'div[class=top_header]');
INSERT INTO `tbl_law_field` VALUES ('5', '1', '4', 'div[id^=wpt-]');
INSERT INTO `tbl_law_field` VALUES ('8', '1', '6', 'self::imgcontent($content)');
INSERT INTO `tbl_law_field` VALUES ('9', '1', '7', 'self::videocontent($content,\'div[class=media_desc] a\',\'http://vk.com/tiigrenok?z=\')');
INSERT INTO `tbl_law_field` VALUES ('10', '2', '2', 'h4[class=simple]');
INSERT INTO `tbl_law_field` VALUES ('11', '2', '4', 'div[id^=wpt]');
INSERT INTO `tbl_law_field` VALUES ('12', '2', '6', 'self::imgcontent($content)');
INSERT INTO `tbl_law_field` VALUES ('13', '2', '7', 'self::videocontent($content,\'div[class=media_desc] a\',\'http://vk.com/tiigrenok?z=\')');
INSERT INTO `tbl_law_field` VALUES ('14', '2', '8', 'self::audiocontent($content,\'div[class=audio_title_wrap] a\',\'http://vk.com\')');
INSERT INTO `tbl_law_field` VALUES ('15', '1', '8', 'self::audiocontent($content,\'div[class=audio_title_wrap] a\',\'http://vk.com\')');
INSERT INTO `tbl_law_field` VALUES ('16', '3', '2', 'div[class=top_header]');
INSERT INTO `tbl_law_field` VALUES ('17', '3', '4', 'div[id=public_wall]');
INSERT INTO `tbl_law_field` VALUES ('18', '3', '6', 'self::imgcontent($content)');
INSERT INTO `tbl_law_field` VALUES ('19', '3', '7', 'self::videocontent($content,\'div[class=media_desc] a\',\'http://vk.com/tiigrenok?z=\')');
INSERT INTO `tbl_law_field` VALUES ('20', '3', '8', 'self::audiocontent($content,\'div[class=audio_title_wrap] a\',\'http://vk.com\')');
INSERT INTO `tbl_law_field` VALUES ('21', '4', '2', 'h3');
INSERT INTO `tbl_law_field` VALUES ('22', '4', '4', 'p[id^=story]');
INSERT INTO `tbl_law_field` VALUES ('23', '5', '2', 'h3');
INSERT INTO `tbl_law_field` VALUES ('24', '5', '4', 'div[id^=post_]');
INSERT INTO `tbl_law_field` VALUES ('26', '4', '6', 'self::imgcontent($content)');
INSERT INTO `tbl_law_field` VALUES ('30', '5', '6', 'self::imgcontent($content)');
INSERT INTO `tbl_law_field` VALUES ('33', '7', '4', 'h3 a');
INSERT INTO `tbl_law_field` VALUES ('34', '8', '2', 'h1[class=title]');
INSERT INTO `tbl_law_field` VALUES ('35', '8', '4', 'div[class=content html_format]');
INSERT INTO `tbl_law_field` VALUES ('36', '8', '6', 'self::imgcontent($content)');
INSERT INTO `tbl_law_field` VALUES ('37', '9', '4', 'a[class=post_title]');

-- ----------------------------
-- Table structure for `tbl_law_field_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_law_field_type`;
CREATE TABLE `tbl_law_field_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `show` int(11) DEFAULT NULL,
  `param` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_law_field_type
-- ----------------------------
INSERT INTO `tbl_law_field_type` VALUES ('2', 'Заголовок', 'header', '1', '1');
INSERT INTO `tbl_law_field_type` VALUES ('3', 'Автор', 'autor', '1', '1');
INSERT INTO `tbl_law_field_type` VALUES ('4', 'Контент', 'content', '1', '1');
INSERT INTO `tbl_law_field_type` VALUES ('6', 'Картинки', 'img', '1', '2');
INSERT INTO `tbl_law_field_type` VALUES ('7', 'Видео', 'video', '1', '2');
INSERT INTO `tbl_law_field_type` VALUES ('8', 'Аудио', 'audio', '1', '2');

-- ----------------------------
-- Table structure for `tbl_law_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_law_type`;
CREATE TABLE `tbl_law_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_law_type
-- ----------------------------
INSERT INTO `tbl_law_type` VALUES ('1', 'Список ссылкок страниц', 'list_link');
INSERT INTO `tbl_law_type` VALUES ('2', 'Одиночка', 'one');
INSERT INTO `tbl_law_type` VALUES ('3', 'Список блоков', 'list_block');
INSERT INTO `tbl_law_type` VALUES ('4', 'Интервал страниц', 'list_link_interval');

-- ----------------------------
-- Table structure for `tbl_post_site`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_post_site`;
CREATE TABLE `tbl_post_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `rpc_script` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_post_site
-- ----------------------------
INSERT INTO `tbl_post_site` VALUES ('1', 'http://wordpress.wp', 'admin', 'admin536', 'http://wordpress.wp', '/xmlrpc.php');

-- ----------------------------
-- Table structure for `tbl_post_site_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_post_site_categories`;
CREATE TABLE `tbl_post_site_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_post_site_categories
-- ----------------------------
INSERT INTO `tbl_post_site_categories` VALUES ('1', 'Без рубрики', 'без-рубрики', '1');
INSERT INTO `tbl_post_site_categories` VALUES ('2', 'Новое', 'new', '1');

-- ----------------------------
-- Table structure for `tbl_site_pars`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_site_pars`;
CREATE TABLE `tbl_site_pars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `law_id` int(11) DEFAULT NULL,
  `coding_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_site_pars
-- ----------------------------
INSERT INTO `tbl_site_pars` VALUES ('1', 'http://vk.com/sleeva', 'Приколы', '1', '2', '0');
INSERT INTO `tbl_site_pars` VALUES ('2', 'http://vk.com/tiigrenok', 'Контакт мой', '2', '2', null);
INSERT INTO `tbl_site_pars` VALUES ('3', 'http://vk.com/sleeva', 'Одиночка тест', '3', '2', null);
INSERT INTO `tbl_site_pars` VALUES ('4', 'http://ithappens.ru', 'ithappens.ru ссылки', '7', '2', '6');
INSERT INTO `tbl_site_pars` VALUES ('5', 'http://habrahabr.ru/posts/top/page[id-1-2]/', 'Хабр интервал', '6', '1', '9');
INSERT INTO `tbl_site_pars` VALUES ('6', 'http://ithappens.ru', 'ithappens.ru одиночка', '4', '2', '0');
INSERT INTO `tbl_site_pars` VALUES ('7', 'http://habrahabr.ru/post/144614/', 'Хабр одиночка', '5', '1', '0');
INSERT INTO `tbl_site_pars` VALUES ('8', 'http://habrahabr.ru/posts/top/page2/', 'Хабр блоки', '8', '1', '0');
INSERT INTO `tbl_site_pars` VALUES ('9', 'http://habrahabr.ru/posts/top/page2/', 'Хабр ссылки', '9', '1', '7');

-- ----------------------------
-- Table structure for `tbl_upload`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_upload`;
CREATE TABLE `tbl_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `upload_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_upload
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_upload_type`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_upload_type`;
CREATE TABLE `tbl_upload_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_upload_type
-- ----------------------------
INSERT INTO `tbl_upload_type` VALUES ('1', 'img', 'Картинки');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'asd');

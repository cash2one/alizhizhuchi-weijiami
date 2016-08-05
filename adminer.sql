/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50712
 Source Host           : localhost
 Source Database       : zhizhuchikong

 Target Server Type    : MySQL
 Target Server Version : 50712
 File Encoding         : utf-8

 Date: 08/05/2016 22:48:42 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `admin`
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES ('1', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');
COMMIT;

-- ----------------------------
--  Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `title` varchar(255) DEFAULT NULL,
  `vip` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `templates` varchar(255) DEFAULT NULL,
  `ver` varchar(255) DEFAULT NULL,
  `ver_date` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `enddate` varchar(255) DEFAULT NULL,
  `link` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `config`
-- ----------------------------
BEGIN;
INSERT INTO `config` VALUES ('', '', '', '', 'MS4zLjQ=', 'MTQ2OTgwODAwMA==', '', '', '0');
COMMIT;

-- ----------------------------
--  Table structure for `domains`
-- ----------------------------
DROP TABLE IF EXISTS `domains`;
CREATE TABLE `domains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `juzi`
-- ----------------------------
DROP TABLE IF EXISTS `juzi`;
CREATE TABLE `juzi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `keywords`
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `shipin`
-- ----------------------------
DROP TABLE IF EXISTS `shipin`;
CREATE TABLE `shipin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `spider`
-- ----------------------------
DROP TABLE IF EXISTS `spider`;
CREATE TABLE `spider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ssyq` varchar(255) NOT NULL,
  `fwdz` varchar(255) NOT NULL,
  `lldz` varchar(255) NOT NULL,
  `ipdz` varchar(255) NOT NULL,
  `age` text,
  `rq` int(11) NOT NULL,
  `ipinfo` text,
  PRIMARY KEY (`id`),
  KEY `ssyq` (`ssyq`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `spiderset`
-- ----------------------------
DROP TABLE IF EXISTS `spiderset`;
CREATE TABLE `spiderset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `ok` bit(1) NOT NULL,
  `age` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `spiderset`
-- ----------------------------
BEGIN;
INSERT INTO `spiderset` VALUES ('1', 'Google', b'1', 'googlebot'), ('2', 'Baidu', b'1', 'baiduspider'), ('3', 'Bing', b'1', 'msnbot'), ('4', 'Yahoo', b'1', 'slurp'), ('6', 'Sogou', b'1', 'sougou'), ('8', '360', b'1', '360spider');
COMMIT;

-- ----------------------------
--  Table structure for `templates`
-- ----------------------------
DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `ok` bit(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `templates`
-- ----------------------------
BEGIN;
INSERT INTO `templates` VALUES ('1', 'moban1', b'1', '模板一');
COMMIT;

-- ----------------------------
--  Table structure for `url`
-- ----------------------------
DROP TABLE IF EXISTS `url`;
CREATE TABLE `url` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  `google` int(11) NOT NULL DEFAULT '0',
  `baidu` int(11) NOT NULL DEFAULT '0',
  `bing` int(11) NOT NULL DEFAULT '0',
  `yahoo` int(11) NOT NULL DEFAULT '0',
  `sogou` int(11) NOT NULL DEFAULT '0',
  `360` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

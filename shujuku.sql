/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50712
 Source Host           : localhost
 Source Database       : zhizhuchi

 Target Server Type    : MySQL
 Target Server Version : 50712
 File Encoding         : utf-8

 Date: 07/19/2016 08:31:42 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `domains`
-- ----------------------------
DROP TABLE IF EXISTS `domains`;
CREATE TABLE `domains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `juzi`
-- ----------------------------
DROP TABLE IF EXISTS `juzi`;
CREATE TABLE `juzi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=771591 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `keywords`
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60087 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `shipin`
-- ----------------------------
DROP TABLE IF EXISTS `shipin`;
CREATE TABLE `shipin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=500 DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170442 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=468 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

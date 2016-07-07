-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-07-07 23:40:09
-- 服务器版本： 5.7.12
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zhizhuchi`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- 表的结构 `domains`
--

CREATE TABLE `domains` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `domains`
--

INSERT INTO `domains` (`id`, `title`) VALUES
(1, 'alizhizhuchi.top');

-- --------------------------------------------------------

--
-- 表的结构 `juzi`
--

CREATE TABLE `juzi` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `juzi`
--

INSERT INTO `juzi` (`id`, `title`) VALUES
(1, '异世邪君写完了'),
(2, '我'),
(3, '情绪'),
(4, '却良久没有恢复'),
(5, '至今'),
(6, '打字'),
(7, '时候'),
(8, '还是习惯性'),
(9, '打出君莫邪梅雪烟等字眼');

-- --------------------------------------------------------

--
-- 表的结构 `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `keywords`
--

INSERT INTO `keywords` (`id`, `title`) VALUES
(1, '滨江哪里可以做人流'),
(2, '滨江区哪里可以做人流'),
(3, '滨江区人流手术什么医院'),
(4, '滨江区最好的人流医院'),
(5, '超导可视的无痛人流杭州哪里有'),
(6, '超导可视无痛人流杭州'),
(7, '打胎杭州有哪些医院'),
(8, '打胎在杭州什么医院最好'),
(9, '妇科医院无痛人流杭州');

-- --------------------------------------------------------

--
-- 表的结构 `shipin`
--

CREATE TABLE `shipin` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `spider`
--

CREATE TABLE `spider` (
  `id` int(10) UNSIGNED NOT NULL,
  `ssyq` varchar(255) NOT NULL,
  `fwdz` varchar(255) NOT NULL,
  `lldz` varchar(255) NOT NULL,
  `ipdz` varchar(255) NOT NULL,
  `age` text,
  `rq` int(11) NOT NULL,
  `ipinfo` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `spiderset`
--

CREATE TABLE `spiderset` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `ok` bit(1) NOT NULL,
  `age` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `spiderset`
--

INSERT INTO `spiderset` (`id`, `title`, `ok`, `age`) VALUES
(1, 'Google', b'1', 'googlebot'),
(2, 'Baidu', b'1', 'baiduspider'),
(3, 'Bing', b'1', 'msnbot'),
(4, 'Yahoo', b'1', 'slurp'),
(6, 'Sogou', b'1', 'sougou'),
(8, '360', b'1', '360spider');

-- --------------------------------------------------------

--
-- 表的结构 `templates`
--

CREATE TABLE `templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `ok` bit(1) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `templates`
--

INSERT INTO `templates` (`id`, `title`, `ok`, `name`) VALUES
(1, 'moban1', b'1', '模板一'),
(2, 'moban2', b'1', '模板二'),
(3, 'moban3', b'1', '模板三');

-- --------------------------------------------------------

--
-- 表的结构 `url`
--

CREATE TABLE `url` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `url`
--

INSERT INTO `url` (`id`, `title`, `count`) VALUES
(1, 'http://www.alizhizhuchi.top/', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `juzi`
--
ALTER TABLE `juzi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipin`
--
ALTER TABLE `shipin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spider`
--
ALTER TABLE `spider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spiderset`
--
ALTER TABLE `spiderset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `juzi`
--
ALTER TABLE `juzi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=536391;
--
-- 使用表AUTO_INCREMENT `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2043;
--
-- 使用表AUTO_INCREMENT `spider`
--
ALTER TABLE `spider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `spiderset`
--
ALTER TABLE `spiderset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `url`
--
ALTER TABLE `url`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

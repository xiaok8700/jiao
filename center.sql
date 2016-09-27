-- phpMyAdmin SQL Dump
-- version 4.1.14.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-09-26 09:44:23
-- 服务器版本： 5.6.27
-- PHP Version: 5.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `center`
--

-- --------------------------------------------------------

--
-- 表的结构 `think_guzhang`
--

CREATE TABLE IF NOT EXISTS `think_guzhang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `class` varchar(15) NOT NULL,
  `people` varchar(20) NOT NULL,
  `program` text NOT NULL,
  `state` int(2) NOT NULL,
  `time` date NOT NULL,
  `time1` date NOT NULL,
  `banfa` text NOT NULL,
  `cname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `think_guzhang`
--

INSERT INTO `think_guzhang` (`id`, `class`, `people`, `program`, `state`, `time`, `time1`, `banfa`, `cname`) VALUES
(34, '1', '﻿﻿    	周红', '话筒无声音或者声音小&amp;电脑无声音或者声音小投影机亮度低激光笔不能翻页好', 1, '2016-08-22', '2016-08-22', 'dsfdsfdfgdf', NULL),
(35, '1', '﻿﻿    	丁义娟', '话筒无声音或者声音小&amp;电脑无声音或者声音小投影机亮度低刷卡不能正常开启系统激光笔不能翻页sdfsdf', 1, '2016-08-22', '2016-08-22', 'dsfdf', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `think_notice`
--

CREATE TABLE IF NOT EXISTS `think_notice` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `timu` varchar(50) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `think_notice`
--

INSERT INTO `think_notice` (`id`, `timu`, `content`, `time`) VALUES
(1, 'xiaok', 'nihai', '2016-07-23'),
(2, 'xiaohei', 'hello world', '2016-07-26'),
(3, 'xiaoh', 'nihao', '2016-07-26'),
(4, 'xiaop', 'enne', '2016-07-27'),
(5, 'xiaog', 'ennen', '2016-07-25'),
(6, 'xiaopg', 'dfdgf', '2016-07-28'),
(7, '改好', '\n		<p>ooooo<br></p>', '2016-08-14'),
(8, '改好', '\n		<p>你哈<br></p>', '2016-08-14'),
(9, '改好', '\n		<p><font color="#ff0000">sdf</font><br></p><p><br></p>', '2016-08-14'),
(10, '改好', '\n		<p><font color="#ff0000" size="7">sdf</font><br></p><p><br></p>', '2016-08-14');

-- --------------------------------------------------------

--
-- 表的结构 `think_technical`
--

CREATE TABLE IF NOT EXISTS `think_technical` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `timu` varchar(20) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `think_technical`
--

INSERT INTO `think_technical` (`id`, `timu`, `content`, `time`) VALUES
(2, 'xiaok', '54566498', '2016-08-23'),
(3, '小凯', '士大夫但是', '2016-08-24'),
(4, 'xiaop', 'sdf', '2016-08-01'),
(5, 'xioa', 'dsfsdfsd', '2016-08-01'),
(6, 'ppp', 'sdfsdfsdfsdf', '2016-08-01'),
(7, 'axasddsf', 'sdfsfsdfsdf', '2016-08-01');

-- --------------------------------------------------------

--
-- 表的结构 `think_user`
--

CREATE TABLE IF NOT EXISTS `think_user` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `quanxian` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `think_user`
--

INSERT INTO `think_user` (`id`, `name`, `quanxian`) VALUES
(1, '0913130425', '1'),
(2, '3521', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

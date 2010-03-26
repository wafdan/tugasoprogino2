-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2010 at 04:33 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `progin2`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseid` int(11) NOT NULL AUTO_INCREMENT,
  `coursecode` varchar(256) NOT NULL,
  `coursename` varchar(256) NOT NULL,
  `coursefaculty` int(11) NOT NULL,
  `courseprogram` int(11) NOT NULL,
  PRIMARY KEY (`courseid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `coursecode`, `coursename`, `coursefaculty`, `courseprogram`) VALUES
(5, 'IF17037', 'Pengantar Otomotif', 0, 2),
(4, 'IF3038', 'Pemrograman Internet', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `courseinstance`
--

CREATE TABLE IF NOT EXISTS `courseinstance` (
  `courseinstanceid` int(11) NOT NULL AUTO_INCREMENT,
  `courseid` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `status` enum('OPEN','CLOSED') NOT NULL,
  PRIMARY KEY (`courseinstanceid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `courseinstance`
--

INSERT INTO `courseinstance` (`courseinstanceid`, `courseid`, `year`, `semester`, `status`) VALUES
(7, 5, 2009, 2, 'OPEN');

-- --------------------------------------------------------

--
-- Table structure for table `courseinstancefollowing`
--

CREATE TABLE IF NOT EXISTS `courseinstancefollowing` (
  `followid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `courseinstanceid` int(11) NOT NULL,
  PRIMARY KEY (`followid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `courseinstancefollowing`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancemanager`
--

CREATE TABLE IF NOT EXISTS `courseinstancemanager` (
  `relationid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `courseinstanceid` int(11) NOT NULL,
  PRIMARY KEY (`relationid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `courseinstancemanager`
--

INSERT INTO `courseinstancemanager` (`relationid`, `userid`, `courseinstanceid`) VALUES
(4, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `courseinstancerepository`
--

CREATE TABLE IF NOT EXISTS `courseinstancerepository` (
  `repositoryid` int(11) NOT NULL AUTO_INCREMENT,
  `courseinstanceid` int(11) NOT NULL,
  `uploadtimestamp` datetime NOT NULL,
  `status` enum('PUBLIC','FOLLOWER','PRIVATE') NOT NULL,
  `filename` varchar(256) NOT NULL,
  `filenamehash` varchar(256) NOT NULL,
  `filesize` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `category` varchar(256) NOT NULL DEFAULT 'Uncategorized',
  PRIMARY KEY (`repositoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `courseinstancerepository`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancetopic`
--

CREATE TABLE IF NOT EXISTS `courseinstancetopic` (
  `topicid` int(11) NOT NULL AUTO_INCREMENT,
  `courseinstanceid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `subtitle` varchar(256) NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`topicid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `courseinstancetopic`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancetopicpost`
--

CREATE TABLE IF NOT EXISTS `courseinstancetopicpost` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `topicid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`postid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `courseinstancetopicpost`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancewallpost`
--

CREATE TABLE IF NOT EXISTS `courseinstancewallpost` (
  `wallpostid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `courseinstanceid` int(11) NOT NULL,
  PRIMARY KEY (`wallpostid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `courseinstancewallpost`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancewallpostcomment`
--

CREATE TABLE IF NOT EXISTS `courseinstancewallpostcomment` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `wallpostid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `courseinstanceid` int(11) NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `courseinstancewallpostcomment`
--


-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `facultyid` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`facultyid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyid`, `code`, `name`) VALUES
(4, 'STEI', 'Sekolah Teknik Elektro dan Informatika'),
(2, 'FSRD', 'Fakultas Seni Rupa dan Desain');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `programid` int(11) NOT NULL AUTO_INCREMENT,
  `facultyid` int(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`programid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`programid`, `facultyid`, `code`, `name`) VALUES
(2, 4, 'IF', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `fullname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `birthdate` date NOT NULL,
  `telephone` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `role` enum('ADMIN','USER') NOT NULL,
  `status` enum('ACTIVE','PENDING','DISABLED') NOT NULL,
  `registerdate` datetime NOT NULL,
  `avatar` varchar(256) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `fullname`, `email`, `birthdate`, `telephone`, `address`, `gender`, `role`, `status`, `registerdate`, `avatar`) VALUES
(9, 'ssssss', 'af15d5fdacd5fdfea300e88a8e253e82', 'The Student', 'zadan@zadan.com', '2010-03-01', '1111111111', 'zzzzzzzzzzzzzzzzzzzz', 'M', 'USER', 'PENDING', '2010-03-26 11:03:15', 'af15d5fdacd5fdfea300e88a8e253e82.jpg'),
(7, 'dosen', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'Prof. Ivni Nipakov ,phD.', 'nipakov@google.com', '2010-03-09', '111111111111111', 'zzzzzzzzzzzzzzzzzzzzz', 'M', 'USER', 'PENDING', '2010-03-26 05:31:01', 'ce28eed1511f631af6b2a7bb0a85d636.jpg'),
(8, 'aaaaaa', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'The Administrator', 'zadan@zadan.com', '2010-03-08', '11111111119', 'zzzzzzzzzzzzzzzzzzz', 'M', 'ADMIN', 'PENDING', '2010-03-26 09:11:59', '0b4e7a0e5fe84ad35fb5f95b9ceeac79.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userfollowing`
--

CREATE TABLE IF NOT EXISTS `userfollowing` (
  `followid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `targetuserid` int(11) NOT NULL,
  PRIMARY KEY (`followid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `userfollowing`
--


-- --------------------------------------------------------

--
-- Table structure for table `userrepository`
--

CREATE TABLE IF NOT EXISTS `userrepository` (
  `repositoryid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `uploadtimestamp` datetime NOT NULL,
  `status` enum('PUBLIC','FOLLOWER','PRIVATE') NOT NULL,
  `filename` varchar(256) NOT NULL,
  `filenamehash` varchar(256) NOT NULL,
  `filesize` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `category` varchar(256) NOT NULL,
  PRIMARY KEY (`repositoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `userrepository`
--

INSERT INTO `userrepository` (`repositoryid`, `userid`, `uploadtimestamp`, `status`, `filename`, `filenamehash`, `filesize`, `counter`, `category`) VALUES
(1, 3, '2010-03-25 15:26:26', 'PUBLIC', '5157d431cfd05dd51044e7794ce06b11.jpg', '5157d431cfd05dd51044e7794ce06b11.jpg', 0, 0, ''),
(2, 4, '2010-03-25 15:32:57', 'PUBLIC', '3355d92c04a3332339b767f9278405ff.jpg', '3355d92c04a3332339b767f9278405ff.jpg', 67695, 0, ''),
(3, 2, '2010-03-25 15:42:39', 'PUBLIC', '429253.jpg', '7f95fdb2d95a59c8f957afe9925fd051.jpg', 93105, 1, ''),
(4, 2, '2010-03-25 17:19:51', 'PUBLIC', '234682.jpg', 'd30605c62a10258e8a9d7dd7aa60a246.jpg', 65006, 0, ''),
(6, 5, '2010-03-25 22:37:21', 'PUBLIC', 'Square_darthRevan.jpg', 'bd265435dc8da77f112e4b13b5420dd4.jpg', 42872, 0, ''),
(7, 7, '2010-03-26 05:31:25', 'PRIVATE', 'ce28eed1511f631af6b2a7bb0a85d636.jpg', 'ce28eed1511f631af6b2a7bb0a85d636.jpg', 49464, 0, 'gambar'),
(8, 7, '2010-03-26 07:34:02', 'PUBLIC', 'Square_darthNihilus.jpg', '54b287812bca9648e6aa51d475122867.jpg', 39906, 0, ''),
(9, 8, '2010-03-26 09:12:23', 'PUBLIC', '0b4e7a0e5fe84ad35fb5f95b9ceeac79.jpg', '0b4e7a0e5fe84ad35fb5f95b9ceeac79.jpg', 41285, 0, ''),
(10, 9, '2010-03-26 11:03:39', 'PUBLIC', 'af15d5fdacd5fdfea300e88a8e253e82.jpg', 'af15d5fdacd5fdfea300e88a8e253e82.jpg', 11737, 0, ''),
(11, 7, '2010-03-26 13:03:55', 'PUBLIC', 'senshuken.html', '79e62f4d84704fba6c9f02e42dab9bac.html', 3322, 0, 'Uncategorized');

-- --------------------------------------------------------

--
-- Table structure for table `userwallpost`
--

CREATE TABLE IF NOT EXISTS `userwallpost` (
  `wallpostid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `targetuserid` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`wallpostid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `userwallpost`
--


-- --------------------------------------------------------

--
-- Table structure for table `userwallpostcomment`
--

CREATE TABLE IF NOT EXISTS `userwallpostcomment` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `wallpostid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `userwallpostcomment`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2010 at 03:06 
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `course`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `courseinstance`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancefollowing`
--

CREATE TABLE IF NOT EXISTS `courseinstancefollowing` (
  `followid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `courseinstanceid` int(11) NOT NULL,
  PRIMARY KEY (`followid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `courseinstancemanager`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancerepository`
--

CREATE TABLE IF NOT EXISTS `courseinstancerepository` (
  `repositoryid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `uploadtimestamp` datetime NOT NULL,
  `status` enum('PUBLIC','FOLLOWER','PRIVATE') NOT NULL,
  `filename` varchar(256) NOT NULL,
  `filenamehash` varchar(256) NOT NULL,
  `filesize` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`repositoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `courseinstancetopic`
--


-- --------------------------------------------------------

--
-- Table structure for table `courseinstancetopicpost`
--

CREATE TABLE IF NOT EXISTS `courseinstancetopicpost` (
  `postid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`postid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`wallpostid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `courseinstancewallpostcomment`
--


-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `programid` int(11) NOT NULL DEFAULT '0',
  `code` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`programid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--


-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `facultyid` int(11) NOT NULL DEFAULT '0',
  `code` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`facultyid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `fullname`, `email`, `birthdate`, `telephone`, `address`, `gender`, `role`, `status`, `registerdate`, `avatar`) VALUES
(1, 'andika', '42fcca6854c8945c26d02060c9270f9a', 'Andika Pratama', 'assda@vdf.com', '2010-03-08', '12345678', 'sdahgdbrfjktykbt', 'M', 'USER', 'PENDING', '2010-03-25 13:43:08', '7e51eea5fa101ed4dade9ad3a7a072bb.jpg'),
(2, 'somin', 'a3bc27e6c84695cf828820d698cb1042', 'sominology', 'afsagsdf@gmai.fom', '2010-03-18', '2132143525346', 'fasffdsgfdjhfyjyr', 'M', 'USER', 'PENDING', '2010-03-25 14:50:57', 'c0cf8c2325b23c3d807a98df7ab3580b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userfollowing`
--

CREATE TABLE IF NOT EXISTS `userfollowing` (
  `followid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `targetuserid` int(11) NOT NULL,
  PRIMARY KEY (`followid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`repositoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `userrepository`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userwallpost`
--

INSERT INTO `userwallpost` (`wallpostid`, `userid`, `targetuserid`, `content`, `timestamp`) VALUES
(1, 1, 0, 'andika ganteng looh', '2010-03-25 13:45:13'),
(2, 1, 0, 'boleh jugaaa', '2010-03-25 13:45:24'),
(3, 1, 0, 'ya udahlah gini dulu yah', '2010-03-25 14:04:57'),
(4, 1, 0, 'oke, test lagi', '2010-03-25 14:19:10'),
(5, 2, 0, 'huuhu', '2010-03-25 14:52:05');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userwallpostcomment`
--

INSERT INTO `userwallpostcomment` (`commentid`, `wallpostid`, `userid`, `content`, `timestamp`) VALUES
(1, 1, 1, 'halo?', '2010-03-25 14:00:42'),
(2, 1, 1, 'ayo doong', '2010-03-25 14:00:53'),
(3, 2, 1, 'ok', '2010-03-25 14:10:44'),
(4, 4, 1, 'lumayan', '2010-03-25 14:19:15'),
(5, 4, 2, 'hohoho', '2010-03-25 14:57:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

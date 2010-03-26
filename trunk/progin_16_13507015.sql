-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2010 at 04:30 
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

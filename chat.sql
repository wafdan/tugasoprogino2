-- MySQL dump 10.13  Distrib 5.1.41, for Win32 (ia32)
--
-- Host: localhost    Database: chat
-- ------------------------------------------------------
-- Server version	5.1.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `chatid` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(256) NOT NULL,
  `receiver` varchar(256) NOT NULL,
  `message` varchar(256) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chatid`)
) ENGINE=MyISAM AUTO_INCREMENT=728 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (253,'7667','23','halo','2010-03-30 09:10:32'),(234,'23','1001','','2010-03-30 09:08:20'),(235,'23','1001','','2010-03-30 09:08:21'),(237,'7667','1001','jiwo','2010-03-30 09:08:31'),(138,'1','3','','2010-03-30 08:47:49'),(139,'1','3',':*','2010-03-30 08:48:00'),(231,'23','1001','hai hai...','2010-03-30 09:07:49'),(150,'1','1001',':*','2010-03-30 08:50:22'),(160,'12','1001','gini jiw?','2010-03-30 08:52:34'),(256,'1002','1001','halo...halo','2010-03-30 10:06:53'),(257,'1412','1001','ini coba-coba.. :D','2010-03-30 10:45:26'),(258,'1412','1001','wow,,, keren2','2010-03-30 10:47:02'),(259,'1412','1001','','2010-03-30 10:47:05'),(260,'1412','1001','wow,, keren','2010-03-30 10:47:08'),(261,'1412','1001','(worship) for the developer.. :D','2010-03-30 10:47:21'),(262,'1','2','www','2010-03-30 10:51:58'),(263,'3000','2000','ada orang?','2010-03-30 10:52:56'),(264,'3000','1001','ada orang?','2010-03-30 10:53:34'),(265,'2000','1001','woo...:D','2010-03-30 10:59:51'),(266,'2000','1001','mw tanya lagi dunk...','2010-03-30 10:59:58'),(267,'2000','1001','misal aku ga nyambung sama internet...','2010-03-30 11:00:06'),(268,'2000','1001','aku bisa nyobanya lwt 2 browser ga?','2010-03-30 11:00:14'),(313,'1','2','test','2010-03-30 12:30:34'),(314,'1','2','ah ini lah kan','2010-03-30 12:30:47'),(318,'2000','1001','jiwooooo online gak','2010-04-01 02:52:17'),(319,'2000','1001','jiwoooooooooooo','2010-04-01 02:52:24'),(323,'6223','6874','tes','2010-04-02 18:20:16'),(491,'9083','7311','tes juga','2010-04-03 00:44:16'),(492,'9083','7311','O','2010-04-03 00:44:24'),(456,'6880','8203','uooooooooohhhhhhhhh -_-','2010-04-02 18:46:18'),(382,'7837','2592',':D','2010-04-02 18:33:47'),(451,'7837','8203','silakan..:D','2010-04-02 18:45:19'),(494,'7849','2792','hoi','2010-04-03 01:11:24'),(510,'testing','fajar','/buzz','2010-04-03 01:36:26'),(508,'orang_gila','fajar','iseng doang','2010-04-03 01:23:39'),(682,'jitheng','samuel_zulkhifly','tes','2010-04-05 07:22:17'),(518,'wanda','dodol','oi juga','2010-04-03 03:08:24'),(715,'galih','warok','tes...;D','2010-04-05 11:57:35'),(689,'testing','test','mencobasaja ini','2010-04-05 11:37:09'),(686,'testing','test','hai','2010-04-05 11:36:59'),(687,'testing','test','hai','2010-04-05 11:37:01'),(688,'testing','test','coba coba','2010-04-05 11:37:03'),(716,'galih','testing','ini siapa?','2010-04-05 11:57:42'),(717,'galih','testing',':D','2010-04-05 11:57:43'),(720,'galih','testing','yoi...','2010-04-05 11:57:49'),(726,'bani','ujicoba','gabungin sama ai3 wo','2010-04-05 11:59:46');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presence`
--

DROP TABLE IF EXISTS `presence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presence` (
  `presenceid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(256) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`presenceid`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presence`
--

LOCK TABLES `presence` WRITE;
/*!40000 ALTER TABLE `presence` DISABLE KEYS */;
INSERT INTO `presence` VALUES (24,'6223','2010-04-02 18:20:37'),(25,'1283','2010-04-02 19:31:32'),(26,'8430','2010-04-02 17:37:40'),(27,'8885','2010-04-02 17:40:16'),(28,'2823','2010-04-02 18:14:57'),(29,'6874','2010-04-02 17:49:40'),(30,'2792','2010-04-03 01:11:11'),(31,'7837','2010-04-03 14:59:22'),(32,'2592','2010-04-02 18:33:21'),(33,'6880','2010-04-02 18:59:12'),(34,'8203','2010-04-02 18:44:57'),(35,'671','2010-04-03 04:48:13'),(36,'2951','2010-04-02 21:40:39'),(37,'8171','2010-04-03 01:12:31'),(38,'1767','2010-04-05 07:03:57'),(39,'6059','2010-04-02 22:13:21'),(40,'6188','2010-04-02 22:49:38'),(41,'2561','2010-04-02 22:24:05'),(42,'3138','2010-04-02 23:42:15'),(43,'8385','2010-04-02 23:34:48'),(44,'925','2010-04-02 23:39:24'),(45,'2859','2010-04-02 23:46:23'),(46,'8097','2010-04-02 23:47:00'),(47,'8411','2010-04-03 00:09:51'),(48,'9083','2010-04-03 23:30:06'),(49,'7836','2010-04-03 00:12:37'),(50,'7311','2010-04-03 00:31:50'),(51,'7808','2010-04-03 00:31:07'),(52,'2124','2010-04-03 00:43:14'),(53,'9466','2010-04-03 01:08:17'),(54,'7849','2010-04-03 01:12:44'),(55,'test','2010-04-05 11:36:47'),(56,'amrul_no_1','2010-04-03 01:12:26'),(57,'orang_gila','2010-04-03 01:56:03'),(58,'anonymous','2010-04-05 06:59:13'),(59,'tes','2010-04-03 01:27:18'),(60,'testing','2010-04-05 11:54:47'),(61,'fajar','2010-04-03 01:22:58'),(62,'7120','2010-04-03 01:21:20'),(63,'haho','2010-04-03 01:36:18'),(64,'wanda','2010-04-03 05:05:59'),(65,'wandong','2010-04-03 05:05:45'),(66,'dodol','2010-04-03 03:08:18'),(67,'matasapi','2010-04-03 03:25:35'),(68,'2192','2010-04-03 03:31:13'),(69,'18108037','2010-04-03 03:53:51'),(70,'hilman','2010-04-03 04:12:02'),(71,'firman','2010-04-03 05:34:23'),(72,'ade','2010-04-03 06:02:21'),(73,'fernando_lawrens','2010-04-03 06:05:07'),(74,'m.anis','2010-04-03 07:21:31'),(75,'rizki','2010-04-03 06:20:47'),(76,'untu','2010-04-03 12:23:06'),(77,'13307055','2010-04-03 07:58:57'),(78,'srijoko','2010-04-03 09:56:55'),(79,'aisar','2010-04-03 10:45:23'),(80,'8673','2010-04-03 11:18:24'),(81,'77','2010-04-03 11:18:58'),(82,'wafdan','2010-04-03 20:56:18'),(83,'muharif','2010-04-03 11:45:26'),(84,'gareszt','2010-04-03 11:53:06'),(85,'x','2010-04-03 13:00:13'),(86,'kk','2010-04-03 13:04:17'),(87,'testes','2010-04-03 13:08:01'),(88,'hmmm','2010-04-03 19:58:00'),(89,'j','2010-04-03 15:04:35'),(90,'imam116','2010-04-03 20:28:35'),(91,'hfdh','2010-04-03 22:30:21'),(92,'nanang','2010-04-04 02:35:09'),(93,'qwww','2010-04-04 03:03:59'),(94,'jitheng','2010-04-05 07:31:12'),(95,'tara','2010-04-05 14:05:03'),(96,'galih','2010-04-05 13:14:40'),(97,'anonim','2010-04-05 06:35:35'),(98,'aaa','2010-04-05 06:33:00'),(99,'gerard','2010-04-05 06:33:03'),(100,'cuk','2010-04-05 06:56:15'),(101,'samuel_zulkhifly','2010-04-05 07:22:15'),(102,'fathiyakan','2010-04-05 07:56:07'),(103,'wahyu_h','2010-04-05 09:33:57'),(104,'wahyu_h@arc.itb.ac.id','2010-04-05 09:33:38'),(105,'warok','2010-04-05 11:36:25'),(106,'asdf','2010-04-05 11:30:49'),(107,'ujicoba','2010-04-05 11:54:00'),(108,'bani','2010-04-05 12:06:21'),(109,'oi','2010-04-05 11:47:15'),(110,'irfanzz','2010-04-05 13:50:51'),(111,'7676','2010-04-05 11:53:40'),(112,'5456','2010-04-05 11:54:03'),(113,'sesdika','2010-04-05 12:56:19'),(114,'9616','2010-04-05 11:57:49'),(115,'9302','2010-04-05 12:04:10'),(116,'5831','2010-04-05 12:06:01'),(117,'1299','2010-04-05 13:44:37');
/*!40000 ALTER TABLE `presence` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-04-05 21:05:04

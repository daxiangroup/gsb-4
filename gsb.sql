-- MySQL dump 10.13  Distrib 5.5.29, for osx10.6 (i386)
--
-- Host: localhost    Database: gsb
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `graduating_year` int(4) DEFAULT '0',
  `admin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `co_admin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `max_size` tinyint(3) NOT NULL DEFAULT '0',
  `headline` varchar(255) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '0',
  `buddies_approval` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_year` (`graduating_year`),
  KEY `idx_admin` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'The Best Group EVER!',2016,1,2,6,'We meet on Thursdays near the gym','we rule the world',0,1,'2013-08-07 16:07:03','2013-08-07 16:07:03'),(2,'We are great',NULL,2,0,8,'We play games in between sessions','the games are fun, they break up the study',0,0,'0000-00-00 00:00:00','2013-08-04 14:10:09'),(3,'Something that someone wants to study to',2018,1,0,10,'Hardcore study time','Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis.',0,0,'2013-04-06 00:36:39','0000-00-00 00:00:00'),(4,'Something Meaningful',2017,2,1,10,'Oh man, you\'re gonna get studied!','Donec sed odio dui. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',0,0,'2013-08-07 15:49:18','2013-08-07 15:49:18');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_buddies`
--

DROP TABLE IF EXISTS `groups_buddies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_buddies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `profile_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_buddies`
--

LOCK TABLES `groups_buddies` WRITE;
/*!40000 ALTER TABLE `groups_buddies` DISABLE KEYS */;
INSERT INTO `groups_buddies` VALUES (1,4,1,0,NULL,'0000-00-00 00:00:00'),(2,2,1,0,NULL,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `groups_buddies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups_meetings`
--

DROP TABLE IF EXISTS `groups_meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups_meetings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `day` tinyint(1) NOT NULL DEFAULT '0',
  `time_start` time NOT NULL DEFAULT '00:00:00',
  `time_end` time NOT NULL DEFAULT '00:00:00',
  `notes` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_group` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups_meetings`
--

LOCK TABLES `groups_meetings` WRITE;
/*!40000 ALTER TABLE `groups_meetings` DISABLE KEYS */;
INSERT INTO `groups_meetings` VALUES (1,1,2,'20:00:00','21:00:00',''),(2,1,4,'20:00:00','21:00:00','here are some notes for the meeting'),(3,2,3,'17:00:00','19:30:00','');
/*!40000 ALTER TABLE `groups_meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(75) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL DEFAULT '',
  `full_name` varchar(60) NOT NULL DEFAULT '',
  `graduating_year` int(4) unsigned NOT NULL,
  `bio` varchar(255) NOT NULL DEFAULT '',
  `language` char(2) NOT NULL DEFAULT 'en',
  `minimum_complete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'ts@daxiangroup.com','$2y$08$oqEsIci7tndBRgMCmPA.rOq9Ou/88VcTHqKXQ6OpMHqbidqo9v8yC','jimmy','Tyler Schwartz',2017,'I rule the world! don\'t you know...','en',0),(2,'ts@test.com','$2y$08$oqEsIci7tndBRgMCmPA.rOq9Ou/88VcTHqKXQ6OpMHqbidqo9v8yC','pauly','Second Dude',2017,'Man, do I ever rule!','en',0),(3,'jj@gmail.com','$2y$08$9Y.7srolA.aeTAN3DTVYLuSlePIp0xVZ5kFQIiNkd3oZLaeVZxQn.','','jimmy james',0,'','en',0),(15,'honny@blamaramma.com','$2y$08$xFmhfV/gcrrozNthYJ4b6.rAM1eOzbNLX64q.bjbKVGFdDua3CCW2','','test unique',2017,'','en',0);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-05 22:05:41

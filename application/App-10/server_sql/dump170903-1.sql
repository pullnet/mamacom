CREATE DATABASE  IF NOT EXISTS `app10` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `app10`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: app10
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.8-MariaDB

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
-- Table structure for table `table1`
--

DROP TABLE IF EXISTS `table1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `refresh_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `refresh_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `colum_a1` varchar(255) DEFAULT NULL,
  `colum_a2` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  `caption` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COMMENT='テーブル1';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table1`
--

LOCK TABLES `table1` WRITE;
/*!40000 ALTER TABLE `table1` DISABLE KEYS */;
INSERT INTO `table1` VALUES (10,'2017-08-29 13:10:49','2017-08-29 13:44:53',NULL,NULL,'aaa','eee','ccc',2,''),(20,'2017-08-29 14:24:58','2017-08-29 18:02:23',NULL,NULL,'nonononon12387','yes','4555555',2,'03030303'),(24,'2017-08-29 18:01:33','2017-08-29 18:01:33',NULL,NULL,'レコード登録テスト','A00001','テスト名1111111111111',1,'aaaaaaaaaa');
/*!40000 ALTER TABLE `table1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table2`
--

DROP TABLE IF EXISTS `table2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `refresh_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `refresh_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `colum_a` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  `caption` text,
  `select_b` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table2`
--

LOCK TABLES `table2` WRITE;
/*!40000 ALTER TABLE `table2` DISABLE KEYS */;
INSERT INTO `table2` VALUES (2,'2017-09-01 15:36:05','2017-09-02 10:23:30',NULL,NULL,'あああああああああああ改良2','123456789','07a9fdf81472a19ea207621c1de0d43d35e4557d03ddc22f8a7f59bb93db3883','f20035227927ea6929f3bf615e945c41f42507680d2e0d3122761818eb70565e','ああああああああああああああああああああああああああああああああああああああああああ','aaa'),(5,'2017-09-02 10:19:52','2017-09-02 10:35:30',NULL,NULL,'てすとあああああ改良3','999999','e92784f88928e5c29e0528b5ecc7e1348b319db58e84e5f213882248cb16f8fe','53ec441ca322080a55f137207026ba9572bd331d656a54ae07fa32ec5026df81','aaaaaaaaaaaaa','bbb');
/*!40000 ALTER TABLE `table2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `refresh_date` datetime DEFAULT NULL,
  `refresh_user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mailaddress` varchar(255) DEFAULT NULL,
  `user_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'2017-09-03 23:38:11',NULL,'2017-09-03 23:38:11',NULL,'testuser','59408aefd685a5da51dfa319abfc797c16537cae463ba0936cf247084bbed2ff','nktj_takakazu2014@yahoo.co.jp','74ef9366f26187afb7ffcca27146685cdb83afe37822ec082a454813c39472fd');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userprov`
--

DROP TABLE IF EXISTS `userprov`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `refresh_date` datetime DEFAULT NULL,
  `refresh_user_id` int(11) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `mailaddress` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userprov`
--

LOCK TABLES `userprov` WRITE;
/*!40000 ALTER TABLE `userprov` DISABLE KEYS */;
INSERT INTO `userprov` VALUES (3,'2017-09-03 11:21:52',NULL,'2017-09-03 11:21:52',NULL,'59ab6','nktj_takakazu2014@yahoo.co.jp','testuser','{\"mailaddress\":\"nktj_takakazu2014@yahoo.co.jp\",\"username\":\"testuser\",\"password\":\"testuser\",\"user_icon\":\"e1a3d85ef9cbbf0c958de7431fe6cf6c71e954ee3035e58ff7d5a1ae64ca78da\"}');
/*!40000 ALTER TABLE `userprov` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-04  0:19:28

CREATE DATABASE  IF NOT EXISTS `app10` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `app10`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: app10
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COMMENT='テーブル1';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table1`
--

LOCK TABLES `table1` WRITE;
/*!40000 ALTER TABLE `table1` DISABLE KEYS */;
INSERT INTO `table1` VALUES (10,'2017-08-29 13:10:49','2017-08-29 13:44:53',NULL,NULL,'aaa','eee','ccc',2,''),(20,'2017-08-29 14:24:58','2017-08-29 18:02:23',NULL,NULL,'nonononon12387','yes','4555555',2,'03030303'),(24,'2017-08-29 18:01:33','2017-08-29 18:01:33',NULL,NULL,'レコード登録テスト','A00001','テスト名1111111111111',1,'aaaaaaaaaa'),(28,'2017-09-04 15:56:40','2017-09-04 15:56:40',NULL,NULL,'ああああ','55555555','333',1,''),(29,'2017-09-04 15:57:27','2017-09-04 15:57:27',2,2,'eeeee','eee','aaaaaaaa',1,''),(30,'2017-09-04 18:13:36','2017-09-04 18:13:36',2,2,'追加ああああああああああああ','abc2070000','5555555',1,'tuika.....\r\n\r\n<h1>aa</h1>'),(34,'2017-09-07 17:01:39','2017-09-07 17:01:39',2,2,'20170907.000000','xxxxxxxxx','121611111',1,'ああああああああええええ'),(35,'2017-09-07 17:02:11','2017-09-07 17:02:11',2,2,'20170907.YYYYYYYYYYYYY','eeee','9999999999999999',1,'いいいいいいいいいいいいいいいいいいいいいいいいいいいいいいいいいい');
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table2`
--

LOCK TABLES `table2` WRITE;
/*!40000 ALTER TABLE `table2` DISABLE KEYS */;
INSERT INTO `table2` VALUES (2,'2017-09-01 15:36:05','2017-09-02 10:23:30',NULL,NULL,'あああああああああああ改良2','123456789','07a9fdf81472a19ea207621c1de0d43d35e4557d03ddc22f8a7f59bb93db3883','f20035227927ea6929f3bf615e945c41f42507680d2e0d3122761818eb70565e','ああああああああああああああああああああああああああああああああああああああああああ','aaa'),(5,'2017-09-02 10:19:52','2017-09-02 10:35:30',NULL,NULL,'てすとあああああ改良3','999999','e92784f88928e5c29e0528b5ecc7e1348b319db58e84e5f213882248cb16f8fe','53ec441ca322080a55f137207026ba9572bd331d656a54ae07fa32ec5026df81','aaaaaaaaaaaaa','bbb'),(8,'2017-09-04 14:03:14','2017-09-04 14:03:14',NULL,NULL,'ああああああああああああ','222222','54f6ddc2997c249d91f3deced16ec27454dc1dd5a7b27a0c25ab767cce8c519e','d6aee601a3ce97d1b730b64f16d453f550141d5768884f8adcc1cadf1cd2756f','おっけい\r\nああああああああああああああああ','bbb'),(9,'2017-09-04 14:04:00','2017-09-04 14:04:00',NULL,NULL,'えええええ','33333','bf7ec7dfd7a413fd91acf05d40946eb79ca7a0bf525555be849fbfb0953ec03c','830b2daf7a9a628ed90ea2b99fdc108a0954311fa2956a2d0843c685614118f3','aaaaaa\r\nbbbbbbbb\r\ncccccccccccccccccccccccccc','bbb'),(10,'2017-09-04 14:04:37','2017-09-04 14:04:37',NULL,NULL,'eeee','12345689','7c5b3dbaf53d11d10c3327c851ce69494ac6d83bead3b78ea0849222e412db0c','','eeee','aaa'),(11,'2017-09-07 12:25:01','2017-09-07 12:25:01',NULL,NULL,'テスト4848484848','5555555','05cc5f0800c8034ec8ab4676591b445c023ad411f1cd15a84f598847a945c510','86c671e7a9af5f9af0ba42b5b30478766617d0ddd0ae11db92697b1eb33ee30e','eeeddddaaaaa\r\n\r\n121312132123','bbb'),(13,'2017-09-07 17:26:34','2017-09-07 17:28:53',2,2,'aeeeee17777','11112020','7ac17b89a451201e398e9403f55576efd76b6ee6d28a4b1ab4974db754df3f09','2a12af0a737fea64f7de1062198d1aad548bece2b7eea8ae90cfce61343a789e','ee11','ccc'),(16,'2017-09-07 17:43:40','2017-09-07 17:43:40',2,2,'どんどこテスト12345','2222222','8deb6f51f54a51197d1360bd4ab66b2cc3ec4e298f57d38337d61eac83eaeae4','c0ff6a57c0627b18ac07133e9cc5086f37a1e9b8b861be01f00aa09d4ded8cfa','aa','ccc'),(17,'2017-09-07 17:44:08','2017-09-07 17:44:08',2,2,'xxxxxxxxxxxxxxxxxx','66666666666666','0b5e79534b27483e297bcc7f79d5aa9b71bc3d3dca92ca4b03281a69de15ef81','89448a2647a77ec0a88e6a8a6b645d59c3d4f68834bf0cdbdd1a03784742a292','eeeyyyyy','ccc'),(18,'2017-09-07 17:44:34','2017-09-07 17:44:34',2,2,'nnnnnnnn','222222','21d34d81c6bc5f557067aef74a67928344e064200be5ec801ba5918f2a298c21','e5e48322af5b3414023f0763b4b0d2e9796ef1a693f1a0ab3f42bbe55e5df93e','eefffaaaaaaaaaaaaa','bbb'),(20,'2017-09-08 10:26:41','2017-09-08 10:26:41',NULL,NULL,'test1111','22222','bed1d3dc022843f2248e56811f8e14dfbbb9d1b935d78c567e2ee34efaf1d866','1c1f5d3ff1cae2f6b942d7a4bb46c0e578ebac90248dbd9e9d45b6072e46acc0','ssssssssssssssssssssssssss','ccc'),(21,'2017-09-08 10:40:00','2017-09-08 10:40:00',NULL,NULL,'mmmm','12346','45b77730590c7dfc1501a745c6fef80f6fb8862cf4bdeacc7c5cd2bc694a945b','314eef29a3ee3e8d2b3c8246722f2c1daddac5e4a02f7c8307393eb89d73eb78','aaaa','ccc'),(22,'2017-09-08 10:40:59','2017-09-08 10:40:59',NULL,NULL,'aaaaa','555555','c62430353cf7ff494871caaeec830b885ef085be5844e2d2f65005b9df37d095','86db3bca21eab3e24eb410232d3accf45d17ed46d86f0268fec4cb821ca17ba9','tatatatatatata','ccc'),(23,'2017-09-08 20:19:37','2017-09-08 20:19:37',2,2,'たなたなた','77777','bc275bf992dba99b5ef6c42cc108485af39005d0b549f07e222b24267acf46bb','b0cd42a381e90f1f2685eb94903350811d55f37b4243353c7edb091303cc6952','たなと','ccc');
/*!40000 ALTER TABLE `table2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table3`
--

DROP TABLE IF EXISTS `table3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` datetime DEFAULT NULL,
  `refresh_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `refresh_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `caption` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table3`
--

LOCK TABLES `table3` WRITE;
/*!40000 ALTER TABLE `table3` DISABLE KEYS */;
INSERT INTO `table3` VALUES (3,'2017-09-08 12:04:55','2017-09-08 12:30:22',2,2,'あああああああああああ改良2','22223','いいいいいいいいいいいいいいい\r\n\r\nええええええええ\r\nええええええええええええええええ'),(4,'2017-09-08 12:14:53','2017-09-08 12:14:53',2,2,'えええええ','6666','665\r\nああああああああああ\r\nええええええええええええ'),(6,'2017-09-08 18:23:34','2017-09-08 18:23:34',2,2,'いいいいいいい','1980777','11777\r\ndddddd'),(7,'2017-09-08 18:23:49','2017-09-08 18:23:49',2,2,'さささささｓｓｓｓｓ','888','aaaaaaaa\r\nccccccccccccc\r\n\r\n\r\ndddddddddddddddddddddd'),(8,'2017-09-08 18:24:19','2017-09-08 18:24:19',2,2,'テストレコード001','0001','あああああああああああああああああああああああああああああああああああ'),(9,'2017-09-08 18:24:32','2017-09-08 18:24:32',2,2,'テストレコード002','888888','あああああああああああええええええええええええええええええええええええええええええええええ'),(10,'2017-09-08 18:24:54','2017-09-08 18:24:54',2,2,'テストレコード003','5555555','いいいいいいい\r\n\r\nえええええええええええええええええええええええええええええええええええええええ'),(11,'2017-09-08 18:25:05','2017-09-08 18:25:05',2,2,'テストレコード004','8888888888','6666666666600000000000555555555555555555555555555'),(12,'2017-09-08 18:25:31','2017-09-08 18:25:31',2,2,'テストレコード005','06166665','TES'),(13,'2017-09-08 18:25:41','2017-09-08 18:25:41',2,2,'テストレコード006','000055555','1054588984D9AAAAAAAAAAA'),(14,'2017-09-08 18:26:31','2017-09-08 18:26:31',2,2,'テストレコード007','777777','777777777777'),(15,'2017-09-08 18:26:43','2017-09-08 18:26:43',2,2,'テストレコード008','88888888','148888888888888888888888888888888888888'),(16,'2017-09-08 18:51:36','2017-09-08 18:51:36',2,2,'テストレコード009','9999999','あああああああ\r\nあああああああああああああああああああああああああああああああ'),(17,'2017-09-08 18:51:52','2017-09-08 18:51:52',2,2,'テストレコード010','10101001','aaaaaeccccccccccccccccccc'),(18,'2017-09-08 18:52:05','2017-09-08 18:52:05',2,2,'テストレコード011','777777777777','ああああああああああ\r\nああああああああああああああああああああああああああああああああああ');
/*!40000 ALTER TABLE `table3` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'2017-09-03 23:38:11',NULL,'2017-09-07 16:50:18',2,'buteneko','fa060992a13735a58a25aadf3888054cf3c2e56bda1f5b3e40f2c981a070cfbf','nktj_takakazu2014@yahoo.co.jp','00224f6e7cc84590ab59ade2e8e3955ff9ddcee435f203d657d842321be1b014'),(3,'2017-09-04 14:14:54',NULL,'2017-09-04 14:14:54',NULL,'bbbb','9db7e85a89697ccb7e92b6d83fca0918cd435d618a3be996a01838f0f4159f2f','aaa','3b037b9ecd2e3f0f3c1a165cd2dc25d362cbd2c27ebf6fac511e221c63e22651'),(5,'2017-09-07 18:56:05',NULL,'2017-09-07 18:56:05',NULL,'admin1','39a407d94038b55af5637ae654735c469a1aa38673e7f0df8f79c121d0c987aa','aaaaaaaaaaa','ef3364973d4167a659b11f044207592dd48a572e4497096876e99dc184a16868');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
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

-- Dump completed on 2017-09-08 20:26:51

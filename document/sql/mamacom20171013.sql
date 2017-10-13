-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mamacom
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
-- Table structure for table `additems`
--

DROP TABLE IF EXISTS `additems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `additems` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `content_id` int(11) DEFAULT NULL COMMENT 'コンテンツID(FK):コンテンツ情報(Content)',
  `type` int(2) DEFAULT '0' COMMENT '追加コンテンツステータス:0:サムネイル、1:追加コンテンツ',
  `content` varchar(255) DEFAULT NULL COMMENT 'コンテンツURL、画像タグ番号:',
  `shortimgtag` varchar(255) DEFAULT NULL COMMENT 'ショートイメージ用タグ番号:',
  `open_status` int(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:非公開',
  `comment` varchar(255) DEFAULT NULL COMMENT 'コンテンツ備考情報:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='追加コンテンツ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additems`
--

LOCK TABLES `additems` WRITE;
/*!40000 ALTER TABLE `additems` DISABLE KEYS */;
/*!40000 ALTER TABLE `additems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `username` varchar(255) DEFAULT NULL COMMENT 'ユーザー名:',
  `password` varchar(100) DEFAULT NULL COMMENT 'パスワード:',
  `name` varchar(255) DEFAULT NULL COMMENT '管理者名:',
  `item_app_id` varchar(255) DEFAULT NULL COMMENT 'コンテンツ管理用アプリID:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='管理アカウント情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,NULL,NULL,NULL,NULL,'admin1','741770f452821c5d37032a904b84660ab48c950f','初期アカウント','1234'),(2,'2017-10-10 15:03:12','2017-10-10 15:03:12',1,1,'admin2','741770f452821c5d37032a904b84660ab48c950f','test','4a6db80438a3889a4b390273083c8c4e');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `name` varchar(255) DEFAULT NULL COMMENT 'カテゴリー名:',
  `html` text COMMENT 'htmlタグ:',
  `type_mode` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COMMENT='カテゴリー情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'アレルギー対応店',NULL,0),(2,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'ママ求人',NULL,0),(3,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'子育て支援室',NULL,0),(4,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'公園紹介',NULL,0),(5,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'授乳室ＭＡＰ',NULL,0),(6,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'地元ママ発信！地域のポータルサイト',NULL,0),(8,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'都島区',NULL,1),(9,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'城東区',NULL,1),(10,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'北区',NULL,1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `number` varchar(255) DEFAULT NULL COMMENT '管理番号:',
  `title` varchar(255) DEFAULT NULL COMMENT 'タイトル:',
  `open_status` int(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:非公開',
  `category_id` int(11) DEFAULT NULL COMMENT 'カテゴリID(FK):カテゴリー(Contentcategory)',
  `district_id` int(11) DEFAULT NULL COMMENT '地区ＩＤID(FK):地区(District)',
  `caption` text COMMENT 'コンテンツ概要（JSON）:JSONで記述',
  `shop_info` text COMMENT '店舗情報（JSON）:JSONで記述',
  `metatag` text COMMENT 'メタタグ情報:',
  `record_date` datetime DEFAULT NULL COMMENT '登録日:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='コンテンツ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (1,NULL,NULL,NULL,NULL,'2001','テストタイトル1',1,1,8,'説明テキストJSOM','店舗情報JSOM',NULL,NULL),(2,NULL,NULL,NULL,NULL,'2001','テストタイトル2',1,2,9,'説明テキストJSOM','店舗情報JSOM',NULL,NULL);
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `contentscategoryparent_id` int(11) DEFAULT NULL COMMENT 'カテゴリーID(FK):カテゴリー（Contentscategory）',
  `name` varchar(255) DEFAULT NULL COMMENT '地区名:',
  `html` text COMMENT 'htmlタグ:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='地区情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts`
--

LOCK TABLES `districts` WRITE;
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergencies`
--

DROP TABLE IF EXISTS `emergencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `number` varchar(255) DEFAULT NULL COMMENT '管理番号:',
  `title` varchar(255) DEFAULT NULL COMMENT 'タイトル:',
  `open_status` int(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:非公開',
  `district_id` int(11) DEFAULT NULL COMMENT '地区ＩＤID(FK):地区(District)',
  `caption` text COMMENT 'コンテンツ概要（JSON）:JSONで記述',
  `record_date` datetime DEFAULT NULL COMMENT '登録日:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='緊急お役立ち情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencies`
--

LOCK TABLES `emergencies` WRITE;
/*!40000 ALTER TABLE `emergencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `emergencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freepagecategories`
--

DROP TABLE IF EXISTS `freepagecategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freepagecategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `name` varchar(255) DEFAULT NULL COMMENT 'フリーページカテゴリー名:',
  `permalink` varchar(100) DEFAULT NULL COMMENT 'カテゴリーURL:',
  `html` text COMMENT 'html:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='フリーページカテゴリー情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freepagecategories`
--

LOCK TABLES `freepagecategories` WRITE;
/*!40000 ALTER TABLE `freepagecategories` DISABLE KEYS */;
INSERT INTO `freepagecategories` VALUES (1,'2017-10-10 00:00:00','2017-10-10 00:00:00',1,1,'お役立ち情報','useful',''),(2,'2017-10-10 00:00:00','2017-10-10 00:00:00',1,1,'アップデート情報','update',''),(3,'2017-10-10 00:00:00','2017-10-10 00:00:00',1,1,'その他','other','');
/*!40000 ALTER TABLE `freepagecategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freepages`
--

DROP TABLE IF EXISTS `freepages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freepages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `name` varchar(255) DEFAULT NULL COMMENT 'フリーページ名:',
  `title` varchar(255) DEFAULT NULL COMMENT 'ページタイトル:',
  `permalink` varchar(100) DEFAULT NULL COMMENT 'フリーページURL:',
  `html` text COMMENT 'html:',
  `page_status` int(2) DEFAULT '0' COMMENT 'ページ表示ステータス:0:有効、1:ヘッダーフッター非表示',
  `open_status` int(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:会員に公開、2:非公開',
  `freepagecategory_id` int(11) DEFAULT NULL COMMENT 'フリーページカテゴリーID(FK):フリーページカテゴリ(Freepagecategory)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='フリーページ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freepages`
--

LOCK TABLES `freepages` WRITE;
/*!40000 ALTER TABLE `freepages` DISABLE KEYS */;
INSERT INTO `freepages` VALUES (2,'2017-10-10 00:00:00','2017-10-10 19:23:09',1,1,'メルマガでお役立ち情報ゲット','メルマガでお役立ち情報ゲット',' mailmagazine','今ならメールマガジンのご登録でママ必見のお得情報をゲットできます。\r\n<a href=\"#\">詳しくはこちらをご覧下さい</a>',0,0,1),(3,'2017-10-13 16:47:41','2017-10-13 16:47:41',1,1,'test','メルマガでお役立ち情報ゲット','test','ｓだふぁｓｆさｄふぁｓｆｄ',0,0,2);
/*!40000 ALTER TABLE `freepages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `post_date` datetime DEFAULT NULL COMMENT '投稿日:',
  `title` varchar(255) DEFAULT NULL COMMENT 'タイトル:',
  `caption` text COMMENT 'インフォメーション内容:',
  `imgtag` text COMMENT '画像タグ:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='インフォメーション情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (1,'2017-10-10 15:25:51','2017-10-13 16:43:52',1,1,'2017-10-10 15:25:50','インフォメーション1','インフォメーションのテキストが入ります。インフォメーションのテキストが入ります。インフォメーションのテキストが入ります。',NULL),(2,'2017-10-13 16:43:45','2017-10-13 16:43:45',1,1,'2017-10-13 16:43:45','インフォメーション2','testテストtestテストtestテストtestテストtestテストtestテストtestテストtestテストtestテスト',NULL);
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inputerrors`
--

DROP TABLE IF EXISTS `inputerrors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inputerrors` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `code` varchar(100) DEFAULT NULL COMMENT '適用コード:',
  `name` varchar(255) DEFAULT NULL COMMENT '表示場所名:',
  `message` text COMMENT 'エラーメッセージ文:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入力エラー表示設定';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inputerrors`
--

LOCK TABLES `inputerrors` WRITE;
/*!40000 ALTER TABLE `inputerrors` DISABLE KEYS */;
/*!40000 ALTER TABLE `inputerrors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitedefaults`
--

DROP TABLE IF EXISTS `sitedefaults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitedefaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID:',
  `createdate` datetime DEFAULT NULL COMMENT '作成日時:',
  `refreshdate` datetime DEFAULT NULL COMMENT '更新日時:',
  `createuserid` int(11) DEFAULT NULL COMMENT '作成ユーザーID:',
  `refreshuserid` int(11) DEFAULT NULL COMMENT '更新ユーザーID:',
  `name` varchar(100) DEFAULT NULL COMMENT '項目名:',
  `value` text COMMENT '値:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='サイト基本情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitedefaults`
--

LOCK TABLES `sitedefaults` WRITE;
/*!40000 ALTER TABLE `sitedefaults` DISABLE KEYS */;
INSERT INTO `sitedefaults` VALUES (1,'2017-10-10 15:11:39','2017-10-10 15:11:39',1,1,'status','0'),(2,'2017-10-10 15:11:39','2017-10-10 15:11:39',1,1,'wwwurl','http://192.168.11.36/mamacom/development/www/'),(3,'2017-10-10 15:11:39','2017-10-10 15:11:39',1,1,'adminurl','http://192.168.11.36/mamacom/development/admin/'),(4,'2017-10-10 15:11:39','2017-10-10 15:11:39',1,1,'itemurl','http://192.168.11.36/mamacom/development/item/'),(5,'2017-10-10 15:11:39','2017-10-10 15:11:39',1,1,'apiurl','http://192.168.11.36/mamacom/development/api/');
/*!40000 ALTER TABLE `sitedefaults` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-13 16:50:01

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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COMMENT='追加コンテンツ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additems`
--

LOCK TABLES `additems` WRITE;
/*!40000 ALTER TABLE `additems` DISABLE KEYS */;
INSERT INTO `additems` VALUES (65,'2017-10-18 10:09:05','2017-10-18 10:09:05',1,1,40,0,'c270935c9089d0d7a1e5c08867a5adf4b5fad1f7e8bea446ded403864918e64a',NULL,0,NULL),(66,'2017-10-18 10:09:05','2017-10-18 10:09:05',1,1,40,1,'248d8f6b2942c9ddbcec10b0f8d3f1538036ede831e03e701fa5199c96e447ec',NULL,0,NULL),(67,'2017-10-18 10:09:05','2017-10-18 10:09:05',1,1,40,2,'05000b0b73d8488c6fcd1f9984a15ebde77dda245e3a65e18d1b9070557dbceb',NULL,0,NULL),(68,'2017-10-18 10:09:06','2017-10-18 10:09:06',1,1,40,3,'74a1dd8e512d22ea54e78a519f9f9dcb3e149fadfbeb4050b1add3fc5bafb33f',NULL,0,NULL),(69,'2017-10-18 10:09:06','2017-10-18 10:09:06',1,1,40,4,'e7b125d72e431096e9012fb4f84c0bc1d5086efc847337f1779b2baf23618b91',NULL,0,NULL),(70,'2017-10-18 10:09:06','2017-10-18 10:09:06',1,1,40,5,'a1ddd53a376e96a1d947ceaa8ad21cc90b23df43ef39d2e1845540eddda9f91f',NULL,0,NULL),(71,'2017-10-18 10:16:26','2017-10-18 10:16:26',1,1,41,0,'d1bb05d80ad9e41f3478864f23111ac69e5180819f99571859a086cdb716b555',NULL,0,NULL),(72,'2017-10-18 10:16:26','2017-10-18 10:16:26',1,1,41,1,'74b30d486b71ae787efdd2a1c249d2c9112779c7869a94a4146acb89ffcceec1',NULL,0,NULL),(73,'2017-10-18 10:16:26','2017-10-18 10:16:26',1,1,41,2,'9e2edb913cfdca7bfe26f802e683ddb670c87c554c4ed688b010398fb4ed2b28',NULL,0,NULL),(74,'2017-10-18 10:17:10','2017-10-18 10:17:10',1,1,42,0,'9efe6c2489397e55c8fffe20fda2bd7d750bf3cf69174048d315553dcec73b97',NULL,0,NULL),(75,'2017-10-18 10:17:58','2017-10-18 10:17:58',1,1,43,0,'c40d3eece418af3c5de0fae9b951ab6cde073ffc0e472fddab5871f3c31f84c3',NULL,0,NULL),(76,'2017-10-18 10:17:58','2017-10-18 10:17:58',1,1,43,1,'de9c392f7b9990c2b3e34230392dae74645aedd6f2645a19dd8060f63f3dead8',NULL,0,NULL),(77,'2017-10-18 10:30:49','2017-10-18 10:30:49',1,1,45,0,'9e8e0acc121c1963b6ab3ec1b30a777b5ce74eb28f45cfb285a304814882c593',NULL,0,NULL),(78,'2017-10-18 10:31:10','2017-10-18 10:31:41',1,1,44,0,'3ca1d1fb3d94efa4d39fcde23c5945037087f11cb7fcdaba6ba9dafbf0f5959d',NULL,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='管理アカウント情報';
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COMMENT='カテゴリー情報';
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COMMENT='コンテンツ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (40,'2017-10-18 10:09:05','2017-10-18 10:09:05',1,1,'a0001','アレルギー対応店テスト1',0,1,10,'{\"ttl1\":\"お店の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"このお店はアレルギー対応店テスト1です。\\r\\nお店のおすすめポイントや対応アレルギーなどが入力されます。\",\"text2\":\"補足事項が入ります。\\r\\n定休日や注意事項など、追記が必要な事項等が入力されます。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5420081\",\"address1\":\"大阪府\",\"address2\":\"大阪市中央区南船場3-10-26-吉川ビル6F\",\"tel\":\"0662437757\",\"shop_text\":\"[受付時間]：9:00-20:00\"}',NULL,NULL),(41,'2017-10-18 10:09:05','2017-10-18 10:19:10',1,1,'b0001','ママ求人テスト1',0,2,9,'{\"ttl1\":\"社名\",\"ttl2\":\"給与\",\"ttl3\":\"雇用形態\",\"ttl4\":\"最寄駅\",\"ttl5\":\"補足・その他\",\"text1\":\"ママ求人○○○○○株式会社\",\"text2\":\"時給970円～　\",\"text3\":\"(1)8:00～14:00●週2・3日～ＯＫ\\r\\n(2)8:00～17:00●週2・3日～ＯＫ\\r\\n(3)17:00～22:00●週2・3日～ＯＫ\\r\\n＊曜日・時間や扶養内勤務など相談ＯＫ\\r\\n＊学校やサークル、子供の送迎など考慮\\r\\n★交通費全額支給◎\",\"text4\":\"ＪＲ梅田駅より徒歩5分\",\"text5\":\"週2・3日～勤務時間・曜日相談お気軽に\"}','{\"postnumber\":\"5420081\",\"address1\":\"大阪府\",\"address2\":\"大阪市中央区南船場3-10-26-吉川ビル6F\",\"tel\":\"0662437757\",\"shop_text\":\"[受付時間]：9:00-20:00\"}',NULL,NULL),(42,'2017-10-18 10:09:05','2017-10-18 10:17:10',1,1,'c0001','子育て支援室テスト1',0,3,8,'{\"ttl1\":\"支援室の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"この場所は子育て支援室テスト1です。\\r\\nお店のおすすめポイントなどが入力されます。\",\"text2\":\"補足事項が入ります。\\r\\n定休日や注意事項など、追記が必要な事項等が入力されます。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5420081\",\"address1\":\"大阪府\",\"address2\":\"大阪市中央区南船場3-10-26-吉川ビル6F\",\"tel\":\"0662437757\",\"shop_text\":\"[受付時間]：9:00-20:00\"}',NULL,NULL),(43,'2017-10-18 10:09:05','2017-10-18 10:19:03',1,1,'d0001','公園紹介テスト1',0,4,10,'{\"ttl1\":\"公園の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"この公園は公園テスト1です。\\r\\n公園のおすすめポイントなどが入力されます。\",\"text2\":\"補足事項が入ります。\\r\\n定休日や注意事項など、追記が必要な事項等が入力されます。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5420081\",\"address1\":\"大阪府\",\"address2\":\"大阪市中央区南船場3-10-26-吉川ビル6F\",\"tel\":\"0662437757\",\"shop_text\":\"[受付時間]：9:00-20:00\"}',NULL,NULL),(44,'2017-10-18 10:09:05','2017-10-18 10:31:41',1,1,'e0001','授乳室マップテスト1',0,5,9,'{\"ttl1\":\"授乳室の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"この場所は授乳室テスト1です。\\r\\n授乳室のおすすめポイントなどが入力されます。\",\"text2\":\"補足事項が入ります。\\r\\n定休日や注意事項など、追記が必要な事項等が入力されます。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5420081\",\"address1\":\"大阪府\",\"address2\":\"大阪市中央区南船場3-10-26-吉川ビル6F\",\"tel\":\"0662437757\",\"shop_text\":\"[受付時間]：9:00-20:00\"}',NULL,NULL),(45,'2017-10-18 10:09:05','2017-10-18 10:30:49',1,1,'f0001','ポータルサイトテスト1',0,6,8,'{\"ttl1\":\"サイトの概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"このサイトは地域のおすすめポータルサイトテスト1です。\\r\\nサイトのおすすめポイントなどが入力されます。\",\"text2\":\"補足事項が入ります。\\r\\n定休日や注意事項など、追記が必要な事項等が入力されます。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5420081\",\"address1\":\"大阪府\",\"address2\":\"大阪市中央区南船場3-10-26-吉川ビル6F\",\"tel\":\"0662437757\",\"shop_text\":\"[受付時間]：9:00-20:00\"}',NULL,NULL),(46,'2017-10-18 10:09:05','2017-10-18 10:21:10',1,1,'f0001','テスト',0,1,10,'{\"ttl1\":\"お店の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"お店の概要\",\"text2\":\"補足・その他\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5420081\",\"address1\":\"大阪府\",\"address2\":\"大阪市中央区南船場3-10-26-吉川ビル6F\",\"tel\":\"0662437757\",\"shop_text\":\"[受付時間]：9:00-20:00\"}',NULL,NULL);
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='緊急お役立ち情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencies`
--

LOCK TABLES `emergencies` WRITE;
/*!40000 ALTER TABLE `emergencies` DISABLE KEYS */;
INSERT INTO `emergencies` VALUES (1,NULL,NULL,NULL,NULL,'123','test',0,6,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='フリーページ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freepages`
--

LOCK TABLES `freepages` WRITE;
/*!40000 ALTER TABLE `freepages` DISABLE KEYS */;
INSERT INTO `freepages` VALUES (2,'2017-10-10 00:00:00','2017-10-10 19:23:09',1,1,'メルマガでお役立ち情報ゲット','メルマガでお役立ち情報ゲット',' mailmagazine','今ならメールマガジンのご登録でママ必見のお得情報をゲットできます。\r\n<a href=\"#\">詳しくはこちらをご覧下さい</a>',0,0,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='インフォメーション情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (1,'2017-10-10 15:25:51','2017-10-13 16:43:52',1,1,'2017-10-10 15:25:50','インフォメーション1','インフォメーションのテキストが入ります。インフォメーションのテキストが入ります。インフォメーションのテキストが入ります。',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='サイト基本情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitedefaults`
--

LOCK TABLES `sitedefaults` WRITE;
/*!40000 ALTER TABLE `sitedefaults` DISABLE KEYS */;
INSERT INTO `sitedefaults` VALUES (1,'2017-10-10 15:11:39','2017-10-17 14:17:07',1,1,'status','0'),(2,'2017-10-10 15:11:39','2017-10-17 14:17:07',1,1,'wwwurl','http://192.168.11.36/mamacom/development/www/'),(3,'2017-10-10 15:11:39','2017-10-17 14:17:07',1,1,'adminurl','http://192.168.11.36/mamacom/development/admin/'),(4,'2017-10-10 15:11:39','2017-10-17 14:17:07',1,1,'itemurl','http://192.168.11.36/mamacom/development/item/'),(5,'2017-10-10 15:11:39','2017-10-17 14:17:07',1,1,'apiurl','http://192.168.11.36/mamacom/development/api/'),(6,'2017-10-17 14:11:24','2017-10-17 14:17:07',1,1,'img_service_secret','safdasagfdafdag'),(7,'2017-10-17 14:11:24','2017-10-17 14:17:07',1,1,'img_lisence_key','jkhhjlhjlhjljhljhljjg');
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

-- Dump completed on 2017-10-18 10:34:07

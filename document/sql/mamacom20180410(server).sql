CREATE DATABASE  IF NOT EXISTS `mamacom` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mamacom`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: mamacom
-- ------------------------------------------------------
-- Server version	5.5.58

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
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COMMENT='追加コンテンツ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additems`
--

LOCK TABLES `additems` WRITE;
/*!40000 ALTER TABLE `additems` DISABLE KEYS */;
INSERT INTO `additems` VALUES (81,'2017-10-23 13:48:45','2017-10-23 13:48:45',1,1,49,0,'2f764772428a48335fd240a969abab78b27d8a14eaaeb49076afcbe9483201db',NULL,0,NULL),(83,'2017-10-23 15:43:34','2018-01-20 17:52:38',1,1,51,0,'b3ccdd5f03c7f7fafe7d92b7f4c53b6178009310d039021f9f4f425466d528bd',NULL,0,NULL),(84,'2017-10-24 11:24:19','2018-01-20 17:57:03',1,1,52,0,'af8edc0814e4de8beeb0f4a2d6553da583cd4b8cfcef4b6d83942675fe6e0190',NULL,0,NULL),(85,'2017-10-24 11:25:52','2018-01-20 17:49:52',1,1,53,0,'fb6878141cb51aa0a79fce79e918165edda2700e82bfe81e9a7d4dbdb23989a3',NULL,0,NULL),(147,'2017-10-24 13:13:12','2018-04-08 06:09:17',1,1,114,0,'9a39803d702dee3fe4eb7dbaa3ae70393c046615f6e2c92c209cb59cff59da5b',NULL,0,NULL),(152,'2017-11-07 20:08:50','2018-01-20 18:09:07',1,1,117,0,'12cfac983020ae92bd38d71e106a6d0bf704fcd0179e64ad987d5443befd9d11',NULL,0,NULL),(153,'2018-01-18 17:08:20','2018-01-18 17:08:20',1,1,118,0,'7ebe7c8e0362fad0c66ebc51e914b97f48255fe9e03323e74a2f4026f2d08333',NULL,0,NULL),(154,'2018-01-18 17:15:22','2018-01-18 17:15:22',1,1,119,0,'fb91f95245ac6e93ab4a665ad6be8b27c8e79939bf6cb4199ece52279da867e3',NULL,0,NULL),(155,'2018-01-18 17:15:22','2018-01-18 17:15:22',1,1,119,1,'76f11837d9ba2b98558fc28cd5521d7924864290c431bbdf3573dfb7c5a99f72',NULL,0,NULL),(156,'2018-01-20 18:19:53','2018-01-20 18:19:53',1,1,120,0,'9136fa65eb9bfbc7232d74bf6e01aa4cfbba2afe12576452c63ccfddc01f6c17',NULL,0,NULL),(161,'2018-04-08 06:46:38','2018-04-08 06:46:38',1,1,121,0,'c4ed80e4193194a07adf56f08c7e541e2894cace73049f266f9add776457c64b',NULL,0,NULL),(162,'2018-04-08 06:50:12','2018-04-08 06:50:12',1,1,122,0,'019c4660b64f73bfc2276abbc0bd752c4f6f4ff64718d81edbcbfa7bd3804853',NULL,0,NULL),(163,'2018-04-08 06:50:12','2018-04-08 06:50:12',1,1,122,1,'0445421e44e4d5d3b64252fdc8e479416a2935d0ba9aab3712d033f031edfe40',NULL,0,NULL),(164,'2018-04-08 06:50:12','2018-04-08 06:50:12',1,1,122,2,'26da17dddbd654babdf76dc26941248b300f8b2e787796ad97418f9d9cbba763',NULL,0,NULL),(165,'2018-04-08 06:50:12','2018-04-08 06:50:12',1,1,122,3,'2c03feeeaf7f2de5e34d2fd3e7f657c1077501e8d03f8bc70f7270895a8e99a9',NULL,0,NULL),(166,'2018-04-08 06:50:12','2018-04-08 06:50:12',1,1,122,4,'e8733cca8285c60a71b9a02bc3ca2c73d49c18077b1ff2df05a5426b97c06cea',NULL,0,NULL),(167,'2018-04-08 07:00:22','2018-04-08 07:00:22',1,1,123,0,'1758aeeabf750fddb6fec71f555e7c93b2037913cc8cbd93260799f5d6df8c85',NULL,0,NULL),(168,'2018-04-08 07:00:22','2018-04-08 07:00:22',1,1,123,1,'867baf821848fe4b0b4e60125640f317854997fa8e693a5a217d87702421c314',NULL,0,NULL),(169,'2018-04-08 07:04:26','2018-04-08 07:04:26',1,1,124,0,'8de33729a6a2dd709c855cd3a4d9b3f19c9517a1b1fefec20e1ec806fbe20e86',NULL,0,NULL),(170,'2018-04-08 07:33:06','2018-04-08 07:33:06',1,1,125,0,'7205c55aac57d8ce6cb1bc04657789a3e84adb5a4620dc2163d55eefd9d88dd0',NULL,0,NULL),(171,'2018-04-08 07:33:06','2018-04-08 07:33:06',1,1,125,1,'6ef507b5c24d9ec554d92d9ae041025fcfc622a1a21f7648540f4745232dcf0a',NULL,0,NULL);
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
INSERT INTO `admins` VALUES (1,NULL,NULL,NULL,NULL,'admin1','741770f452821c5d37032a904b84660ab48c950f','初期アカウント','1234'),(2,'2017-10-10 15:03:12','2017-11-07 20:11:01',1,1,'admin2','741770f452821c5d37032a904b84660ab48c950f','test','ae9580823268bfe9cbe06cdc3f9837c1');
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COMMENT='カテゴリー情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'2017-10-10 00:00:00','2017-11-07 20:11:41',NULL,1,'アレルギー対応店','',0),(2,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'ママ求人',NULL,0),(3,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'子育て支援室',NULL,0),(4,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'公園紹介',NULL,0),(5,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'授乳室ＭＡＰ',NULL,0),(6,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'地元ママ発信！地域のポータルサイト',NULL,0),(8,'2017-10-10 00:00:00','2017-10-10 00:00:00',NULL,NULL,'都島区',NULL,1),(32,'2018-04-08 07:12:02','2018-04-08 07:12:02',1,1,'城東区','',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COMMENT='コンテンツ情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (51,'2017-10-18 10:09:05','2018-01-20 17:52:38',1,1,'','小児救急電話相談',0,0,NULL,'{\"ttl1\":\"-\",\"ttl2\":\"-\",\"text1\":\"小児科医の支援体制のもとに看護師が相談に応じます。夜間の子どもの急病時、病院へ行ったほうがよいかどうか、判断に迷った時にご利用ください。\",\"text2\":\"※相談料は無料ですが、通話料は利用者負担です。<br>\\r\\n※電話相談であり、診察などの医療行為は行うことができません。<br>\\r\\n※緊急を要する場合は、119番をご利用ください。\"}','{\"tel\":\"#8000\",\"tel_text\":\"又は06-6765-3650（ダイヤル回線、IP電話）\",\"open_text\":\"20時から翌朝8時（365日）\"}',NULL,NULL),(52,'2017-10-24 11:24:19','2018-01-20 17:57:03',1,1,'','救急病院案内',0,0,NULL,'{\"ttl1\":\"-\",\"ttl2\":\"-\",\"text1\":\"大阪府では救急医療相談窓口「救急安心センターおおさか #7119」を運営しており、電話での相談を受け付けています。\",\"text2\":\"救急車を呼んだほうがいい？病院に行った方がいい？<br>\\r\\n近くの救急病院はどこ？応急手当の方法は？<br>\\r\\nなど迷う場合に電話して下さい。緊急時は119番へ。\"}','{\"tel\":\"#7119\",\"tel_text\":\"又は06-6582-7119\",\"open_text\":\"24時間365日\"}',NULL,NULL),(53,'2017-10-24 11:25:52','2018-01-20 17:49:52',1,1,'','児童虐待ホットライン',0,0,NULL,'{\"ttl1\":\"-\",\"ttl2\":\"-\",\"text1\":\"こども相談センターに24時間365日体制で児童虐待の通告・相談に対応する児童虐待専用電話『児童虐待ホットライン』を設置しています。匿名でもかまいません。ご連絡いただいた方のプライバシーと相談の秘密は守られます。\",\"text2\":\"24時間フリーダイヤルで受付\"}','{\"tel\":\"0120－01－7285\",\"tel_text\":\"\",\"open_text\":\"24時間\"}',NULL,NULL),(114,'2017-10-24 11:40:22','2018-04-08 06:09:57',NULL,1,'','地域の情報発信（子連れOK）',0,2,8,'{\"ttl1\":\"社名\",\"ttl2\":\"給与\",\"ttl3\":\"雇用形態\",\"ttl4\":\"最寄駅\",\"ttl5\":\"補足・その他\",\"text1\":\"株式会社ドットコムホールディングス\",\"text2\":\"完全歩合\\r\\n（例）ブログ制作1本500円～2000円\\r\\n（例）広告手数料（内容により異なる）\",\"text3\":\"ご都合の良い時間\\r\\n＊毎月第一水曜日10時半からの会議に参加できる方\\r\\n\",\"text4\":\"地下鉄谷町線都島駅から徒歩3分\",\"text5\":\"お店の取材に行ってブログを書いたり、お店にイベントの紹介をしたりします。子連れでできるお仕事もあります。\"}','{\"postnumber\":\"5340021\",\"address1\":\"大阪府\",\"address2\":\"大阪市都島区都島本通3-19-4\",\"tel\":\"06-6115-7077\",\"shop_text\":\"[受付時間]：（月～木）10:00-17:00\"}',NULL,NULL),(117,'2017-11-07 20:08:50','2018-01-20 18:09:07',1,1,'','大阪府救急医療情報センター',0,0,NULL,'{\"ttl1\":\"-\",\"ttl2\":\"-\",\"text1\":\"「救急車を利用するほどでもないけれど、診てもらえる病院がわからない」などにお答えしています。\",\"text2\":\"365日24時間対応\"}','{\"tel\":\"06-6693-1199\",\"tel_text\":\"\",\"open_text\":\"365日24時間対応\"}',NULL,NULL),(118,'2018-01-18 17:08:20','2018-01-18 17:08:20',1,1,'','都島区子ども・子育てプラザ',0,3,8,'{\"ttl1\":\"支援室の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"★つどいの広場<未就学児とその保護者対象＞\\r\\n\\r\\n☆自由遊び＜火曜日～土曜日の午前9時～午後2時＞\\r\\n\\r\\n※つどいの広場は２時までですが午後２時～４時まではプレイルームを開放しています。\\r\\n\\r\\n☆あかちゃんルーム＜火曜日～土曜日の午前９時～午後４時＞\\r\\n\\r\\n＜ただし、第2土曜日はつどいの広場、赤ちゃんルームとも、午後2時まで＞\\r\\n\\r\\n　つどいの広場（軽運動室）→0～6歳（未就学児）対象\\r\\n\\r\\n　赤ちゃんルーム（和室）→0歳～1歳11か月対象\\r\\n\",\"text2\":\"利用に関してはプラザの登録が必要です。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5340027\",\"address1\":\"大阪府\",\"address2\":\"大阪市都島区中野町5-15−21 大阪市都島センタービル 2F\",\"tel\":\"06-6923-0150\",\"shop_text\":\"［開設時間］9:00～21:00（日曜日は17:30まで）  ［休業日］月曜日・祝日・年末年始（12月29日～1月3日）\"}',NULL,NULL),(119,'2018-01-18 17:15:22','2018-04-08 07:12:31',1,1,'','城東区子ども・子育てプラザ',0,3,32,'{\"ttl1\":\"支援室の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"好きな時間にちょっとだけ！ママの憩いの場。\\r\\n乳幼児親子がいつでも気軽に訪れ、自由に遊ぶことができる場所です。季節のイベント・親子遊び教室もあります。 ハイハイやヨチヨチ歩きまでの子だけが集まるぴよぴよDAYは、月齢の近い子を持つママさん達にとっての憩いの場でもあります。\",\"text2\":\" ※各事業の実施時間については、子育てプラザまでお問い合わせ下さい。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5360004\",\"address1\":\"大阪府\",\"address2\":\"大阪市城東区今福西１丁目１−３９\",\"tel\":\"06-6933-2880\",\"shop_text\":\"利用時間 9:00～17:00 休館日 月曜日・祝日(月曜日が祝日の場合はその翌日も休館)年末年始(12\\/29～1\\/3) \"}',NULL,NULL),(120,'2018-01-20 18:19:53','2018-01-20 18:19:53',1,1,'','中央急病診療所',0,0,NULL,'{\"ttl1\":\"-\",\"ttl2\":\"-\",\"text1\":\"西区北堀江4-10-13\\r\\n地下鉄千日前線・長堀鶴見緑地線「西長堀」駅下車4号A出口　西へ100m\",\"text2\":\"内科・小児科【月曜～金曜（祝日・年末年始を除く）22:00～翌朝5:30、土曜（祝日・年末年始を除く）15:00～翌朝5:30、日曜・祝日・年末年始（12\\/30～1\\/4）17:00～翌朝5:30】\\r\\n眼科・耳鼻咽喉科【月曜～金曜（祝日・年末年始を除く）22:00～翌朝0:30、土曜（祝日・年末年始を除く）15:00～21:30、日曜・祝日・年末年始（12\\/30～1\\/4）10:00～21:30】\"}','{\"tel\":\"06-6534-0321\",\"tel_text\":\"\",\"open_text\":\"\"}',NULL,NULL),(121,'2018-04-08 06:46:38','2018-04-08 06:46:38',1,1,'','【ケーキ】リスボン',0,1,8,'{\"ttl1\":\"お店の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"都島駅近くにあるケーキ屋さん。卵アレルギーに対応したノンエッグのデコレーションケーキがあります。完全予約制。\",\"text2\":\"\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5340014\",\"address1\":\"大阪府\",\"address2\":\"大阪市都島区都島北通1-1-5\",\"tel\":\"06-6925-7707\",\"shop_text\":\"【営業時間】９：００～２１：００（不定休）\"}',NULL,NULL),(122,'2018-04-08 06:50:12','2018-04-08 06:50:12',1,1,'','毛馬中央公園',0,4,8,'{\"ttl1\":\"公園の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"大阪市営バスの終点にもなっている大きな公園です。\\r\\n 遊具の種類も豊富で、近くの保育園の子達も遊びに来ています。\",\"text2\":\"トイレ・・・あり\\r\\n時計・・・あり\\r\\n水道・・・あり\\r\\nゴミ入れ・・・なし\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5340001\",\"address1\":\"大阪府\",\"address2\":\"大阪市都島区毛馬町4-43-19\",\"tel\":\"06-6912-0650\",\"shop_text\":\"上記の電話番号は鶴見緑地公園事務所のものです\"}',NULL,NULL),(123,'2018-04-08 07:00:22','2018-04-08 07:00:22',1,1,'','Snip（スニップ）都島本店',0,5,8,'{\"ttl1\":\"授乳室の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"キッズカットのスペースにカーテンがついています。ママさんスタッフの多いお店なので安心です。\",\"text2\":\"【授乳スペース利用時間】\\r\\n営業時間内OK\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5340014\",\"address1\":\"大阪府\",\"address2\":\"大阪市都島区都島北通1-13-13\",\"tel\":\"0120-630-089\",\"shop_text\":\"【平日】９：３０～１９：３０【土日祝】９：００～１９：００（月曜定休※祝日は営業）\"}',NULL,NULL),(124,'2018-04-08 07:04:26','2018-04-08 07:05:09',1,1,'','都島区ドットコム',0,6,8,'{\"ttl1\":\"サイトの概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"都島区のお店情報やイベント情報を地元の主婦が配信しています。\",\"text2\":\"http:\\/\\/www.miyakojimaku.com\\/index.html\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5340021\",\"address1\":\"大阪府\",\"address2\":\"大阪市都島区都島本通3-19-4\",\"tel\":\"06-6115-7077\",\"shop_text\":\"【電話受付時間】月～木　１０：００～１７：００\"}',NULL,NULL),(125,'2018-04-08 07:33:06','2018-04-08 07:33:26',1,1,'','【インド料理】AMMY（アミ―）蒲生店',0,1,8,'{\"ttl1\":\"お店の概要\",\"ttl2\":\"補足・その他\",\"ttl3\":\"-\",\"ttl4\":\"-\",\"ttl5\":\"-\",\"text1\":\"原材料や添加物にこだわったカラダ想いの本格インド料理がリーズナブルに楽しめる。 カレーの辛さはお子さまでも食べれる「普通」から、汗だくになる「激辛」まで調節でき、高級小麦で作ったモチモチのナンとの相性も抜群。 ナンは、チーズナンやチョコレートナンなどにチェンジ可能。 その他、濃厚なラッシーやタンドリーチキン、手作りドレッシングのサラダなどサイドメニューもおすすめ。 500円のワンコインランチも人気♪\",\"text2\":\"【卵・乳アレルギーに対応可能】乳アレルギーの方はナンをチャパティに変更できる。\",\"text3\":\"\",\"text4\":\"\",\"text5\":\"\"}','{\"postnumber\":\"5340016\",\"address1\":\"大阪府\",\"address2\":\"大阪市都島区友渕町3-1-1\",\"tel\":\"06-6928-3710\",\"shop_text\":\"【営業時間】11:00~15:00,17:00~22:00（無休）\"}',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='緊急お役立ち情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencies`
--

LOCK TABLES `emergencies` WRITE;
/*!40000 ALTER TABLE `emergencies` DISABLE KEYS */;
INSERT INTO `emergencies` VALUES (2,NULL,NULL,NULL,NULL,'123','緊急お役立ちテスト1',0,1,NULL,NULL);
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
INSERT INTO `freepages` VALUES (2,'2017-10-10 00:00:00','2017-11-07 20:12:03',1,1,'フリーページテスト','フリーページテスト',' mailmagazine','フリーページテスト<br>\r\n<a href=\"#\">詳しくはこちらをご覧下さい</a>',0,0,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='インフォメーション情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (1,'2017-10-10 15:25:51','2017-10-20 11:42:11',1,1,'2017-10-01 15:25:50','新着のお知らせ3','インフォメーションのテキストが入ります。インフォメーションのテキストが入ります。インフォメーションのテキストが入ります。',NULL),(2,'2017-10-20 09:53:52','2017-10-20 09:54:04',1,1,'2017-10-20 09:53:52','新着のお知らせ2','お知らせ内容がはいります。テストです。',NULL),(3,'2017-10-20 09:57:13','2017-11-07 20:09:14',1,1,'2017-10-20 09:57:13','アプリリリース記念！お得情報配信！','<img src=\"http://mamacom.net/mail.jpg\" style=\"margin-bottom:5px;\"><br>\r\nこの度、アプリのリリースを記念して、メールマガジン限定お得情報を配信します！<br>\r\nメールマガジンへのご登録方法は○○○○○○○○○○○○○○○○○○○○○○○○<br>\r\n是非この機会にご登録下さい。',NULL),(4,'2017-11-07 20:09:30','2017-11-07 20:09:30',1,1,'2017-11-07 20:09:30','test','testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='サイト基本情報';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitedefaults`
--

LOCK TABLES `sitedefaults` WRITE;
/*!40000 ALTER TABLE `sitedefaults` DISABLE KEYS */;
INSERT INTO `sitedefaults` VALUES (1,'2017-10-10 15:11:39','2017-11-08 21:07:39',1,1,'status','0'),(2,'2017-10-10 15:11:39','2017-11-08 21:07:39',1,1,'wwwurl','http://admin.mamacom.xyz/html/'),(3,'2017-10-10 15:11:39','2017-11-08 21:07:39',1,1,'adminurl','http://admin.mamacom.xyz/'),(4,'2017-10-10 15:11:39','2017-11-08 21:07:39',1,1,'itemurl','http://sys.mamacom.xyz/content/'),(5,'2017-10-10 15:11:39','2017-11-08 21:07:39',1,1,'apiurl','http://sys.mamacom.xyz/api/'),(6,'2017-10-17 14:11:24','2017-11-08 21:07:39',1,1,'img_service_secret','safdasagfdafdag'),(7,'2017-10-17 14:11:24','2017-11-08 21:07:39',1,1,'img_lisence_key','jkhhjlhjlhjljhljhljjg'),(8,'2017-10-18 11:39:39','2017-11-08 21:07:39',1,1,'service_secret','WZfZkPzn6HHpHh3BjNJH'),(9,'2017-10-18 11:39:39','2017-11-08 21:07:39',1,1,'lisence_key','AxGehf7jz5458qB6vFgn'),(10,'2017-10-18 12:35:49','2017-11-08 21:07:39',1,1,'token','yGCuE8FAsfY2ANTW6AERXWQdmAt2gSCSGUL'),(11,'2017-10-23 16:05:30','2017-11-08 21:07:39',1,1,'mail_host','collabos.sakura.ne.jp'),(12,'2017-10-23 16:05:30','2017-11-08 21:07:39',1,1,'mail_address','message@collabos.jp'),(13,'2017-10-23 16:05:30','2017-11-08 21:07:39',1,1,'mail_sendname','mamacom'),(14,'2017-10-23 16:05:30','2017-11-08 21:07:39',1,1,'mail_port','587'),(15,'2017-10-23 16:05:30','2017-11-08 21:07:39',1,1,'mail_username','message@collabos.jp'),(16,'2017-10-23 16:05:30','2017-11-08 21:07:39',1,1,'mail_password','fHg1chBT');
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

-- Dump completed on 2018-04-10 12:05:44

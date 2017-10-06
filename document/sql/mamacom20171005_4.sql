CREATE DATABASE  IF NOT EXISTS `mamacom` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mamacom`;


/* 管理アカウント情報 */

DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    username VARCHAR(255) DEFAULT NULL COMMENT 'ユーザー名:',
    password VARCHAR(100) DEFAULT NULL COMMENT 'パスワード:',
    name VARCHAR(255) DEFAULT NULL COMMENT '管理者名:',
    item_app_id VARCHAR(255) DEFAULT NULL COMMENT 'コンテンツ管理用アプリID:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='管理アカウント情報';

/* サイト基本情報 */

DROP TABLE IF EXISTS sitedefaults;
CREATE TABLE sitedefaults (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    name VARCHAR(100) DEFAULT NULL COMMENT '項目名:',
    value TEXT DEFAULT NULL COMMENT '値:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='サイト基本情報';

/* インフォメーション情報 */

DROP TABLE IF EXISTS informations;
CREATE TABLE informations (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    post_date DATETIME DEFAULT NULL COMMENT '投稿日:',
    title VARCHAR(255) DEFAULT NULL COMMENT 'タイトル:',
    caption TEXT DEFAULT NULL COMMENT 'インフォメーション内容:',
    imgtag TEXT DEFAULT NULL COMMENT '画像タグ:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='インフォメーション情報';

/* カテゴリー情報 */

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    name VARCHAR(255) DEFAULT NULL COMMENT 'カテゴリー名:',
    html TEXT DEFAULT NULL COMMENT 'htmlタグ:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='カテゴリー情報';

/* 地区情報 */

DROP TABLE IF EXISTS districts;
CREATE TABLE districts (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    contentscategoryparent_id INT(11) DEFAULT NULL COMMENT 'カテゴリーID(FK):カテゴリー（Contentscategory）',
    name VARCHAR(255) DEFAULT NULL COMMENT '地区名:',
    html TEXT DEFAULT NULL COMMENT 'htmlタグ:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='地区情報';

/* 緊急お役立ち情報 */

DROP TABLE IF EXISTS emergencies;
CREATE TABLE emergencies (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    number VARCHAR(255) DEFAULT NULL COMMENT '管理番号:',
    title VARCHAR(255) DEFAULT NULL COMMENT 'タイトル:',
    open_status INT(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:非公開',
    district_id INT(11) DEFAULT NULL COMMENT '地区ＩＤID(FK):地区(District)',
    caption TEXT DEFAULT NULL COMMENT 'コンテンツ概要（JSON）:JSONで記述',
    record_date DATETIME DEFAULT NULL COMMENT '登録日:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='緊急お役立ち情報';

/* コンテンツ情報 */

DROP TABLE IF EXISTS contents;
CREATE TABLE contents (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    number VARCHAR(255) DEFAULT NULL COMMENT '管理番号:',
    title VARCHAR(255) DEFAULT NULL COMMENT 'タイトル:',
    open_status INT(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:非公開',
    category_id INT(11) DEFAULT NULL COMMENT 'カテゴリID(FK):カテゴリー(Contentcategory)',
    district_id INT(11) DEFAULT NULL COMMENT '地区ＩＤID(FK):地区(District)',
    caption TEXT DEFAULT NULL COMMENT 'コンテンツ概要（JSON）:JSONで記述',
    shop_info TEXT DEFAULT NULL COMMENT '店舗情報（JSON）:JSONで記述',
    metatag TEXT DEFAULT NULL COMMENT 'メタタグ情報:',
    record_date DATETIME DEFAULT NULL COMMENT '登録日:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='コンテンツ情報';

/* 追加コンテンツ情報 */

DROP TABLE IF EXISTS additems;
CREATE TABLE additems (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    content_id INT(11) DEFAULT NULL COMMENT 'コンテンツID(FK):コンテンツ情報(Content)',
    type INT(2) DEFAULT '0' COMMENT '追加コンテンツステータス:0:サムネイル、1:追加コンテンツ',
    content VARCHAR(255) DEFAULT NULL COMMENT 'コンテンツURL、画像タグ番号:',
    shortimgtag VARCHAR(255) DEFAULT NULL COMMENT 'ショートイメージ用タグ番号:',
    open_status INT(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:非公開',
    comment VARCHAR(255) DEFAULT NULL COMMENT 'コンテンツ備考情報:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='追加コンテンツ情報';

/* フリーページ情報 */

DROP TABLE IF EXISTS freepages;
CREATE TABLE freepages (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    name VARCHAR(255) DEFAULT NULL COMMENT 'フリーページ名:',
    title VARCHAR(255) DEFAULT NULL COMMENT 'ページタイトル:',
    permalink VARCHAR(100) DEFAULT NULL COMMENT 'フリーページURL:',
    html TEXT DEFAULT NULL COMMENT 'html:',
    page_status INT(2) DEFAULT '0' COMMENT 'ページ表示ステータス:0:有効、1:ヘッダーフッター非表示',
    open_status INT(2) DEFAULT '0' COMMENT '公開ステータス:0:公開、1:会員に公開、2:非公開',
    freepagecategory_id INT(11) DEFAULT NULL COMMENT 'フリーページカテゴリーID(FK):フリーページカテゴリ(Freepagecategory)',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='フリーページ情報';

/* フリーページカテゴリー情報 */

DROP TABLE IF EXISTS freepagecategories;
CREATE TABLE freepagecategories (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    name VARCHAR(255) DEFAULT NULL COMMENT 'フリーページカテゴリー名:',
    permalink VARCHAR(100) DEFAULT NULL COMMENT 'カテゴリーURL:',
    html TEXT DEFAULT NULL COMMENT 'html:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='フリーページカテゴリー情報';

/* 入力エラー表示設定 */

DROP TABLE IF EXISTS inputerrors;
CREATE TABLE inputerrors (
    id INT(11) NOT NULL  AUTO_INCREMENT COMMENT 'ID:',
    createdate DATETIME DEFAULT NULL COMMENT '作成日時:',
    refreshdate DATETIME DEFAULT NULL COMMENT '更新日時:',
    createuserid INT(11) DEFAULT NULL COMMENT '作成ユーザーID:',
    refreshuserid INT(11) DEFAULT NULL COMMENT '更新ユーザーID:',
    code VARCHAR(100) DEFAULT NULL COMMENT '適用コード:',
    name VARCHAR(255) DEFAULT NULL COMMENT '表示場所名:',
    message TEXT DEFAULT NULL COMMENT 'エラーメッセージ文:',
PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='入力エラー表示設定';


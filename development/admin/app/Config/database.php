<?php
class DATABASE_CONFIG {

	//メイン用DB
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'collabos_v2_normal',
		'prefix' => '',
		'encoding' => 'utf8',
	);
	//マスター用DB
	public $db_master = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'collabos_v2_master',
		'prefix' => '',
		'encoding' => 'utf8',
	);
	//ログ用DB
	public $db_log = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'collabos_v2_log',
		'prefix' => '',
		'encoding' => 'utf8',
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
}

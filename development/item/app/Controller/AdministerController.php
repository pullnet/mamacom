<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/12							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://image.collabos.jp					*/
/*									*/
/*	コンテンツ管理用コントローラ					*/
/*	AdministerController.php					*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppController', 'Controller');

class AdministerController extends AppController {

	public $uses=array("Admin");

	public $autoRender=false;//viewを使わない
	public $layout=false;//レイアウトなし

//	public $test_appid="7777777777777777777777";//テスト用アプリID

	public function beforefilter(){
		parent::beforefilter();
	}

	//★インデックス(空の画面)
	public function index()
	{
	}
	//★コンテンツデータをすべてロードして渡す
	public function getdata()
	{
		//まずGetパラメータをチェック
		if($this->request->query)
		{
			$query=$this->request->query;
			//アプリIDがあるかどうかチェック
			if(isset($query["app_id"]))
			{
				//アプリIDにあるIDが正しいものかどうかをチェック
				if($this->check_appid($query["app_id"]))
				{
					//ここまでOKならばコンテンツデータを全取得して返す
					$getdata=array();
					$getbuff_smpimg=glob("smpimg/".$query["directory"]."/*.data");
					$getbuff_smp=array();
					foreach($getbuff_smpimg as $gfs_)
					{
						$filetype=exif_imagetype($gfs_);
						$getbuff_smp=array(
							"path"=>$gfs_,
							"filename"=>basename($gfs_),
							"created"=>date("Y-m-d H:i:s",filectime($gfs_)),
							"modified"=>date("Y-m-d H:i:s",filemtime($gfs_)),
							"exif"=>$filetype,
						);
						$getdata[]=$getbuff_smp;
					}

					//一旦JSON形式で渡す
					return json_encode($getdata);
				}

			}

		}

	}
	//アプリIDが存在するものかどうかをチェック....
	private function check_appid($appid){
		
		$checkfind=$this->Admin->find("count",array(
			"conditions"=>array(
				"Admin.item_app_id"=>$appid,
			),
		));
		if($checkfind)
		{
			return true;
		}
		else
		{
			return false;
		}

	}
}

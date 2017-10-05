<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	画像データ管理用コントローラ					*/
/*	ContentsdataController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('DblistController', 'Controller');

class ContentsdataController extends DblistController {

	public $uses=array(
		"Additem",
		"Useroption",
		"Group",
		"Messagezip",
	);
	public $components=array(
		"Db",
		"Loadbasic",
		"Curl",
	);


	public function beforeFilter(){
		parent::beforeFilter();//Dblistコントローラから継承
		
	}
	//★コンテンツ画像データ一覧画面
	public function contentsimage($page=1){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);

		$this->set("content_type",array(0=>"画像",1=>"動画",2=>"WEB画像"));

		//まずコンテンツ画像データとして使用しているものをDBから取得
		$result=$this->Additem->find("all",array(
			"conditions"=>array(

			),
			"order"=>array("Additem.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$totalcount=$this->Additem->find("count",array(
			"conditions"=>array(

			),
		));
		$totalpage=ceil($totalcount/$limit);

		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);
	}
	//★未使用コンテンツデータをまとめる
	public function contentsimage_unview($action=null){

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$params=array(
			"directory"=>"data/contents",
			"app_id"=>$this->admindata["Admin"]["item_app_id"],
		);
		$getdata=$this->Curl->access($itemurl."content/getlist",$params);

		$getdata_count=count($getdata);

		$result_content=$this->Additem->find("all",array(
			"conditions"=>array(
				"Additem.contents_type"=>0,
			),
			"fields"=>array("id","contents_type","content"),
		));

		$ind=0;
		foreach($getdata as $g_){

			foreach($result_content as $rc_){
				if($rc_["Additem"]["content"]==basename($g_)){
					unset($getdata[$ind]);
				}
			}
			$ind++;
		}

		$this->set("getdata",$getdata);

		if($action=="delete_run"){
	
			foreach($getdata as $g_){
				$params=array(
					"app_id"=>$this->admindata["Admin"]["item_app_id"],
					"delete_path"=>$g_,
				);
				$this->Curl->access($itemurl."content/data_delete",$params);
			}

			$this->Session->write("alert","一括削除が完了しました");
			$this->redirect(array("controller"=>"contentsdata","action"=>"contentsimage_unview"));
		}
	}
	//★未使用ショートサムネイルをまとめる
	public function contentsshortimg_unview($action=null){

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$params=array(
			"directory"=>"smpimg/contents",
			"app_id"=>$this->admindata["Admin"]["item_app_id"],
		);
		$getdata=$this->Curl->access($itemurl."content/getlist",$params);

		$result_content=$this->Additem->find("all",array(
			"fields"=>array("id","contents_type","shortimgtag"),
		));

		$ind=0;
		foreach($getdata as $g_){

			foreach($result_content as $rc_){
				if($rc_["Additem"]["shortimgtag"]==basename($g_)){
					unset($getdata[$ind]);
				}
			}
			$ind++;
		}

		$this->set("getdata",$getdata);

		if($action=="delete_run"){
	
			foreach($getdata as $g_){
				$params=array(
					"app_id"=>$this->admindata["Admin"]["item_app_id"],
					"delete_path"=>$g_,
				);
				$this->Curl->access($itemurl."content/data_delete",$params);
			}

			$this->Session->write("alert","一括削除が完了しました");
			$this->redirect(array("controller"=>"contentsdata","action"=>"contentsshortimg_unview"));
		}
	}
	//★未使用コンテンツデータの存在チェック用
	public function check_contentsdata($number){
		$this->autoRender=false;

		$check=$this->Additem->find("first",array(
			"conditions"=>array(
				"Additem.content"=>$number,
			),
		));
		debug($check);
	}
	//★未使用ショートサムネイルの存在チェック用
	public function check_contentsshortimg($number){
		$this->autoRender=false;

		$check=$this->Additem->find("first",array(
			"conditions"=>array(
				"Additem.shortimgtag"=>$number,
			),
		));
		debug($check);
	}
	//★ユーザーアイコン一覧
	public function usericon($page=1){
		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);

		//まずユーザーアイコンとして使用しているものをDBから取得
		$this->Useroption->bindModel(array(
			"belongsTo"=>array(
				"User",
			),
		));
		$result=$this->Useroption->find("all",array(
			"conditions"=>array(
				"Useroption.name"=>"icontag",
			),
			"order"=>array("Useroption.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$totalcount=$this->Useroption->find("count",array(
			"conditions"=>array(
				"Useroption.name"=>"icontag",
			),
		));
		$totalpage=ceil($totalcount/$limit);

		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);
	}
	//★未使用のユーザーアイコン一覧
	public function usericon_unview($action=null){


		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$params=array(
			"directory"=>"smpimg/usericon",
			"app_id"=>$this->admindata["Admin"]["item_app_id"],
		);
		$getdata=$this->Curl->access($itemurl."content/getlist",$params);

		$result_content=$this->Useroption->find("all",array(
			"conditions"=>array(
				"Useroption.name"=>"icontag",
			),
			"fields"=>array("id","name","value"),
		));

		$ind=0;
		foreach($getdata as $g_){

			foreach($result_content as $rc_){
				if($rc_["Useroption"]["value"]==basename($g_)){
					unset($getdata[$ind]);
				}
			}
			$ind++;
		}

		$this->set("getdata",$getdata);

		if($action=="delete_run"){
	
			foreach($getdata as $g_){
				$params=array(
					"app_id"=>$this->admindata["Admin"]["item_app_id"],
					"delete_path"=>$g_,
				);
				$this->Curl->access($itemurl."content/data_delete",$params);
			}

			$this->Session->write("alert","一括削除が完了しました");
			$this->redirect(array("controller"=>"contentsdata","action"=>"usericon_unview"));
		}

	}

	//★未使用コンテンツデータの存在チェック用
	public function check_usericon($number){
		$this->autoRender=false;

		$check=$this->Useroption->find("first",array(
			"conditions"=>array(
				"Useroption.name"=>"icontag",
				"Useroption.value"=>$number,
			),
		));
		debug($check);
	}
	//★グループアイコン一覧
	public function groupicon($page=1){
		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);

		//まずユーザーアイコンとして使用しているものをDBから取得
		$result=$this->Group->find("all",array(
			"conditions"=>array(
				"Group.status"=>1,
				"NOT"=>array(
					"Group.icontag"=>"",
				),
			),
			"recursive"=>2,
			"order"=>array("Group.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$totalcount=$this->Group->find("count",array(
			"conditions"=>array(
				"NOT"=>array(
					"Group.icontag"=>"",
				),
				"Group.status"=>1,
			),
		));
		$totalpage=ceil($totalcount/$limit);

		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);
	}

	//★未使用のグループアイコン一覧
	public function groupicon_unview($action=null){

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$params=array(
			"directory"=>"smpimg/groupicon",
			"app_id"=>$this->admindata["Admin"]["item_app_id"],
		);
		$getdata=$this->Curl->access($itemurl."content/getlist",$params);

		$result_content=$this->Group->find("all",array(
			"conditions"=>array(
				"Group.status"=>1,
			),
		));

		$ind=0;
		foreach($getdata as $g_){

			foreach($result_content as $rc_){
				if($rc_["Group"]["icontag"]==basename($g_)){
					unset($getdata[$ind]);
				}
			}
			$ind++;
		}

		$this->set("getdata",$getdata);

		if($action=="delete_run"){
	
			foreach($getdata as $g_){
				$params=array(
					"app_id"=>$this->admindata["Admin"]["item_app_id"],
					"delete_path"=>$g_,
				);
				$this->Curl->access($itemurl."content/data_delete",$params);
			}

			$this->Session->write("alert","一括削除が完了しました");
			$this->redirect(array("controller"=>"contentsdata","action"=>"groupicon_unview"));
		}

	}
	//★未使用グループアイコンの存在チェック用
	public function check_groupicon($number){
		$this->autoRender=false;

		$check=$this->Group->find("first",array(
			"conditions"=>array(
				"Group.status"=>1,
				"Group.icontag"=>$number,
			),
		));
		debug($check);
	}

	//★メッセージ添付データ一覧
	public function msgzip($page=1){
		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);

		//まずメッセージ添付データとして使用しているものをDBから取得
		$result=$this->Messagezip->find("all",array(
			"recursive"=>2,
			"order"=>array("Messagezip.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$totalcount=$this->Messagezip->find("count");
		$totalpage=ceil($totalcount/$limit);

		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);
	}
	//★未使用のメッセージ添付データ一覧
	public function msgzip_unview($action=null){

		$itemurl=$this->Loadbasic->load("itemurl");
		$this->set("itemurl",$itemurl);

		$params=array(
			"directory"=>"data/msgzip",
			"app_id"=>$this->admindata["Admin"]["item_app_id"],
		);
		$getdata=$this->Curl->access($itemurl."content/getlist",$params);

		$result_content=$this->Messagezip->find("all");

		$ind=0;
		foreach($getdata as $g_){

			foreach($result_content as $rc_){
				if($rc_["Messagezip"]["data_tag"]==basename($g_)){
					unset($getdata[$ind]);
				}
			}
			$ind++;
		}

		$this->set("getdata",$getdata);

		if($action=="delete_run"){
	
			foreach($getdata as $g_){
				$params=array(
					"app_id"=>$this->admindata["Admin"]["item_app_id"],
					"delete_path"=>$g_,
				);
				$this->Curl->access($itemurl."content/data_delete",$params);
			}

			$getdata2=array();
			foreach($getdata as $g_){
				$buff="smpimg/msgzip/".basename($g_);
				$getdata2[]=$buff;
			}

			foreach($getdata2 as $g_){
				$params=array(
					"app_id"=>$this->admindata["Admin"]["item_app_id"],
					"delete_path"=>$g_,
				);
				$this->Curl->access($itemurl."content/data_delete",$params);
			}


			$this->Session->write("alert","一括削除が完了しました");
			$this->redirect(array("controller"=>"contentsdata","action"=>"msgzip_unview"));
		}

	}
	//★未使用メッセージ添付データの存在チェック用
	public function check_msgzip($number){
		$this->autoRender=false;

		$check=$this->Messagezip->find("first",array(
			"conditions"=>array(
				"Messagezip.data_tag"=>$number,
			),
		));
		debug($check);
	}
}

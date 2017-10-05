<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ・ライブラリ共通用コントローラ				*/
/*	ContentsController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');//サニタイズ用

class ContentsController extends AppController {
	public $uses=array(
		"User",
		"Content",
		"Additem",
	);

	public $components=array(
		"Db",
		"Loadbasic",
		"Csv",
		"Numbering",
		"Other",
	);

	//コンテンツ一覧
	public function index($page=1){
		$limit=20;
		$this->set("limit",$limit);
		$this->set("page",$page);
		//公開設定リストをset
		$this->set("openstatus",$this->Db->openstatus());
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));

		if($this->params["controller"]=="collabo")
		{
			$contenttype=0;
		}
		else if($this->params["controller"]=="library")
		{
			$contenttype=1;
		}

		$params=array(
			"Content.status"=>$contenttype,
		);


		if(@$this->request->query){
			$query=$this->request->query;
			if(@$query["keyword"]){
				$cond_keyword=array(
					"Content.title LIKE"=>"%".$query["keyword"]."%",
				);
			}

		}

		$this->Content->bindModel(array(
			"belongsTo"=>array(
				"User"=>array(
					"fields"=>array("id","nickname","username"),
				),
			),
		));
		$result=$this->Content->find("all",array(
			"conditions"=>array(
				$params,
				@$cond_keyword,
			),
			"order"=>array("Content.createdate desc"),
			"limit"=>$limit,
			"page"=>$page,
			"recursive"=>2,
		));
		$this->set("result",$result);

		$totalcount=$this->Content->find("count",array(
			"conditions"=>array(
				$params,
				@$cond_keyword,
			),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->Render("../Contents/index");
	}
	//各ユーザーごとのコンテンツ一覧
	public function lists($user_id){

		//会員情報をset
		$result=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$user_id,
			),
		));
		$this->set("result",$result);


		if($this->params["controller"]=="collabo")
		{
			$contenttype=0;
		}
		else if($this->params["controller"]=="library")
		{
			$contenttype=1;
		}

		$params=array(
			"Content.user_id"=>$user_id,
			"Content.status"=>$contenttype,
		);

		$this->paginate=array(
			"Content"=>array(
				"conditions"=>$params,
				"limit"=>10,
				"order"=>"Content.createdate desc",
				"recursive"=>2,
			),
		);
		$result_content=$this->paginate("Content");
		$this->set("result_content",$result_content);

		//公開設定リストをset
		$this->set("openstatus",$this->Db->openstatus());


		$this->Render("../Contents/lists");
	}
	//各ユーザーごとのコンテンツ詳細画面
	public function view($content_id){

		if($this->Session->read("data"))
		{	
			$this->set("data",$this->Session->read("data"));
			$this->Session->delete("data");
		}

		//itemurlをset
		$this->set("itemurl",$this->Loadbasic->load("itemurl"));
		//wwwmurlをset
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
		//公開設定リストをset
		$this->set("openstatus",$this->Db->openstatus());
		//コンテンツカテゴリーリストをset
		$this->set("contents_category",$this->Db->contentscategory(3));

		//コンテンツ情報を取得
		$this->Content->bindModel(array(
			"hasMany"=>array(
				"Additem",
			),
			"belongsTo"=>array(
				"User",
			),
		));
		$result=$this->Content->find("first",array(
			"conditions"=>array("Content.id"=>$content_id),
		));
		$this->set("result",$result);

		$this->Render("../Contents/view");
	}
	//各ユーザーごとのコンテンツ編集画面
	public function edit($user_id,$content_id=""){

		//itemurlをset
		$this->set("itemurl",$this->Loadbasic->load("itemurl"));
		//wwwmurlをset
		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
		//公開設定リストをset
		$this->set("openstatus",$this->Db->openstatus());
		$this->set("statuslist",$this->Db->openstatus());
		//コンテンツカテゴリーリストをset
		$this->set("contents_category",$this->Db->contentscategory(3));
		

		//POSTがある場合...
		if($this->request->data)
		{
			$postdata=$this->request->data;
			$this->Content->set($postdata);
			if($this->Content->validates()){

				//登録作業(一般のとほぼ同様...)
				//※ユーザー情報を取得
				$userdata=$this->User->find("first",array(
					"conditions"=>array(
						"User.id"=>$postdata["Content"]["user_id"],
					),
				));

				//①まず基本情報(Content)を保存
				$postdata["Content"]["number"]=$this->Numbering->create(2,$postdata["Content"]["number"]);//管理番号を生成
				if(!$postdata["Content"]["id"]){
					$postdata["Content"]["record_date"]=date("Y-m-d H:i:s");//登録日(=作成日時でも良いけど..)
				}
				$result=$this->Content->save($postdata,false);

				//②コンテンツ情報の構築
				$savedata=array();
				$count=0;
				foreach($postdata["Additem"] as $pd_)
				{
					//削除ステータスがない場合は自動でfalseを作成
					if(!isset($pd_["deletestatus"])){ $pd_["deletestatus"]="false"; }

					//削除ステータスがfalse=追加・編集
					if($pd_["deletestatus"]=="false")
					{
						//コンテンツURLタグ番号が入っているときのみ保存されますー。
						if($pd_["content"])
						{
							$pd_["content_id"]=$result["Content"]["id"];

							$adpd=array();//初期化
							$adpd["Additem"]=$pd_;
							//ショートイメージ用タグ番号が空の場合は自動設定
							if(!$adpd["Additem"]["shortimgtag"]){
								$adpd["Additem"]["shortimgtag"]=md5(uniqId(date("ymdhis")));
							}
							$result_additem=$this->Additem->save($adpd,false);

							//③コンテンツが画像ならばitemドメインへ転送
							if($result_additem["Additem"]["contents_type"]==0)
							{
								//キュー用のurlを作成
								$url=$this->Loadbasic->load("itemurl")."content/save?";
								$url.="directory=contents&";//ディレクトリを指定
								$url.="app_id=".$userdata["User"]["item_app_id"]."&";
								$url.="source=".Router::url("/",true)."buffer/Admin/".$this->admindata["Admin"]["admin_number"]."/".$result_additem["Additem"]["content"]."&";
								$url.="write_tag=".$result_additem["Additem"]["content"];//タグ番号

								//curlでキュー送信
								$ch = curl_init();
								curl_setopt( $ch, CURLOPT_URL, $url);
								curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
								curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//4/28追加　CURLはSSL接続したものに対してはバグるのでそれ会費用
								$result_curl = curl_exec($ch);
								curl_close($ch);
							}

							//④各コンテンツごとのショートイメージを生成する
							if($result_additem["Additem"]["contents_type"]==0)
							{
								//画像の場合
								//キュー用のurlを作成
								$smpurl=$this->Loadbasic->load("itemurl")."content/savesmp?";
								$smpurl.="directory=contents&";//ディレクトリを指定
								$smpurl.="app_id=".$userdata["User"]["item_app_id"]."&";
								$smpurl.="source=".Router::url("/",true)."buffer/Admin/".$this->admindata["Admin"]["admin_number"]."/".$result_additem["Additem"]["content"]."&";
								$smpurl.="write_tag=".$result_additem["Additem"]["shortimgtag"];//タグ番号

							}
							else if($result_additem["Additem"]["contents_type"]==1)
							{
								//動画の場合
								//youtubeであればサムネイル画像用のurlを使用すれば可能。

								$codenumber=split("/",$result_additem["Additem"]["content"]);//スプリットして番号のみを取り出す。
								$thumbnailurl="http://i.ytimg.com/vi/".$codenumber[count($codenumber)-1]."/0.jpg";
								
								$smpurl=$this->Loadbasic->load("itemurl")."content/savesmp?";
								$smpurl.="directory=contents&";//ディレクトリを指定
								$smpurl.="app_id=".$userdata["User"]["item_app_id"]."&";
								$smpurl.="source=".$thumbnailurl."&";
								$smpurl.="write_tag=".$result_additem["Additem"]["shortimgtag"];//タグ番号

							}
							else if($result_additem["Additem"]["contents_type"]==2)
							{
								//web画像の場合
								$smpurl=$this->Loadbasic->load("itemurl")."content/savesmp?";
								$smpurl.="directory=contents&";//ディレクトリを指定
								$smpurl.="app_id=".$userdata["User"]["item_app_id"]."&";
								$smpurl.="source=".$result_additem["Additem"]["content"]."&";
								$smpurl.="write_tag=".$result_additem["Additem"]["shortimgtag"];//タグ番号
							}

								//curlでキュー送信
							$ch = curl_init();
							curl_setopt( $ch, CURLOPT_URL, $smpurl);
							curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
							curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//4/28追加　CURLはSSL接続したものに対してはバグるのでそれ会費用
							$result_curl = curl_exec($ch);
							curl_close($ch);

							$count++;
						}
					}
					else
					{
						//削除ステータスがtrue=削除
						$this->Additem->delete($pd_["id"]);
					}
				}

				//Sessionのpostをリセット...
				$this->Session->delete("post");

				//OKならばメッセージ送信後に、リダイレクト...
				$this->Session->write("data",array(
					"id"=>$result["Content"]["id"],
					//"permalink"=>$result["Content"]["permalink"],
				));
				$this->redirect(array("controller"=>$this->params["controller"],"action"=>"view",$result["Content"]["id"]));


			}


		}
		else
		{
			//POSTが無い場合....
			if($content_id)
			{
				//コンテンツ情報を取得
				$this->Content->bindModel(array(
					"hasMany"=>array(
						"Additem",
					),
				));
				$post=$this->Content->find("first",array(
					"conditions"=>array("Content.id"=>$content_id),
				));
				$this->request->data=$post;
				$this->set("post",$post);

				//一旦バッファデータをお掃除～。
				$this->Other->bufferclear($this->authdata["User"]["user_number"]);

				//同時にコンテンツ画像データをダウンする
		
				//Additemの画像データを一旦バッファに置きなおす(=後々これを編集してとかの布石)
				$itemurl=$this->Loadbasic->load("itemurl");
				//まずバッファに入れる用のディレクトリがなければ作成
				@mkdir("buffer/User/".$this->authdata["User"]["user_number"]);
				foreach($post["Additem"] as $p_)
				{
					if($p_["contents_type"]==0)
					{
						//画像があればitemドメインにあるデータをバッファ領域にコピー
						copy($itemurl."data/contents/".$p_["content"],"buffer/Admin/".$this->admindata["Admin"]["admin_number"]."/".$p_["content"]);
					}
				}

			}
		}

		//User情報を取得
		$result_user=$this->User->find("first",array(
			"conditions"=>array(
				"User.id"=>$user_id,
			),
		));
		$this->set("result_user",$result_user);

		$this->Render("../Contents/edit");
	}

	//★コンテンツの非表示
	public function delete($id){
		$this->autoRender=false;
		$data=array(
			"Content"=>array(
				"id"=>$id,
				"delete_flag"=>1,
			),
		);
		$this->Content->save($data,false);

		$this->Session->write("alert","コンテンツを一件非表示にしました。");
		$this->redirect(array("controller"=>$this->params["controller"],"action"=>"index"));

	}
	//★コンテンツの表示
	public function undelete($id){
		$this->autoRender=false;
		$data=array(
			"Content"=>array(
				"id"=>$id,
				"delete_flag"=>0,
			),
		);
		$this->Content->save($data,false);

		$this->Session->write("alert","コンテンツを一件表示に戻しました。");
		$this->redirect(array("controller"=>$this->params["controller"],"action"=>"index"));
	}

	//★登録ユーザーの変更画面
	public function changeuser($id){

		if($this->request->data){
			$data=$this->request->data;

			$this->Content->save($data,false);

			$this->Session->write("alert","コンテンツ一件登録ユーザーを変更しました");
			$this->redirect(array("controller"=>$this->params["controller"],"action"=>"index"));
		}
		else
		{

			$this->Content->bindModel(array(
				"belongsTo"=>array(
					"User"=>array(
						"fields"=>array("id","username","nickname"),
					),
				),
			));
			$result_content=$this->Content->find("first",array(
				"conditions"=>array(
					"Content.id"=>$id,
				),
				"recursive"=>2,
			));
			$this->request->data=$result_content;
			$this->set("result_content",$result_content);
			//公開設定リストをset
			$this->set("openstatus",$this->Db->openstatus());
			//コンテンツカテゴリーリストをset
			$this->set("contents_category",$this->Db->contentscategory(3));

			//会員情報をロード
			$userlist_buff=$this->User->find("all",array(
				"conditions"=>array(
					"User.role"=>1,//本会員のみ
				),
				"fields"=>array("id","nickname","username"),
			));
			$userlist=array();
			foreach($userlist_buff as $u_){
				$userlist[$u_["User"]["id"]]=$u_["User"]["username"]." - ".$u_["User"]["nickname"];
			}
			$this->set("userlist",$userlist);
		}

		$this->Render("../Contents/changeuser");
	}
	//★一覧情報をcsv出力
	public function dataexport(){
		$this->layout=false;

		$result=$this->Content->find("all");
		$result_key=array_keys($result[0]["Content"]);
		$dat=$this->Csv->makecsv($result_key,$result,"Content");
		
		$this->set("filename","Content_data.csv");
		$this->set("html",$dat);

		$this->Render("../Csv/dataexport");
	}



	//コンテンツ詳細情報をダウンロード(CSVと画像)
	public function sourcedown($id,$type=0)
	{
		$this->layout=false;

		//コラボ・ライブラリ基本情報(csv形式)
		if($type==0)
		{
			$result=$this->Content->find("first",array(
				"conditions"=>array(
					"Content.id"=>$id,
				),
			));

			$result_key=array_keys($result["Content"]);

			$csvdata=$this->Csv->makecsv_single($result_key,$result["Content"]);

			$this->set("html",$csvdata);
			$this->set("filename","content.csv");
		}
		else if($type==1)
		{
			//サムネイル・追加コンテンツ情報(CSV形式)
			$result=$this->Additem->find("all",array(
				"conditions"=>array(
					"Additem.content_id"=>$id,
				),
			));

			$result_key=array_keys($result[0]["Additem"]);
			$csvdata=$this->Csv->makecsv($result_key,$result,"Additem");

			$this->set("html",$csvdata);
			$this->set("filename","additem.csv");
		}
	}
	//zipファイルのダウンロードテスト
	public function ziptest($id){
		$this->Layout=false;
		$this->autoRender=false;
		// 処理制限時間を外す
		set_time_limit(0);
		$itemurl=$this->Loadbasic->load("itemurl");

		//まずコンテンツ情報を取得
		$result_content=$this->Content->find("first",array(
			"conditions"=>array(
				"Content.id"=>$id,
			),
		));
		$result_key=array_keys($result_content["Content"]);
		$csv_content=$this->Csv->makecsv_single($result_key,$result_content["Content"]);
		$csv_content=mb_convert_encoding($csv_content,"Shift-jis");//csvの日本語文字化け対策用

		//次にサムネイル情報等を取得
		$result_additem=$this->Additem->find("all",array(
			"conditions"=>array(
				"Additem.content_id"=>$id,
			),
		));
		$result_key=array_keys($result_additem[0]["Additem"]);
		$csv_additem=$this->Csv->makecsv($result_key,$result_additem,"Additem");
		$csv_additem=mb_convert_encoding($csv_additem,"Shift-jis");//csvの日本語文字化け対策用

		//一時的にファイルをセーブ
		$path_csv_content="temp/csv_content.csv";
		$path_csv_additem="temp/csv_additem.csv";

		file_put_contents($path_csv_content,$csv_content);
		file_put_contents($path_csv_additem,$csv_additem);

		//次にコンテンツファイルをすべて列挙
		$itemlist=array();
		foreach($result_additem as $ra_)
		{
			@mkdir("temp/item/");
			@copy($itemurl."data/contents/".$ra_["Additem"]["content"],"temp/item/".$ra_["Additem"]["content"]);
			$itemlist[]="temp/item/".$ra_["Additem"]["content"];
		}

		$source=array(
			$path_csv_content,
			$path_csv_additem,
			array(
				"item"=>$itemlist,
			),
		);
		$this->Csv->zipfile("test_2016",$source);

	}

}

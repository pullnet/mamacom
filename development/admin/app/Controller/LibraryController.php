<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	ライブラリ管理用コントローラ					*/
/*	LibraryController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('ContentsController', 'Controller');
App::uses('Sanitize', 'Utility');//サニタイズ用

class LibraryController extends ContentsController {

	public function beforeFilter(){
		parent::beforeFilter();

		$this->uses[]="Libraryorderset";
		$this->uses[]="Libraryorder";

	}
	//★全注文情報一覧
	public function orderlist()
	{

	}
	//★受注設定情報一覧
	public function ordersetlist($id){


		//まずライブラリ情報を取得
		$result_content=$this->Content->find("first",array(
			"conditions"=>array(
				"Content.id"=>$id,
			),
		));
		$this->set("result_content",$result_content);


		//次に受注設定情報を取得
		$this->paginate=array(
			"Libraryorderset"=>array(
				"conditions"=>array(
					"Libraryorderset.content_id"=>$id,
				),
				"limit"=>10,
			),
		);
		$result=$this->paginate("Libraryorderset");
		$this->set("result",$result);

		$this->set("libraryreleace",$this->Db->libraryreleace());
	}
	//★受注設定情報詳細
	public function ordersetview($id){

		//メッセージを受信
		if($this->Session->read("alert")){
			$this->set("alert",true);
			$this->Session->delete("alert");
		}

		//まず受注設定情報を取得
		$result=$this->Libraryorderset->find("first",array(
			"conditions"=>array(
				"Libraryorderset.id"=>$id,
			),
		));
		//次にライブラリ情報を取得
		$result_content=$this->Content->find("first",array(
			"conditions"=>array(
				"Content.id"=>$result["Libraryorderset"]["content_id"],
			),
		));
		$this->set("result",$result);;
		$this->set("result_content",$result_content);

		$this->set("open_status",$this->Db->openstatus());
		$this->set("contentscategory",$this->Db->contentscategory(1));
		$this->set("order_type",$this->Db->libraryreleace());
		$this->set("output_type",$this->Db->outputs());
	}
	//★受注設定情報編集
	public function ordersetedit($contentid,$id=null){

		//まずライブラリ情報を取得
		$result_content=$this->Content->find("first",array(
			"conditions"=>array(
				"Content.id"=>$contentid,
			),
		));
		$this->set("result_content",$result_content);

		if($id){
			//受注設定情報を取得
			$post=$this->Libraryorderset->find("first",array(
				"conditions"=>array(
					"Libraryorderset.id"=>$id,
				),
			));
			$this->set("post",$post);
		}


		//POSTがされている場合
		if($this->request->data){
			$data=$this->request->data;

			$this->Libraryorderset->set($data);

			//バリデーションチェック
			if($this->Libraryorderset->validates()){
				
				//okならば登録

				//content_idは必須なので入れる。
				if(!$data["Libraryorderset"]["content_id"]){
					$data["Libraryorderset"]["content_id"]=$contentid;
				}
				$data["Libraryorderset"]["number"]=$this->Numbering->create(3,$data["Libraryorderset"]["number"]);//管理番号を生成(なければ)


				$savedata=$this->Libraryorderset->save($data,false);

				//メッセージ送信してリダイレクト...

				$this->Session->write("alert",true);
				$this->redirect(array("controller"=>"library","action"=>"ordersetview",$savedata["Libraryorderset"]["id"]));

			}
		
		}
		else
		{
			if($id)
			{

				$this->request->data=$post;

			}
		}

		$this->set("open_status",$this->Db->openstatus());
		$this->set("contentscategory",$this->Db->contentscategory());
		$this->set("order_type",$this->Db->libraryreleace());
		$this->set("output_type",$this->Db->outputs());
	}
	//★受注設定情報のcsv出力
	public function dataexport_orderset($content_id,$id=null){
		$this->autoRender=false;

		$result_orderset=$this->Libraryorderset->find("all",array(
			"conditions"=>array(
				"Libraryorderset.content_id"=>$content_id,
			),
		));
		$result_orderset_key=array_keys($result_orderset[0]["Libraryorderset"]);
		$csv_liborder=$this->Csv->makecsv($result_orderset_key,$result_orderset,"Libraryorderset");
		$csv_liborder=mb_convert_encoding($csv_liborder,"Shift-jis");//csvの日本語文字化け対策用

		//一時的にファイルをセーブ
		$path_csv_liborderset="temp/csv_liborderset.csv";
		file_put_contents($path_csv_liborderset,$csv_liborder);

		if($id)
		{
			

		}
		else
		{
			$source=array(
				$path_csv_liborderset,
			);
			$this->Csv->zipfile("csv_liborder",$source);
		}


	}

}

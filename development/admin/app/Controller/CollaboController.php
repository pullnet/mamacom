<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/12							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	コラボ管理用コントローラ					*/
/*	CollaboController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('ContentsController', 'Controller');
App::uses('Sanitize', 'Utility');//サニタイズ用

class CollaboController extends ContentsController {

	public function beforeFilter(){
		parent::beforeFilter();//継承

		$this->uses[]="Collabopartyset";
	}
	//★全参加設定一覧
	public function partylist()
	{
		
	}
	//★コラボごとのコラボ参加設定一覧
	public function partysetlist($id){

		//まずコラボ情報を取得
		$result_content=$this->Content->find("first",array(
			"conditions"=>array(
				"Content.id"=>$id,
			),
		));
		$this->set("result_content",$result_content);

		//次に参加表明情報を取得
		$this->paginate=array(
			"Collabopartyset"=>array(
				"conditions"=>array(
					"Collabopartyset.content_id"=>$id,
				),
				"limit"=>10,
			),
		);
		$result=$this->paginate("Collabopartyset");
		$this->set("result",$result);
	}
	//★参加設定詳細
	public function partysetview($id){

		//メッセージを受信
		if($this->Session->read("alert")){
			$this->set("alert",true);
			$this->Session->delete("alert");
		}

		//まず参加設定情報を取得
		$result=$this->Collabopartyset->find("first",array(
			"conditions"=>array(
				"Collabopartyset.id"=>$id,
			),
		));
		//次にコンテンツ情報を取得
		$result_content=$this->Content->find("first",array(
			"conditions"=>array(
				"Content.id"=>$result["Collabopartyset"]["content_id"],
			),
		));

		$this->set("result",$result);
		$this->set("result_content",$result_content);


		$this->set("open_status",$this->Db->openstatus());
		$this->set("party_status",$this->Db->collabojobs());
		$this->set("output_status",$this->Db->outputs());
		$this->set("contentscategory",$this->Db->contentscategory(1));
	}
	//★参加設定編集フォーム
	public function partysetedit($content_id,$id=null){
		
		//まずコンテンツ情報を取得
		$result_content=$this->Content->find("first",array(
			"conditions"=>array(
				"Content.id"=>$content_id,
			),
		));
		$this->set("result_content",$result_content);

		if($id)
		{
			//参加設定情報を取得
			$post=$this->Collabopartyset->find("first",array(
				"conditions"=>array(
					"Collabopartyset.id"=>$id,
				),
			));
			$this->set("post",$post);
		}

		if($this->request->data)
		{
			$data=$this->request->data;

			$this->Collabopartyset->set($data);

			//バリデーションチェック
			if($this->Collabopartyset->validates()){

				//okならば登録
				//content_idは必須なので入れる。
				if(!$data["Collabopartyset"]["content_id"]){
					$data["Collabopartyset"]["content_id"]=$content_id;
				}
				$data["Collabopartyset"]["number"]=$this->Numbering->create(5,$data["Collabopartyset"]["number"]);//管理番号を生成(なければ)


				$savedata=$this->Collabopartyset->save($data,false);

				//メッセージ送信してリダイレクト...

				$this->Session->write("alert",true);
				$this->redirect(array("controller"=>"collabo","action"=>"partysetview",$savedata["Collabopartyset"]["id"]));

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
		$this->set("party_status",$this->Db->collabojobs());
		$this->set("output_status",$this->Db->outputs());
		$this->set("contentscategory",$this->Db->contentscategory(1));
	}
	//参加設定一覧のcsv出力
	public function dataexport_partyset($content_id,$id=null){
		$this->autoRender=false;

		$result_partyset=$this->Collabopartyset->find("all",array(
			"conditions"=>array(
				"Collabopartyset.content_id"=>$content_id,
			),
		));
		$result_partyset_key=array_keys($result_partyset[0]["Collabopartyset"]);
		$csv_partyset=$this->Csv->makecsv($result_partyset_key,$result_partyset,"Collabopartyset");
		$csv_partyset=mb_convert_encoding($csv_partyset,"Shift-jis");//csvの日本語文字化け対策用

		//一時的にファイルをセーブ
		$path_csv_partyset="temp/csv_partyset.csv";
		file_put_contents($path_csv_partyset,$csv_partyset);

		if($id)
		{
			

		}
		else
		{
			$source=array(
				$path_csv_partyset,
			);
			$this->Csv->zipfile("csv_partyset",$source);
		}

	}
}

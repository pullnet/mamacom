<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/17							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	DBリスト管理用共通コントローラ					*/
/*	DblistController.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class DblistController extends AppController {

	public function beforefilter(){
		parent::beforefilter();
	}
	//★リストカテゴリー一覧
	public function index($page=1){

		$limit=20;
		$this->set("page",$page);
		$this->set("limit",$limit);

		//テーブル情報を取得
		$model_parent=$this->Model_c;
		$models=$this->Model_m;

		if($model_parent!="Reviewlankindex")
		{
			$this->$model_parent->bindModel(array(
				"hasMany"=>array($models=>array(
					"fields"=>array("name",mb_strtolower($model_parent."_id"),"id"),
					),
				),
			),false);
		}

		$result=$this->$model_parent->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
			"order"=>array($model_parent.".createdate desc"),
			"recursive"=>2,
		));
		$this->set("result",$result);
		$totalcount=$this->$model_parent->find("count");
		$totalpage=ceil($totalcount/$limit);

		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		if($this->params["controller"]=="contentscategory"){
			$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
		}

		$this->Render("/Dblist/index");
	}
	//★リストカテゴリー詳細
	public function view($id,$page=1){
		$limit=20;
		$this->set("limit",$limit);
		$this->set("page",$page);
		$this->set("id",$id);

		//テーブル情報を取得
		$model_parent=$this->Model_c;
		$models=$this->Model_m;

		$this->$model_parent->bindModel(array(
			"hasMany"=>array(
				$models=>array(
					"fields"=>array("name","id","createdate"),
				),
			),
		));
		$result=$this->$model_parent->find("first",array(
			"conditions"=>array($model_parent.".id"=>$id),
		));
		$this->set("result",$result);
	
		//リスト情報をpaginateで取得
		$result_list=$this->$models->find("all",array(
			"conditions"=>array($models.".".mb_strtolower($model_parent)."_id"=>$result[$model_parent]["id"]),
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result_list",$result_list);

		$totalcount=$this->$models->find("count",array(
			"conditions"=>array($models.".".mb_strtolower($model_parent)."_id"=>$result[$model_parent]["id"]),
		));
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->Render("/Dblist/view");
	}
	//★リストカテゴリー編集
	public function edit($id=""){
		$this->set("id",$id);

		//テーブル情報を取得
		$model_parent=$this->Model_c;
		$models=$this->Model_m;

		//postされている場合
		if($this->request->data)
		{
			$data=$this->request->data;
			//バリデーション
			$valdata=array(
				"Dblist"=>$data[$model_parent],
			);

			$this->Dblist->set($valdata);

			if($this->Dblist->validates())
			{
				//OKなら登録手続きへ
				$result_save=$this->$model_parent->save($data,false);

				//メッセージ送信後、リダイレクト
				$this->Session->write("alert",true);
				$this->redirect(array("controller"=>$this->params["controller"],"action"=>"view",$result_save[$model_parent]["id"]));
			}
			else
			{
				debug($this->Dblist->validationErrors);
				debug($valdata);
			}
		}
		else
		{
			if($id)
			{
				//$idがあればカテゴリー情報を取得してpost
				$post=$this->$model_parent->find("first",array(
					"conditions"=>array($model_parent.".id"=>$id),
				));
				$this->request->data=$post;
				$this->set("post",$post);
			}
		}

		$this->Render("/Dblist/edit");
	}
	//★親カテゴリー変更
	public function parentchange($id){

		//テーブル情報を取得
		$model_parent=$this->Model_c;
		$models=$this->Model_m;
		$models_parentid=$this->Model_cid;

		if($this->request->data){
			$data=$this->request->data;
			//変更手続き
			$this->$models->save($data);

			$this->Session->write("alert",true);
			$this->redirect(array("controller"=>$this->params["controller"],"action"=>"view",$data[$models][$models_parentid]));
		}
		else
		{
			$this->$models->bindModel(array(
				"belongsTo"=>array(
					$model_parent,
				),
			));
			$post=$this->$models->find("first",array(
				"conditions"=>array(
					$models.".id"=>$id,
				),
				"recursive"=>2,
			));
			$this->request->data=$post;
			$this->set("post",$post);
		}

		//親カテゴリーのリスト
		$parent_list=$this->$model_parent->find("list");
		$this->set("parent_list",$parent_list);

		$this->Render("/Dblist/parentchange");
	}
	//★リスト編集
	public function inputedit($cid,$id=""){
		$this->set("cid",$cid);
		$this->set("id",$id);

		//テーブル情報を取得
		$model_parent=$this->Model_c;
		$models=$this->Model_m;

		//カテゴリー情報を取得
		$this->$model_parent->bindModel(array(
			"hasMany"=>array(
				$models,
			),
		));
		$result_c=$this->$model_parent->find("first",array(
			"conditions"=>array($model_parent.".id"=>$cid),
			"recursive"=>2,
		));
		$this->set("result_c",$result_c);

		//postがある場合
		if($this->request->data)
		{
			$data=$this->request->data;
			//バリデーション
			$valdata=array("Dblist"=>$data[$models]);
			$this->Dblist->set($valdata);
			if($this->Dblist->validates())
			{
				//ＯＫなら登録・更新手続き
				$data[$models][mb_strtolower($model_parent)."_id"]=$cid;
				$result_save=$this->$models->save($data,false);

				//メッセージ送信後、リダイレクト
				$this->Session->write("alert",true);
				$this->redirect(array("controller"=>$this->params["controller"],"action"=>"view",$cid));
			}
		}
		else
		{
			if($id)
			{
				//idがある場合はリスト情報を取得してpostさせる
				$post=$this->$models->find("first",array(
					"conditions"=>array($models.".id"=>$id),
				));
				$this->request->data=$post;
				$this->set("post",$post);
			}
		}

		$this->Render("/Dblist/inputedit");
	}
	//★一覧情報をzip出力
	public function dataexport_zip(){
		$this->layout=false;
		$this->autoRender=false;

		//テーブル情報を取得
		$model_parent=$this->Model_c;
		$models=$this->Model_m;

		//まず親情報を取得
		$result_parent=$this->$model_parent->find("all");
		$result_key=array_keys($result_parent[0][$model_parent]);
		$csv_parent=$this->Csv->makecsv($result_key,$result_parent,$model_parent);
		$csv_parent=mb_convert_encoding($csv_parent,"Shift-jis");//csvの日本語文字化け対策用

		//次に子情報を取得
		$result_child=$this->$models->find("all");
		$result_key=array_keys($result_child[0][$models]);
		$csv_child=$this->Csv->makecsv($result_key,$result_child,$models);
		$csv_child=mb_convert_encoding($csv_child,"Shift-jis");//csvの日本語文字化け対策用

		$path_csv_parent="temp/csv_parent.csv";
		$path_csv_children="temp/csv_children.csv";

		file_put_contents($path_csv_parent,$csv_parent);
		file_put_contents($path_csv_children,$csv_child);

		$source=array(
			$path_csv_parent,
			$path_csv_children,
		);

		$this->Csv->zipfile($this->params["controller"]."_csv",$source);

	}

}

<?php
//-----------------------------------------------------------------------------
//
//	2017.09.01
//	Masato Nakatsuji
//
//	V1Controller
//
//-----------------------------------------------------------------------------

class V1Controller extends Controller{

	public $layout=false;
	public $autoRender=false;

	public $uses=array(
		"Table1",
		"Table2",
		"Userregist",
		"Userprov",
		"User",
		"Userregistration",
	);

	public $components=array(
		"RestAPI",
		"Session",
	);

	public function beforeFilter(){
		parent::beforeFilter();

		session_start();
		header("Access-Control-Allow-Origin:*");
		if(!@$this->RestAPI->check_accessToken("private")){
			echo JSON_ENC($this->RestAPI->error);
			exit;
		}

		//認証OKならば、POSTからトークン消す
		unset($_POST["access_token"]);
	}
	//-----------------------------------------------------------------------------

	// ここからTable1用....

	//-----------------------------------------------------------------------------
	//Table1のリスト取得
	public function list_table1(){
		$status=array(
			1=>"公開",
			2=>"非公開",
		);
		$result=$this->Table1->find("all",array(
			"order"=>array("Table1.create_date desc"),
		));
		foreach($result as $key=>$r_){
			$result[$key]["Table1"]["status"]=$status[$r_["Table1"]["status"]];
		}
		echo JSON_ENC($result);
	}
	//Table1の詳細取得
	public function get_table1($id,$mode="edit"){
		$status=array(
			1=>"公開",
			2=>"非公開",
		);
		$result=$this->Table1->find("first",array(
			"conditions"=>array(
				"Table1.id"=>$id,
			),
		));
		if($mode=="detail"){
			$result["Table1"]["status"]=$status[$result["Table1"]["status"]];
		}

		echo JSON_ENC($result);
	}
	//Table1の登録
	public function edit_table1(){

		$post=array("Table1"=>$_POST);
		$juge=$this->Table1->validates($post);
		if($juge){

			$output=array(
				"code"=>201,
				"message"=>"validation error",
				"validate"=>$juge["Table1"],
			);

			echo JSON_ENC($output);
			return;
		}
		else
		{
			try{
				$this->transam("begin",array(
					"Table1",
				));

				$res=$this->Table1->save($post);


				if(!$res){
					$this->transam("rollback");
				}

				$this->transam("commit");

			}catch(Exception $e_){
				$this->transam("rollback");
			}

			$output=array(
				"mode"=>200,
				"message"=>"Table1のレコードを登録しました",
			);

			echo JSON_ENC($output);
		}

	}
	//Table1の削除
	public function delete_table1($id){

		$this->Table1->delete($id);

		$output=array(
			"mode"=>200,
			"message"=>"Table1のレコードを１件削除しました",
		);
		echo JSON_ENC($output);

	}
	//-----------------------------------------------------------------------------

	// ここからTable2用....

	//-----------------------------------------------------------------------------

	//Table2リストの取得...
	public function list_table2(){
		$select_b=array(
			"aaa"=>"選択項目AAAA",
			"bbb"=>"選択項目BBBB",
			"ccc"=>"選択項目CCCC",
		);
		
		$result=$this->Table2->find("all",array(
			"order"=>array("Table2.create_date desc"),
		));
		foreach($result as $key=>$r_){
			$result[$key]["Table2"]["select_b"]=$select_b[$r_["Table2"]["select_b"]];
			$result[$key]["Table2"]["thumbnail"]=$this->params["root"]."wdata/Content/table2/".$r_["Table2"]["thumbnail"];

		}
		echo JSON_ENC($result);
	}
	//Table2の詳細取得
	public function get_table2($id,$mode="edit"){

		$select_b=array(
			"aaa"=>"選択項目AAAA",
			"bbb"=>"選択項目BBBB",
			"ccc"=>"選択項目CCCC",
		);
		
		$result=$this->Table2->find("first",array(
			"conditions"=>array(
				"Table2.id"=>$id,
			),
		));
		if($mode=="detail"){
			$result["Table2"]["select_b"]=$select_b[$result["Table2"]["select_b"]];
		}
		$result["Table2"]["thumbnail_path"]=$this->params["root"]."wdata/Content/table2/".$result["Table2"]["thumbnail"];
		$result["Table2"]["background_path"]=$this->params["root"]."wdata/Content/table2/".$result["Table2"]["background"];

		echo JSON_ENC($result);

	}
	//Table2の選択項目取得用
	public function get_table2_select_b($mode=0){

		//mode: 0:通常JSON,1:optionタグで出力

		$select=array(
			"aaa"=>"選択項目AAAA",
			"bbb"=>"選択項目BBBB",
			"ccc"=>"選択項目CCCC",
		);
		if($mode==1){
			$str="";
			foreach($select as $key=>$s_){
				$str.='<option value="'.$key.'">'.h($s_).'</option>';
			}

			echo $str;
		}
		else
		{
			echo JSON_ENC($select);
		}
	}
	//Table2の仮登録
	public function edit_table2_pre(){
		
		$post=array("Table2"=>$_POST);
		$juge=$this->Table2->validates($post);
		if($juge){
			$output=array(
				"code"=>201,
				"message"=>"validation error",
				"validate"=>$juge["Table2"],
			);

			echo JSON_ENC($output);
			return;
		}
		else
		{	
			$output=array(
				"mode"=>200,
				"cash"=>$post,
			);
			echo JSON_ENC($output);
		}
	}
	//Table2の本登録
	public function edit_table2(){
		if($_POST){
			$post=array("Table2"=>$_POST);

			try{
				$this->transam("begin",array(
					"Table2",
				));

				$res_table2=$this->Table2->save($post);
				
				if(!$res_table2){
					$this->transam("rollback");
				}

				$this->transam("commit");

			}catch(Exception $e_){
				$this->transam("rollback");

			}

			//画像の保存....
			//※本来はコンテンツ管理用ドメイン(またはシステム)にCURLで投げて、保存してもらった方がいい

			if($post["Table2"]["thumbnail_changed"]){
				@mkdir("Content");
				@mkdir("Content/table2");
				copy($post["Table2"]["thumbnail_path"],"Content/table2/".$post["Table2"]["thumbnail"]);
			}
			if($post["Table2"]["background_changed"]){
				@mkdir("Content");
				@mkdir("Content/table2");
				copy($post["Table2"]["background_path"],"Content/table2/".$post["Table2"]["background"]);
			}

			$output=array(
				"mode"=>200,
				"message"=>"table2のレコード登録が完了しました",
			);

			echo JSON_ENC($output);
		}
		else
		{
			$output=array(
				"mode"=>400,
			);
			echo JSON_ENC($output);
		}

	}
	//Table2の削除
	public function delete_table2($id){
		

		$this->Table2->delete($id);

		$output=array(
			"mode"=>200,
			"message"=>"Table2のレコードを１件削除しました",
		);
		echo JSON_ENC($output);

	}
}
?>
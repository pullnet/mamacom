<?php
//-----------------------------------------------------------------------------
//
//	2017.09.01
//	Masato Nakatsuji
//
//	V2Controller
//
//-----------------------------------------------------------------------------

class V2Controller extends Controller{

	public $layout=false;
	public $autoRender=false;

	public $uses=array(
		"Table3",
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

	// ここからTable3用....

	//-----------------------------------------------------------------------------
	//Table3のリスト取得
	public function list_table3(){
		$page=1;
		$limit=5;

		$cond=array();
		if(@$this->request->get){
			$get=$this->request->get;

			if(@$get["page"]){
				$page=$get["page"];
			}
			if(@$get["keyword"]){
				$cond=array(
					"OR"=>array(
						"Table3.name LIKE"=>"%".$get["keyword"]."%",
						"Table3.code LIKE"=>"%".$get["keyword"]."%",
					),
				);
			}
		}

		$result=$this->Table3->find("all",array(
			"conditions"=>$cond,
			"order"=>array("Table3.create_date desc"),
			"page"=>$page,
			"limit"=>$limit,
		));

		if($result){
			echo JSON_ENC($result);
		}
		else
		{
			if($page!=1){
				$output=array(
					"mode"=>201,
				);
				echo JSON_ENC($output);
			}
			else{
				$output=array(
					"mode"=>400,
				);
				echo JSON_ENC($output);

			}
		}

	}
	//Table3の詳細取得
	public function get_table3($id){
		$result=$this->Table3->find("first",array(
			"conditions"=>array(
				"Table3.id"=>$id,
			),
		));
		echo JSON_ENC($result);
	}
	//Table3の仮登録
	public function edit_table3_pre(){
		if($_POST){

			$post=array("Table3"=>$_POST);


			$juge=$this->Table3->validates($post);
			if($juge){

				$output=array(
					"code"=>201,
					"message"=>"validation error",
					"validate"=>$juge["Table3"],
				);

				echo JSON_ENC($output);
				return;
			}
			else
			{
				$output=array(
					"mode"=>200,
					"cash"=>$post["Table3"],
				);
				echo JSON_ENC($output);
				return;

			}

		}
	}
	//Table3の本登録
	public function edit_table3(){

		if($_POST){

			$post=array("Table3"=>$_POST);

			try{
				$this->transam("begin",array(
					"Table3",
				));

				$res=$this->Table3->save($post);

				if(!$res){
					$this->transam("rollback");
				}

				$this->transam("commit");

			}catch(Exception $e_){
				$this->transam("rollback");
			}

			$output=array(
				"mode"=>200,
			);
			echo JSON_ENC($output);
			return;
		}
	}
	//Table3の削除
	public function delete_table3($id){
		$this->Table3->delete($id);

		$output=array(
			"mode"=>200,
		);
		echo JSON_ENC($output);
	}
}
?>
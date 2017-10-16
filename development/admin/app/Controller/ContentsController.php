<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/12/06							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	地区管理画面					*/
/*	ContentsController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class ContentsController extends AppController{

	public $uses=array(
		"Contents",
		"Category",
		"District",
	);

	public $components=array(
		"Db",
		"Loadbasic",
		"Csv",
	);

	public function beforeFilter(){
		parent::beforeFilter();
	}
	//★ページカテゴリー一覧
	public function index($page=1){
		$limit=30;
		$this->set("page",$page);
		$this->set("limit",$limit);
		
		
		//カテゴリー情報をset
		$category_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"0",						
			),
		));
		$this->set("category_list",$category_list);
		
		//地区情報をset
		$district_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"1",						
			),
		));
		$this->set("district_list",$district_list);		
		
		//コンテンツ情報をset
		$result=$this->Contents->find("all",array(
			"limit"=>$limit,
			"page"=>$page,
		));
		$this->set("result",$result);

		$totalcount=$result=$this->Contents->find("count");
		$totalpage=ceil($totalcount/$limit);
		$this->set("totalcount",$totalcount);
		$this->set("totalpage",$totalpage);

		$this->set("wwwurl",$this->Loadbasic->load("wwwurl"));
	}
	//★ページカテゴリー登録・編集
	public function edit($id=null){
		
		//カテゴリー情報をset
		$category_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"0",						
			),
		));
		$this->set("category_list",$category_list);
		
		//地区情報をset
		$district_list=$this->Category->find("list",array(
			"fields"=>array("id","name"),
			"conditions"=>array(
				"Category.type_mode"=>"1",						
			),
		));
		$this->set("district_list",$district_list);		


		if($this->request->data){
			$post=$this->request->data;

			$this->Contents->set($post);
			if($this->Contents->validates()){

				//詳細情報をJSON化して登録・更新
				$caption=json_encode(array(
					"ttl1"=>$post["Contents"]["ttl1"],
					"ttl2"=>$post["Contents"]["ttl2"],
					"ttl3"=>$post["Contents"]["ttl3"],
					"ttl4"=>$post["Contents"]["ttl4"],
					"ttl5"=>$post["Contents"]["ttl5"],
					"text1"=>$post["Contents"]["text1"],
					"text2"=>$post["Contents"]["text2"],
					"text3"=>$post["Contents"]["text3"],
					"text4"=>$post["Contents"]["text4"],
					"text5"=>$post["Contents"]["text5"],
				),JSON_UNESCAPED_UNICODE);
				
				$post["Contents"]["caption"]=$caption;

				//店舗情報をJSON化して登録・更新
				$shop_info=json_encode(array(
					"postnumber"=>$post["Contents"]["postnumber"],
					"address"=>$post["Contents"]["address"],
					"tel"=>$post["Contents"]["tel"],
					"shop_text"=>$post["Contents"]["shop_text"],	
				),JSON_UNESCAPED_UNICODE);
				$post["Contents"]["shop_info"]=$shop_info;
				
				//画像をadditem登録・更新

				$post["Additems"]["content_id"]=$post["Contents"]["id"];

				$this->Contents->save($post,false);

				$this->Session->write("alert","コンテンツを１件設定しました。");
				$this->redirect(array("controller"=>"contents","action"=>"index"));
			}
		}
		else{
			if($id){

				$post=$this->Contents->find("first",array(
					"conditions"=>array(
						"Contents.id"=>$id,
					),
				));
	
				$caption=json_decode(@$post["Contents"]["caption"],true);
				if(@$caption){
					$post["Contents"]=array_merge($post["Contents"],@$caption);
				}
				$shop_info=json_decode(@$post["Contents"]["shop_info"],true);
				if(@$shop_info){
					$post["Contents"]=array_merge($post["Contents"],@$shop_info);
				}				

				$this->request->data=$post;
			}
		}
	}

	//★地区・削除
	public function delete($id){
		
		$this->autoRender=false;
		
		//idでテーブルデータ取得
		$result=$this->Contents->find("first",array(
			'conditions' => array(
				'Contents.id' => $id,
			)
		));
		//idでテーブルデータ削除
		$this->Contents->delete($id);
		
		//テキスト表示とリダイレクト
		$this->Session->write("alert", "地区を削除いたしました。");
		$this->redirect(array("controller"=>"contents","action"=>"index"));

	}
	
}

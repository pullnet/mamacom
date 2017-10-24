<?php


App::uses('AppController', 'Controller');


class EmergencyController extends AppController{

	public $uses=array(
		"Contents",
		"Additems",		
		"Category",
		"District",
	);
	
	public $components=array(
		"Db",
		"Loadbasic",
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function emergency_list(){	
		$page=1;
		$limit=30;
		
		$domain_item=$this->Loadbasic->load("itemurl");
		
		if($this->request->data){
			
			$post=$this->request->data;	
			//debug($post);
		
			//お役立ち一覧を取得			
			$contents_list=$this->Contents->find("all",array(
				"conditions"=>array(
					//"Contents.district_id"=>$post["id"],
					"Contents.category_id"=>"0",//緊急お役立ちは0
				),
				"fields"=>array("id","title","district_id","caption","shop_info"),
				"limit"=>$limit,
				"page"=>$post["page"],
			));	

			//idから該当のメイン画像additemsを取得
			$i=0;
			foreach($contents_list as $t_){
				//画像を探して取り出す
				$test=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$t_["Contents"]["id"],
						"Additems.type"=>"0",	//メインアイコン画像は0				
					),
				"fields"=>array("content"),				
				));
				
				//itemURLを付与
				$test["Additems"]["content"]= $domain_item."app/webroot/Content/".$test["Additems"]["content"];
				
				$output[$i]["Contents"]=array_merge($t_["Contents"],@$test["Additems"]);
				$i++;

			}

			$totalcount=$this->Contents->find("count",array(
				"conditions"=>array(
					"Contents.category_id"=>"0",//緊急お役立ちは0
				),
			));

			$totalpage=ceil($totalcount/$limit);

			$pager_array = array(
				"page"=>$page,
				"limit"=>$limit,
				"totalcount"=>$totalcount,
				"totalpage"=>$totalpage,
			);
			
			$output = array_merge($output,$pager_array);			

			return json_encode($output,JSON_UNESCAPED_UNICODE);
		}
		
	}
	
}


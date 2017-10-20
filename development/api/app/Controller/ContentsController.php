<?php


App::uses('AppController', 'Controller');


class ContentsController extends AppController{

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
	
	
	public function contents_list(){
		
		$domain_item=$this->Loadbasic->load("itemurl");
		
		if($this->request->data){
			
			$post=$this->request->data;	
			//debug($post);
		
			//地区idから特定のadditemsを取得			
			$contents_list=$this->Contents->find("all",array(
				"conditions"=>array(
					"Contents.district_id"=>$post["id"],
					"Contents.category_id"=>$post["cid"],
				),
				"fields"=>array("id","title","district_id","caption"),
			));	

			//コンテンツidから該当のメイン画像additemsを取得
			$i=0;
			foreach($contents_list as $t_){
				//画像を探して取り出す
				$test=$this->Additems->find("first",array(
					"conditions"=>array(
						"Additems.content_id"=>$t_["Contents"]["id"],
						"Additems.type"=>"0",						
					),
				"fields"=>array("content"),					
				));
				
				//itemURLを付与
				$test["Additems"]["content"]= $domain_item."app/webroot/Content/".$test["Additems"]["content"];
				
				$output[$i]["Contents"]=array_merge($t_["Contents"],@$test["Additems"]);
				$i++;
				
			}
			return json_encode($output,JSON_UNESCAPED_UNICODE);
		}
		
	}
	
	public function contents_detail(){
		
		$domain_item=$this->Loadbasic->load("itemurl");
		
		if($this->request->data){
			
			$post=$this->request->data;	
			//debug($post);
		
			//地区idから特定のadditemsを取得			
			$contents_list=$this->Contents->find("all",array(
				"conditions"=>array(
					"Contents.id"=>$post["id"],
				),
				"fields"=>array("id","number","title","district_id","caption","shop_info","refreshdate"),
			));

			//コンテンツidから該当のメイン画像additemsを取得
			$test=$this->Additems->find("all",array(
				"conditions"=>array(
					"Additems.content_id"=>$post["id"],	
					"Additems.type"=>"0",
				),
				"fields"=>array("content","type"),
			));
			
			$test[0]["Additems"]["content"]= $domain_item."app/webroot/Content/".$test[0]["Additems"]["content"];		
			$output=array_merge($contents_list,$test);

			
			//コンテンツidから該当のサブ画像additemsを取得
			$test=$this->Additems->find("all",array(
				"conditions"=>array(
					"Additems.content_id"=>$post["id"],	
					"Additems.type"=>"1",
				),
				"fields"=>array("content","type"),
			));
			/*サブ画像があればマージ*/
			if(@$test[0]["Additems"]["content"]){
				$test[0]["Additems"]["content"]= $domain_item."app/webroot/Content/".$test[0]["Additems"]["content"];	
				$output=array_merge($output,$test);	
			}
								
			//コンテンツidから該当のサブ画像additemsを取得
			$test=$this->Additems->find("all",array(
				"conditions"=>array(
					"Additems.content_id"=>$post["id"],	
					"Additems.type"=>"2",
				),
				"fields"=>array("content","type"),
			));
			
			/*サブ画像があればマージ*/
			if(@$test[0]["Additems"]["content"]){
				$test[0]["Additems"]["content"]= $domain_item."app/webroot/Content/".$test[0]["Additems"]["content"];	
				$output=array_merge($output,$test);	
			}	

			//コンテンツidから該当のサブ画像additemsを取得
			$test=$this->Additems->find("all",array(
				"conditions"=>array(
					"Additems.content_id"=>$post["id"],	
					"Additems.type"=>"3",
				),
				"fields"=>array("content","type"),
			));
			
			/*サブ画像があればマージ*/
			if(@$test[0]["Additems"]["content"]){
				$test[0]["Additems"]["content"]= $domain_item."app/webroot/Content/".$test[0]["Additems"]["content"];	
				$output=array_merge($output,$test);	
			}

			//コンテンツidから該当のサブ画像additemsを取得
			$test=$this->Additems->find("all",array(
				"conditions"=>array(
					"Additems.content_id"=>$post["id"],	
					"Additems.type"=>"4",
				),
				"fields"=>array("content","type"),
			));
			
			/*サブ画像があればマージ*/
			if(@$test[0]["Additems"]["content"]){
				$test[0]["Additems"]["content"]= $domain_item."app/webroot/Content/".$test[0]["Additems"]["content"];	
				$output=array_merge($output,$test);	
			}

			//コンテンツidから該当のサブ画像additemsを取得
			$test=$this->Additems->find("all",array(
				"conditions"=>array(
					"Additems.content_id"=>$post["id"],	
					"Additems.type"=>"5",
				),
				"fields"=>array("content","type"),
			));
			
			/*サブ画像があればマージ*/
			if(@$test[0]["Additems"]["content"]){
				$test[0]["Additems"]["content"]= $domain_item."app/webroot/Content/".$test[0]["Additems"]["content"];	
				$output=array_merge($output,$test);	
			}
			
			
			return json_encode($output,JSON_UNESCAPED_UNICODE);
		}
	}	
	
	
}


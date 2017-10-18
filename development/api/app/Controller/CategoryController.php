<?php


App::uses('AppController', 'Controller');


class CategoryController extends AppController{

	public $uses=array(
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

	public function ditrict_list(){
		
		//地区情報をset
		$district_list=$this->Category->find("all",array(
			"conditions"=>array(
				"Category.type_mode"=>"1",						
			),
			"fields"=>array("id","name"),
		));
		$output=array();
		foreach($district_list as $key=>$d_){
			$output[$key]=$d_["Category"];
		}

		return json_encode($output,JSON_UNESCAPED_UNICODE);
	
	}
	
	public function category_list(){
		
		$district_list=$this->Category->find("all",array(
			"conditions"=>array(
				"Category.type_mode"=>"0",						
			),
			"fields"=>array("id","name"),
		));
		$output=array();
		foreach($district_list as $key=>$d_){
			$output[$key]=$d_["Category"];
		}
		
		return json_encode($output,JSON_UNESCAPED_UNICODE);

	}	
	
	
	public function ditrict_name(){
		
		if($this->request->data){
			
			$post=$this->request->data;

			$district_list=$this->Category->find("all",array(
				"conditions"=>array(
					"Category.type_mode"=>"1",
					"Category.id"=>$post["id"],					
				),
				"fields"=>array("id","name"),
			));
			$output=array();
			foreach($district_list as $key=>$d_){
				$output[$key]=$d_["Category"];
			}
		
			return json_encode($output,JSON_UNESCAPED_UNICODE);

		}
		
	}

}


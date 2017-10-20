<?php


App::uses('AppController', 'Controller');


class InformationController extends AppController{

	public $uses=array(
		"Information",
	);
	
	public $components=array(
		"Db",
		"Loadbasic",
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function information_list(){
		
		$domain_item=$this->Loadbasic->load("itemurl");
		
		if($this->request->data){
			
			$post=$this->request->data;	
			//debug($post);
		
			//お知らせを取得			
			if($post["info_id"]==0){
				$output=$this->Information->find("all",array(
					'order' => array(
						'Information.post_date' => 'desc',
					),
					"fields"=>array("id","title","caption","post_date"),
					"limit"=>$post["article_limit"],
				));
				
				for($i = 0; $i < 3; $i++){
					$output[$i]["Information"]["post_date"]=date('Y/m/d', strtotime( $output[$i]["Information"]["post_date"] ));
				}
			}
			else if($post["info_id"]!=0){
				$output=$this->Information->find("all",array(
					'order' => array(
						'Information.post_date' => 'desc',
					),
					"conditions"=>array(
						"Information.id"=>$post["info_id"],					
					),
					"limit"=>$post["article_limit"],
					"fields"=>array("id","title","caption","post_date"),
				));
			}
			//debug($output);
			return json_encode($output,JSON_UNESCAPED_UNICODE);
		}
		
	}
	

}


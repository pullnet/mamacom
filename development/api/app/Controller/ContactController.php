<?php


App::uses('AppController', 'Controller');


class ContactController extends AppController{

	public $uses=array(
		"Contact",
	);
	
	public $components=array(
		"Db",
		"Loadbasic",
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	public function contact_step1(){
		
		$domain_item=$this->Loadbasic->load("itemurl");
		
		if($this->request->data){

			$post=$this->request->data;	
			//debug($post);
			
			$post2=array(
				"Contact"=>$post,
			);
			
			$this->Contact->set($post2);

			if($this->Contact->validates()){
				$result=array(
					"enable"=>true,
					"errors"=>"",
				);
			}
			else{
				$errors = $this->Contact->validationErrors;			
				$result=array(
					"enable"=>false,
					"errors"=>$errors,
				);
			}
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}
	
	
	public function contact_step2(){
		
		$domain_item=$this->Loadbasic->load("itemurl");
		
		if($this->request->data){

			$post=$this->request->data;	
			//debug($post);
			
			$post2=array(
				"Contact"=>$post,
			);
			
			$this->Contact->set($post2);

			if($this->Contact->validates()){
				$result=array(
					"enable"=>true,
					"errors"=>"",
				);
				
				//メールの送信処理
				//
				//
				//
				
			}
			else{
				$errors = $this->Contact->validationErrors;			
				$result=array(
					"enable"=>false,
					"errors"=>$errors,
				);
			}

			return json_encode($result,JSON_UNESCAPED_UNICODE);
			
		}
	}	

}
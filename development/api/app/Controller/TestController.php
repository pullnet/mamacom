<?php


App::uses('AppController', 'Controller');


class TestController extends AppController{

	public $components=array(
		"Loadbasic",
	);
	
	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function token_test(){
	
		$token=$this->Loadbasic->load("token");	
	
		if($this->request->data){
			
			$post=$this->request->data;
			
			if( $post["send_token"]!=$token){
							
				$result=array(
					"enable"=>false,
					"error"=>"error code:201 : token is incorrect.",
				);
				return json_encode($result,JSON_UNESCAPED_UNICODE);
				
			}
			else{
				
				$result=array(
					"enable"=>true,
					"error"=>"",
				);
				return json_encode($result,JSON_UNESCAPED_UNICODE);	
							
			}
		}
		else{
			
				$result=array(
					"enable"=>false,
					"error"=>"error code:100 : requestdata is null.",
				);
				return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	
	}




	
}


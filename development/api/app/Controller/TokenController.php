<?php


App::uses('AppController', 'Controller');


class TokenController extends Controller{
	
	public $autoRender=false;
	public $layout=false;

	public $components=array(
		"Loadbasic",
	);

	public function get_token(){
		header("Access-Control-Allow-Origin:*");
		$se_key=$this->Loadbasic->load("service_secret");
		$li_key=$this->Loadbasic->load("lisence_key");	
		$token=$this->Loadbasic->load("token");	
	
		if($this->request->data){
			
			$post=$this->request->data;
			
			if( (!@$post["service_secret"]) or (!@$post["lisence_key"]) ){
					
				$result=array(
					"access_token"=>"",
					"enable"=>false,
					"error"=>"error code:101 : key's type is incorrect.",
				);
				
			}
			else if( $post["service_secret"]!=$se_key or $post["lisence_key"]!=$li_key){
							
				$result=array(
					"access_token"=>"",
					"enable"=>false,
					"error"=>"error code:102 : key's value is incorrect.",
				);
				
			}
			else/*成功*/{
				
				$result=array(
					"access_token"=>$token,
					"enable"=>true,
					"error"=>"",
				);
				
			}
		}
		else{
				$result=array(
					"access_token"=>"",
					"enable"=>false,
					"error"=>"error code:100 : requestdata is null.",
				);
		}
		
		return json_encode($result,JSON_UNESCAPED_UNICODE);
		
	}
	
}


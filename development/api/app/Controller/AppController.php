<?php


App::uses('Controller', 'Controller');


class AppController extends Controller {
	
	public $autoRender=false;
	public $layout=false;


	public $components=array(
		"Loadbasic",
	);

	//前処理
	public function beforeFilter(){
	
		header("Access-Control-Allow-Origin:*");
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

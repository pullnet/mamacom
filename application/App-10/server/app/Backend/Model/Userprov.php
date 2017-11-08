<?php
include_once(Router::url("Model")."AppModel.php");
class Userprov extends AppModel{

	public function afterfind($data,$type){
		if(@$data){
			if(@$type=="first"){
				$data["Userprov"]["user_data"]=JSON_DEC($data["Userprov"]["user_data"]);
			}
			return $data;
		}

	}
}
?>
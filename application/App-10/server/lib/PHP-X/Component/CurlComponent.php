<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	CurlComponent
//	CurlComponent.php
//
//--------------------------------------------------
class CurlComponent extends Component{

	//constructer
	public function __construct($data){
		parent::__construct($data);

	}
	//access
	public function access($url_base,$params=array(),$json_outupt=false){

		//parameter set
		if(!@$params["method"]){
			$params["method"]="get";
		}

		if($params["method"]=="get"){

			unset($params["method"]);

			//URL setting
			$url=$url_base."?";
			$params_key=array_keys($params);

			//get parameter
			$icount=0;
			$last=count($params);
			foreach($params as $p_){
				$url.=$params_key[$icount]."=".urlencode($p_);
				if($icount<($last-1)){
					$url.="&";
				}
				$icount++;
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);//SSL setting

		}
		else if($params["method"]=="post"){

			unset($params["method"]);

			//URL setting
			$url=$url_base;

			$params_key=array_keys($params);
			$ind=0;
			$post_params=array();
			foreach($params as $p_){
				if($params_key[$ind]!="method"){
					$post_params["dat"][$params_key[$ind]]=$p_;
				}
				$ind++;
			}

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_params));
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);//SSL setting
		}
	
		$result_curl=array();
		$result_curl = curl_exec($ch);
		curl_close($ch);

		if($json_outupt){
			return json_decode($result_curl,true);
		}
		else
		{
			return $result_curl;
		}
	}

}
?>
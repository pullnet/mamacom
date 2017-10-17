<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	2016/07/28							*/
/*									*/
/*	コンテンツ管理アクセス用コンポーネント				*/
/*	CurlComponent.php						*/
/* ------------------------------------------------------------------- 	*/
class CurlComponent extends Component{

	//アクセス
	public function access($url_base,$params=array(),$jsonoutupt=true){

		//URLを整列
		$url=$url_base."?";
		$params_key=array_keys($params);

		//getパラメータを作成
		$icount=0;
		foreach($params as $p_){
			$url.=$params_key[$icount]."=".$p_."&";
			$icount++;
		}

		$result_curl=array();
		//curlで画像変更手続き
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);//4/28追加　CURLはSSL接続したものに対してはバグるのでそれ会費用
		$result_curl = curl_exec($ch);
		curl_close($ch);
debug($result_curl);

		if($jsonoutupt){
			return json_decode($result_curl);
		}
		else
		{
			return $result_curl;
		}
	}

}

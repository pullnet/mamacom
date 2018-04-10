<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/03/03
//
//	HtmlscrapeComponent
//	HtmlscrapeComponent.php
//
//--------------------------------------------------

class HtmlscrapeComponent extends Component{

	public $element;

	public $XMLS;

	public function __construct($data){

	}
	public function load($url,$option=array()){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);//SSL setting
		$result=array();
		$result=curl_exec($ch);
		curl_close($ch);

		if(!@$option["encoding"]){
			$option["encoding"]="utf-8";
		}
		if(!@$option["unicode"]){
			$option["unicode"]=false;
		}
		$this->_xml_converting($result,@$option["encoding"],@$option["unicode"]);
	}
	public function scrape($array){
		$getelement=$this->element;

		if(@$array["path"]){
			foreach($array["path"] as $key=>$a_){
				if($key==="class"){
					foreach($getelement as $key0=>$gl_){
						if(@$gl_["@attributes"]["class"]==$a_){
							unset($getelement[$key0]["@attributes"]);
							$index=$key0;
						}
					}
					@$getelement=$getelement[$index];
				}
				else{
					$getelement=$getelement[$a_];
				}
			}
		}
		if(@$array["search"]){


		}

		$output=$getelement;
		return $output;
	}

	private function _xml_converting($html,$encoding="utf-8",$json_unicode=false){
		$DOMS = new DOMDocument();
		@$DOMS->loadHTML($html);
		$xmlString=$DOMS->saveXML();
		$xmlObject = simplexml_load_string($xmlString);
		if(!$json_unicode){
			$json=json_encode($xmlObject,JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$json=json_encode($xmlObject);
		}
		$json=mb_convert_encoding($json,$encoding,"auto");
		$output=json_decode($json, true);
		$this->element=$output;

	}

}

<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/03/01
//
//	FormHelper
//	FormHelper.php
//
//--------------------------------------------------
class HtmlHelper extends Helper{

	//link tag
	public function link($text,$url,$option=null){
		$linkurl=$this->_seturl($url);

		//option
		if($option){
			$option_str="";
			foreach($option as $key=>$o_){
				$option_str.=$key.'="'.$o_.'" ';
			}
		}

		return '<a href="'.$linkurl.'" '.@$option_str.'>'.$text.'</a>';
	}
	//get parameter
	private function _getparams($params){
		$get_str="?";
		$params_key=array_keys($params);
		$ind=0;
		$last=count($params);
		foreach($params as $p_){
			$get_str.=$params_key[$ind]."=".$p_;
			if($ind<($last-1)){
				$get_str.="&";
			}
			$ind++;
		}
		return $get_str;

	}
	//url tag
	public function url($url){
		return $this->_seturl($url);
	}
	//seturl
	private function _seturl($url){

		if(is_array($url)){

			$checkurl=$url;
			unset($checkurl["controller"]);
			unset($checkurl["action"]);
			if(@$checkurl){
				if(!@$url["action"]){
					$url["action"]="index";
				}
				if(!@$url["controller"]){
					$url["controller"]=$this->params["controller"];
				}
			}

			if(@$this->params["firsturl"]){
				$linkurl=$this->params["root"].@$url[$this->params["firsturl"]]."/".$url["controller"]."/".$url["action"];
			}
			else
			{
				$linkurl=$this->params["root"].$url["controller"]."/".@$url["action"];
			}

			$urlbuff=$url;
			unset($urlbuff["controller"]);
			unset($urlbuff["action"]);
			unset($urlbuff["?"]);
			unset($urlbuff["#"]);
			unset($urlbuff[@$this->params["firsturl"]]);
			$last=count($urlbuff);
			$ind=0;
			foreach($urlbuff as $u_){
				if($ind<$last){
					$linkurl.="/".$u_;
				}
				$ind++;
			}

			//get parameter
			if(@$url["?"]){
				$url["?"]=$this->_getparams($url["?"]);
			}
			else
			{
				unset($url["?"]);
			}
			//pagein linke
			if(@$url["#"]){
				$url["#"]="#".$url["#"];
			}

			$linkurl.=@$url["?"].@$url["#"];

			return $linkurl;
		}
		else
		{
			if($url=="/"){
				return $this->params["root"];
			}
			else
			{
				return $url;
			}
		}
	}
	//image tag
	public function image($image_url,$option=null){
		//url pass
		$parse=parse_url($image_url);
		if(isset($parse["scheme"]) || isset($parse["host"])){
			$url=$image_url;
		}
		else
		{
			$url=$this->params["root"]."wdata/images/".$image_url;
		}

		//option
		if($option){
			$option_str="";
			foreach($option as $key=>$o_){
				$option_str.=$key.'="'.$o_.'" ';
			}
		}

		return '<img src="'.$url.'" '.$option_str.'>';
	}
	//SVG tag load
	public function loadsvg($svg_url,$option=null){
		$parse=parse_url($svg_url);
		if(isset($parse["scheme"]) || isset($parse["host"])){
			$url=$svg_url;
		}
		else
		{
			$url=$this->params["root"]."wdata/images/".$svg_url;
		}
		$handle = fopen($url, "r");
		$contents = stream_get_contents($handle);
		fclose($handle);
		
		//option
		if($option){
			$option_str="";
			foreach($option as $key=>$o_){
				$option_str.=$key.'="'.$o_.'" ';
			}
		}
		$contents=str_replace("<svg","<svg ".$option_str,$contents);

		return $contents;
	}
	//iframe tag
	public function iframe($iframe_url,$option=null){
		//url pass
		$iframe_url=$this->_seturl($iframe_url);

		//option
		if($option){
			$option_str="";
			foreach($option as $key=>$o_){
				$option_str.=$key.'="'.$o_.'" ';
			}
		}

		return '<iframe src="'.$iframe_url.'" '.$option_str.'></iframe>';
	}
	//video tag
	public function video($video_url,$option=null){
		//option
		if($option){
			$option_str="";
			foreach($option as $key=>$o_){
				$option_str.=$key.'="'.$o_.'" ';
			}
		}
		return '<video controls '.$option_str.'><source src="'.$video_url.'"></iframe>';
	}
	//css tag
	public function css($cssfile,$cache=false){
		if(is_array($cssfile)){
			$html="";
			foreach($cssfile as $c_){
				$path=$this->params["root"]."wdata/css/".$c_.".css";
				if($cache){
					$path.="?".phpx_date("YmdHis",phpx_strtotime());
				}

				$html.='<link rel="stylesheet" type="text/css" href="'.$path.'">';
			}
		}
		else
		{
			$path=$this->params["root"]."wdata/css/".$cssfile.".css";
			if($cache){
				$path.="?".phpx_date("YmdHis",phpx_strtotime());
			}
			$html='<link rel="stylesheet" type="text/css" href="'.$path.'">';
		}
		return $html;
	}
	//css tag(lib)
	public function css_lib($cssfile){
		if(is_array($cssfile)){
			$html="";
			foreach($cssfile as $c_){
				$path=$this->params["root"]."_css/".$c_.".css";
				$html.='<link rel="stylesheet" type="text/css" href="'.$path.'">';
			}
		}
		else
		{
			$path=$this->params["root"]."_css/".$cssfile.".css";
			$html='<link rel="stylesheet" type="text/css" href="'.$path.'">';
		}
		return $html;
	}
	//script tag
	public function script($scriptfile,$cache=false){
		if(is_array($scriptfile)){
			$html="";
			foreach($scriptfile as $s_){
				$path=$this->params["root"]."wdata/js/".$s_;
				if($cache){
					$path.="?".phpx_date("YmdHis",phpx_strtotime());
				}
				$html.='<script type="text/javascript" src="'.$path.'"></script>';
			}
		}
		else
		{
			$path=$this->params["root"]."wdata/js/".$scriptfile;
			if($cache){
				$path.="?".phpx_date("YmdHis",phpx_strtotime());
			}
			$html='<script type="text/javascript" src="'.$path.'"></script>';
		}

		return $html;
	}
	//active tag
	public function active($html=null,$option=null){
		if(@$html){
			if($option){
				$option_str=" ";
				foreach($option as $key=>$o_){
					$option_str.=$key.'="'.$o_.'"';
				}
				return '<div'.@$option_str.'>'.$html.'</div>';
			}
			else
			{
				return $html;
			}
		}
	}
}
?>
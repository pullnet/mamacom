<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/05/22
//
//	ApidocHelper
//	Apidochelper.php
//
//--------------------------------------------------

class ApidocHelper extends Helper{

	/*
	create Api document table

	Save the API reference in the folders below

	plugin/Apidoc/{API Name}.php

	*/

	public $params;

	public function beforeFilter(){

	}
	//API LIST
	public function get_apilist($option=array()){

		if(@file_exists("../plugin/Apidoc/_default.php")){
			include("../plugin/Apidoc/_default.php");
			$default=@$params;
		}
		$params=array();


		$list=array();


		if(@$default){
			foreach($default as $key=>$d_){

				if(@$d_["sort"]){
					foreach($d_["sort"] as $key2=>$dd_){
						@include("../plugin/Apidoc/".$dd_.".php");
						if(@$params){
							$b_=array(
								"name"=>@$params["name"],
								"title"=>@$params["title"],
								"endpoint"=>@$params["endpoint"],
								"caption"=>@$params["caption"],
								"method"=>@$params["method"],
								"encoding"=>@$params["encoding"],
								"autholity"=>@$params["autholity"],
								"output"=>@$params["output"],
							);
							$list[$d_["name"]][]=$b_;
						}
					}
				}
			}
		}
		else
		{
			$glob=glob("../plugin/Apidoc/*.php");
			foreach($glob as $g_){
				if(@basename($g_)!="_default.php"){
					$params=array();
					include($g_);
					$b_=array(
						"name"=>@$params["name"],
						"title"=>@$params["title"],
						"endpoint"=>@$params["endpoint"],
						"caption"=>@$params["caption"],
						"method"=>@$params["method"],
						"encoding"=>@$params["encoding"],
						"autholity"=>@$params["autholity"],
						"output"=>@$params["output"],
					);
					if(@$params["category"]){
						$list[@$params["category"]][]=$b_;
					}
					else
					{
						$list["_other"][]=$b_;
					}

				}
			}
		}

		return $list;
	}
	//API DOCUMENT LOAD
	public function load($array){
		if(is_array($array)){
			$this->params=$array;
		}
		else
		{
			include("../plugin/Apidoc/".$array.".php");
			$this->params=$params;
		}

	}
	//OUTPUT DOCUMENT TABLE
	public function output_document(){

		$html='<h2 style="margin-bottom:10px">API Document</h2><table>';

		$html_main="";
		foreach($this->params as $key=>$a_){
			if($key=="Request"){
				$html_request=$this->_set_request_table($a_);
			}
			else if($key=="Response"){
				$html_response=$this->_set_response_table($a_,$this->params["output"]);
				if($this->params["output"]=="json"){
					$html_responce_json=$this->_set_response_json($a_);
				}
			}
			else
			{
				$html_main.=$this->_set_colum($key,$a_);
			}
		}

		$html.=$html_main.@$html_request.@$html_response.@$html_responce_json;


		$html.='</table>';

		return $html;
	}
	//OUTPUT API TEST FORM
	private function _set_request_table($params){


		$html='<tr><th colspan="2">Request</th></tr>';
		if(!$params){
			return $html.'<tr><td colspan="2" style="text-align:center;font-size:16px"> no request..</td></tr>';
		}

		$html.='<tr><td colspan="2">
<table class="list">
<tr>
<th style="width:50px">No</th>
<th style="width:80px">required</th>
<th style="width:150px">Name</th>
<th style="width:150px">type</th>
<th>Colum name</th>
<th>caption</th></tr>';

		$r_count=0;
		foreach($params as $key2=>$aa_){
			$r_count++;
			$html.='<tr>';

			if(@$aa_["multi"]){
				$html.='<td style="text-align:center">'.$r_count.'</td>';
				if(@$aa_["required"]){
					$html.='<td class="center">○</td>';
				}
				else
				{
					$html.="<td></td>";
				}
				$html.='<td>'.$key2.'</td>';
				$html.='<td>Array</td>';
				if(@$aa_["name"]){
					$html.='<td>'.$aa_["name"]."(multi resource)</td>";
				}


				$html.="<td></td>";
				$html.="</tr>";

				foreach($aa_["multi"] as $key3=>$aaa_){
					$r_count++;
					$html.="<tr>";
					$html.='<td class="center">'.$r_count.'</td>';
					if(@$aaa_["required"]){
						$html.='<td class="center">○</td>';
					}
					else
					{
						$html.="<td></td>";
					}

					$html.='<td style="padding-left:20px">'.$key3.'</td>';
					if(@$aaa_["type"]){
						$html.='<td>'.@$aaa_["type"].'</td>';
					}
					else
					{
						$html.='<td>text</td>';
					}

					if(@$aaa_["name"]){
						$html.="<td>".$aaa_["name"]."</td>";
					}

					$html.="<td>".nl2br(@$aa_["caption"])."</td>";
					$html.="</tr>";
				}
			}
			else
			{
				$html.='<td class="center">'.$r_count.'</td>';
				if(@$aa_["required"]){
					$html.='<td class="center">○</td>';
				}
				else
				{
					$html.="<td></td>";
				}
				$html.='<td>'.$key2.'</td>';
				if(@$aa_["type"]){
					$html.='<td>'.@$aa_["type"].'</td>';
				}
				else
				{
					$html.='<td>text</td>';
				}

				if(@$aa_["name"]){
					$html.="<td>".$aa_["name"]."</td>";
				}

				if(@$aa_["select"]){
					if(!@$aa_["caption"]){
						$aa_["caption"]="";
					}
					$buff="[";
					foreach($aa_["select"] as $key_s=>$aas_){
						$buff.=$key_s.":".$aas_." , ";
					}
					$buff.="]";
					$aa_["caption"].=$buff;
				}
				$html.="<td>".nl2br(@$aa_["caption"])."</td>";
			}

			$html.='</tr>';
		}
		$html.="</table></td></tr>";
		return $html;
	}
	private function _set_response_table($params,$mode="json"){

		$html='<tr><th colspan="2">Response</th></tr>';

		if($mode=="json"){

			if(!@$params){

				return $html.'<tr><td colspan="2" style="font-size:16px;text-align:center"> undefined response...</td></tr>';
			}
			$html.='<tr><td colspan="2">
<table class="list">
<tr>
<th style="width:50px">No</th>
<th style="width:150px">Name</th>
<th style="width:150px">type</th>
<th style="width:300px">Colum name</th>
<th>caption</th></tr>';

			$r_count=0;
			foreach($params as $key2=>$aa_){
				$r_count++;

				$html.='<tr>';
				if(@$aa_["multi"]){
					$html.='<td style="text-align:center">'.$r_count.'</td>';
					$html.='<td>'.$key2.'</td>';
					$html.='<td>Array</td>';
					if(@$aa_["name"]){
						$html.='<td>'.$aa_["name"]."(multi resource)</td>";
					}

					$html.="<td></td>";
					$html.="</tr>";

					foreach($aa_["multi"] as $key3=>$aaa_){
						$r_count++;
						$html.="<tr>";
						$html.='<td class="center">'.$r_count.'</td>';


						$html.='<td style="padding-left:20px">'.$key3.'</td>';
						if(@$aaa_["type"]){
							$html.='<td>'.@$aaa_["type"].'</td>';
						}
						else
						{
							$html.='<td>text</td>';
						}

						if(@$aaa_["name"]){
							$html.="<td>".$aaa_["name"]."</td>";
						}
						if(@$aaa_["select"]){
							if(!@$aaa_["caption"]){
								$aaa_["caption"]="";
							}
							$buff="[";
							foreach($aaa_["select"] as $key_s=>$aas_){
								$buff.=$key_s.":".$aas_." , ";
							}
							$buff.="]";
							$aaa_["caption"].=$buff;
						}
						$html.="<td>".nl2br(@$aaa_["caption"])."</td>";
						$html.="</tr>";
					}
				}
				else
				{
					$html.='<td style="text-align:center">'.$r_count.'</td>';
					$html.='<td>'.$key2.'</td>';
					if(@$aa_["type"]){
						$html.='<td>'.@$aa_["type"].'</td>';
					}
					else
					{
						$html.='<td>text</td>';
					}

					if(@$aa_["name"]){
						$html.="<td>".$aa_["name"]."</td>";
					}

					if(@$aa_["select"]){
						if(!@$aa_["caption"]){
							$aa_["caption"]="";
						}
						$buff="[";
						foreach($aa_["select"] as $key_s=>$aas_){
							$buff.=$key_s.":".$aas_." , ";
						}
						$buff.="]";
						$aa_["caption"].=$buff;
					}
					$html.="<td>".nl2br(@$aa_["caption"])."</td>";
				}

				$html.='</tr>';
			}
			$html.="</table></td></tr>";
		}
		else if($mode=="html"){
			$html.='<tr><td colspan="2"><p class="center h4">HTML DATA..</p></tr></td>';
		}


		return $html;
	}
	private function _set_response_json($params){

		$html='<tr><th colspan="2">Response(JSON Code)</th></tr>';
		$html.='<tr><td colspan="2" style="background:#444;color:#fff">';

		$json="{\n";

		foreach($params as $key=>$a_){
				if(@$a_["multi"]){
					$json.='<span style="display:inline-block;padding:0px 30px"></span>'.$key.':{'."\n";

					foreach($a_["multi"] as $key2=>$aa_){
						$json.='<span style="display:inline-block;padding:0px 60px"></span>'.$key2.':"'.$aa_["name"].'"'."\n";
					}

					$json.='<span style="display:inline-block;padding:0px 30px"></span>}'."\n";
				}
				else
				{
					$json.='<span style="display:inline-block;padding:0px 30px"></span>'.$key.':"'.$a_["name"].'",'."\n";
				}
		}

		$json.="}";

		$html.=nl2br($json)."</td></tr>";

		return $html;

	}
	private function _set_colum($name,$value){
		if($name=="title"){
			$html='<tr><th>'.$name.'</th><td style="font-size:16px;font-weight:bold;">'.$value.'</td></tr>';

		}
		else if($name=="endpoint"){
			$html='<tr><th>'.$name.'</th><td style="text-decoration:underline">'.$value.'</td></tr>';
		}
		else if($name=="caption"){
			$html='<tr><th>'.$name.'</th><td>'.nl2br($value).'</td></tr>';
		}
		else{
			if($name!="testForm"){
				$html='<tr><th>'.$name.'</th><td>'.$value.'</td></tr>';
			}
			else{
				$html="";
			}
		}

		return $html;

	}
	//create form
	public function create_form(){

		$req=$this->params["Request"];

		$Form=new FormHelper($this);

		$html=$Form->create("Post",array(
			"method"=>@$this->params["method"],
			"action"=>@$this->params["testForm"]["url"],
		));

		$addhtml="";
		if(@$this->params["testForm"]){
			foreach($this->params["testForm"] as $key=>$r_){
				if($key!="url"){
					$addhtml.=$Form->hidden($key,array("value"=>$r_));
				}
			}
		}



		$html.=@$addhtml;

		$html.="<table>";
		foreach($req as $key=>$r_){

			if(@$r_["multi"]){
				$html.='<tr><th><strong>'.$r_["name"].'</strong></th><td>';

				unset($r_["multi"]);
				unset($r_["name"]);

				$html.="<table>";
				foreach($r_ as $key2=>$rr_){

					$html.="<tr><th>".$rr_["name"]."</th><td>";
					if(!@$rr_["type"]){
						$rr_["type"]="text";
					}
					if($rr_["type"]=="select"){

						$html.=$Form->select($key.".".$key2,@$r_r["select"]);
					}
					else if($rr_["type"]=="text_long"){

						$html.=$Form->textarea($key.".".@$key2);
					}
					else
					{
						$html.=$Form->input($key.".".$key2);
					}
					$html.="</td></tr>";
				}
				$html.="</table></td></tr>";
			}
			else
			{

				$html.="<tr><th><strong>".$r_["name"]."</strong></th>";
				$html.="<td>";
				if(!@$r_["type"]){
					$r_["type"]="text";
				}
				if($r_["type"]=="select"){

					$html.=$Form->select($key,@$r_["select"]);
				}
				else if($r_["type"]=="text_long"){

					$html.=$Form->textarea(@$key);
				}
				else
				{
					$html.=$Form->input($key);
				}
				$html.="</td></tr>";
			}
		}
		$html.="</table><br><center>";

		$html.=$Form->submit("送信",array("class"=>"buttons add"));
		$html.="</center>";
		$html.=$Form->end();



		return $html;
	}
}
?>
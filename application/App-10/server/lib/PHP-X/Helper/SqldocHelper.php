<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/05/24
//
//	SqldocHelper
//	Sqldochelper.php
//
//--------------------------------------------------

class SqldocHelper extends Helper{

	public $db_default;
	public $db_params;
	public $path="../plugin/Sqldoc/";

	public function beforeFilter(){

	}
	public function get_sqllist(){

		include($this->path."_default.php");

		$db_default=$params;

		$glob=glob($this->path."*.php");

		$output=array();
		foreach($glob as $g_){
			if(basename($g_)!="_default.php"){
				$params=array();
				include($g_);

				$params["Table"]=array_merge(@$db_default[$params["Schema"]]["Table"],@$params["Table"]);

				$b_=array(
					"name"=>@$params["name"],
					"title"=>@$params["title"],
					"Schema"=>@$params["Schema"],
					"tableCount"=>count($params["Table"]),
				);
				$output[$params["Schema"]][]=$b_;
			}
		}

		return $output;

	}
	public function table($array){
		include($this->path."_default.php");

		$this->db_default=$params;
		$params=array();
		include($this->path.$array.".php");

		$params["Table"]=array_merge($this->db_default[$params["Schema"]]["Table"],$params["Table"]);

		$this->db_params=$params;
	}
	public function output_document(){
		$mmdata=array(
			"table"=>array(
				$this->db_params["name"]=>array(
					"comment"=>$this->db_params["title"].":\n".$this->db_params["caption"],
					"encoding"=>$this->db_default[$this->db_params["Schema"]]["encoding"],
				),
			),
		);

		$html="<h2>SQL DETAIL</h2>";

		$html.="<table>";

		$html_main="";
		$html_table="";
		
		foreach($this->db_params as $key=>$t_){
			if($key!="Table"){
				$html_main.="<tr><th>".$key."</th><td>".$t_."</td></tr>";
			}
			else{
				$r_count=0;

				$html_table.='<tr><th colspan="2">Table list</th></tr>
				<tr><td colspan="2">
				<table class="list">
				<tr>
				<th style="width:50px">No</th>
				<th style="width:200px">Table name</th>
				<th>title</th>
				<th style="width:150px">type</th>
				<th style="width:50px">AI</th>
				<th style="width:50px">PK</th>
				<th style="width:50px">NN</th>
				<th>comment</th>';
				foreach($t_ as $key2=>$tt_){
					$r_count++;

					if(@$tt_["primary_key"]){
						$html_table.='<tr style="background:#ecc">';
					}
					else
					{
						$html_table.="<tr>";
					}

					$html_table.='<td style="text-align:center">'.$r_count."</td>";
					$html_table.='<td>'.$key2."</td>";
					$html_table.='<td>'.$tt_["name"]."</td>";
					$html_table.='<td>'.$tt_["type"];
					if(!($tt_["type"]=="datetime" || $tt_["type"]=="text")){
						$html_table.="(".@$tt_["length"].")";
					}
					$html_table.="</td>";


					if(@$tt_["auto_increment"]){
						$html_table.='<td style="text-align:center">○</td>';
					}
					else
					{
						$html_table.="<td></td>";
					}
					if(@$tt_["primary_key"]){
						$html_table.='<td style="text-align:center">○</td>';
					}
					else
					{
						$html_table.="<td></td>";
					}
					if(@$tt_["not_null"]){
						$html_table.='<td style="text-align:center">○</td>';
					}
					else
					{
						$html_table.="<td></td>";
					}

					$html_table.="<td>".@$tt_["comment"]."</td>";
					$html_table.="</tr>";

					$mmdata["table"][$this->db_params["name"]]["colum"][$key2]=$tt_;
				}
				$html_table.="</table></td></tr>";
			}
		}

		$html.=$html_main.$html_table;

		$Modelmake=new ModelmakeComponent($this);

		$html_sql="";
		$html_sql.='<tr><th colspan="2">SQL CODE</th></tr>';
		$html_sql.='<tr><td colspan="2">';
		$html_sql.='<textarea disabled="true" style="height:400px">'.$Modelmake->create_table($mmdata,1).'</textarea>';
		$html_sql.="</td></tr>";
		$html.=$html_sql;

		$html.="</table>";


		return $html;
	}
}
?>
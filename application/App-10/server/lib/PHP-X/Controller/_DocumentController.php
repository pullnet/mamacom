<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/06/01
//
//	_DdocumentController
//	_DdocumentControoler.php
//
//--------------------------------------------------
include(Router::url("lib/Controller")."_AppController.php");

class _DocumentController extends _AppController{

	public $layout_lib="default_document";

	public $uses_lib=array(
		"_Doc_DatabaseReference",
	);
	public $components=array(
		"Modelmake",
	);

	public function index(){


	}
	public function accounter(){


	}
	public function basic(){


	}
	public function std(){
		$search_controller=glob_deep("../app/02_Controller","file");

		$ac_list=$this->_defined_actions($search_controller);

		$this->set("ac_list",$ac_list);


		if($this->request->post){
			$post=$this->request->post;

			$jsoncode=json_encode($post);
			
			file_put_contents("std_diagram.json",$jsoncode);

			$this->Session->write("alert","diagram save complete!");
			$this->redirect(array("controller"=>"_document","action"=>"std"));
		}
		else
		{
			$jsoncode=@file_get_contents("std_diagram.json");
			$jsoncode=json_decode($jsoncode,true);
			$this->request->post=$jsoncode;

		}

	}
	public function std_pagelist(){
		$search_controller=glob_deep("../app/02_Controller","file");

		$ac_list=$this->_defined_actions($search_controller);

		$this->set("ac_list",$ac_list);

	}
	private function _defined_actions($pathlist){

		$action=array();
		foreach($pathlist as $p_){

			$html=file_get_contents($p_);

			for($vs=0;$vs<30;$vs++){
				$start_int=0;
				$exit_int=0;

				$title_start_int=mb_stripos($html,"##");

				if($title_start_int){
					$buff_html=mb_substr($html,$title_start_int+strlen("##"));

					$title_exit_int=mb_stripos($buff_html,"##");
					
					$title=mb_substr($buff_html,0,$title_exit_int);
				}
				else
				{
					$title="";
				}

				$start_int=mb_stripos($html,"public function ");
				$html=mb_substr($html,$start_int+strlen("public function "));

				if(!$start_int){
					break;
				}

				$exit_int=mb_stripos($html,"(");

				$getword=mb_substr($html,0,$exit_int);

				$next_int=mb_stripos($html,"public function ");
				if($next_int){
					$action_html=mb_substr($html,0,$next_int);
				}
				else
				{
					$action_html=$html;
				}

				if(stripos($action_html,"this->autoRender=false;")){
					$autoRender=false;
				}
				else
				{
					$autoRender=true;
				}

				$html=mb_substr($html,$exit_int);
				if($getword!="beforeFilter" && $getword!="afterFilter"){
					$action[basename($p_,".php")][$getword]=array(
						"action"=>$getword,
						"autoRender"=>$autoRender,
						"title"=>@$title,
					);
				}
			}
		}

		return $action;

	}
	public function dbr(){
		$params_default=file_get_contents("../plugin/Sqldocument/_default.json");
		$params_default=json_decode($params_default,true);

		$json_list=glob("../plugin/Sqldocument/*.json");

		foreach($json_list as $j_){
			if(basename($j_)!="_default.json"){

				$buff=file_get_contents($j_);
				$buff=json_decode($buff,true);

				$buff["Table"]=array_merge(@$params_default[@$buff["Schema"]]["default"],@$buff["Table"]);

				$params_default[$buff["Schema"]]["Table"][]=$buff;
			}
		}

		$this->set("params_default",$params_default);

	}
	public function dbr_detail($dbname,$tablename){
		$params_default=file_get_contents("../plugin/Sqldocument/_default.json");
		$params_default=json_decode($params_default,true);

		$params_table=file_get_contents("../plugin/Sqldocument/".$tablename.".json");
		$params_table=json_decode($params_table,true);

		$params_table["Table"]=array_merge(@$params_default[@$dbname]["default"],@$params_table["Table"]);

		$this->set("dbname",$dbname);
		$this->set("params_default",$params_default);
		$this->set("params_table",$params_table);
	
		$modelmakes=array(
			"database"=>$dbname,
			"encoding"=>$params_default[$dbname]["encoding"],
			"table"=>array(
				$tablename=>array(
					"comment"=>$params_table["title"]." : ".$params_table["caption"],
					"colum"=>$params_table["Table"],
				),
			),
		);
		$sql_code=$this->Modelmake->create_table($modelmakes,1);
		$this->set("sql_code",$sql_code);

	}
	public function dbr_down(){
		$this->autoRender=false;

		$sql_code=$this->__dbr_createsql();

		$filename="___sql.".hash("sha256",phpx_date("YmdHis",phpx_strtotime()));

		file_put_contents($filename,$sql_code);

		$this->download($filename,"dump_".phpx_date("YmdHis",phpx_strtotime()).".sql");
		
		unlink($filename);
	}
	public function dbr_sqlview(){

		$sql_code=$this->__dbr_createsql();

		$this->set("sql_code",$sql_code);

	}
	private function __dbr_createsql(){

		$params_default=file_get_contents("../plugin/Sqldocument/_default.json");
		$params_default=json_decode($params_default,true);

		$json_list=glob("../plugin/Sqldocument/*.json");

		foreach($json_list as $j_){
			if(basename($j_)!="_default.json"){

				$buff=file_get_contents($j_);
				$buff=json_decode($buff,true);

				$buff["Table"]=array_merge(@$params_default[@$buff["Schema"]]["default"],@$buff["Table"]);

				$params_default[$buff["Schema"]]["Table"][]=$buff;
			}
		}

		$modelmakes=array();
		foreach($params_default as $dbname=>$pd_){

			$mbuff=array(
				"database"=>$dbname,
				"encoding"=>$pd_["encoding"],
				"table"=>array(),
			);

			if(@$pd_["Table"]){
				foreach($pd_["Table"] as $pdt_){
					$mbuff["table"][$pdt_["name"]]=array(
						"comment"=>$pdt_["title"]." : ".$pdt_["caption"],
						"colum"=>$pdt_["Table"],
					);
				}
			}
			$modelmakes[]=$mbuff;

		}

		$sql_code="";
		foreach($modelmakes as $m_){
			$sql_code.=$this->Modelmake->create_sql($m_);
		}

		return $sql_code;

	}
	public function dbr_er(){


	}

	public function api(){


	}
}
?>
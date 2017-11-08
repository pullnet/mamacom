<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/06/01
//
//	_PhpxovenController
//	_PhpxovenController.php
//
//--------------------------------------------------

class _PhpxovenController extends Controller{

	public $uses_lib=array(
		"_Oven_Controller",
		"_Oven_Component",
		"_Oven_Model",
	);

	public $layout_lib="default_oven";

	public function index(){


	}
	public function config($configname){

		$this->Render="config_".$configname;

		if($this->request->post){


		}
		else
		{

		}

	}
	public function controller($mode=null,$cname=null){
		if($mode=="edit"){
			$this->Render="controller-edit";


			if($this->request->post){

				$post=$this->request->post;

				$juge=$this->_Oven_Controller->validates($post);

				if(!$juge){

$phptag="<?php\n";

if($post["Controller"]["inheritance_controller"]){
	$bef_controller=$post["Controller"]["inheritance_controller"]."Controller";
	$bef_controller_back='include_once(Router::url("Controller")."/".'.$post["Controller"]["inheritance_controller"].'Controller.php");';
}
else
{
	$bef_controller="Controller";
}
$phptag.=@$bef_controller_back;
$phptag.="\nclass ".$post["Controller"]["name"]."Controller extends ".$bef_controller."{\n";
if(@$post["Controller"]["uses"]){
	$uses_tag="public \$uses=array(";
	$uses=explode(",",$post["Controller"]["uses"]);
	foreach($uses as $u_){
		$uses_tag.='\n"'.$u_.'",';
	}
	$uses_tag.=");\n";

	$phptag.=$uses_tag;


}



$phptag.="}\n";


$phptag.="?>";



echo nl2br(h($phptag));
exit;

				}
				else
				{
					$this->set("errors",$juge);
				}

			}
			else
			{

			}




		}
		else
		{


		}
	}
	public function ajax_getactionform($index){
		$this->set("index",$index);

		$this->layout_lib="default_no";

		$this->Render="ajax/ajax_getactionform";
	}
}
?>
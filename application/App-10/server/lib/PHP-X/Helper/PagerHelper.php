<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/13
//
//	PagerHelper
//	PagerHelper.php
//
//--------------------------------------------------

class PagerHelper extends HtmlHelper{

	public function view($pager,$option=array()){
		if($pager["totalpage"]>1){
			$html='<div class="pager '.@$option["class"].'">';
			$html.='<ul>';

			if($pager["page"]!=1){
				$this->get["page"]=($pager["page"]-1);
				$html.='<li>'.$this->link("<",array("controller"=>$this->params["Controller"],"action"=>$this->params["action"],"?"=>$this->get),array("class"=>"underline"))."</li>";
			}
			for($v1=1;$v1<=$pager["totalpage"];$v1++){
				if($v1==$pager["page"]){
					$active="active";
				}
				else
				{
					$active="";
				}
				$this->get["page"]=$v1;
				$html.='<li class="'.$active.'">'.$this->link($v1,array("controller"=>$this->params["Controller"],"action"=>$this->params["action"],"?"=>$this->get),array("class"=>"underline"))."</li>";
			}
			if($pager["page"]<$pager["totalpage"]){
				$this->get["page"]=($pager["page"]+1);
				$html.='<li>'.$this->link(">",array("controller"=>$this->params["Controller"],"action"=>$this->params["action"],"?"=>$this->get),array("class"=>"underline"))."</li>";
			}
			$html.="</ul></div>";
		}
		else
		{
			return "";
		}
		return $html;
	}
}
?>
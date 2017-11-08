<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/13
//
//	FormHelper
//	FormHelper.php
//
//--------------------------------------------------
class FormHelper extends Model{

	public $breakoff;

	public $model;
	public $default_charset;
	public $method="post";

	public function __construct($data){
		parent::__construct($data);

		@include("../app/Backend/Config/config.php");
		$this->default_charset=$default_charset;
		$this->breakoff=$breakoff;
	}
	private function _breakoff(){
		if(!@$this->breakoff){
			return "\n";
		}
		else{
			return "";
		}
	}
	private function set_name($name,$mode=false,$model=null){
		$namesplit=explode(".",$name);

		if($model){
			$names="dat[".$model."]";
		}
		else if($this->model){
			$names="dat[".$this->model."]";
		}
		else
		{
			$names="dat";
		}

		$name_id="";
		foreach($namesplit as $n_){
			if($mode){
				$names.=$n_;
			}
			else
			{
				$names.="[".$n_."]";
			}
		}
		return $names;
	}
	private function _post_answer($name){


		$name_array=explode(".",$name);

		if(count($name_array)==1){
			$ans_value=@$this->request->post[$this->model][$name];
		}
		if(count($name_array)==2){
			$ans_value=@$this->request->post[$this->model][$name_array[0]][$name_array[1]];
		}
		if(count($name_array)==3){
			$ans_value=@$this->request->post[$this->model][$name_array[0]][$name_array[1]][$name_array[2]];
		}
		if(count($name_array)==4){
			$ans_value=@$this->request->post[$this->model][$name_array[0]][$name_array[1]][$name_array[2]][$name_array[3]];
		}
		if(count($name_array)==5){
			$ans_value=@$this->request->post[$this->model][$name_array[0]][$name_array[1]][$name_array[2]][$name_array[3]][$name_array[4]];
		}
		if(count($name_array)==6){
			$ans_value=@$this->request->post[$this->model][$name_array[0]][$name_array[1]][$name_array[2]][$name_array[3]][$name_array[4]][$name_array[5]];
		}
		if(count($name_array)==7){
			$ans_value=@$this->request->post[$this->model][$name_array[0]][$name_array[1]][$name_array[2]][$name_array[3]][$name_array[4]][$name_array[5]][$name_array[6]];
		}
		if(count($name_array)==8){
			$ans_value=@$this->request->post[$this->model][$name_array[0]][$name_array[1]][$name_array[2]][$name_array[3]][$name_array[4]][$name_array[5]][$name_array[6]][$name_array[7]];
		}
		return $ans_value;

	}
	public function name($name,$change_model){
		$names=$this->set_name($name,false,$change_model);
		return $names;
	}
	//form create
	public function create($model,$array=array()){
		$this->model=$model;

		$array["method"]=strtolower(@$array["method"]);
		$array["charset"]=strtolower(@$array["charset"]);

		if(!@$array["method"]){
			$array["method"]="post";
		}
		if(!@$array["charset"]){
			if(!@$array["type"]=="file"){
				$array["charset"]=$this->default_charset;
			}
		}

		$this->method=$array["method"];

		$array_key=array_keys($array);
		$index=0;
		$options="";
		foreach($array as $a_){
			if($array_key[$index]=="action"){
				if(is_array($a_)){
					if(!@$a_["action"]){
						$a_["action"]="index";
					}
					$values=$this->params["root"].$a_["controller"]."/".$a_["action"];
				}
				else
				{
					$values=$a_;
				}
			}
			else if($array_key[$index]=="type"){
				if($a_=="file"){
					$array_key[$index]="enctype";
					$values="multipart/form-data";
					unset($array["type"]);
				}
			}
			else
			{
				$values=$a_;
			}

			$options.=$array_key[$index].'="'.$values.'" ';
			$index++;
		}
		return '<form '.$options.'>'.$this->_breakoff();
	}
	//form end
	public function end(){
		return '</form>'.$this->_breakoff();
	}
	//input tag
	public function input($name,$array=array()){

		$arraybase=array(
			"type"=>"text",
		);
		$array=array_merge($arraybase,$array);

		if($this->method=="post"){
			$names=$this->set_name($name);
		}
		else
		{
			$names=$name;
		}

		$array_key=array_keys($array);
		$index=0;
		$options="";

		if(!@$array["value_lock"]){
			$ans_value=$this->_post_answer($name);
		}

		if(@$array["autocomplete"]){
			$acm_list=$array["autocomplete"];
			$acm_str='<datalist id="'.$names.'">';
			foreach($acm_list as $a_){
				$acm_str.='<option value="'.$a_.'">';
			}
			$acm_str.="</datalist>";
			$options.=' autocomplete="on" list="'.$names.'"';
			unset($array["autocomplete"]);
		}

		if(@$ans_value){

			if(@$array["type"]=="checkbox"){
				$options.="checked ";
			}
			else
			{
				$options.=' value="'.$ans_value.'"';
			}

		}

		foreach($array as $a_){
			$options.=$array_key[$index].'="'.$a_.'" ';
			$index++;
		}

		return '<input name="'.$names.'" '.$options.'>'.@$acm_str.$this->_breakoff();
	}
	//hidden tag
	public function hidden($name,$array=array()){
		$arraybase=array(
			"type"=>"hidden",
		);
		$array=array_merge($arraybase,$array);

		if($this->method=="post"){
			$names=$this->set_name($name);
		}
		else
		{
			$names=$name;
		}

		$array_key=array_keys($array);
		$index=0;
		$options="";

		if(!@$array["value_lock"]){
			$ans_value=$this->_post_answer($name);
		}
		if(@$ans_value){
			$options.='value="'.$ans_value.'" ';
		}
		else
		{
			$options.='value="'.@$array["value"].'"';
		}
		foreach($array as $a_){
			if($array_key[$index]!="value"){
				$options.=$array_key[$index].'="'.$a_.'" ';
				$index++;
			}
		}

		return '<input type="hidden" name="'.$names.'" '.$options.'>'.$this->_breakoff();
	}
	//textarea tag
	public function textarea($name,$array=array()){

		if($this->method=="post"){
			$names=$this->set_name($name);
		}
		else
		{
			$names=$name;
		}

		$array_key=array_keys($array);
		$index=0;
		$options="";
		$values="";

		foreach($array as $a_){
			if($array_key[$index]=="value"){
				$values=$a_;
			}
			else
			{
				$options.=$array_key[$index].'="'.$a_.'" ';
			}
			$index++;
		}

		if(!@$array["value_lock"]){
			$post_values=$this->_post_answer($name);
		}
		if(@$post_values){
			$values=$post_values;
		}

		return '<textarea name="'.$names.'" '.$options.'>'.$values.'</textarea>'.$this->_breakoff();
	}
	//radio tag
	public function radio($name,$option,$array=array()){

		$html_out="";

		$names=$this->set_name($name,false,@$option["Model"]);
		$names_id=$this->set_name($name,true);

		$array_key=array_keys($array);
		$index=0;
		$options="";
		$values="";
		foreach($array as $a_){
			if($array_key[$index]=="id"){
				$names_id=$a_;
			}
			if($array_key[$index]=="default"){
				$default=$a_;
			}
			if($array_key[$index]=="value"){
				$default=$a_;
			}
			else
			{
				$options.=$array_key[$index].'="'.$a_.'" ';
				$index++;
			}
		}

		//option select
		$option_key=array_keys($option);
		foreach($option as $key=>$o_){
			$checked="";
			$value=$key;

			if(!@$array["value_lock"]){
				$values=$this->_post_answer($name);
			}

			if(@$values){
				if($key==$values){
					$checked='checked';
				}
			}
			else
			{
				if(@$default==$key){
					$checked="checked";
				}
				else
				{
					$checked="";
				}
			}

			$names_ids=$names_id.$key;
			$names_ids=str_replace("[","",$names_ids);
			$names_ids=str_replace("]","",$names_ids);

			$html_out.='<input type="radio" name="'.$names.'" '.$options.' id="'.$names_ids.'" value="'.$value.'" '.$checked.'>'."\n";
			$html_out.= '<label for="'.$names_ids.'">'.$o_.'</label>'.$this->_breakoff();
		}

		return $html_out;
	}
	//checkbox tag
	public function checkbox($name,$option,$array=array()){
		$html_out="";

		$names=$this->set_name($name);
		$names_id=$this->set_name($name,true);

		$html_out.='<input type="hidden" name="'.$names.'">';

		$options="";
		$values="";
		foreach($array as $key=>$a_){
			if($key=="id"){
				$names_id=$a_;
			}
			else if($key=="default"){
				$default=$a_;
			}
			else if($key=="value"){
				if(!@$this->request->post[$this->model][$name]){
					$default=$a_;
				}
			}
			else
			{
				$options.=$key.'="'.$a_.'" ';
				$index++;
			}
		}
		//option select
		foreach($option as $key=>$o_){
			$checked="";
			$value=$key;

			if(is_array(@$default)){
				foreach($default as $d_){

					if(@$d_==$key){
						$checked="checked";
						break;
					}
				}
			}
			else
			{
				if(@$default==$key){
					$checked="checked";
				}
				else
				{
					$checked="";
				}
			}

			if(isset($this->request->post[$this->model][$name])){
				if(is_array($this->request->post[$this->model][$name])){
					foreach($this->request->post[$this->model][$name] as $ttm_){
						if($ttm_==$key){
							$checked='checked';
							break;
						}
					}
				}
				else
				{
					if($this->request->post[$this->model][$name]==$key){
						$checked='checked';
					}
					else
					{
						$checked="";
					}
				}
			}

			$names_2=$names."[".$key."]";
			$names_ids=$names_id.$key;
			$names_ids=str_replace("[","",$names_ids);
			$names_ids=str_replace("]","",$names_ids);

			$html_out.='<input type="checkbox" name="'.$names_2.'" '.$options.' id="'.$names_ids.'" value="'.$value.'" '.$checked.'>'."\n";
			$html_out.='<label for="'.$names_ids.'">'.$o_.'</label>'.$this->_breakoff();
		}

		return $html_out;
	}
	//select tag
	public function select($name,$option,$array=array()){

		$html_out="";

		if($this->method=="post"){
			$names=$this->set_name($name);
		}
		else
		{
			$names=$name;
		}

		$array_key=array_keys($array);
		$options="";
		$values="";
		foreach($array as $key=>$a_){
			if($key=="default"){
				$default=$a_;
			}
			if($key=="value"){
				$default=$a_;
			}
			if($key=="empty"){
				$empty="<option value>".$a_."</option>";
			}
			else
			{
				$options.=$key.'="'.$a_.'" ';
			}
		}

		$html_out.='<select name="'.$names.'" '.$options.'>'.$this->_breakoff();
		if(@$empty){
			$html_out.=$empty;
		}
		foreach($option as $key0=>$o_){
			if(is_array($o_)){
				$html_out.= '<optgroup label="'.$key0.'">'."\n";
				foreach($o_ as $key=>$oo_){
					if(@$default==$key){
						$selected="selected";
					}
					else{
						$selected="";
					}


					if(!@$array["value_lock"]){
						$values=$this->_post_answer($name);
					}
					if(@$values){
						if($key==$values){
							$selected='selected';
						}
					}

					$html_out.= '<option value="'.$key.'" '.$selected.'>'.$oo_.'</option>'.$this->_breakoff();
				}
				$html_out.= '</optgroup>'.$this->_breakoff();
			}
			else
			{
				$selected="";
				if(@$default==$key0){
					$selected="selected";
				}

				$values=$this->_post_answer($name);

				if(@$values){
					if($key0==$values){
						$selected='selected';
					}
					else
					{
						$selected='';
					}
				}

				$html_out.= '<option value="'.$key0.'" '.$selected.'>'.$o_.'</option>'.$this->_breakoff();
			}

		//	$index++;
		}
		$html_out.= '</select>'.$this->_breakoff();

		return $html_out;
	}

	//file tag
	public function file($name,$array=array()){
		
		$names=$this->set_name($name);

		$array_key=array_keys($array);
		$index=0;
		$options="";
		$values="";
		$key=array_keys($array);
		foreach($array as $a_){
			if($key[$index]=="multiple"){
				$names.="[]";
			}
			$options.=$array_key[$index].'="'.$a_.'" ';
			$index++;
		}

		return '<input type="file" name="'.$names.'" '.$options.'>'.$this->_breakoff();
	}
	//submit tag
	public function submit($value,$array=array()){

		$array_key=array_keys($array);
		$options="";
		$values="";
		foreach($array as $key=>$a_){
			if($key=="type" && $a_=="button"){
				$button_type=true;
			}
			else
			{
				$options.=$key.'="'.$a_.'" ';
			}
		}

		if(@$button_type){
			return '<button type="button" '.$options.'>'.$value.'</button>'.$this->_breakoff();
		
		}
		else
		{
			return '<input type="submit" value="'.$value.'" '.$options.'>'.$this->_breakoff();
		}
	}
	//varidation Error
	/*
	public function error($dataname){
		if(@$this->request->post[$this->model]){
			//print_r($this);
			$models=new $this->model($this);
			$error=$models->validatecheck($this->model,$dataname,$this->request->post[$this->model][$dataname]);
			if($error){
				echo '<div class="error-message">'.$error.'</div>'.$this->_breakoff();
			}
		}
	}
	*/
}
?>
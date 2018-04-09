<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	Model
//	Model.php
//
//--------------------------------------------------

class Model extends Object{
	
	public $data;

	public $database_name="default";

	public $bindModel;

	public $sql_cache=array();

	public function __construct($data,$change_model=null){
		parent::__construct($data);

		$this->model=$change_model;

		if($this->bindModel){
			$this->_bindModel();
		}

		//Component setting
		$dcl_list=array(
			"Auth"=>true,
			"Cookie"=>true,
			"Session"=>true,
			"Encrypt"=>true,
			"Email"=>true,
			"Configload"=>true,
			"Image"=>true,
			"Filemanage"=>true,
			"Curl"=>true,
			"Zip"=>true,
			"Ftp"=>true,
			"Filemanage"=>true,
			"Ascllart"=>true,
			"Htmlscrape"=>true,
			"Modelmake"=>true,
		);
		//set component
		if(@$this->components){
			$com_key=array_keys($this->components);
			$ind=0;
			foreach($this->components as $com_){
				if(is_array($com_)){
					$com2_=$com_key[$ind];
				
					if(@$dcl_list[$com2_]){
						include_once("../lib/PHP-X/Component/".$com2_."Component.php");
					}
					else
					{
						if(file_exists("../app/Backend/Component/".$com2_."Component.php")){
							include_once("../app/Backend/Component/".$com2_."Component.php");
						}else{
							$subdir=glob_deep("../app/Backend/Component","directory");
							foreach($subdir as $key=>$s_){
								if(file_exists($s_."/".$com2_."Component.php")){
									include_once($s_."/".$com2_."Component.php");
									break;
								}
							}
						}
					}
					$componame=$com2_."Component";
					$this->{$com2_}=new $componame($this);
					$this->{$com2_}->add_data($com2_,$com_);
				}
				else
				{
					if(@$dcl_list[$com_]){
						include_once("../lib/PHP-X/Component/".$com_."Component.php");
					}
					else
					{
						if(file_exists("../app/Backend/Component/".$com_."Component.php")){
							include_once("../app/Backend/Component/".$com_."Component.php");
						}
						else
						{
							$subdir=glob_deep("../app/Backend/Component","directory");
							foreach($subdir as $key=>$s_){
								if(file_exists($s_."/".$com_."Component.php")){
									include_once($s_."/".$com_."Component.php");
									break;
								}
							}
						}
					}
					$componame=$com_."Component";
					$this->{$com_}=new $componame($this);
				}
				$ind++;
			}
		}

	}
	//validates
	public function validates($data){
		$this->data=$data;

		$this->validation_error=array();
		$model_name=array_keys($this->data);

		$allgreen=true;

		if(isset($this->validate)){
			foreach($model_name as $nm_){
	
				$array_name=array_keys($this->validate);
				$index=0;
				foreach($this->validate as $v_){
					$key=$array_name[$index];

					$check_name=array_keys($v_);
					$index_2=0;
					foreach($v_ as $vv_){
						$key2=$check_name[$index_2];

						foreach($vv_ as $vvv_){
							$data_name=@array_keys($this->data[$nm_]);

							$index_3=0;
							if(is_array(@$this->data[$nm_])){
								foreach($this->data[$nm_] as $dmn_){
									$key3=$data_name[$index_3];
										if($key2==$key3){
											$checked=$this->validation_check($dmn_,$vvv_);

											if(!$checked){
												$this->validation_error[$key][$key2]=$vvv_["message"];
												$allgreen=false;
											}
										}
									$index_3++;
								}
							}
						}

						$index_2++;
					}

					$index++;
				}
			}

			return @$this->validation_error;
		}
		else
		{
			return false;
		}
	}
	private function validation_check($value,$params){

		$checkname=$params["rule"][0];

		//notBlank
		if($checkname=="notBlank"){
			if($value==""){
				return false;
			}
		}
		//numberSingle
		else if($checkname=="numberSingle"){

			//number and string list
			$trueword="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-=+*/()[]{}:;$#.,@|";
			$check=$value;

			//accept word delete
			for($cs1=0;$cs1<strlen($trueword);$cs1++){
				$check=str_replace($trueword[$cs1],"",$check);
			}

			if($check){
				return false;
			}
		}
		//number
		else if($checkname=="number"){

			//accept number
			$trueword="0123456789";
			$check=$value;

			//accpet word delete
			for($cs1=0;$cs1<strlen($trueword);$cs1++){
				$check=str_replace($trueword[$cs1],"",$check);
			}

			if($check){
				return false;
			}
		}
		//maxLength
		else if($checkname=="maxLength"){
			$prm=$params["rule"][1];
			if(!$value){
				return true;
			}

			$vallen=mb_strlen($value);

			if($vallen>$prm){
				return false;
			}
		}
		//minLength
		else if($checkname=="minLength"){
			$prm=$params["rule"][1];
			if(!$value){
				return true;
			}

			$vallen=mb_strlen($value);
			if($vallen<$prm){
				return false;
			}
		}
		//maxValue
		else if($checkname=="maxValue"){
			//max Value
			$prm=$params["rule"][1];
			if(!$value){
				return true;
			}

			$vallen=intval($value);

			if($vallen>$prm){
				return false;
			}
		}
		//minValue
		else if($checkname=="minValue"){
			//min Value
			$prm=$params["rule"][1];
			if(!$value){
				return true;
			}

			$vallen=intval($value);

			if($vallen<$prm){
				return false;
			}
		}
		//equal
		else if($checkname=="equal"){
			//equal value(2017/4/5)
			$target=$params["rule"][1];
			if(!$value){
				return true;
			}

			if($value!=$target){
				return false;
			}
		}
		//like
		else if($checkname=="like"){
			//like value(2017/4/5)
			$target=$params["rule"][1];
			if(!$value){
				return true;
			}

			$values="--".$value."--";

			$jmt=strpos($values,$target);
				
			if(!$jmt){
				return $false;
			}
		}
		else
		{
			return $this->$checkname($this->data);
		}

		return true;
	}

	private function _mysqli_setting(){
		if(!@$this->mysqli){
			$this->mysqli = new mysqli(
				$this->database[$this->database_name]["host"],
				$this->database[$this->database_name]["username"], 
				$this->database[$this->database_name]["password"],
				$this->database[$this->database_name]["database"]
			);
			$this->mysqli->set_charset($this->database[$this->database_name]["encoding"]);
		}
	}
	//db setting refresh...
	public function refresh(){
		if(@$this->mysqli){
			$this->mysqli->close();

			$this->mysqli = new mysqli(
				$this->database[$this->database_name]["host"],
				$this->database[$this->database_name]["username"], 
				$this->database[$this->database_name]["password"],
				$this->database[$this->database_name]["database"]
			);
			$this->mysqli->set_charset($this->database[$this->database_name]["encoding"]);
		}
	}
	//rollback setting
	private function _rollback_setting($data){
		if(@$data[$this->model]["id"]){
			$this->rollback_data=$this->find("first",array(
				"conditions"=>array(
					$this->model.".id"=>$data[$this->model]["id"],
				),
			));
		}
		else
		{
			$this->rollback_data=array();
		}
	}
	//database recode save
	public function save($data,$params=array()){
		if(@$params["model"]){
			$this->model=$params["model"];
		}


		if(@$params["backup"]){
			$this->backup=$this->find("first",array(
				"conditions"=>array(
					$this->model.".id"=>$data[$this->model]["id"],
				),
			));
		}

		$data=$this->beforeSave($data);
		$this->_mysqli_setting();

		if($this->mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		}else{

			$this->_rollback_setting($data);

			//table colum check
			$str="SHOW COLUMNS FROM ".$this->model;
			$result=$this->mysqli->query($str);
			if(@$this->mysqli->error){
				echo "Error:".$this->mysqli->error;
			}
			$columlist=array();
			$columtype=array();
			while($row=$result->fetch_array(MYSQLI_ASSOC)){
				$columlist[]=$row["Field"];
				$columtype[]=$row["Type"];
			}
			//Sql parameter
			if(@$data[$this->model]["id"]){
				//if existe .UPDATE
				$data_key=array_keys($data[$this->model]);
				$input_str="";
				$ind=0;
				foreach($data[$this->model] as $d_){
					foreach($columlist as $c_ind=>$c_){
						if($c_==$data_key[$ind]){
							if($input_str){
								$input_str.=", ";
							}
							$d_=$this->mysqli->real_escape_string($d_);
							if($d_){
								$input_str.=$data_key[$ind]."='".$d_."'";
							}
							else
							{
								if(strpos($columtype[$c_ind],"int")!==false){
									$input_str.=$data_key[$ind]."=NULL";
								}
								else
								{
									$input_str.=$data_key[$ind]."=''";
								}
							}


						}
					}
					$ind++;
				}

				$sql_str='UPDATE '.$this->model.' SET '.$input_str.' WHERE id='.$data[$this->model]["id"];
				$result=$this->mysqli->query($sql_str);
				if(@$this->mysqli->error){
					echo "<p>ERROR:".$this->mysqli->error."</p>";
				}

				$nid=$data[$this->model]["id"];
			}
			else
			{
				//if nothing. INSERT
				unset($data[$this->model]["id"]);
				$data_key=array_keys($data[$this->model]);
				$input_key="";
				$input_value="";
				$ind=0;
				foreach($data[$this->model] as $d_){
					foreach($columlist as $c_ind=>$c_){
						if($c_==$data_key[$ind]){
							if($input_value){
								$input_key.=",";
								$input_value.=",";
							}
							$input_key.=$data_key[$ind];
							$d_=$this->mysqli->real_escape_string($d_);

							if($d_){
								$input_value.="'".$d_."'";
							}
							else
							{
								if(strpos($columtype[$c_ind],"int")!==false){
									$input_value.="NULL";
								}
								else
								{
									$input_value.="''";
								}
							}
						}
					}
					$ind++;
				}
				$sql_str="INSERT INTO ".$this->model." (".$input_key.") VALUES (".$input_value.")";

				$result=$this->mysqli->query($sql_str);
				if(@$this->mysqli->error){
					echo "<p>ERROR:".$this->mysqli->error."</p>";
				}

				$nid=$this->mysqli->insert_id;
			}
			//record data loading
			$sql_str="SELECT * FROM ".$this->model." WHERE id='".$nid."'";
			if($this->mysqli->query($sql_str)->fetch_array(MYSQLI_ASSOC)){
				$output[$this->model]=$this->mysqli->query($sql_str)->fetch_array(MYSQLI_ASSOC);
			}

			if(!@$params["throw_aftersave"]){
				$output=$this->afterSave($output);
			}

			return $output;
		}

	}
	//database delete
	public function delete($id){
		if(!@$this->model){
			$this->model=get_Class($this);
		}

		$this->_mysqli_setting();

		if($this->mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		}else{

			$sql_str="DELETE FROM ".$this->model." WHERE id = '".$id."';";

			return $this->mysqli->query($sql_str);
		}
	}
	//database delete(colum name)
	public function delete_colum($colum){
		if(!@$this->model){
			$this->model=get_Class($this);
		}

		$this->_mysqli_setting();
		if($this->mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		}else{

			$columname=key($colum);
			$columvalue=$colum[$columname];

			$sql_str="DELETE FROM ".$this->model." WHERE ".$columname." = '".$columvalue."';";
			return $this->mysqli->query($sql_str);

		}
	}
	//database delete all
	public function delete_all($ignore_id=null){

		$id_list=$this->find("list",array(
			"fields"=>array("id","id"),
		));

		if(@$ignore_id){
			if(is_array($ignore_id)){
				foreach($ignore_id as $i_){
					unset($id_list[$i_]);
				}
			}
			else
			{
				unset($id_list[$ignore_id]);
			}
		}

		$jugement=true;
		foreach($id_list as $i_){
			$buff=$this->delete($i_);
			if(!$buff){
				$jugement=false;
				break;
			}
		}

		return $jugement;
	}
	//reset PrimaryKey AutoIncromenty
	public function reset_primary_key(){
		
		$this->_mysqli_setting();
		if($this->mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		}else{
			$sql_str="ALTER TABLE ".$this->model." AUTO_INCREMENT = 1;";
			return $this->mysqli->query($sql_str);
		}
	}
	//rollback
	public function rollback(){
		$rollback_data=$this->rollback_data;

		$this->save($rollback_data);


	}
	//beforeSave
	public function beforeSave($data){
		return $data;
	}
	//afterSave
	public function afterSave($data){
		return $data;
	}
	//afterfind
	public function afterfind($data){
		return $data;
	}

	//(2017 6/2) transaction
	public function transam($mode=null){
		if($mode){
			if($mode=="begin"){
				unset($this->mysqli);
				$this->_mysqli_setting();
				$this->mysqli->query("BEGIN;");
			}
			else if($mode=="commit"){
				$this->mysqli->query("COMMIT;");
			}
			else if($mode=="rollback"){
				$this->mysqli->query("ROLLBACK;");
			}
		}
	}

	//database record load
	public function find($type,$option=array()){
		$start_tick=microtime(true);

		if(@$option["Model"]){
			$this->model=$option["Model"];
		}

		if(!@$option["model_visible"]){
			$option["model_visible"]=false;
		}

		//sql code make
		$sql_str=$this->create_query($type,$option);

		//sql cache existed return cache data.
//		if(@$this->sql_cache[$this->model][$sql_str]){
//			$this->sql_ticktime=(microtime(true)-$start_tick)*1000;
//			return $this->sql_cache[$this->model][$sql_str];
//		}

		$listdata=array();

		$this->_mysqli_setting();

		if($this->mysqli->connect_error) {
			echo "ERROR:".$this->mysqli->connect_error;
			if(@$this->mysqli->connect_error=="No such file or directory"){
				echo "<p>Nothing MySQL Server...?</p>";
			}
			exit();
		}else{

			if($type=="all"){
				$result=$this->mysqli->query($sql_str);
				if(@$this->mysqli->error){
					echo "ERROR:".$this->mysqli->error;
				}
				if(@$result){
					while($row=$result->fetch_array(MYSQLI_ASSOC)){
						$buff=array();
						if(!@$option["model_invisible"]){
							$buff[$this->model]=$row;
						}
						else
						{
							$buff=$row;
						}
						//Model Associate
						if(@$this->bindModel){
							$buff_ac=$this->_assoc($this->bindModel,$row,$this->model);
							if($buff_ac){
								$buff=array_merge($buff,$buff_ac);
							}
						}
						$listdata[]=$buff;
					}
				}

			}
			else if($type=="first")
			{
				if(@$this->mysqli->query($sql_str)){
					$result=$this->mysqli->query($sql_str)->fetch_array(MYSQLI_ASSOC);
					if(@$this->mysqli->error){
						echo "ERROR:".$this->mysqli->error;
					}
					if($result){
						$buff[$this->model]=$result;

						//Model Associate
						if(@$this->bindModel){
							$buff_ac=$this->_assoc($this->bindModel,$result,$this->model);
							if($buff_ac){
								$buff=array_merge($buff,$buff_ac);
							}
						}
						$listdata=$buff;
					}
				}
			}
			else if($type=="list"){
				$result=$this->mysqli->query($sql_str);
				if(@$this->mysqli->error){
					echo "ERROR:".$this->mysqli->error;
				}
				while($row=$result->fetch_array(MYSQLI_ASSOC)){
					$key_1=key($row);
					next($row);
					$key_2=key($row);
					if(!@$key_2){ $key_2=$key_1; }
					$listdata[$row[$key_1]]=$row[$key_2];
				}
			}
			else if($type=="count"){
				$result=$this->mysqli->query($sql_str)->fetch_array(MYSQLI_ASSOC);
				if(@$this->mysqli->error){
					echo "ERROR:".$this->mysqli->error;
				}
				$listdata=$result["COUNT(*)"];
			}


			$this->sql_cache[$this->model][$sql_str]=$listdata;

			$listdata=$this->afterfind($listdata,$type);

			$this->sql_ticktime=(microtime(true)-$start_tick)*1000;

			return $listdata;
		}

	}
	public function pager($option=array()){
		$totalcount=$this->find("count",array(
			"conditions"=>@$option["conditions"],
		));

		$totalpage=ceil($totalcount/$option["limit"]);

		$output=array(
			"page"=>$option["page"],
			"limit"=>$option["limit"],
			"totalcount"=>$totalcount,
			"totalpage"=>$totalpage,
		);

		return $output;
	}

	//find createquery
	public function create_query($type,$option){
		unset($option["model_visible"]);

		if(@$option["Model"]){
			$this->model=$option["Model"];
		}

		//where
		if(@$option["conditions"]){
			$where=" WHERE ";
			$ind=0;
			if(is_array($option["conditions"])){
				foreach($option["conditions"] as $key=>$ow_){
					if($key=="OR" || $key=="AND"){
						$array_str="";
						$ind2=0;
						if(@$ow_){
							foreach($ow_ as $key2=>$owa_){
								if($ind2!=0){
									$array_str.=" ".$key." ";
								}
								if(strpos($key2," LIKE")){
									$array_str.=$key2." '".$owa_."'";
								}
								else
								{
									if($owa_){
										$array_str.=$key2."='".$owa_."'";
									}
									else
									{
										if(is_null($owa_)){
											$array_str.=$key2." IS NULL";
										}
										else
										{
											if($owa_==""){
												$array_str.=$key2."=''";
											}
											else
											{
												$array_str.=$key2."=0";
											}
										}
									}

								}
								$ind2++;
							}
						}
						$where.=$array_str;
						$ind++;
					}
					else if($key!="model_invisible"){
						if(is_array($ow_)){
							$array_str="";
							$ind2=0;
							foreach($ow_ as $key2=>$owa_){
								if($ind2!=0){
									$array_str.=",";
								}

								if(strpos($key2," LIKE")){
									$array_str.=$key2." '".$owa_."'";
								}
								else
								{
									if($key2==$owa_){
										$array_str.="'".$owa_."'";
									}
									else
									{
										if($owa_){
											$array_str.=$key2."='".$owa_."'";
										}
										else
										{
											if(is_null($owa_)){
												$array_str.=$key2." IS NULL";
											}
											else
											{
												if($owa_==""){
													$array_str.=$key2."=''";
												}
												else
												{
													$array_str.=$key2."=0";
												}
											}
										}

									}
								}
								$ind2++;
							}
							if($ind!=0){
								$where.=" OR ";
							}
							$where.=$key." IN (".$array_str.")";
						}
						else
						{
							if($ind!=0){
								$where.=" AND ";
							}
							if(strpos($key," LIKE")){
								$where.=$key." '".$ow_."'";
							}
							else
							{

								if($ow_){
									$where.=$key."='".$ow_."'";
								}
								else
								{
									if(is_null($ow_)){
										$where.=$key." IS NULL";
									}
									else
									{
										if($ow_==""){
											$where.=$key."=''";
										}
										else
										{
											$where.=$key."=0";
										}
									}
								}

							}
						}
						$ind++;
					}
				}
			}
			else
			{
				$where.=$option["conditions"];
			}

		}

		//where (direct sql code.) 
		if(@$option["where"]){
			$where=$option["where"];
		}

		//page and limit
		if(@$option["limit"] && @$option["page"]){
			$limit=" limit ".($option["page"]-1)*$option["limit"].",".$option["limit"];
		}
		else
		{
			if(@$option["limit"]){
				$limit=" limit 0,".$option["limit"];
			}
		}

		//fields
		$fields="*";
		if(@$option["fields"]){
			if(count($option["fields"])){
				$fields="";
				$ind=0;
				foreach($option["fields"] as $fs_){
					if($ind!=0){
						$fields.=",";
					}
					$fields.=$fs_;
					$ind++;
				}
			}
		}

		//order
		if(@$option["order"]){
			$orderby=" ORDER BY ";
			$orderbuff="";
			if(is_array($option["order"])){
				foreach($option["order"] as $key=>$o_){
					if($key!=0){
						$orderbuff.=",";
					}
					$orderbuff.=$o_;
				}
			}
			else
			{
				$orderbuff.=$option["order"];
			}
			if($orderbuff){
				$orderby.=$orderbuff;
			}
			else
			{
				unset($orderby);
			}

		}

		if($type=="all"){
			$sql_str="SELECT ".$fields." FROM ".$this->model.@$where.@$orderby.@$limit.@$alter;
		}
		else if($type=="first"){
			$sql_str="SELECT ".$fields." FROM ".$this->model.@$where.@$alter;
		}
		else if($type=="list"){
			$sql_str="SELECT ".$fields." FROM ".$this->model.@$where.@$orderby.@$limit;
		}
		else if($type=="count"){
			$sql_str="SELECT COUNT(*) FROM ".$this->model.@$where.@$limit;
		}
//debug($sql_str);
		return $sql_str;
		
	}
	//bindModel
	public function bindModel($array){
		$this->bindModel=$array;
		$this->_bindModel();
	}
	private function _bindModel(){
		if(@$this->bindModel["belongsTo"]){
			foreach($this->bindModel["belongsTo"] as $key=>$keys){
				if(is_array($keys)){
					if(@$keys["className"]){
						@include_once("../app/Backend/Model/".$keys["className"].".php");
						$this->$keys["className"]=new $keys["className"]($this,$keys["className"]);
					}
					else
					{
						@include_once("../app/Backend/Model/".$key.".php");
						$this->$key=new $key($this,$key);
					}
				}
				else{
					@include_once("../app/Backend/Model/".$keys.".php");
					$this->$keys=new $keys($this,$keys);
				}
			}
		}
		if(@$this->bindModel["hasMany"]){
			foreach($this->bindModel["hasMany"] as $key=>$keys){
				if(is_array($keys)){
					if(@$keys["className"]){
						@include_once("../app/Backend/Model/".$keys["className"].".php");
						$this->$keys["className"]=new $keys["className"]($this,$keys["className"]);
					}
					else
					{
						@include_once("../app/Backend/Model/".$key.".php");
						$this->$key=new $key($this,$key);
					}
				}
				else{
					@include_once("../app/Backend/Model/".$keys.".php");
					$this->$keys=new $keys($this,$keys);
				}
			}
		}
		if(@$this->bindModel["hasOne"]){
			foreach($this->bindModel["hasOne"] as $key=>$keys){
				if(is_array($keys)){
					if(@$keys["className"]){
						@include_once("../app/Backend/Model/".$keys["className"].".php");
						$this->$keys["className"]=new $keys["className"]($this,$keys["className"]);
					}
					else
					{
						@include_once("../app/Backend/Model/".$key.".php");
						$this->$key=new $key($this,$key);
					}
				}
				else{
					@include_once("../app/Backend/Model/".$keys.".php");
					$this->$keys=new $keys($this,$keys);
				}
			}
		}
	}
	//associate 
	private function _assoc($bindmodel,$input,$model){
		$output=array();
		if(@$bindmodel["belongsTo"]){
			foreach($this->bindModel["belongsTo"] as $key=>$tbb_){
				if(is_array($tbb_)){
					$assoc_model=$key;
					$option=$tbb_;
				}
				else
				{
					$assoc_model=$tbb_;
					$option=array();

				}
				if(!@$option["className"]){
					$option["className"]=$assoc_model;
				}

				if(!@$option["foreignKey"]){
					$option["foreignKey"]=mb_strtolower($assoc_model)."_id";
				}
				if(@$input[$option["foreignKey"]]){
					$option["conditions"][$option["className"].".id"]=@$input[$option["foreignKey"]];
					
					$option["Model"]=$option["className"];

					$buff=$this->$option["Model"]->find("first",$option);
					if($option["Model"]!=$assoc_model){
						$buff[$assoc_model]=@$buff[$option["Model"]];
						unset($buff[$option["Model"]]);
					}

					$output=array_merge($output,$buff);
				}
			}
		}
		if(@$bindmodel["hasMany"]){

			foreach($this->bindModel["hasMany"] as $key=>$tbb_){

				if(is_array($tbb_)){
					$before_model=$this->model;
					$this->model=$key;
					$option=$tbb_;
				}
				else
				{
					$before_model=$this->model;
					$this->model=$tbb_;
					$option=array();
				}

				if(!@$option["className"]){
					$option["className"]=$this->model;
				}

				if(!@$option["foreignKey"]){
					$option["foreignKey"]=mb_strtolower($before_model)."_id";
				}


				$option["Model"]=$option["className"];
				$option["conditions"][$option["className"].".".$option["foreignKey"]]=$input["id"];
				$option["model_invisible"]=true;

				$buff=$this->$option["Model"]->find("all",$option);
				if($buff){
					$output[$this->model]=@$buff;
				}
				$this->model=$before_model;
			}
		}
		if(@$bindmodel["hasOne"]){

			foreach($this->bindModel["hasOne"] as $key=>$tbb_){
				if(is_array($tbb_)){
					$before_model=$this->model;
					$this->model=$key;
					$option=$tbb_;
				}
				else
				{
					$before_model=$this->model;
					$this->model=$tbb_;
					$option=array();
				}

				if(!@$option["className"]){
					$option["className"]=$this->model;
				}

				if(!@$option["foreignKey"]){
					$option["foreignKey"]=mb_strtolower($before_model)."_id";
				}


				$option["Model"]=$option["className"];
				$option["conditions"][$option["className"].".".$option["foreignKey"]]=$input["id"];
				$option["model_visible"]=true;

				$buff=$this->$option["Model"]->find("first",$option);
				if(@$buff){
					if($this->model==key($buff)){
						$output[$this->model]=@$buff[$this->model];
					}
					else
					{
						$output[$this->model]=@$buff[$option["className"]];
					}

				}
				$this->model=$before_model;
			}
		}

		return $output;
	}
	//associate
	public function associate($array){
		$this->associate=$array;
	}
	public function assoc_find($type,$option=array(),$first_model=null,$assoc=null,$modelview=true){

		if(!$first_model){
			$first_model=get_Class($this);
			$assoc=@$this->associate;
		}
		else
		{
			if(!@$this->$first_model){
				include_once("../app/Backend/Model/".$first_model.".php");
				$this->$first_model=new $first_model($this,$first_model);
			}
		}

		$option["Model"]=$first_model;

		if(get_Class($this)==$first_model){

			$buff=$this->find($type,$option,$modelview);
		}
		else
		{
			$buff=$this->$first_model->find($type,$option,$modelview);
		}

		if($type=="first"){
			if(@$assoc["belongsTo"]){
				foreach($assoc["belongsTo"] as $key_2=>$aa_){
					$model=$aa_["model"];
					if(@$buff[$first_model][mb_strtolower($model)."_id"]){
						unset($aa_["model"]);
						$sub_option=$aa_;
						
						$sub_option["conditions"][$model.".id"]=@$buff[$first_model][mb_strtolower($model)."_id"];

						$buff_2=$this->assoc_find("first",$sub_option,$model,$aa_);
				
						if(@$buff_2){
							$buff[$first_model][$model]=@$buff_2[$model];
						}
					}
				}
			}
			if(@$assoc["hasMany"]){
				foreach($assoc["hasMany"] as $key_2=>$aa_){
					if(@$buff[$first_model]["id"]){
						$model=$aa_["model"];

						unset($aa_["model"]);
						$sub_option=$aa_;

						$sub_option["conditions"][$model.".".mb_strtolower($first_model)."_id"]=@$buff[$first_model]["id"];
						$sub_option["conditions"]["model_invisible"]=true;

						$buff_2=$this->assoc_find("all",$sub_option,$model,$aa_);
					
						if(@$buff_2){
							$buff[$first_model][$model]=@$buff_2;
						}
					}
				}
			}
			if(@$assoc["hasOne"]){
				foreach($assoc["hasOne"] as $key_2=>$aa_){
					if(@$buff[$first_model]["id"]){

						$model=$aa_["model"];

						unset($aa_["model"]);
						$sub_option=$aa_;

						$sub_option["conditions"][$model.".".mb_strtolower($first_model)."_id"]=@$buff[$first_model]["id"];
						$sub_option["conditions"]["model_invisible"]=true;
						
					
						$buff_2=$this->assoc_find("first",$sub_option,$model,$aa_);
					
						if(@$buff_2){
							$buff[$first_model][$model]=@$buff_2;
						}
					}
				}
			}
		}
		else if($type="all"){
			foreach($buff as $key0=>$b_){
				if(@$assoc["belongsTo"]){
					foreach($assoc["belongsTo"] as $key_2=>$aa_){
						$model=$aa_["model"];

						if(@$b_[$first_model][mb_strtolower($model)."_id"]){

							unset($aa_["model"]);
							$sub_option=$aa_;

							$sub_option["conditions"][$model.".id"]=@$b_[$first_model][mb_strtolower($model)."_id"];

							$buff_2=$this->assoc_find("first",$sub_option,$model,$aa_);
						

							if(@$buff_2){
								$b_[$first_model][$model]=@$buff_2[$model];
								$buff[$key0]=$b_;
							}
						}
					}
				}
				if(@$assoc["hasMany"]){
					foreach($assoc["hasMany"] as $key_2=>$aa_){
						if(@$b_["id"] || @$b_[$first_model]["id"]){
							$model=$aa_["model"];

							unset($aa_["model"]);
							$sub_option=$aa_;

							if($modelview){
								$sub_option["conditions"][$model.".".mb_strtolower($first_model)."_id"]=@$b_["id"];
								$sub_option["conditions"]["model_invisible"]=true;
							}
							else
							{
								$sub_option["conditions"][$model.".".mb_strtolower($first_model)."_id"]=@$b_[$first_model]["id"];
								$sub_option["conditions"]["model_invisible"]=true;
							}

						
							$buff_2=$this->assoc_find("all",$sub_option,$model,$aa_);
						
							if(@$buff_2){
								$b_[$model]=@$buff_2;
								$buff[$key0]=$b_;
							}
						}
					}
				}
				if(@$assoc["hasOne"]){

					foreach($assoc["hasOne"] as $key_2=>$aa_){
						if(@$b_["id"] || @$b_[$first_model]["id"]){
							$model=$aa_["model"];

							unset($aa_["model"]);
							$sub_option=$aa_;

							if($modelview){
								$sub_option["conditions"][$model.".".mb_strtolower($first_model)."_id"]=@$b_["id"];
								$sub_option["conditions"]["model_invisible"]=true;
							}
							else
							{
								$sub_option["conditions"][$model.".".mb_strtolower($first_model)."_id"]=@$b_[$first_model]["id"];
								$sub_option["conditions"]["model_invisible"]=true;
							}
						
							$buff_2=$this->assoc_find("first",$sub_option,$model,$aa_);
						
							if(@$buff_2){
								$b_[$model]=@$buff_2;
								$buff[$key0]=$b_;
							}
						}
					}
				}
			}
		}

		if(@$first_model && get_Class($this)!=$first_model){
			$this->sql_cache=array_merge($this->sql_cache,$this->$first_model->sql_cache);
		}

		return $buff;
	}
	//sql request list
	public function sql_list(){
		$sql_list=array();
		foreach($this->sql_cache as $model=>$tc_){
			$sql_list[$model]=array_keys($tc_);
		}
		return $sql_list;
	}
	//recode copy
	public function copy($before_id){
		if(!@$this->model){
			$this->model=get_Class($this);
		}

		$this->_mysqli_setting();

		if($this->mysqli->connect_error) {
			echo $mysqli->connect_error;
			exit();
		}else{
			$copydata=$this->find("first",array(
				"conditions"=>array(
					$this->model.".id"=>$before_id,
				),
			));
			$copydata[$this->model]["id"]="";
			$result=$this->save($copydata);

			return $result;
		}
	}
	//colum add
	public function columadd($colum,$primarykey,$addvalue=0){
		if(!@$this->model){
			$this->model=get_Class($this);
		}

		$find=$this->find("first",array(
			"conditions"=>array(
				$this->model.".id"=>$primarykey,
			),
			"fields"=>array("id",$colum),
		));

		$find[$this->model][$colum]+=$addvalue;

		$this->save($find);

		return true;
	}
	//multi validates
	public function multivalidates($data){
		if(!@$this->model){
			$this->model=get_Class($this);
		}

		$errors=array();
		foreach($data as $key=>$po_){
			$setval=array($this->model=>$po_);
			if($this->validates($setval)){
				$errors[$this->model][$key]=$this->validates($setval)[$this->model];
			}
		}

		return $errors;
	}
}

?>
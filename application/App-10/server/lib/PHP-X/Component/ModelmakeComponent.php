<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/03/14
//
//	ModelmakeComponent
//	ModelmakeComponent.php
//
//--------------------------------------------------
class ModelmakeComponent extends Component{

	public $database;
	public $database_name="default";

	public $error;


	public function create_sql($params){
		
		//database create
		$output=$this->make_database($params,1);

		if(@$params["database"]){
			$output.="use ".$params["database"].";\n\n";
		}
		//create table
		$output.=$this->create_table($params,1);

		return $output;

	}
	public function make($params){
		//database create
		$output=$this->make_database($params);

		//create table
		$output.=$this->create_table($params);

		return true;
	}
	public function make_database($params,$mode=0){

		//mode 0:model make、1:sql query only

		$dbm_local=new mysqli(
			$this->database[$this->database_name]["host"],
			$this->database[$this->database_name]["username"], 
			$this->database[$this->database_name]["password"]
		);

		if(!@$params["encoding"]){
			$params["encoding"]="utf8";
		}
		$query="create database ".$params["database"]." DEFAULT CHARACTER SET '".$params["encoding"]."';\n\n";

		if($mode==0){
			if ($dbm_local->query($query)===TRUE) {
				$dbm_local->close();
				return $query;
			} else {
				$this->error["database"]=$dbm_local->error;;
				$dbm_local->close();
				return false;
			}
		}
		else
		{
			return $query;
		}
	}
	public function create_table($params,$mode=0){

		//mode 0:model make、1:sql query only

		$allquery="";

		foreach($params["table"] as $table_name=>$p_){
			$query="create table ".$table_name ." (";

			$ind=0;
			foreach($p_["colum"] as $sec_name=>$pp_){
				if(!$pp_["type"]){
					$pp_["type"]="varchar";
				}
				else
				{
					if($pp_["type"]=="integer" || $pp_["type"]=="INTEGER"){
						$pp_["type"]="int";
					}
				}
				if(@$pp_["length"]){
					$length="(".$pp_["length"].")";
				}
				else
				{
					$length="";
				}
				$sub_query=$sec_name." ".$pp_["type"].$length;

				if(@$pp_["not_null"]){
					$sub_query.=" NOT NULL";
				}

				if(@$pp_["default"]){
					$sub_query.=" DEFAULT '".$pp_["default"]."'";
				}
				else
				{
					if(isset($pp_["default"])){
						$sub_query.=" DEFAULT 0";
					}
					else
					{
						$sub_query.=" DEFAULT NULL";
					}
				}
				if(@$pp_["auto_increment"]){
					$sub_query.=" AUTO_INCREMENT";
				}


				if(@$pp_["name"]){
					if(@$pp_["comment"]){
						@$pp_["comment"]=$pp_["name"].":\n".@$pp_["comment"];
					}
					else
					{
						@$pp_["comment"]=$pp_["name"];
					}
				}
				if(@$pp_["comment"]){
					$sub_query.=" COMMENT '".$pp_["comment"].":'";
				}
				if(@$pp_["primary_key"]){
					$primary_key=$sec_name;
				}
				$sub_query.=",";
				$query.="\n".$sub_query;
				$ind++;
			}
			$query.="\nPRIMARY KEY (".$primary_key.")";
			$query.=")";

			if(@$p_["comment"]){
				$query.=" COMMENT='".$p_["comment"].":'";
			}
			if(@$p_["encoding"]){
				$query.=" DEFAULT CHARSET=".$p_["encoding"];
			}
			else
			{
				$query.=" DEFAULT CHARSET=".$params["encoding"];
			}

			if($mode==0){

				$dbm_local=new mysqli(
					$this->database[$this->database_name]["host"],
					$this->database[$this->database_name]["username"], 
					$this->database[$this->database_name]["password"],
					$params["database"]
				);
				$dbm_local->set_charset($this->database[$this->database_name]["encoding"]);

				if($dbm_local->query($query)===true){
					
				}
				else
				{
					$this->error["table"][$table_name]=$dbm_local->error;
				}
			}
			else if($mode==1){
				$comment_out="# create table ".$table_name."\n\n";
				$allquery.=$comment_out.$query.";\n\n";
			}
		}
		
		if($mode==1){
			return $allquery;
		}
	}

	public function dump($database){
		$dbm_local=new mysqli(
			$this->database[$this->database_name]["host"],
			$this->database[$this->database_name]["username"], 
			$this->database[$this->database_name]["password"],
			$database
		);
		$sql="SHOW TABLES FROM ".$database;
		$result=$dbm_local->query($sql);
		$table_list=array();
		while($row=$result->fetch_row()){
			$table_list[]=$row[0];
		}
		debug($table_list);

		foreach($table_list as $t_){
			$sql="SHOW COLUMNS FROM ".$t_;
			$buff=$dbm_local->query($sql);
			while($row=$buff->fetch_row()){
				debug($row);
			}
		}

	}
}
?>
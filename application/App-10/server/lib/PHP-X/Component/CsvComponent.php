<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/04/30
//
//	CsvComponent
//	CsvComponent.php
//
//--------------------------------------------------
class CsvComponent extends Component{

	public $config;

	public $components=array(
		"Curl",
	);

	//constructer
	public function __construct($data){
		parent::__construct($data);

	}
	//csv import
	public function import($filename,$option=array()){

		/// ## filename:csv file path
		/// ## colum: csv colum list
		/// ## option: option parameter..

		if(!@$option["encoding"]){
			$option["encoding"]="UTF-8";
		}
		$file = new SplFileObject($filename); 
		$file->setFlags(SplFileObject::READ_CSV);
		$output=array();
		$colum=array();
		$ind=0;
		while (!$file->eof()) {
			if($ind==0){
				foreach($file->fgetcsv() as $key=>$f_){
					$f_=mb_convert_encoding($f_,"UTF-8",$option["encoding"]);
					if($f_){
						$colum[]=$f_;
					}
					else
					{
						$colum[]=$key;
					}
				}
			}
			else
			{
				foreach($file->fgetcsv() as $key=>$f_){
					if($f_){		
						$f_=mb_convert_encoding($f_,"UTF-8",$option["encoding"]);
						$output[$ind-1][$colum[$key]]=$f_;
					}
				}
			}
			$ind++;
		}
		return $output;
	}
	//csv file export...
	public function export($filepath,$param,$option=array()){

		$str="";
		$colum_list=array_keys($param[0]);
		foreach($colum_list as $c_){
			if(@$option["quotes"]){
				$str.='"'.$c_.'",';
			}
			else
			{
				$str.=$c_.",";
			}
		}
		$str.="\n";
		foreach($param as $p_){
			foreach($p_ as $key=>$pp_){
				if(@$option["quotes"]){
					$str.='"'.$pp_.'",';
				}
				else
				{
					$str.=$pp_.",";
				}
			}
			$str.="\n";
		}

		if(!@$option["encoding"]){
			$option["encoding"]="UTF-8";
		}
		$str=mb_convert_encoding($str,$option["encoding"],"UTF-8");
		file_put_contents($filepath,$str);

		return true;
	}
}
?>
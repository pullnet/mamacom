<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	ZipComponent
//	ZipComponent.php
//
//--------------------------------------------------
class ZipComponent extends Component{

	public $config;

	//constructer
	public function __construct($data){
		parent::__construct($data);

		include("../app/Backend/Config/zip.php");
		$this->config=@$zip["default"];

	}
	//config change
	public function set_config($name){
		$this->config=@$zip[$name];
	}
	//config manual setting
	public function manual_setting($array){
		$this->config=$array;
	}
	//zip create
	public function create($inputfile,$output_path){
		$zip=new ZipArchive();
		$res=$zip->open($output_path, ZipArchive::CREATE);
		if($res === true){
			if(is_array($inputfile)){
				foreach($inputfile as $i_){
					if(is_dir($i_)){
                				$zip->addEmptyDir($localpath);
					}
					else
					{
						$zip->addFile($i_);
					}
				}
			}
			else
			{
				$zip->addFile($inputfile);
			}
			$zip->close();
		}
	}
	//open
	public function open(){

	}
}
?>
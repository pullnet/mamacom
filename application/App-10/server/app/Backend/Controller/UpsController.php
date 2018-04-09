<?php
//-----------------------------------------------------------------------------
//
//	2017.09.01
//	Masato Nakatsuji
//
//	UpsController
//
//-----------------------------------------------------------------------------

class UpsController extends Controller{

	public $layout=false;
	public $autoRender=false;

	public $components=array(
		"RestAPI",
		"Image",
	);

	public function beforeFilter(){
		parent::beforeFilter();

		header("Access-Control-Allow-Origin:*");
		if(!@$this->RestAPI->check_accessToken("private")){
			echo JSON_ENC($this->RestAPI->error);
			exit;
		}

		//認証OKならば、POSTからトークン消す
		unset($_POST["access_token"]);
	}
	// ファイルバッファ準備
	public function fileup_buffer($maxwidth=1500){
		if(@$_FILES){

			$folder="buffer/".phpx_date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);

			$image_tag=hash("sha256",$_FILES["file"]["tmp_name"].phpx_date("YmdHis"));

			$params=array(
				"maxWidth"=>$maxwidth,
			);

			$this->Image->image_resize($_FILES["file"]["tmp_name"],$folder."/".$image_tag,$params);

			$output=array(
				"path"=>$this->params["root"]."wdata/".$folder."/".$image_tag,
				"tag"=>$image_tag,
				"uniqId"=>phpx_date("YmdHis"),
			);
			echo json_encode($output);
		}
	}
	// ファイルバッファ決定
	public function fileup($trim=false){
		if(@$_POST){

			$image_tag=hash("sha256",$_POST["buffer"].phpx_date("YmdHis"));

			$folder="buffer/".phpx_date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);

			if($trim){

				$mdata=getimagesize($_POST["buffer"]);
				$source_width=$mdata[0];
				$source_height=$mdata[1];

				//zoom
				$zoom=$_POST["zoom"]*($_POST["output_width"]/$source_width);

				//offset_x(px)
				$offset_x=-($_POST["offset_left"]*($_POST["output_width"]/$_POST["trim_width"])/$zoom);

				//offset_y(px)
				$offset_y=-($_POST["offset_top"]*($_POST["output_height"]/$_POST["trim_height"])/$zoom);

				$imageWidth=getimagesize($_POST["buffer"]);
				$params=array(
					"trim"=>true,
					"width"=>$_POST["output_width"],
					"height"=>$_POST["output_height"],
					"offset_x"=>$offset_x,
					"offset_y"=>$offset_y,
					"zoom"=>$zoom,
				);
				$this->Image->image_resize($_POST["buffer"],$folder."/".$image_tag,$params);
			}
			else
			{
				copy($_POST["buffer"],$folder."/".$image_tag);
			}

			$output=array(
				"tag"=>$image_tag,
				"path"=>$this->params["root"]."wdata/".$folder."/".$image_tag,
				"uniqid"=>hash("sha256",phpx_date("YmdHis")."n"),
			);
			echo JSON_ENC($output);
		}
	}
}
?>
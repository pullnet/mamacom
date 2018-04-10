<?php
//--------------------------------------------------
//
//	PHP-X
//	(C)Masato Nakatsuji
//	2017/02/10
//
//	ImageComponent
//	ImageComponent.php
//
//--------------------------------------------------
class ImageComponent extends Component{

	public $config;

	//constructer
	public function __construct($data){
		parent::__construct($data);
		@include("../app/Backend/Config/image.php");
		$this->config=@$image["default"];
	}
	//config change
	public function set_config($name){
		$this->config=@$image[$name];
	}
	//config manual setting
	public function manual_setting($array){
		$this->config=$array;
	}
	//image
	public function image_resize($source,$output_file,$option=array()){

		//option LIST
		//quality  : (1～100)
		//maxWidth : (px)
		//width    : (px)
		//height   : (px)
		//offset_x : (px)
		//offset_y : (px)
		//zoom	   : (rate)
		//side_unit :(px(default), %)
		//offset_unit :(%(default),px)
		//device_rotate : false(default),true

		$in_img=$this->_setting($source);

		if(!@$option["device_rotate"]){

			//GET EXIF 
			$exif_data=@exif_read_data($source,0,true);

			if(isset($exif_data["IFD0"]['Orientation'])){
				$orien=$exif_data["IFD0"]['Orientation'];
	
				if($orien==2){
					//left <=> right
					$in_img["source"]=$this->image_flop($in_img["source"]);
				}
				else if($orien==3){
					//180 rotate
					$in_img["source"]=$this->image_rotate($in_img["source"],180, 0);

				}
				else if($orien==4){
					//top <=> bottom
					$in_img["source"]=$this->image_flip($in_img["source"]);
				}
				else if($orien==5){
					//90 rotate and left <=> right
					$in_img["source"]=$this->image_rotate($in_img["source"],270, 0);
					$in_img["source"]=$this->image_flip($in_img["source"]);
					$buf_width=$in_img["width"];
					$buf_height=$in_img["height"];
					$in_img["width"]=$buf_height;
					$in_img["height"]=$buf_width;
					$in_img["aspect"]=$in_img["width"]/$in_img["height"];
				}
				else if($orien==6){
					//270 rotate
					$in_img["source"]=$this->image_rotate($in_img["source"],270, 0);
					$buf_width=$in_img["width"];
					$buf_height=$in_img["height"];
					$in_img["width"]=$buf_height;
					$in_img["height"]=$buf_width;
					$in_img["aspect"]=$in_img["width"]/$in_img["height"];
				}
				else if($orien==7){
					//-90 rotate and left <=> right
					$in_img["source"]=$this->image_rotate($in_img["source"],90, 0);
					$in_img["source"]=$this->image_flip($in_img["source"]);
					$buf_width=$in_img["width"];
					$buf_height=$in_img["height"];
					$in_img["width"]=$buf_height;
					$in_img["height"]=$buf_width;
					$in_img["aspect"]=$in_img["width"]/$in_img["height"];
				}
				else if($orien==8){
					//-90 rotate
					$in_img["source"]=$this->image_rotate($in_img["source"],270, 0);
					$buf_width=$in_img["width"];
					$buf_height=$in_img["height"];
					$in_img["width"]=$buf_height;
					$in_img["height"]=$buf_width;
					$in_img["aspect"]=$in_img["width"]/$in_img["height"];
				}
			}
		}

		if(!@$option){
			copy($source,$output_file);
			return true;
		}

		if(@$option["maxWidth"]){
			if($option["maxWidth"]>=$in_img["width"]){
				copy($source,$output_file);
				return true;
			}
			else
			{
				$option["width"]=$option["maxWidth"];
			}
		}
		if(@$option["quality"]){
			$this->config["quality"]=$option["quality"];
		}

		if(!@$option["offset_x"]){
			$option["offset_x"]=0;
		}
		if(!@$option["offset_y"]){
			$option["offset_y"]=0;
		}

		$out_img=array();
		//output image aspect
		if(@$option["width"] && @$option["height"]){
			$out_img["aspect"]=$option["width"]/$option["height"];
			$out_img["width"]=$option["width"];
			$out_img["height"]=$option["height"];
		}
		else
		{
			$out_img["aspect"]=$in_img["aspect"];
			if(@$option["width"]){
				$out_img["width"]=$option["width"];
				$out_img["height"]=$out_img["width"]/$out_img["aspect"];
			}
			else if(@$option["height"]){
				$out_img["height"]=$option["height"];
				$out_img["width"]=$out_img["height"]*$out_img["aspect"];
			}
			else
			{
				$out_img["width"]=$in_img["width"];
				$out_img["height"]=$in_img["height"];
			}
		}

		//zoom
		if(@$option["zoom"]){
			$w_rate=$option["zoom"];
		}
		else
		{
			$w_rate=1;
		}

		//整数値化
		$out_img["width"]=intval($out_img["width"]);
		$out_img["height"]=intval($out_img["height"]);

		$out_img["mime"]=$in_img["mime"];

		//output setting
		$out = ImageCreateTrueColor(@$out_img["width"],@$out_img["height"]);

		//background change.
		$white = imagecolorallocate($out, 255, 255, 255);
		imagefill($out,0 ,0, $white);

		//png or gif
		if($in_img["mime"]["mime"]=="image/png"|| $in_img["mime"]["mime"]=="image/gif")
		{
			imagealphablending($out, true);
			imagesavealpha($out, true);
		}

		//trimming

		if(@$option["trim"]){

//			$offset_x=$out_img["width"]*($option["offset_x"]/100);
//			$offset_y=$out_img["height"]*($option["offset_y"]/100);
			$offset_x=$option["offset_x"];
			$offset_y=$option["offset_y"];

			ImageCopyResampled($out,
				$in_img["source"],
				0,
				0,
				$offset_x,
				$offset_y,
			//	$out_img["width"]+($option["offset_x"]/100), 
			//	$out_img["height"]+($option["offset_y"]/100), 
				$out_img["width"],
				$out_img["height"],
				$out_img["width"]/$w_rate,
				$out_img["height"]/$w_rate
				);
		}
		else if(@$option["autofixed"]){

			if($in_img["mime"][0]>$in_img["mime"][1]){
				$out_img["height"]=$in_img["mime"][1]*($option["width"]/$in_img["mime"][0]);
				$offset_x=0;
				$offset_y=(($option["height"]-$out_img["height"])/2);
			}
			else
			{
				$out_img["width"]=$in_img["mime"][0]*($option["height"]/$in_img["mime"][1]);
				$offset_y=0;
				$offset_x=($option["width"]-$out_img["width"])/2;
			}
			ImageCopyResampled($out,
				$in_img["source"],
				$offset_x,
				$offset_y,
				0,
				0,
				$out_img["width"],
				$out_img["height"],
				$in_img["width"],
				$in_img["height"]
				);
		}
		else
		{
			ImageCopyResampled($out,
				$in_img["source"],
				0,
				0,
				0,
				0,
				$out_img["width"], 
				$out_img["height"], 
				$in_img["width"],
				$in_img["height"]
				);
		}

		$this->_output($out,$out_img,$output_file);



		imagedestroy($in_img["source"]);
		sleep(0.1);
		return true;
	}
	//image authcode
	public function image_authcode($string,$option=array()){
		if(!$string){
			$string=substr(uniqId(),mt_rand(5,8));
		}
		$fonttype=array(
			"impact.ttf",
			"lhandw.ttf",
			"minionproboldit.ttf",
			"plantc.ttf",
			"tektonproboldext.ttf",
		);

		$width = 1000;
		$height = 120;

		$bkColor=array(
			"red"=>mt_rand(220,255),
			"green"=>mt_rand(220,255),
			"blue"=>mt_rand(220,255),
		);

		$out=imagecreatetruecolor($width, $height);

		//background setting
		$backGroundColor=imagecolorallocate($out, $bkColor["red"], $bkColor["green"], $bkColor["blue"]);
		imagefilledrectangle($out, 0, 0, $width, $height, $backGroundColor);

		$strPosX=15;

		for($vn=0;$vn<strlen($string);$vn++){
			//string drow
			$char=substr($string,$vn,1);

			$font="font/".$fonttype[mt_rand(0,4)];
			$strColor=array(
				"red"=>mt_rand(0,200),
				"green"=>mt_rand(0,200),
				"blue"=>mt_rand(0,200),
			);
			$angle=mt_rand(-20,20);
			$strColors=imagecolorallocate($out, $strColor["red"], $strColor["green"], $strColor["blue"]);
			$fontSize = 25+mt_rand(0,25);

			$strPosY=50+mt_rand(0,10);

			imagettftext($out, 
				$fontSize, 
				$angle, 
				$strPosX, 
				$strPosY, 
				$strColors, 
				$font, 
				$char);

			$strPosX=$strPosX+$fontSize;
		}

		//hools
		for($vn2=0;$vn2<10;$vn2++){
			$mau=".";
			$mau_size=mt_rand(60,100);
			$mau_color=imagecolorallocatealpha($out,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),mt_rand(100,110));
			imagettftext($out, 
				$mau_size, 
				0, 
				mt_rand(0,$strPosX), 
				mt_rand(0,$height), 
				$mau_color, 
				$font, 
				$mau);
		}

		//image trim
		$out2=imagecreatetruecolor($strPosX+10, $strPosY+20);
		$backGroundColor=imagecolorallocate($out, $bkColor["red"], $bkColor["green"], $bkColor["blue"]);
		imagefilledrectangle($out2, 0, 0, $width, $height, $backGroundColor);

		imagecopyresampled($out2, $out, 0, 0, 0, 0, $strPosX+10, $height,$strPosX+10, $height);

		//image output
		ob_start();
		imagejpeg($out2, null, 95);
		$content = base64_encode(ob_get_contents());
		ob_end_clean();

		imagedestroy($out2);
		imagedestroy($out);

		sleep(0.1);
		$output=array(
			"image"=>$content,
			"word"=>$string,
		);
		return $output;
	}

	private function _setting($source){
		//Set image...
		$img_info=getimagesize($source);

		$this->_setMemoryForImage($source);

		//Jpeg
		if($img_info["mime"]=="image/jpeg")
		{
			$imgsource=ImageCreateFromJPEG($source);
		}
		//Png
		else if($img_info["mime"]="image/png")
		{
			$imgsource=ImageCreateFromPNG($source);
		}
		//Gif
		else if($img_info["mime"]=="image/gif")
		{
			$imgsource=ImageCreateFromGIF($source);
		}
		else
		{
			$imgsource=ImageCreateFromJPEG($source);
		}


		//input image size
		$width = ImageSx($imgsource);
		$height = ImageSy($imgsource);

		//input image aspect
		$input_sqrate=$width/$height;

		$output=array(
			"mime"=>$img_info,
			"source"=>$imgsource,
			"width"=>$width,
			"height"=>$height,
			"aspect"=>$input_sqrate,
		);
		return $output;
	}
	
	private function _output($out,$outimg,$output_path){
		if(!@$this->config["quality"]){
			$this->config["quality"]=95;
		}
		//jpg
		if($outimg["mime"]["mime"]=="image/jpeg")
		{
			ImageJPEG($out,$output_path,$this->config["quality"]);

		}
		//png
		else if($outimg["mime"]["mime"]=="image/png")
		{
			ImagePNG($out,$output_path);
		}
		//GIF
		else if($outimg["mime"]["mime"]=="image/gif")
		{
			ImageGIF($out,$output_path);
		}
		else
		{
			ImageJPEG($out,$output_path,$this->config["quality"]);
		}

		//image destroy
		imagedestroy($out);

	}
	//image flop
	private function image_flop($image){
		$w = imagesx($image);
		$h = imagesy($image);
		$destImage = @imagecreatetruecolor($w,$h);
		for($i=($w-1);$i>=0;$i--){
			for($j=0;$j<$h;$j++){
				$color_index = imagecolorat($image,$i,$j);
				$colors = imagecolorsforindex($image,$color_index);
				imagesetpixel($destImage,abs($i-$w+1),$j,imagecolorallocate($destImage,$colors["red"],$colors["green"],$colors["blue"]));
			}
		}
		return $destImage;
	}
	//image filp
	private function image_flip($image){
		$w = imagesx($image);
		$h = imagesy($image);
		$destImage = @imagecreatetruecolor($w,$h);
		for($i=0;$i<$w;$i++){
			for($j=($h-1);$j>=0;$j--){
				$color_index = imagecolorat($image,$i,$j);
				$colors = imagecolorsforindex($image,$color_index);
				imagesetpixel($destImage,$i,abs($j-$h+1),imagecolorallocate($destImage,$colors["red"],$colors["green"],$colors["blue"]));
			}
		}
		return $destImage;
	}
	//image rotate
	private function image_rotate($image, $angle, $bgd_color){
		return imagerotate($image, $angle, $bgd_color,0);
	}
	// memory cache resetting...
	private function _setMemoryForImage($filename){
		$imageInfo = getimagesize($filename);
		if(!@$imageInfo["channels"]){
			$imageInfo["channels"]=1;
		}
		$MB = 1048576;  // number of bytes in 1M
		$K64 = 65536;    // number of bytes in 64K
		$TWEAKFACTOR = 1.5;  // Or whatever works for you
		$memoryNeeded = round( ( $imageInfo[0] * $imageInfo[1]
			* $imageInfo['bits']
			* $imageInfo['channels'] / 8 + $K64
		) * $TWEAKFACTOR
		);
		//ini_get('memory_limit') only works if compiled with "--enable-memory-limit" also
		//Default memory limit is 8MB so well stick with that.
		//To find out what yours is, view your php.ini file.
		$memoryLimit = 8 * $MB;
		if (function_exists('memory_get_usage') && memory_get_usage() + $memoryNeeded > $memoryLimit){
			$memoryLimitMB=ini_get("memory_limit");
			$newLimit = $memoryLimitMB + ceil( ( memory_get_usage()+$memoryNeeded-$memoryLimit) / $MB);
			return true;
		}else{
			return false;
		}
	}

}
?>
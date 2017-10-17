<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	2016/02/11							*/
/*									*/
/*	JSON専用コントローラ						*/
/*	JsonmethodController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class JsonmethodController extends AppController {

	public $autoRender=false;
	public $layout=false;

	public $components=array(
		"Loadbasic",
		"Db",
	);

	//★前処理
	public function beforeFilter(){
		parent::beforeFilter();
	}
	
	
	//★サブ画像
	public function buffersave_sub1(){
		
		if($this->request->data){
			
			
			$data=$this->request->data;
			
			$folder="buffer/".date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);
			
			$tag=hash("sha256",date("YmdHis").$data["Uploadimage_sub1"]["upfile_sub1"]["tmp_name"]);
			
			$copy_url=$folder."/".$tag;
			
			//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
			$this->buffersave_maxwidthedit($data["Uploadimage_sub1"]["upfile_sub1"]["tmp_name"],$copy_url,1000);

			$result=array(
				"url"=>Router::url("/",true).$copy_url,
				"number"=>$tag,
				"number_copy"=>$tag."_1",
			);
				
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}

	public function buffersave_sub2(){
		
		if($this->request->data){
			
			
			$data=$this->request->data;
			
			$folder="buffer/".date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);
			
			$tag=hash("sha256",date("YmdHis").$data["Uploadimage_sub2"]["upfile_sub2"]["tmp_name"]);
			
			$copy_url=$folder."/".$tag;
			
			//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
			$this->buffersave_maxwidthedit($data["Uploadimage_sub2"]["upfile_sub2"]["tmp_name"],$copy_url,1000);

			$result=array(
				"url"=>Router::url("/",true).$copy_url,
				"number"=>$tag,
				"number_copy"=>$tag."_1",
			);
				
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}
	
	public function buffersave_sub3(){
		
		if($this->request->data){
			
			
			$data=$this->request->data;
			
			$folder="buffer/".date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);
			
			$tag=hash("sha256",date("YmdHis").$data["Uploadimage_sub3"]["upfile_sub3"]["tmp_name"]);
			
			$copy_url=$folder."/".$tag;
			
			//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
			$this->buffersave_maxwidthedit($data["Uploadimage_sub3"]["upfile_sub3"]["tmp_name"],$copy_url,1000);

			$result=array(
				"url"=>Router::url("/",true).$copy_url,
				"number"=>$tag,
				"number_copy"=>$tag."_1",
			);
				
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}	
	
	public function buffersave_sub4(){
		
		if($this->request->data){
			
			
			$data=$this->request->data;
			
			$folder="buffer/".date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);
			
			$tag=hash("sha256",date("YmdHis").$data["Uploadimage_sub4"]["upfile_sub4"]["tmp_name"]);
			
			$copy_url=$folder."/".$tag;
			
			//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
			$this->buffersave_maxwidthedit($data["Uploadimage_sub4"]["upfile_sub4"]["tmp_name"],$copy_url,1000);

			$result=array(
				"url"=>Router::url("/",true).$copy_url,
				"number"=>$tag,
				"number_copy"=>$tag."_1",
			);
				
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}		
	
	public function buffersave_sub5(){
		
		if($this->request->data){
			
			
			$data=$this->request->data;
			
			$folder="buffer/".date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);
			
			$tag=hash("sha256",date("YmdHis").$data["Uploadimage_sub5"]["upfile_sub5"]["tmp_name"]);
			
			$copy_url=$folder."/".$tag;
			
			//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
			$this->buffersave_maxwidthedit($data["Uploadimage_sub5"]["upfile_sub5"]["tmp_name"],$copy_url,1000);

			$result=array(
				"url"=>Router::url("/",true).$copy_url,
				"number"=>$tag,
				"number_copy"=>$tag."_1",
			);
				
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}
	
	
	//★ファイルをバッファにセット
	public function buffersave(){
		if($this->request->data){
			$data=$this->request->data;

			$folder="buffer/".date("Ymd");
			@mkdir("buffer");
			@mkdir($folder);

			$tag=hash("sha256",date("YmdHis").$data["Uploadimage"]["upfile"]["tmp_name"]);
			$copy_url=$folder."/".$tag;

			//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
			$this->buffersave_maxwidthedit($data["Uploadimage"]["upfile"]["tmp_name"],$copy_url,1000);

			$result=array(
				"url"=>Router::url("/",true).$copy_url,
				"number"=>$tag,
				"number_copy"=>$tag."_1",
			);
			return json_encode($result,JSON_UNESCAPED_UNICODE);
		}
	}
	
	
	//★アイコン画像のトリミング保存
	public function iconimgedit()
	{
		if($this->request->data){
			$data=$this->request->data;

			$iconnumber_original=$data["buffer"]["buffer_icontag_original"];//元のソース
			$iconnumber=$data["buffer"]["buffer_icontag"];

			//元の画像パスを指定
			$folder="buffer/".date("Ymd");
			$input_source=$iconnumber_original;
			$output_source=$folder."/".$iconnumber;

			//画像情報を取得
			$img_info=getimagesize($input_source);

			//GDライブラリ使ってトリミング
			//画像がJPEGの場合
			if($img_info["mime"]=="image/jpeg")
			{
				//JPEGファイルを呼び出し
				$imgsource=ImageCreateFromJPEG($input_source);
			}
			//画像がPNGの場合
			else if($img_info["mime"]=="image/png")
			{
				//PNGファイルを呼び出し
				$imgsource=ImageCreateFromPNG($input_source);
			}
			//画像がGIFの場合
			else if($img_info["mime"]=="image/gif")
			{
				//GIFファイルを呼び出し
				$imgsource=ImageCreateFromGIF($input_source);
			}
			//どれにも属さない場合は、強制でJpegで...
			else
			{
				//JPEGファイルを呼び出し
				$imgsource=ImageCreateFromJPEG($input_source);
			}


			//元の画像のサイズを図る
			$width = ImageSx($imgsource);
			$height = ImageSy($imgsource);

			//縮小率(レート)の設定
			$w_rate=$data["buffer"]["buffer_icontag_zoom"]/100;

			//出力設定
			$out = ImageCreateTrueColor(300,300);

			//背景が黒になるので白くしてあげよう
			$white = imagecolorallocate($out, 255, 0, 255);
			imagefill($out,0 ,0, $white);

			//透過pngと透過gifの設定
			if($img_info["mime"]=="image/png"|| $img_info["mime"]=="image/gif")
			{
				//画像形式がPNGまたはGIFの場合、透過のある画像の場合は透過をつける
				//ブレンドモードを無効にする
				imagealphablending($out, false);
				//完全なアルファチャネル情報を保存するフラグをonにする
				imagesavealpha($out, true);
			}

			//トリミング処理
			imagecopyresampled($out, 
				$imgsource,
				0,
				0,
				-$width*($data["buffer"]["buffer_icontag_trim_left"]/100),
				-$height*($data["buffer"]["buffer_icontag_trim_top"]/100), 
				300, 
				300, 
				$width/$w_rate, 
				$width/$w_rate);

			//ファイルを保存
			header('Content-Type: '.$img_info["mime"]);

			//画像がJPEGの場合
			if($img_info["mime"]=="image/jpeg")
			{
				ImageJPEG($out,$output_source,97);
			}
			//画像がPNGの場合
			else if($img_info["mime"]=="image/png")
			{
				ImagePNG($out,$output_source);
			}
			//画像がGIFの場合
			else if($img_info["mime"]=="image/gif")
			{
				ImageGIF($out,$output_source);
			}
			//どれにも属さない場合は、強制でJpegで...
			else
			{
				ImageJPEG($out,$output_source,97);
			}

			//イメージを解放
			imagedestroy($out);

			$output=array(
				"url"=>Router::url("/",true).$output_source,
				"number"=>$iconnumber,
			);
		}
		return json_encode($output);
	}
	//★ユーザー保存画像のバッファ領域にwidhtが一定値オーバーの場合はそこまで縮小して出力
	private function buffersave_maxwidthedit($source,$copy_url,$maxwidth)
	{
		//画像情報を取得
		$img_info=getimagesize($source);

		//2016 2/2 課題
		//iphoneなどはどうやら縦で撮影しても、自動的に横になってしまうらしい....
		//のでこちらで情報取得するしかねー....
		/*
		$exif_data = exif_read_data($source);
		if($exif_data){

		}*/

		//横幅が1600px以上の場合は縮小対象
		if($img_info[0]>1600)
		{
			//GDライブラリ使って画像縮小
			//画像がJPEGの場合
			if($img_info["mime"]=="image/jpeg")
			{
				//JPEGファイルを呼び出し
				$imgsource=ImageCreateFromJPEG($source);
			}
			//画像がPNGの場合
			else if($img_info["mime"]=="image/png")
			{
				//PNGファイルを呼び出し
				$imgsource=ImageCreateFromPNG($source);
			}
			//画像がGIFの場合
			else if($img_info["mime"]=="image/gif")
			{
				//GIFファイルを呼び出し
				$imgsource=ImageCreateFromGIF($source);
			}
			//どれにも属さない場合は、強制でJpegで...
			else
			{
				//JPEGファイルを呼び出し
				$imgsource=ImageCreateFromJPEG($source);
			}

			//元の画像のサイズを図る
			$width = ImageSx($imgsource);
			$height = ImageSy($imgsource);

			//縮小率(レート)の設定
			$w_rate=$width/$maxwidth;

			//出力設定
			$out = ImageCreateTrueColor((int)$width/$w_rate, (int)$height/$w_rate);

			//透過pngと透過gifの設定
			if($img_info["mime"]=="image/png"|| $img_info["mime"]=="image/gif")
			{
				//画像形式がPNGまたはGIFの場合、透過のある画像の場合は透過をつける
				//ブレンドモードを無効にする
				imagealphablending($out, false);
				//完全なアルファチャネル情報を保存するフラグをonにする
				imagesavealpha($out, true);
			}
			//リサイズ処理
			imagecopyresampled($out, $imgsource,0,0,0,0, (int)$width/$w_rate, (int)$height/$w_rate, $width, $height);

			//ファイルを保存
			header('Content-Type: '.$img_info["mime"]);

			//画像がJPEGの場合
			if($img_info["mime"]=="image/jpeg")
			{
				ImageJPEG($out,$copy_url,97);
			}
			//画像がPNGの場合
			else if($img_info["mime"]=="image/png")
			{
				ImagePNG($out,$copy_url);
			}
			//画像がGIFの場合
			else if($img_info["mime"]=="image/gif")
			{
				ImageGIF($out,$copy_url);
			}
			//どれにも属さない場合は、強制でJpegで...
			else
			{
				ImageJPEG($out,$copy_url,97);
			}

			//イメージを解放
			imagedestroy($out);

			return true;

		}
		else
		{
			//それ以下の場合はそのままコピーするだけ
			copy($source,$copy_url);
		}

	}

}

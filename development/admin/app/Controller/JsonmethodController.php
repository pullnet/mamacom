<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/02/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	JSON専用コントローラ						*/
/*	JsonmethodController.php					*/
/* ------------------------------------------------------------------- 	*/
App::uses('AppController', 'Controller');

class JsonmethodController extends AppController {

	/*　中身はほとんど一般画面のjsonmethodコントローラとほぼ同じ */
	/*　一部機能を管理画面専用になっているだけ */

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
	//★ユーザーネーム利用可能かどうか調べるメソッド
	public function username_available($username,$now_username="")
	{
		//1(true):利用可能 0(false):利用不可、2:現行のユーザーネーム

		//Userテーブルを使用
		$this->uses=array("User");

		//Userテーブル内から同じユーザネームを持つユーザーがいないかどうかをチェック
		$pre_user=$this->User->find("count",array(
			"conditions"=>array("User.username"=>$username),
		));
		
		//一件も見つからない場合は0
		if($pre_user==0)
		{
			$result=array("enabled"=>1);
		}
		else
		{
			if($now_username==$username)
			{
				$result=array("enabled"=>2);
			}
			else
			{
				$result=array("enabled"=>0);
			}
		}
		
		return json_encode($result);
	}
	//★ニックネーム利用可能かどうか調べるメソッド
	public function nickname_available($nickname)
	{
		//Userテーブルを使用
		$this->uses=array("User");

		//Userテーブル内から同じニックネームを持つユーザーがいないかどうかをチェック
		$pre_user=$this->User->find("count",array(
			"conditions"=>array("User.nickname"=>$nickname),
		));
		
		if($pre_user==0)
		{
			$result=array("enabled"=>true);
		}
		else
		{
			$result=array("enabled"=>false);
		}
		
		return json_encode($result);
	}
	//★メールアドレスが利用可能かどうか調べるメソッド
	public function mailaddress_available($mailaddress,$now_mailaddress="")
	{
		//戻り値は0:利用可能、1:利用不可、2:元々使用しているメールアドレス

		//Userテーブルを使用
		$this->uses=array("User");
		
		//Userテーブル内から同じメールアドレスを持つユーザーがいないかどうかをチェック
		$pre_user=$this->User->find("count",array(
			"conditions"=>array(
				"User.mailaddress"=>$mailaddress,
			),
		));

		//一つも見つからない場合は0
		if($pre_user==0)
		{
			$result=array("enabled"=>0);
		}
		else
		{
			//見つかった場合はそれが元々のアドレスかどうかを判定(元々のだったら2,違っていたら1)
			if($mailaddress==$now_mailaddress)
			{
				$result=array("enabled"=>2);
			}
			else
			{
				$result=array("enabled"=>1);
			}
		}
		
		return json_encode($result);
	}
	//★ファイルをバッファにセット
	public function buffersave($adminnumber)
	{
		$data=$this->request->data;

		//ユニークなアイコンタグを生成
		$iconnumber=md5(uniqId(date("ymdhis")));
		$iconnumber_copy=md5(uniqId(date("hisymd")));
		
		//バッファの保存場所を設定
		$copy_url="buffer/Admin/".$adminnumber."/".$iconnumber;

		//画像・コンテンツのバッファ領域を作成(なければ)
		if(!is_dir("buffer"))
		{
			mkdir("buffer");
		}
		if(!is_dir("buffer/Admin"))
		{
			mkdir("buffer/Admin");
		}
		if(!is_dir("buffer/Admin/".$adminnumber))
		{
			mkdir("buffer/Admin/".$adminnumber);
		}

		//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
		$this->buffersave_maxwidthedit($data["senddata"]["uploadicon"]["tmp_name"],$copy_url,1500);

		$result=array(
			"url"=>Router::url("/",true).$copy_url,
			"number"=>$iconnumber,
			"number_copy"=>$iconnumber_copy,
		);
		return json_encode($result);
	}

	//★ファイルをバッファにセット(画像ファイル以外の形式対応用)
	public function buffersave_anyfile($adminnumber)
	{
		$data=$this->request->data;

		//ユニークなアイコンタグを生成
		$iconnumber=md5(uniqId(date("ymdhis")));
		$iconnumber_copy=md5(uniqId(date("hisymd")));
		
		//バッファの保存場所を設定
		$copy_url="buffer/Admin/".$adminnumber."/".$iconnumber;

		//画像・コンテンツのバッファ領域を作成(なければ)
		if(!is_dir("buffer"))
		{
			mkdir("buffer");
		}
		if(!is_dir("buffer/Admin"))
		{
			mkdir("buffer/Admin");
		}
		if(!is_dir("buffer/Admin/".$adminnumber))
		{
			mkdir("buffer/Admin/".$adminnumber);
		}

		//ファイルをバッファ領域へコピー(でかい場合は縮小をかける)
		copy($data["senddata"]["uploadicon"]["tmp_name"],$copy_url);

		$result=array(
			"url"=>Router::url("/",true).$copy_url,
			"number"=>$iconnumber,
			"number_copy"=>$iconnumber_copy,
			"filename"=>$data["senddata"]["uploadicon"]["name"],
			"type"=>getimagesize($data["senddata"]["uploadicon"]["tmp_name"]),
		);
		return json_encode($result);
	}


	//★アイコン画像のトリミング保存
	public function iconimgedit($adminnumber)
	{
		$data=$this->request->data;

		$iconnumber_original=$data["buffer"]["buffer_icontag_original"];//元のソース
		$iconnumber=$data["buffer"]["buffer_icontag"];

		//元の画像パスを指定
		$input_source="buffer/Admin/".$adminnumber."/".$iconnumber_original;
		$output_source="buffer/Admin/".$adminnumber."/".$iconnumber;

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

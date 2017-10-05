<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/06							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://image.collabos.jp					*/
/*									*/
/*	画像・コンテンツメソッド用コントローラ				*/
/*	ContentController.php						*/
/* ------------------------------------------------------------------- 	*/

App::uses('AppController', 'Controller');

class ContentController extends AppController {

	public $uses=array("User","Admin");//Userテーブルのみ使用

	public $autoRender=false;//viewを使わない
	public $layout=false;//レイアウトなし

	public function beforefilter(){
		parent::beforefilter();
	}

	//★インデックス(空の画面)
	public function index()
	{
		//予定入るものなし
echo "...?";
		return false;
	}
	//★画像・コンテンツ存在確認
	public function exist()
	{
		//まずgetパラメータがあるかどうか
		if($this->request->query)
		{
			$query=$this->request->query;
			//タグ番号があるかどうか
			if(isset($query["tag"]))
			{
				//タグ番号が空でないかどうか
				if($query["tag"]!="")
				{
					//ファイル存在チェック
					$juge=file_exists("data/".$query["tag"]);
					return $juge;
				}
			}
		}
		return false;
	}
	//★画像・コンテンツ読み込み用メソッド
	//4/28 時点で使用しない方針に決定
	public function read()
	{
		//まずgetパラメータがあるかどうか
		if($this->request->query)
		{
			$query=$this->request->query;
			//タグ番号があるかどうか
			if(isset($query["read_tag"]))
			{
				//ファイルが画像形式であるかどうか
					if(exif_imagetype("data/".$query["directory"]."/".$query["read_tag"]))
					{
						//画像形式である場合はこちら
						//画像形式を保存
						$imgtype=exif_imagetype("data/".$query["directory"]."/".$query["read_tag"]);
						
						//widthが設定されているかどうか
						//設定されていればそのままパフォーマンスチューニング実行
						if(isset($query["width"]))
						{
							//画像縮小処理
							$this->loadimage($query,$imgtype);

						}
						else
						{
							//widthも設定されていない場合はそのままファイルをロード
							$ch = curl_init();
							$datatype=getimagesize(Router::url("/data/".$query["directory"]."/".$query["read_tag"],true));
							curl_setopt( $ch, CURLOPT_URL, Router::url("/data/".$query["directory"]."/".$query["read_tag"],true));
							curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
							$imgdata = curl_exec($ch);
							curl_close($ch);
							$this->response->type($datatype["mime"]);
							return $imgdata;
						}
					}
					else
					{
						//画像形式以外のデータは直接ダウンロード
						$ch = curl_init();
						curl_setopt( $ch, CURLOPT_URL, Router::url("/data/".$query["directory"]."/".$query["read_tag"],true));
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
						$otherdata = curl_exec($ch);
						curl_close($ch);

						return $otherdata;
					}
			}
		}
		return false;
	}
	//★画像・コンテンツ書き込みメソッド
	public function save()
	{
		//getパラメータががあるかどうか
		if($this->request->query)
		{
			$query=$this->request->query;

			//app_idがあるかどうか
			if(isset($query["app_id"]))
			{
				//app_idの番号と同じものがあるかどうか
				//2016 1/6 現時点はテスト用のアプリIDを用意
				if($this->test_appid($query["app_id"]))
				{
					//で、次に元ファイルのパスがあるかどうか確認、なければ即終了。
					if(isset($query["source"]))
					{
						//まずはオリジナルのコピーをする
						//write_tagが無ければ一旦空を作成
						if(!isset($query["write_tag"])){ $query["write_tag"]=""; }

						//タグ情報空ならば自作
						if($query["write_tag"]=="")
						{
							$tagstring="";
							$libon="0123456789abcdefghijklmnopqrstuvwxyz";
							for($ms1=0;$ms1<50;$ms1++)
							{
								$rmd=substr($libon,mt_rand() % strlen($libon),1);
								$tagstring.=$rmd;
							}
							$query["write_tag"]=$tagstring;
						}

						//ファイルをリモートへコピー
						copy($query["source"],"data/".$query["directory"]."/".$query["write_tag"]);

						//最後にタグ番号を渡す
						return $query["write_tag"];
					}
				}
			}
		}
		return false;
	}
	//★画像・コンテンツ書き込みメソッド(ショートイメージ生成用)
	//ユーザーアイコン、サムネイルのショート画像はこっちを使用する。
	public function savesmp()
	{
		//getパラメータががあるかどうか
		if($this->request->query)
		{
			$query=$this->request->query;

			//app_idがあるかどうか
			if(isset($query["app_id"]))
			{
				//app_idの番号と同じものがあるかどうか
				if($this->test_appid($query["app_id"]))
				{
					//で、次に元ファイルのパスがあるかどうか確認、なければ即終了。
					if(isset($query["source"]))
					{
						//まずはオリジナルのコピーをする
						//write_smptagが無ければ一旦空を作成
						if(!isset($query["write_smptag"])){ $query["write_smptag"]=""; }
						//タグ情報空ならば自作
						if($query["write_tag"]=="")
						{
							$tagstring="";
							$libon="0123456789abcdefghijklmnopqrstuvwxyz";
							for($ms1=0;$ms1<50;$ms1++)
							{
								$rmd=substr($libon,mt_rand() % strlen($libon),1);
								$tagstring.=$rmd;
							}
							$query["write_tag"]=$tagstring;
						}

						//画像形式の場合は....
						if($imgtype=@exif_imagetype($query["source"]))
						{
							//画像縮小・保存処理($smpsaveをtrue)
							$this->saveimage($query,$imgtype,true);
						}
						else
						{
							//よく分からない画像が出てきたとする場合は
							//まず一回バッファのファイルを保存
							$data=file_get_contents($query["source"]);
							file_put_contents("buffer/".$query["write_tag"],$data);
						}

						//最後にsmpタグ番号を渡す
						return $query["write_tag"];
					}
				}
			}
		}
	}
	//★画像・コンテンツ削除メソッド
	public function delete()
	{
		//getパラメータがあるかどうか
		if($this->request->query)
		{
			$query=$this->request->query;

			//app_idがあるかどうか
			if(isset($query["app_id"]))
			{
				//app_idの番号と同じものがあるかどうか
				if($this->test_appid($query["app_id"]))
				{
					//delete_tagがあるかどうか
					if(isset($query["delete_tag"]))
					{
						//delete_tagの中身が空でないかどうか
						if($query["delete_tag"]!="")
						{
							//削除処理
							if(unlink("data/".$query["delete_tag"]))
							{
								return true;
							}
						}
					}
				}
			}
		}
		return false;
	}
	//★コンテンツデータダウンロード用メソッド
	public function download()
	{
		//getパラメータががあるかどうか
		if($this->request->query)
		{
			$query=$this->request->query;
			
			if($query["read_tag"] && $query["filename"])
			{
				//ファイル情報を取得
				header('Content-Type: application/force-download');
				header('Content-Length: '.filesize("data/msgzip/".$query["read_tag"]));
				header('Content-disposition: attachment; filename="'.$query["filename"].'"');

				readfile("data/msgzip/".$query["read_tag"]);
			}

		}
		return false;
	}

	//★画像・コンテンツリスト取得(管理用)
	public function getlist(){
		//getパラメータがあるかどうか

		if($this->request->query){
			$query=$this->request->query;

			//app_idがあるかどうか
			if(isset($query["app_id"])){

				//app_idの番号と同じものがあるかどうか
				if($this->test_appid($query["app_id"])){

					//特定ディレクトリの保存データリスト
					$getlist=@glob($query["directory"]."/*");

					return json_encode($getlist);

				}
			}
		}
	}
	//★画像・コンテンツ削除用(管理用)
	public function data_delete(){
		//getパラメータがあるかどうか

		if($this->request->query){
			$query=$this->request->query;

			//app_idがあるかどうか
			if(isset($query["app_id"])){

				//app_idの番号と同じものがあるかどうか
				if($this->test_appid($query["app_id"])){
					
					@unlink(@$query["delete_path"]);

				}
			}
		}

	}
	//アプリID使用可能かチェック
	public function check()
	{
		//getパラメータがあるかどうか
		if($this->request->query)
		{
			$query=$this->request->query;
			//app_idがあるかどうか
			if(isset($query["app_id"]))
			{
				//app_idの番号と同じものがあるかどうか
				if($this->test_appid($query["app_id"]))
				{
					return true;
				}
			}
		}
		return false;
	}
	//★コンテンツ管理アプリIDの整合チェックメソッド
	private function test_appid($appid)
	{
		//アプリIDがあるかどうかをチェック
		$result=$this->User->find("first",array(
			"conditions"=>array("User.item_app_id"=>$appid),
		));
		//管理者側でもアプリIDがあるかどうかをチェック
		$result_ap=$this->Admin->find("first",array(
			"conditions"=>array("Admin.item_app_id"=>$appid),
		));
		//どちらかにあればTrue、両方ともなければFalseを返す
		if($result || $result_ap){
			return true;
		}
		else{
			return false;
		}
	}
	//★画像拡大・縮小処理メソッド(read用)
	private function loadimage($query,$imgtype){

		//GDライブラリ使って画像縮小
		//画像がJPEGの場合
		if($imgtype==IMAGETYPE_JPEG)
		{
			//JPEGファイルを呼び出し
			$imgsource=ImageCreateFromJPEG("data/".$query["directory"]."/".$query["read_tag"]);
		}
		//画像がPNGの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//PNGファイルを呼び出し
			$imgsource=ImageCreateFromPNG("data/".$query["directory"]."/".$query["read_tag"]);
		}
		//画像がGIFの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//GIFファイルを呼び出し
			$imgsource=ImageCreateFromGIF("data/".$query["directory"]."/".$query["read_tag"]);
		}
		//どれにも属さない場合は、強制でJpegで...
		else
		{
			//JPEGファイルを呼び出し
			$imgsource=ImageCreateFromJPEG("data/".$query["directory"]."/".$query["read_tag"]);
		}

		//元の画像のサイズを図る
		$width = ImageSx($imgsource);
		$height = ImageSy($imgsource);


		//縮小率を図る
		//リサイズを２回に分けるので半分にする
		$w_rate_1=$width/$query["width"]/2;//１回目のレート
		$w_rate_2=$width/$query["width"];//２回目のレート

		//出力設定
		$out = ImageCreateTrueColor((int)$width/$w_rate_1, (int)$height/$w_rate_1);
		$out2 = ImageCreateTrueColor((int)$width/$w_rate_2, (int)$height/$w_rate_2);

		if($imgtype==IMAGETYPE_PNG || $imgtype==IMAGETYPE_GIF)
		{
			//画像形式がPNGまたはGIFの場合、透過のある画像の場合は透過をつける
			//ブレンドモードを無効にする
			imagealphablending($out, false);
			imagealphablending($out2, false);
			//完全なアルファチャネル情報を保存するフラグをonにする
			imagesavealpha($out, true);
			imagesavealpha($out2, true);
		}

		//リサイズ処理(２パス行う)
		//リサイズ(1回目)
		imagecopyresampled($out, $imgsource,0,0,0,0, (int)$width/$w_rate_1, (int)$height/$w_rate_1, $width, $height);
		//リサイズ(2回目)
		imagecopyresampled($out2, $out,0,0,0,0, (int)$width/$w_rate_2, (int)$height/$w_rate_2, (int)$width/$w_rate_1, (int)$height/$w_rate_1);


		//画像がJPEGの場合
		if($imgtype==IMAGETYPE_JPEG)
		{
			//JPGファイルを出力
			header('Content-Type:image/jpeg');
			header("Cache-control: no-cache");
			ImageJPEG($out2);

			//イメージを解放
			imagedestroy($out2);
		}
		//画像がPNGの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//PNGファイルを出力
			header('Content-Type:image/png');
			header("Cache-control: no-cache");
			ImagePNG($out2);

			//イメージを解放
			imagedestroy($out2);
		}
		//画像がGIFの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//GIFファイルを出力
			header('Content-Type:image/gif');
			header("Cache-control: no-cache");
			ImageGIF($out2);

			//イメージを解放
			imagedestroy($out2);
		}
		//どれにも属さない場合はJPEGで強制
		else
		{
			//JPGファイルを出力
			header('Content-Type: image/jpeg');
			header("Cache-control: no-cache");
			ImageJPEG($out2);

			//イメージを解放
			imagedestroy($out2);
		}
	}
	//★画像縮小保存メソッド(縮小画像用)
	private function saveimage($query,$imgtype){

		//GDライブラリ使って画像縮小
		//画像がJPEGの場合
		if($imgtype==IMAGETYPE_JPEG)
		{
			//JPEGファイルを呼び出し
			$imgsource=ImageCreateFromJPEG($query["source"]);
		}
		//画像がPNGの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//PNGファイルを呼び出し
			$imgsource=ImageCreateFromPNG($query["source"]);
		}
		//画像がGIFの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//GIFファイルを呼び出し
			$imgsource=ImageCreateFromGIF($query["source"]);
		}
		//どれにも属さない場合はJPEGで強制
		else
		{
			//JPEGファイルを呼び出し
			$imgsource=ImageCreateFromJPEG($query["source"]);
		}

		//画像幅はデフォルトで300pxに固定
		if(!isset($query["width"])){ $query["width"]=300; }

		//元の画像のサイズを図る
		$width = ImageSx($imgsource);
		$height = ImageSy($imgsource);

		//縮小率を図る
		//リサイズを２回に分けるので半分にする
		$w_rate_1=$width/$query["width"]/2;//１回目のレート
		$w_rate_2=$width/$query["width"];//２回目のレート

		//出力設定
		$out = ImageCreateTrueColor((int)$width/$w_rate_1, (int)$height/$w_rate_1);
		$out2 = ImageCreateTrueColor((int)$width/$w_rate_2, (int)$height/$w_rate_2);

		if($imgtype==IMAGETYPE_PNG || $imgtype==IMAGETYPE_GIF)
		{
			//画像形式がPNGまたはGIFの場合、透過のある画像の場合は透過をつける
			//ブレンドモードを無効にする
			imagealphablending($out, false);
			imagealphablending($out2, false);
			//完全なアルファチャネル情報を保存するフラグをonにする
			imagesavealpha($out, true);
			imagesavealpha($out2, true);
		}

		//リサイズ処理(２パス行う)
		//リサイズ(1回目)
		imagecopyresampled($out, $imgsource,0,0,0,0, (int)$width/$w_rate_1, (int)$height/$w_rate_1, $width, $height);
		//リサイズ(2回目)
		imagecopyresampled($out2, $out,0,0,0,0, (int)$width/$w_rate_2, (int)$height/$w_rate_2, (int)$width/$w_rate_1, (int)$height/$w_rate_1);


		//画像がJPEGの場合
		if($imgtype==IMAGETYPE_JPEG)
		{
			//JPGファイルを保存
			header('Content-Type: image/jpeg');
			header("Cache-control: no-cache");
			ImageJPEG($out2,"smpimg/".$query["directory"]."/".$query["write_tag"]);

			//イメージを解放
			imagedestroy($out2);
		}
		//画像がPNGの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//PNGファイルを出力
			header('Content-Type: image/png');
			header("Cache-control: no-cache");
			ImagePNG($out2,"smpimg/".$query["directory"]."/".$query["write_tag"]);

			//イメージを解放
			imagedestroy($out2);
		}
		//画像がGIFの場合
		else if($imgtype==IMAGETYPE_PNG)
		{
			//GIFファイルを出力
			header('Content-Type: image/gif');
			header("Cache-control: no-cache");
			ImageGIF($out2,"smpimg/".$query["directory"]."/".$query["write_tag"]);

			//イメージを解放
			imagedestroy($out2);
		}
		//どれにも属さない場合はJPEGで
		else
		{
			//JPGファイルを保存
			header('Content-Type: image/jpeg');
			header("Cache-control: no-cache");
			ImageJPEG($out2,"smpimg/".$query["directory"]."/".$query["write_tag"]);

			//イメージを解放
			imagedestroy($out2);
		}

	}

}

<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/03/09							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://www.collabos.jp						*/
/*									*/
/*	CSVファイル生成用コンポーネント					*/
/*	CsvComponent.php						*/
/* ------------------------------------------------------------------- 	*/

class CsvComponent extends Component{

	//csv形式を作成するメソッド(複数用)
	public function makecsv($th,$result,$typename)
	{
		$string_th="";
		foreach($th as $t_)
		{

			$string_th.='"'.$t_.'",';
		}

		$string_td="";
		foreach($result as $rc_)
		{
			foreach($rc_[$typename] as $rca_)
			{
				$rca_=str_replace('"','""',$rca_);
				$string_td.='"'.$rca_.'",';
			}
			$string_td.="\n";
		}
		return $string_th."\n".$string_td;
	}
	//csv形式を作成するメソッド(単一用)
	public function makecsv_single($th,$result)
	{
		$string_th="";
		foreach($th as $t_)
		{

			$string_th.='"'.$t_.'",';
		}

		$string_td="";
		foreach($result as $rca_)
		{
			$rca_=str_replace('"','""',$rca_);
			$string_td.='"'.$rca_.'",';
		}
		return $string_th."\n".$string_td;
	}
	public function zipfile($filename,$source)
	{
		// Zipクラスロード
		$zip = new ZipArchive();
		// Zipファイル名
		$zipFileName = $filename.".zip";
		// Zipファイル一時保存ディレクトリ
		$zipTmpDir = "zip/";
		  
		// Zipファイルオープン
		$result = $zip->open($zipTmpDir.$zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
		if ($result !== true) {
		    // 失敗した時の処理
			echo "aa?";
		}
		  
		foreach ($source as $f_) {
			if(is_array($f_))
			{
				//$zip->addEmptyDir("zip/".key($f_));
				foreach($f_ as $f2_)
				{
					foreach($f2_ as $f2a_)
					{
						$fpc=basename($f2a_);
						$zip->addFile($f2a_,key($f_)."/".$fpc);
					}
				}
			}
			else
			{

				$fp=basename($f_);

				$zip->addFile($f_,$fp);
			}
		}
		$zip->close();

		// ストリームに出力
		header('Content-Type: application/zip; name="' . $zipFileName . '"');
		header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
		header('Content-Length: '.filesize($zipTmpDir.$zipFileName));
		readfile($zipTmpDir.$zipFileName);

		// 一時ファイルを削除しておく
		unlink($zipTmpDir.$zipFileName);
		exit();
	}

}
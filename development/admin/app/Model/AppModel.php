<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/11							*/
/*									*/
/*	Collabos_ver2.0(管理)						*/
/*	https://admin.collabos.jp					*/
/*									*/
/*	共通モデル設定							*/
/*	AppModel.php							*/
/* ------------------------------------------------------------------- 	*/
App::uses('Model', 'Model');

class AppModel extends Model {
	//Authでのログイン情報をパくる
	public function _getCurrentUser() {
	    App::uses('AuthComponent',  'Controller/Component');
	    return AuthComponent::user();
	}
	//★保存前処理
	public function beforeSave($option=array()){
		//更新日、更新権限をセット
		$this->data[$this->alias]["refreshdate"]=date("y-m-d H:i:s")."だす";
		$cuser=@$this->_getCurrentUser();
		$this->data[$this->alias]["refreshstatus"]=1;
		$this->data[$this->alias]["refreshuserid"]=@$cuser["id"];

		//idが含まれていない(=新規レコード登録)の場合は登録日、登録権限をセット
		if(@$this->data[$this->alias]["id"]==""){
			$this->data[$this->alias]["createdate"]=date("y-m-d H:i:s");
			$cuser=@$this->_getCurrentUser();
			$this->data[$this->alias]["createstatus"]=1;
			$this->data[$this->alias]["createuserid"]=@$cuser["id"];
		}

		//XSS対策用(php若しくはjavascript的な構文が含まれていないかどうかチェック)

		if(!@$this->xss_omit){
			$xss_wordlist=array(
				"<?php",
				"<?PHP",
				"?>",
				"<?",
				"<script",
				"<SCRIPT",
				"</script>",
				"</SCRIPT>",
				"onclick=",
				"onClick=",
			);
			$keylist=array_keys($this->data[$this->alias]);
			$k_count=0;
			foreach($this->data[$this->alias] as $d_)
			{
				foreach($xss_wordlist as $xw_)
				{
					//xss対策用ワードが来たときは空にする
					$d_=str_replace($xw_,"",$d_);
				}

				$this->data[$this->alias][$keylist[$k_count]]=$d_;
				$k_count++;
			}
		}

		return true;
	}

	//★日本語チェック用
	public function alphaNumeric($check) {
		//許可する記号
		$trueword=array(
			"_",
			"-",
			"=",
			"+",
			"@",
			".",
			",",
			"/",
			"]",
			"[",
			")",
			"(",
			">",
			"<",
			":",
			";",
			"$",
		);
		//許可する文字列を消去。
		foreach($trueword as $t_){
			$check=str_replace($t_,"",$check);
		}

	    $value = array_values($check);  // 配列の添字を数値添字に変換
	    $value = $value[0];     // 最初の値を取る
	    return preg_match('/^[a-zA-Z0-9]+$/', $value);
	}
}

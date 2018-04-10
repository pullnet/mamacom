<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/12							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://www.collabos.jp						*/
/*									*/
/*	サイト基本情報取得コンポーネント				*/
/*	LoadbasicComponent.php						*/
/* ------------------------------------------------------------------- 	*/
class LoadbasicComponent extends Component{
	public $components=array(
		"Session",
	);
	//基本情報をロード
	public function load($colum=""){
		//基本情報をロード
		$loadModel = ClassRegistry::init('Sitedefault');

		//sessionから取得
		$loadbasic=@$this->Session->read("mamacom_loadbasic");

		//有効期限が過ぎたら、session内は一回消す	

		if(strtotime(@$loadbasic["cache_limit"])<=strtotime(date("Y-m-d H:i:s"))){
			$loadbasic=null;
		}

		//レスポンス向上の為Sessionの中身を確認....
		if(@$loadbasic){
			//あればそこから取得
			if($colum)
			{
				return @$loadbasic[$colum];
			}
			else
			{
				return @$loadbasic;
			}
		}
		else
		{

			//Sessionの中身がない場合はDBから取得+(Sessionに値を返す)
			//カラムが入っていればその値を返す(無ければすべての情報を取得)
			$result=$loadModel->find("list",array(
				"fields"=>array("name","value"),
			));
			//有効期限を設定(1時間)
			$result["cache_limit"]=date("Y-m-d H:i:s",strtotime("+1 hour"));

			$this->Session->write("mamacom_loadbasic",$result);

			if($colum)
			{
				return $result[$colum];
			}
			else
			{
				return $result;
			}
		}
	}
}
<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/09							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://www.collabos.jp						*/
/*									*/
/*	その他ちょいと必要なコンポーネント				*/
/*	OtherComponent.php						*/
/* ------------------------------------------------------------------- 	*/

class OtherComponent extends Component{

	//★バッファ領域のクリア
	public function bufferclear($usernumber){

		$fileName = "buffer/User/".$usernumber."/*";
		foreach (glob($fileName) as $val) {
			unlink($val);
		}
		return true;
	}
	//★生年月日から年齢層を自動算出
	public function age($birthday)
	{
		if($birthday){
			$now=date("Y");
			$bas=date("Y",strtotime($birthday));
			$ddd=$now-$bas;

			//四捨五入...
			return (int)($ddd/10)*10;
		}
		else
		{
			return null;
		}
	}
	//★使っているユーザー名が会員のものか、もしくはグループのURLかチェックできるメソッド
	public function check_username($username)
	{
		$loadModel = ClassRegistry::init("User");
			
		$checks=$loadModel->find("count",array(
			"conditions"=>array(
				"User.username"=>$username,
			),
		));
		if($checks)
		{
			return 0;//会員のusernameと判明
		}
		else
		{
			$loadModel = ClassRegistry::init("Group");
			$checks=$loadModel->find("count",array(
				"conditions"=>array(
					"Group.permalink"=>$username,
				),
			));
			if($checks)
			{
				return 1;//グループurlと判明
			}
			else
			{
				return 2;//使途不明...
			}
		}
	}
}

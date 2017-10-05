<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/09							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://www.collabos.jp						*/
/*									*/
/*	管理番号生成コンポーネント					*/
/*	NumberingComponent.php						*/
/* ------------------------------------------------------------------- 	*/
App::uses('CakeEmail', 'Network/Email');//cakeEmailの読み込み

class NumberingComponent extends Component{

	//★管理番号生成
	public function create($type=0,$before="")
	{
		if(!$before)
		{
			//すでに管理番号がない場合のみ生成
			$number="";

			//ヘッダー番号の指定
			$number=$type;
			
			//日付を追加
			$number.="-".date("ymdhis");

			//ランダム英数字追加(8桁)
			$number.="-".substr(uniqId(),1,8);

			return $number;
		}
		else
		{
			//すでに管理番号がある場合
			return $before;
		}
	}
}

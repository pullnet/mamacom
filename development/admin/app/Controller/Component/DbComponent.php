<?php
/* ------------------------------------------------------------------- 	*/
/*	PULL-NET.Inc							*/
/*	Masato Nakatsuji						*/
/*	2016/01/09							*/
/*									*/
/*	Collabos_ver2.0							*/
/*	https://www.collabos.jp						*/
/*									*/
/*	DBリスト抽出用コンポーネント					*/
/*	DbComponent.php							*/
/* ------------------------------------------------------------------- 	*/

class DbComponent extends Component{

	public $components=array(
		"Loadbasic",
	);

	//★メールフォーマットタイプ
	public function mailtemplate(){
		//職種カテゴリーをセット
		$loadModel = ClassRegistry::init("Mailtemplate");
		$result=$loadModel->find("list",array(
			"fields"=>array("name"),
		));
		return $result;
	}

	//★地域(都道府県)リスト
	public function locationarea($listtype=0){

		$result=$this->dbfind("Locationarea","Locationcategory",$listtype);
		return $result;
	}
	//★職種リスト
	public function job($listtype=0){

		$result=$this->dbfind("Job","Jobcategory",$listtype);
		return $result;
	}
	//★スキルリスト
	public function skill($listtype=0){

		$result=$this->dbfind("Skill","Skillcategory",$listtype);
		return $result;
	}
	//★共通カテゴリーリスト
	public function contentscategory($listtype=0){

		$result=$this->dbfind("Contentscategory","Contentscategoryparent",$listtype);
		return $result;
	}
	//★グループカテゴリーリスト
	public function groupcategory($listtype=0){

		$result=$this->dbfind("Groupcategory","Groupcategoryparent",$listtype);
		return $result;
	}
	//★ライブラリ注文ステータスリスト
	public function orderstatus(){

		$sortlist=json_decode($this->Loadbasic->load("orderstatus_sort"),true);

		if(@$sortlist){
			$sortstr="Field(Orderstatuslist.id";
			foreach($sortlist as $s_){
				$sortstr.=",".$s_;
			}
			$sortstr.=")";
		}

		$loadModel = ClassRegistry::init("Orderstatuslist");
		$result=$loadModel->find("list",array(
			"order"=>@$sortstr,
			"fields"=>array("code","name"),
		));
		return $result;
	}
	//★コラボ参加ステータスリスト
	public function partystatus(){


		$sortlist=json_decode($this->Loadbasic->load("orderstatus_sort"),true);

		if(@$sortlist){
			$sortstr="Field(Collabostatuslist.id";
			foreach($sortlist as $s_){
				$sortstr.=",".$s_;
			}
			$sortstr.=")";
		}

		$loadModel = ClassRegistry::init("Collabostatuslist");
		$result=$loadModel->find("list",array(
			"order"=>@$sortstr,
			"fields"=>array("code","name"),
		));
		return $result;
	}
	//★支払ステータスリスト
	public function payment_status(){
		$output=array(
			"0"=>"未支払",
			"1"=>"支払請求中",
			"2"=>"支払確認済み",
		);
		return $output;
	}

	//dbテーブル抽出共通メソッド
	private function dbfind($table,$categorytable,$listtype=0)
	{
		//ステータス：0:selectタグ用、1:カテゴリー(親)なしリスト形式、2:findで抽出したデータそのまんま,3:カテゴリー(親)と項目名のセットでリスト化

		//$listtype=0または$listtype=2の場合(カテゴリー含むリストで抽出)
		if($listtype==0 || $listtype==2 || $listtype==3)
		{
			//職種カテゴリーをセット
			$loadModel = ClassRegistry::init($categorytable);
			
			//職種をbind
			$loadModel->bindModel(array(
				"hasMany"=>array(
					$table=>array(
						"fields"=>array("name","id"),
					),
				),
			));
			$result=$loadModel->find("all",array(
				"fields"=>array("name"),
			));

			if($listtype==0)
			{
				//$listtype=0の場合(result内をselect用に変換)
				$output=array();
				foreach($result as $r_)
				{
					$out2=array();
					foreach($r_[$table] as $r2_)
					{
						$out2[$r2_["id"]]=$r2_["name"];
					}
					$output[$r_[$categorytable]["name"]]=$out2;
				}
			}
			else if($listtype==2)
			{
				//$listtype=2の場合(select用の変換はなし、$resultそのままを$outputへ)
				$output=$result;
			}
			else
			{
				//$listtype=3の場合(頭にカテゴリー(親)名、後ろに項目名のセットになる)
				$output=array();
				foreach($result as $r_)
				{
					foreach($r_[$table] as $r2_)
					{
						$out=$r_[$categorytable]["name"]." - ".$r2_["name"];
						$output[$r2_["id"]]=$out;
					}
				}
			}
		}
		else
		{
			//$listtype=1の場合(カテゴリーなしのリスト)
			//スキル情報をセット
			$loadModel = ClassRegistry::init($table);
			$result=$loadModel->find("list",array(
				"fields"=>array("name"),
			));
			$output=$result;
		}
		return $output;
	}
	//★公開設定リスト
	public function openstatus($pattern=0){
		if($pattern==0)
		{
			$output=array(
				0=>"すべて",
				1=>"非公開",
				2=>"削除",
			);
		}
		else if($pattern==1)
		{
			$output=array(
				0=>"公開",
				1=>"非公開",
			);
		}
		return $output;
	}

	//★支払方法リスト
	public function payment(){
		$output=array(
			0=>"---支払方法未設定---",
			1=>"クレジットカード決済",
			2=>"銀行振込",
			3=>"その他",
			4=>"[未設定]",
		);
		return $output;
	}
	//★振込方法リスト
	public function pool(){
		$output=array(
			0=>"---振込方法未設定---",
			1=>"銀行振込",
			2=>"その他",
		);
		return $output;
	}
	//★決済会社リスト
	public function credit_company()
	{
		$output=array(
			0=>"VISA",
			1=>"JCB",
			2=>"edy",
		);
		return $output;
	}
	//★性別リスト
	public function gender()
	{
		$output=array(
			0=>"男性",
			1=>"女性",
		);
		return $output;
	}
	//★日付リスト
	public function datelist($type=0)
	{
		//0:今年以前、1:今年より上
		$now_year=(int)date("Y");

		if($type==0)
		{
			//過去100年分の年をピックアップ
			for($sl=0;$sl<100;$sl++)
			{	
				$years=$now_year--;
				$result["year"][$years]=$years;
			}
		}
		else
		{
			//50年後までの年をピックアップ
			for($sl=0;$sl<50;$sl++)
			{	
				$years=$now_year++;
				$result["year"][$years]=$years;
			}
		}

		for($se=1;$se<=12;$se++)
		{
			$result["month"][$se]=$se;
		}
		for($su=1;$su<=31;$su++)
		{
			$result["day"][$su]=$su;
		}
		return $result;
	}
	//★ライブラリ提供方法リスト
	public function libraryreleace()
	{
		$output=array(
			0=>"商品の作成・製造",
			1=>"サービス提供",
			2=>"活動・イベントの補助・スタッフ",
			3=>"モニター調査",
			4=>"その他",
		);
		return $output;
	}
	//★コラボ参加方法リスト
	public function collabojobs()
	{
		$output=array(
			0=>"商品の作成・製造",
			1=>"サービス提供",
			2=>"活動・イベントの補助・スタッフ",
			3=>"モニター調査",
			4=>"その他",
		);
		return $output;
	}
	//★納品形態リスト
	public function outputs()
	{
		$output=array(
			0=>"データ納品",
			1=>"配送",
			2=>"サービス提供",
			3=>"その他",
		);
		return $output;
	}

	//★仲間申請ステータス
	public function friendstatus(){
		$output=array(
			0=>"申請中",
			1=>"申請承諾",
			2=>"申請拒否",
			3=>"関係終了",
		);
		return $output;
	}
	//★メールフォーマットのカテゴリー
	public function mailformat_category(){
		$output=array(
			"user"=>"ユーザー関連",
			"friendgroup"=>"仲間・グループ関連",
			"order"=>"受注共用",
			"collabo"=>"コラボ参加関連",
			"message"=>"メッセージ関連",
			"other"=>"その他問い合わせなど",
		);
		return $output;
		

	}
}

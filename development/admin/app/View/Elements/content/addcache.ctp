<div id="hidden_additem">
<?php

//サムネイル情報をここにhidden
echo $this->Form->hidden("Additem.0.id",array("id"=>"thumbnail_id"));				//Additemのid
echo $this->Form->hidden("Additem.0.content_id",array("id"=>"thumbnail_content_id"));		//コラボ・ライブラリ共通情報ID
echo $this->Form->hidden("Additem.0.type",array("value"=>1,"id"=>"thumbnail_type"));		//追加コンテンツステータス
echo $this->Form->hidden("Additem.0.contents_type",array("id"=>"thumbnail_contents_type"));	//コンテンツ形式
echo $this->Form->hidden("Additem.0.content",array("id"=>"thumbnail_content"));			//コンテンツURL・タグ番号
echo $this->Form->hidden("Additem.0.movie_stauts",array("id"=>"thumbnail_movie_stauts"));	//コンテンツ動画用ステータス
echo $this->Form->hidden("Additem.0.open_status",array("id"=>"thumbnail_open_status"));		//公開ステータス
echo $this->Form->hidden("Additem.0.shortimgtag");						//ショートイメージ用タグ番号

echo $this->Form->hidden("thumbnail");

$ad_count=0;//初期値

if(isset($post["Additem"]))
{
	for($svi=0;$svi<(count($post["Additem"])-1);$svi++)
	{
		//追加コンテンツ情報をここにhidden
		$ad_count++;
	?>
	<div class="field" adc_index="<?php echo $ad_count; ?>">
	<?php
		echo $this->Form->hidden("Additem.".$ad_count.".id",array("class"=>"addcontents_id","adc_index"=>$ad_count))."\n";				
		echo $this->Form->hidden("Additem.".$ad_count.".content_id",array("class"=>"addcontents_content_id","adc_index"=>$ad_count))."\n";		//コラボ・ライブラリ共通情報ID
		echo $this->Form->hidden("Additem.".$ad_count.".type",array("value"=>0,"class"=>"addcontents_type","adc_index"=>$ad_count))."\n";		//追加コンテンツステータス
		echo $this->Form->hidden("Additem.".$ad_count.".contents_type",array("class"=>"addcontents_contents_type","adc_index"=>$ad_count))."\n";	//コンテンツ形式
		echo $this->Form->hidden("Additem.".$ad_count.".content",array("class"=>"addcontents_content","adc_index"=>$ad_count))."\n";			//コンテンツURL・タグ番号
		echo $this->Form->hidden("Additem.".$ad_count.".movie_stauts",array("class"=>"addcontents_movie_stauts","adc_index"=>$ad_count))."\n";		//コンテンツ動画用ステータス
		echo $this->Form->hidden("Additem.".$ad_count.".open_status",array("class"=>"addcontents_open_status","adc_index"=>$ad_count))."\n";		//公開ステータス
		echo $this->Form->hidden("Additem.".$ad_count.".comment",array("class"=>"addcontents_comment","adc_index"=>$ad_count))."\n";			//コメント記入欄									//ショートイメージ用タグ番号
		echo $this->Form->hidden("Additem.".$ad_count.".shortimgtag");											//ショートイメージ用タグ番号
		if(isset($post["Additem"][$svi+1]["deletestatus"]))
		{
			$deletestatus=$post["Additem"][$svi+1]["deletestatus"];
		}
		else
		{
			$deletestatus="false";
		}
		echo $this->Form->hidden("Additem.".$ad_count.".deletestatus",array("value"=>$deletestatus,"class"=>"addcontents_deletestatus","adc_index"=>$ad_count));//削除ステータス
	?>
	</div><!--//.field-->
	<?php
		}
	}
	else
	{
		//postされていない状態はこちら
	?>
	<div class="field" adc_index="1">
	<?php
		echo $this->Form->hidden("Additem.1.id",array("class"=>"addcontents_id","adc_index"=>1))."\n";				
		echo $this->Form->hidden("Additem.1.content_id",array("class"=>"addcontents_content_id","adc_index"=>1))."\n";			//コラボ・ライブラリ共通情報ID
		echo $this->Form->hidden("Additem.1.type",array("value"=>0,"class"=>"addcontents_type","adc_index"=>1))."\n";			//追加コンテンツステータス
		echo $this->Form->hidden("Additem.1.contents_type",array("class"=>"addcontents_contents_type","adc_index"=>1))."\n";		//コンテンツ形式
		echo $this->Form->hidden("Additem.1.content",array("class"=>"addcontents_content","adc_index"=>1))."\n";			//コンテンツURL・タグ番号
		echo $this->Form->hidden("Additem.1.movie_stauts",array("class"=>"addcontents_movie_stauts","adc_index"=>1))."\n";		//コンテンツ動画用ステータス
		echo $this->Form->hidden("Additem.1.open_status",array("class"=>"addcontents_open_status","adc_index"=>1))."\n";		//公開ステータス
		echo $this->Form->hidden("Additem.1.comment",array("class"=>"addcontents_comment","adc_index"=>1))."\n";			//コメント記入欄									//ショートイメージ用タグ番号
		echo $this->Form->hidden("Additem.1.shortimgtag");										//ショートイメージ用タグ番号
		echo $this->Form->hidden("Additem.1.deletestatus",array("value"=>false,"class"=>"addcontents_deletestatus","adc_index"=>1));	//削除ステータス
	?>
	</div><!--//.field-->
<?php } ?>
</div><!--//.hidden_additem-->
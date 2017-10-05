<?php
$checked="checked";
$active='class="active"';
?>

<div class="sub">
	<ul>
		<li>
		<?php
			if(
				$this->params["controller"]=="hpset" || 
				$this->params["controller"]=="freepage" || 
				$this->params["controller"]=="pagecategory" || 
				$this->params["controller"]=="account" || 
				$this->params["controller"]=="information" || 
				$this->params["controller"]=="campaign" ||
				$this->params["controller"]=="filedata"
			){
				$index1=true;
			} 
		?>
			<input type="checkbox" id="sub06" style="display:none" <?php if(isset($index1)){ echo $checked; } ?>>
			<label for="sub06">管理基本設定</label>
			<ul class="sub2">
				<li <?php if($this->params["controller"]=="hpset"){ echo $active; } ?>><?php echo $this->Html->link("サイト基本設定",array("controller"=>"hpset","action"=>"basic")); ?></li>
				<li <?php if($this->params["controller"]=="account"){ echo $active; } ?>><?php echo $this->Html->link("管理アカウント一覧",array("controller"=>"account","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="freepage" || $this->params["controller"]=="pagecategory"){ echo $active; } ?>><?php echo $this->Html->link("LP・固定ページ設定",array("controller"=>"freepage","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="information"){ echo $active; } ?>><?php echo $this->Html->link("インフォメーション管理",array("controller"=>"information","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="campaign"){ echo $active; } ?>><?php echo $this->Html->link("キャンペーン管理",array("controller"=>"campaign","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="filedata"){ echo $active; } ?>><?php echo $this->Html->link("アップロード画像・ファイル管理",array("controller"=>"filedata","action"=>"index")); ?></li>
			</ul>
		</li>
		<li>
		<?php
			if(
				$this->params["controller"]=="mailtemplate" ||
				$this->params["controller"]=="mailformat" ||
				$this->params["controller"]=="mail"
			){
				$index1b=true;
			} 
		?>
			<input type="checkbox" id="sub06b" style="display:none" <?php if(isset($index1b)){ echo $checked; } ?>>
			<label for="sub06b">メール管理</label>
			<ul class="sub2">
				<li <?php if($this->params["controller"]=="mailtemplate"){ echo $active; } ?>><?php echo $this->Html->link("メールテンプレート一覧",array("controller"=>"mailtemplate","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="mailformat"){ echo $active; } ?>><?php echo $this->Html->link("メールフォーマット一覧",array("controller"=>"mailformat","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="mail"){ echo $active; } ?>><?php echo $this->Html->link("メール送信管理",array("controller"=>"mail","action"=>"index")); ?></li>
			</ul>
		</li>
		<li>
		<?php
			if($this->params["controller"]=="users"){
				$index2=true;
			} 
		?>
			<input type="checkbox" id="sub01" style="display:none" <?php if(isset($index2)){ echo $checked; } ?>>
			<label for="sub01">ユーザー管理</label>
			<ul class="sub2">
				<li <?php if($this->params["controller"]=="users"){ echo $active; } ?>><?php echo $this->Html->link("ユーザー一覧",array("controller"=>"users","action"=>"index")); ?></li>
			</ul>
		</li>
		<li>
		<?php
			if($this->params["controller"]=="collabo" || $this->params["controller"]=="library"){
				$index3=true;
			} 
		?>
			<input type="checkbox" id="sub02" style="display:none" <?php if(isset($index3)){ echo $checked; } ?>>
			<label for="sub02">コラボ・ライブラリ管理</label>
			<ul class="sub2">
				<li <?php if($this->params["controller"]=="collabo"){ echo $active; } ?>><?php echo $this->Html->link("コラボ一覧",array("controller"=>"collabo","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="library"){ echo $active; } ?>><?php echo $this->Html->link("ライブラリ一覧",array("controller"=>"library","action"=>"index")); ?></li>
			</ul>
		</li>
		<li>
			<?php
			if($this->params["controller"]=="order" || $this->params["controller"]=="cparty"){
				$index5=true;
			}
			?>
			<input type="checkbox" id="sub03b" style="display:none" <?php if(isset($index5)){ echo $checked; } ?>>
			<label for="sub03b">注文・参加表明管理</label>
			<ul class="sub2">
				<li <?php if($this->params["controller"]=="order"){ echo $active; } ?>><?php echo $this->Html->link("注文情報一覧",array("controller"=>"order","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="cparty"){ echo $active; } ?>><?php echo $this->Html->link("コラボ参加表明情報一覧",array("controller"=>"cparty","action"=>"index")); ?></li>
			</ul>
		</li>
		<li>
			<?php
			if($this->params["controller"]=="payment" || $this->params["controller"]=="transferrequest"){
				$index101=true;
			}
			?>
			<input type="checkbox" id="sub03c" style="display:none;" <?php if(isset($index101)){ echo $checked; } ?>>
			<label for="sub03c" style="background:#933;border:solid 1px #933;">支払・振込管理</label>
			<ul class="sub2">
				<li><?php echo $this->Html->link("支払管理",array("controller"=>"payment","action"=>"index"),array("style"=>"background:#933;border:solid 1px #933;")); ?></li>
				<li><?php //echo $this->Html->link("支払管理(クレジット決済)",array("controller"=>"payment","action"=>"credit"),array("style"=>"background:#933;border:solid 1px #933;")); ?></li>
				<li><?php echo $this->Html->link("振込管理",array("controller"=>"transferrequest","action"=>"index"),array("style"=>"background:#933;border:solid 1px #933;")); ?></li>
			</ul>
		</li>
		<li>
			<?php
			if($this->params["controller"]=="friend" || $this->params["controller"]=="group")
			{
				$index6=true;
			}
			?>
			<input type="checkbox" id="sub04" style="display:none" <?php if(isset($index6)){ echo $checked; } ?>>
			<label for="sub04">仲間・グループ管理</label>
			<ul class="sub2">
				<li <?php if($this->params["controller"]=="friend"){ echo $active; } ?>><?php echo $this->Html->link("仲間関係一覧",array("controller"=>"friend","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="group"){ echo $active; } ?>><?php echo $this->Html->link("登録グループ一覧",array("controller"=>"group","action"=>"index")); ?></li>
			</ul>
		</li>
		<li>
			<?php
			if($this->params["controller"]=="talk"){
				$index7=true;
			}
			?>
			<input type="checkbox" id="sub05" style="display:none" <?php if(isset($index7)){ echo $checked; } ?>>
			<label for="sub05">メッセージ管理</label>
			<ul class="sub2">
				<li <?php if($this->action=="index"){ echo $active; } ?>><?php echo $this->Html->link("メッセージフィールド一覧",array("controller"=>"talk","action"=>"index")); ?></li>
				<li <?php if($this->action=="originalmsg"){ echo $active; } ?>><?php echo $this->Html->link("コラボス運営メッセージ管理",array("controller"=>"talk","action"=>"originalmsg")); ?></li>
			</ul>
		</li>
		<li>
		<?php
			if(
			$this->params["controller"]=="keyword" || 
			$this->params["controller"]=="location" || 
			$this->params["controller"]=="skill" ||
			$this->params["controller"]=="job" || 
			$this->params["controller"]=="contentscategory" ||
			$this->params["controller"]=="groupcategory" ||
			$this->params["controller"]=="themacolor" ||
			$this->params["controller"]=="themalayout" ||
			$this->params["controller"]=="exampletext" ||
			$this->params["controller"]=="reviewlank" ||
			$this->params["controller"]=="orderstatus" ||
			$this->params["controller"]=="partystatus" ||
			$this->params["controller"]=="inputerror"
			){
				$index_db=true;
			} 
		?>
			<input type="checkbox" id="sub07" style="display:none" <?php if(isset($index_db)){ echo $checked; } ?>>
			<label for="sub07">その他設定データ管理</label>
			<ul class="sub2">
				<li <?php if($this->params["controller"]=="location"){ echo $active; } ?>><?php echo $this->Html->link("検索キーワード管理",array("controller"=>"keyword","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="location"){ echo $active; } ?>><?php echo $this->Html->link("地域管理",array("controller"=>"location","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="job"){ echo $active; } ?>><?php echo $this->Html->link("職種管理",array("controller"=>"job","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="contentscategory"){ echo $active; } ?>><?php echo $this->Html->link("共通コンテンツカテゴリー管理",array("controller"=>"contentscategory","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="themacolor"){ echo $active; } ?>><?php echo $this->Html->link("テーマカラー管理",array("controller"=>"themacolor","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="orderstatus"){ echo $active; } ?>><?php echo $this->Html->link("注文ステータス管理",array("controller"=>"orderstatus","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="partystatus"){ echo $active; } ?>><?php echo $this->Html->link("コラボ参加ステータス管理",array("controller"=>"partystatus","action"=>"index")); ?></li>
				<li <?php if($this->params["controller"]=="inputerror"){ echo $active; } ?>><?php echo $this->Html->link("入力エラー表示文章管理",array("controller"=>"inputerror","action"=>"index")); ?></li>


			</ul>
		</li>
		<li>
		<?php
			if($this->params["controller"]=="contentsdata"){
				$index_co=true;
			} 
		?>
			<input type="checkbox" id="sub10" style="display:none" <?php if(isset($index_co)){ echo $checked; } ?>>
			<label for="sub10">登録画像・ファイル管理</label>
			<ul class="sub2">
				<li <?php if(isset($index_co) && $this->params["action"]=="contentsimage"){ echo $active; } ?>><?php echo $this->Html->link("コンテンツ画像管理",array("controller"=>"contentsdata","action"=>"contentsimage")); ?></li>
				<li <?php if(isset($index_co) && $this->params["action"]=="usericon"){ echo $active; } ?>><?php echo $this->Html->link("ユーザーアイコン管理",array("controller"=>"contentsdata","action"=>"usericon")); ?></li>
				<li <?php if(isset($index_co) && $this->params["action"]=="groupicon"){ echo $active; } ?>><?php echo $this->Html->link("グループアイコン管理",array("controller"=>"contentsdata","action"=>"groupicon")); ?></li>
				<li <?php if(isset($index_co) && $this->params["action"]=="msgzip"){ echo $active; } ?>><?php echo $this->Html->link("メッセージ添付データ管理",array("controller"=>"contentsdata","action"=>"msgzip")); ?></li>
			</ul>
		</li>
		<li>
			<input type="checkbox" id="sub_logout" style="display:none">
			<label for="sub_logout">ログアウト</label>
			<ul class="sub2">
				<li><?php echo $this->Html->link("ログアウト",array("controller"=>"user","action"=>"logout")); ?></li>
			</ul>
		</li>
	</ul>
</div><!--//.sub-->
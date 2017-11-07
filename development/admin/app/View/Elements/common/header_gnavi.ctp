<style>

</style>
<div class="header_gnavi">





	<div class="bs">
		<ul>
			<li>
				<label>コンテンツ管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("コンテンツ一覧",array("controller"=>"contents","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("コンテンツ新規登録",array("controller"=>"contents","action"=>"edit")); ?></li>
				</ul>
			</li>
			<li>
				<label>緊急お役立ち管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("緊急お役立ち一覧",array("controller"=>"emergency","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("緊急お役立ち新規登録",array("controller"=>"emergency","action"=>"edit")); ?></li>
				</ul>
			</li>
			<li>
				<label>お知らせ管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("緊急お役立ち一覧",array("controller"=>"information","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("緊急お役立ち新規登録",array("controller"=>"information","action"=>"edit")); ?></li>
				</ul>
			</li>	
			<li>
				<label>その他の管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("サイト基本設定",array("controller"=>"hpset","action"=>"basic")); ?></li>
					<li><?php echo $this->Html->link("管理アカウント一覧",array("controller"=>"account","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("カテゴリー・地区管理",array("controller"=>"category","action"=>"index")); ?></li>
					<?php /*<li><?php echo $this->Html->link("フリーページ管理",array("controller"=>"freepage","action"=>"index")); ?></li>*/ ?>
				</ul>
			</li>
		</ul>
	</div>



<!--
	<div class="bs">
		<ul>
			<li>
				<label>注文・参加表明管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("注文情報一覧",array("controller"=>"order","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("コラボ参加表明情報一覧",array("controller"=>"cparty","action"=>"index")); ?></li>
				</ul>
			</li>
			<li>
				<label>支払・振込管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("支払管理",array("controller"=>"payment","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("振込管理",array("controller"=>"transferrequest","action"=>"index")); ?></li>
				</ul>
			</li>
			<li>
				<label>コラボ・ライブラリ管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("コラボ一覧",array("controller"=>"collabo","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("ライブラリ一覧",array("controller"=>"library","action"=>"index")); ?></li>
				</ul>
			</li>
			<li>
				<label>ユーザー管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("ユーザー一覧",array("controller"=>"users","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("仲間関係一覧",array("controller"=>"friend","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("登録グループ一覧",array("controller"=>"group","action"=>"index")); ?></li>
				</ul>
			</li>

			<li>
				<label for="sub05">メッセージ管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("メッセージ一覧",array("controller"=>"talk","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("運営メッセージ管理",array("controller"=>"talk","action"=>"originalmsg")); ?></li>
					<li><?php echo $this->Html->link("メールテンプレート一覧",array("controller"=>"mailtemplate","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("メールフォーマット一覧",array("controller"=>"mailformat","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("メール送信管理",array("controller"=>"mail","action"=>"index")); ?></li>

				</ul>
			</li>
			<li>
				<label for="sub06">その他の管理</label>
				<ul class="sub2">
					<li><?php echo $this->Html->link("サイト基本設定",array("controller"=>"hpset","action"=>"basic")); ?></li>
					<li><?php echo $this->Html->link("管理アカウント一覧",array("controller"=>"account","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("LP・固定ページ設定",array("controller"=>"freepage","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("インフォメーション管理",array("controller"=>"information","action"=>"index")); ?></li>
					<?php /*<li><?php echo $this->Html->link("キャンペーン管理",array("controller"=>"campaign","action"=>"index")); ?></li> */ ?>
					<li><?php echo $this->Html->link("アップロード画像・ファイル管理",array("controller"=>"filedata","action"=>"index")); ?></li>


					<li><?php echo $this->Html->link("検索キーワード管理",array("controller"=>"keyword","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("地域管理",array("controller"=>"location","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("職種管理",array("controller"=>"job","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("共通コンテンツカテゴリー管理",array("controller"=>"contentscategory","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("テーマカラー管理",array("controller"=>"themacolor","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("注文ステータス管理",array("controller"=>"orderstatus","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("コラボ参加ステータス管理",array("controller"=>"partystatus","action"=>"index")); ?></li>
					<li><?php echo $this->Html->link("入力エラー表示文章管理",array("controller"=>"inputerror","action"=>"index")); ?></li>

					<li><?php echo $this->Html->link("コンテンツ画像管理",array("controller"=>"contentsdata","action"=>"contentsimage")); ?></li>
					<li><?php echo $this->Html->link("ユーザーアイコン管理",array("controller"=>"contentsdata","action"=>"usericon")); ?></li>
					<li><?php echo $this->Html->link("グループアイコン管理",array("controller"=>"contentsdata","action"=>"groupicon")); ?></li>
					<li><?php echo $this->Html->link("メッセージ添付データ管理",array("controller"=>"contentsdata","action"=>"msgzip")); ?></li>

				</ul>
			</li>
		</ul>
	</div>

-->
	
</div><!--//.header_gnavi-->
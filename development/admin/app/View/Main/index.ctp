
<style>	

/*
.toppage_block{
	width:1200px;
	margin:0 auto;
}*/

.toppage_block li{
		display:block;
		width:100%;
		margin-bottom:20px;
}
.toppage_block li:last-child{
		margin-bottom:0px;
}
.toppage_block li h2 {
    font-size: 20px;
}
.toppage_block h2 {
    font-size: 16px;
    line-height: 1;
    padding-bottom: 8px;
    border-bottom: solid 1px #D8D8D8;
    background: none;
    height: auto;
}		
.toppage_block li .f_clear {
    margin: 10px 0px 20px;
    margin-right: -10px;
}	
.f_clear {
    overflow: hidden;
    zoom: 1;
}
.toppage_block li .f_clear p {
    float: left;
    width: 25%;
		text-align:center;
}	
.toppage_block li p a {
    border: solid 2px #999;
    padding: 10px;
    margin-bottom: 10px;
    margin-right: 10px;
    display: block;
    font-size: 15px;
}		
.f_clear:after {
    clear: both;
    display: block;
    content: "";
}	
</style>


		<div class="toppage_block">
			<ul>
				<li>
					<h2>コンテンツ管理</h2>
					<div class="f_clear">
						<p><?php echo $this->Html->link("コンテンツ一覧",array("controller"=>"contents","action"=>"index")); ?></p>
						<p><?php echo $this->Html->link("コンテンツ新規登録",array("controller"=>"contents","action"=>"edit")); ?></p>
					</div><!--//.bs-->
				</li>
				<li>
					<h2>緊急お役立ち管理</h2>
					<div class="f_clear">
						<p><?php echo $this->Html->link("緊急お役立ち一覧",array("controller"=>"emergency","action"=>"index")); ?></p>
						<p><?php echo $this->Html->link("緊急お役立ち新規登録",array("controller"=>"emergency","action"=>"edit")); ?></p>
					</div><!--//.bs-->
				</li>
				<li>
					<h2>お知らせ管理</h2>
					<div class="f_clear">
						<p><?php echo $this->Html->link("お知らせ一覧",array("controller"=>"information","action"=>"index")); ?></p>
						<p><?php echo $this->Html->link("お知らせ新規登録",array("controller"=>"information","action"=>"edit")); ?></p>
					</div><!--//.bs-->
				</li>				
				<li>
					<h2>その他管理</h2>
					<div class="f_clear">
						<p><?php echo $this->Html->link("サイト基本設定",array("controller"=>"hpset","action"=>"basic")); ?></p>
						<p><?php echo $this->Html->link("管理アカウント一覧",array("controller"=>"account","action"=>"index")); ?></p>
						<p><?php echo $this->Html->link("カテゴリー・地区管理",array("controller"=>"category","action"=>"index")); ?></p>
						<?php /*<p><?php echo $this->Html->link("フリーページ管理",array("controller"=>"freepage","action"=>"index")); ?></p>*/ ?>
					</div><!--//.bs-->
				</li>
			</ul>
		</div>

<div class="gnavi">
	<ul class="float">
		<li <?php if($this->params["action"]=="edit"){ echo 'class="active"'; }?>><?php echo $this->Html->link("会員情報編集",array("controller"=>"users","action"=>"edit",$result["User"]["id"])); ?></li>
		<li <?php if($this->params["action"]=="content"){ echo 'class="active"'; }?>><?php echo $this->Html->link("登録コラボ・ライブラリ",array("controller"=>"users","action"=>"content",$result["User"]["id"])); ?></li>
		<li <?php if($this->params["action"]=="friend"){ echo 'class="active"'; }?>><?php echo $this->Html->link("仲間一覧",array("controller"=>"users","action"=>"friend",$result["User"]["id"])); ?></li>
		<li <?php if($this->params["action"]=="group"){ echo 'class="active"'; }?>><?php echo $this->Html->link("グループ一覧",array("controller"=>"users","action"=>"group",$result["User"]["id"])); ?></li>
		<li <?php if($this->params["action"]=="message"){ echo 'class="active"'; }?>><?php echo $this->Html->link("メッセージ一覧",array("controller"=>"users","action"=>"message",$result["User"]["id"])); ?></li>
	</ul>
</div><!--//.gnavi-->
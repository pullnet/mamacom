<div class="gnavi">
	<ul class="float">
		<li <?php if($this->params["action"]=="basic"){ echo 'class="active"'; } ?>><?php echo $this->Html->link("サイト基本設定",array("controller"=>"hpset","action"=>"basic")); ?></li>
		<li <?php if($this->params["action"]=="openinfo"){ echo 'class="active"'; } ?>><?php echo $this->Html->link("公開情報設定",array("controller"=>"hpset","action"=>"openinfo")); ?></li>
		<li <?php if($this->params["action"]=="toppage"){ echo 'class="active"'; } ?>><?php echo $this->Html->link("トップページ設定",array("controller"=>"hpset","action"=>"toppage")); ?></li>
		<li <?php if($this->params["action"]=="other"){ echo 'class="active"'; } ?>><?php echo $this->Html->link("振込口座情報設定",array("controller"=>"hpset","action"=>"other")); ?></li>
		<li <?php if($this->params["action"]=="datacontrol"){ echo 'class="active"'; } ?>><?php echo $this->Html->link("データ管理",array("controller"=>"hpset","action"=>"datacontrol")); ?></li>
	</ul>
</div><!--//.gnavi-->

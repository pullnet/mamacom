<br>
<div class="login">
	<?php
	if(isset($alert)){
	?>
	<div class="alert-message"><?php echo $alert; ?></div>
	<?php	
	}
	?>
	<?php echo $this->Form->create("Adminlogin",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));
	?>
		<h2 class="mb20">管理者ログイン</h2>
		<p>ユーザー名</p>
		<p class="mb20">
		<?php echo $this->Form->input("username",array("error"=>false)); ?>
		<?php echo $this->Form->error("username"); ?>
		</p>
		<p>パスワード</p>
		<p class="mb20">
		<?php echo $this->Form->input("password",array("error"=>false)); ?>
		<?php echo $this->Form->error("password"); ?>
		</p>
		<div class="center mt20">
			<?php echo $this->Form->submit("ログイン",array("class"=>"buttons")); ?>
		</div>
		<?php
		if(@$cookie){
		?>
		<p class="center mt20"><?php echo $this->Html->link("前回のアカウントでログイン",array("controller"=>"user","action"=>"autologin","?"=>$this->request->query),array("class"=>"underline")); ?></p>
		<?php
		}
		?>
		</dl>
	<?php echo $this->Form->end(); ?>
</div><!--//.login-->
		<div class="bread">管理TOP　＞　<a href="adminaccount_list.html">管理アカウント一覧</a>　＞　管理アカウント編集</div>
			<h1>管理アカウント編集</h1>
			<div class="main_content">

				<?php echo $this->Form->create("Admin",array(
					"inputDefaults"=>array(
						"div"=>false,
						"label"=>false,
						"legend"=>false,
						"required"=>false,
					),
				)); 
				echo $this->Form->hidden("id");
				echo $this->Form->hidden("item_app_id");
				echo $this->Form->hidden("admin_number");

				?>
				
				<table cellspacing="0" cellpadding="0">
				<tr>
					<th>ユーザー名</th>
					<td colspan="3">
						<?php echo $this->Form->input("username",array("class"=>"short","error"=>false)); ?>
						<?php echo $this->Form->error("username"); ?>
					</td>
				</tr>
				<tr>
					<th>パスワード</th>
					<td colspan="3">
						<p class="mb5">
						<?php echo $this->Form->input("password_1",array("type"=>"password","class"=>"short","error"=>false)); ?>
						</p>
						<p class="mb5">※確認の為、再入力</p>
						<p>
						<?php echo $this->Form->input("password_2",array("type"=>"password","class"=>"short","error"=>false)); ?>
						</p>
						<p>
						<?php echo $this->Form->error("password_1"); ?>
						</p>
						<p>
						<?php echo $this->Form->error("password_2"); ?>
						</p>
					</td>
				</tr>
				<tr>
					<th>管理者指名</th>
					<td colspan="3">
						<?php echo $this->Form->input("name",array("class"=>"short","error"=>false)); ?>
						<?php echo $this->Form->error("name"); ?>
					</td>
				</tr>
				<tr>
				</table>

				<div class="center mt20 mb20">
					<?php echo $this->Form->submit("管理アカウントを設定する",array("class"=>"buttons short","div"=>false)); ?>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>

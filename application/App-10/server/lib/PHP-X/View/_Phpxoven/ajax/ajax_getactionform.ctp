<?php $this->Form->model="Controller"; ?>
<div class="sec mb10" index="<?php echo $index; ?>">
	<table>
	<tr>
		<th>action name</th>
		<td>
			<?php
			echo $this->Form->input("action.".$index.".name",array("class"=>"w300"));
			echo $this->Html->active(@$errors["Controller"]["action"][$index]["name"],array("class"=>"error-message"));
			?>
		</td>
	</tr>
	<tr>
		<th>private or public</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("action.".$index.".access_mode",array("public"=>"Public","private"=>"Private"),array("value"=>"Public")); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>layout</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("action.".$index.".layout",array(true=>"TRUE",false=>"False"),array("value"=>true)); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>autoRender</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("action.".$index.".autoRender",array(true=>"TRUE",false=>"False"),array("value"=>true)); ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<label class="buttons delete delete_action" index="<?php echo $index; ?>">delete action(method)</label>
		</td>
	</tr>
	</table>
</div>

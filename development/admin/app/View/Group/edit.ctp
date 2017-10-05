<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　グループ情報編集</div>
<h1>グループ情報編集</h1>
<?php
//画像アップロード用form
/*
echo $this->Form->create("senddata",array("id"=>"sendfileform"));
echo $this->Form->file("uploadicon",array("style"=>"display:none","id"=>"uploadicon"));
echo $this->Form->end();
//画像アップロード用form
<div style="display:none" id="index-usernumber"><?php echo $post["User"]["user_number"]; ?></div>
<div style="display:none" id="index-uploadimage"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"buffersave",$admindata["Admin"]["admin_number"])); ?></div>
<div style="display:none" id="index-iconedit"><?php echo $this->Html->url(array("controller"=>"jsonmethod","action"=>"iconimgedit",$admindata["Admin"]["admin_number"])); ?></div>
*/
?>

<div class="main_content">

	<?php
	echo $this->Form->create("Group",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	echo $this->Form->hidden("id");
	if(isset($user_id))
	{
		echo $this->Form->hidden("user_id",array("value"=>$user_id));
	}
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>グループ名</th>
		<td>
			<?php echo $this->Form->input("name",array("error"=>false)); ?>
			<?php echo $this->Form->error("name"); ?>
		</td>
	</tr>
	<tr>
		<th>アイコン</th>
		<td>
			<div class="iconimage mb10">
			<?php
					if(isset($this->request->data["Group"]))
					{
						if(file_exists("buffer/Admin/".$admindata["Admin"]["admin_number"]."/".$this->request->data["Group"]["icontag"]))
						{
							echo $this->Html->image(Router::url("/",true)."buffer/Admin/".$admindata["Admin"]["admin_number"]."/".$this->request->data["Group"]["icontag"],array("onerror"=>'this.src="'.Router::url("/",true).'img/iconpeople.png"',"id"=>"iconimage"));
						}
						else
						{
							echo $this->Html->image($itemurl."smpimg/groupicon/".$this->request->data["Group"]["icontag"],array("onerror"=>'this.src="'.Router::url("/",true).'img/iconpeople.png"',"id"=>"iconimage"));
						}
					}
					else
					{
						echo $this->Html->image(Router::url("/",true)."img/iconpeople.png",array("onerror"=>'this.src="'.Router::url("/",true).'img/iconpeople.png"',"id"=>"iconimage"));
					}
/*
					if(isset($post))
					{
						echo $this->Html->image($itemurl."smpimg/groupicon/".$post["Group"]["icontag"].".data",array("onerror"=>'this.src="'.Router::url("/",true).'img/icongroup.png"',"id"=>"iconimage"));
					}
					else
					{
						echo $this->Html->image(Router::url("/",true)."img/icongroup.png",array("onerror"=>'this.src="'.Router::url("/",true).'img/icongroup.png"',"id"=>"iconimage"));
					}
*/
					?>
				</div>
				<label for="bigp01" class="buttons">アイコンの設定</label>
				<?php echo $this->Form->hidden("icontag",array("id"=>"icontag")); ?>
				<?php echo $this->Form->error("icontag"); ?>
		</td>
	</tr>
	<tr>
		<th>グループURL</th>
		<td>
			<?php echo $this->Form->input("permalink",array("class"=>"short","error"=>false)); ?>
			<?php echo $this->Form->error("permalink"); ?>
		</td>
	</tr>
	<tr>
		<th>グループカテゴリー</th>
		<td>
			<?php echo $this->Form->select("groupcategory_id",$groupcategory,array("class"=>"short","empty"=>false)); ?>
		</td>
	</tr>
	<tr>
		<th>ステータス</th>
		<td>
			<div id="swradio">
				<?php echo $this->Form->radio("group_status",$group_status,array("legend"=>false,"default"=>0)); ?>
			</div>
		</td>
	</tr>
	<tr>
		<th>概要</th>
		<td>
			<?php echo $this->Form->textarea("caption",array("class"=>"high")); ?>
		</td>
	</tr>
	<tr>
		<th>グループリーダー</th>
		<td>
			<?php
			if(isset($user_nickname)){
				echo $this->Form->hidden("leader_user_id",array("value"=>$user_id));
				echo $user_nickname;
			}
			else
			{
				echo $this->Form->select("leader_user_id",$userlist,array("empty"=>"----未設定----","required"=>false));
				echo $this->Form->error("leader_user_id");
			}
			?>
		</td>
	</tr>

	</table>
	<div class="center mb20">
		<?php echo $this->Form->submit("グループ情報を設定する",array("class"=>"short","div"=>false)); ?>
	</div>

	<?php echo $this->Form->end(); ?>
</div>


<?php
//※アイコン編集セットはコチラ↓
echo $this->element("users/iconedit_block");
?>

<?php
/*

<div id="popup">
	<input type="checkbox" class="checks" id="bigp01">
	<label></label>
	<div class="basejavar"></div>
	<div class="window usersettingicon">
		<div class="bs">
			<h1>アイコン編集</h1>
			<p>アイコン画像のトリミングする部分を設定して下さい</p>
			<ul class="table">
				<li>
					<div class="squrea">
						<div class="bse" id="buff_trims">
							<img src="" id="buffer_iconimage">
						</div>
					</div>
				</li>
				<li>
					<div id="buff_icontrimview">横=0,縦=0</div>
					<p>拡大倍率</p>
					<div id="buff_iconzoomvalue_view">100%</div>
					<div class="gages" id="buffer_iconzoomvalue">
						<div class="value"></div>
					</div><!--//gages-->
					<?php echo $this->Form->create("buffer",array("id"=>"editbufferdata")); ?>
					<?php echo $this->Form->hidden("buffer_icontag",array("id"=>"buffer_icontag")); ?>
					<?php echo $this->Form->hidden("buffer_icontag_trim_left",array("id"=>"buffer_icontag_trim_left","value"=>"0")); ?>
					<?php echo $this->Form->hidden("buffer_icontag_trim_top",array("id"=>"buffer_icontag_trim_top","value"=>"0")); ?>
					<?php echo $this->Form->hidden("buffer_icontag_zoom",array("id"=>"buffer_icontag_zoom","value"=>"100")); ?>
					<?php echo $this->Form->end(); ?>
					<div class="center">
						<label for="bigp01" class="buttons">キャンセル</label>
						<a class="buttons" id="buffer_iconedit_btn">アイコン決定</a>
					</div>
				</li>
			</ul>

		</div>
	</div><!--//.window-->
</div><!--//#popup-->

<script type="text/javascript">
$(function(){
	//アイコントリム・拡大用JS

	//トリム場所を指定
	$("#buff_trims").on("scroll",function(){
		var trim_left=parseInt($("#buff_trims").scrollLeft()/$("#buffer_iconimage").width()*100);
		var trim_top=parseInt($("#buff_trims").scrollTop()/$("#buffer_iconimage").height()*100);
		$("#buff_icontrimview").text("横="+trim_left+",縦="+trim_top);

		$("#buffer_icontag_trim_left").val(trim_left);
		$("#buffer_icontag_trim_top").val(trim_top);
	});
	//拡大率を指定
	$("#buffer_iconzoomvalue").on("mousemove",function(event){
		var p_left=parseInt(event.clientX-$(this).offset().left)/$(this).width()*300;
		$("#buff_iconzoomvalue_view").text((parseInt(p_left)+100)+"%");
		$("#buffer_iconzoomvalue .value").css("width",p_left/3+"%");
		$("#buffer_iconimage").css("width",(p_left)+100+"%");

		$("#buffer_icontag_zoom").val(p_left+100);
	});

	//トリミングしたアイコンで決定！
	$("#buffer_iconedit_btn").on("click",function(){
		iconedit();
	});
	function iconedit()
	{
		$.ajax({
			url:$("#index-iconedit").text(),
			method: "POST",
			processData: false,
			contentType: false,
			data:new FormData($("#editbufferdata").get(0)),
			success:function(data){
				var result=JSON.parse(data);
				var dst=new Date();
				$("#bigp01").click();

				$("#iconimage").attr("src",result.url+"?"+dst.getTime());
				$("#icontag").val(result.number);
			},
		});
	}

});
</script>
*/
?>
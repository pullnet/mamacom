<?php echo $this->Html->script("pullcalender/calender.js"); ?>
<?php echo $this->Html->css("/js/pullcalender/calender.css"); ?>


<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link($result_content["Content"]["title"]."の詳細",array("controller"=>"collabo","action"=>"view",$result_content["Content"]["id"])); ?>
　＞　<?php echo $this->Html->link("コラボ参加設定一覧",array("controller"=>"collabo","action"=>"partysetlist",$result_content["Content"]["id"])); ?>　＞　コラボ参加設定編集
</div>
<h1>コラボ参加設定編集</h1>
<div class="main_content">
	
	<?php
	echo $this->Form->create("Collabopartyset",array(
		"inputDefaults"=>array(
			"div"=>false,
			"label"=>false,
			"legend"=>false,
			"required"=>false,
		),
	));

	echo $this->Form->hidden("id");
	echo $this->Form->hidden("content_id");
	echo $this->Form->hidden("number");
	
	?>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>公開ステータス</th>
		<td>
			<?php echo $this->Form->select("open_status",$open_status,array("class"=>"short","empty"=>false)); ?>
		</td>
	</tr>
	<?php
	if(isset($post))
	{
	?>
	<tr>
		<th>管理番号</th>
		<td>
			<?php echo $post["Collabopartyset"]["number"]; ?>
		</td>
	</tr>
	<?php
	}
	?>
	<tr>
		<th>参加表明タイトル</th>
		<td>
			<?php echo $this->Form->input("title",array("error"=>false)); ?>
			<?php echo $this->Form->error("title"); ?>
		</td>
	</tr>
	<tr>
		<th>参加の種類</th>
		<td>
			<?php echo $this->Form->select("contentscategory_id",$contentscategory,array("class"=>"short","empty"=>false,"error"=>false)); ?>
			<?php echo $this->Form->error("contentscategory_id"); ?>
		</td>
	</tr>
	<tr>
		<th>参加予定人数</th>
		<td>
			<?php echo $this->Form->input("max_people",array("class"=>"mini")); ?> 人
		</td>
	</tr>
	<tr>
		<th>募集期間</th>
		<td>
			<p class="mb5">募集開始日</p>
			<p class="mb5"><?php echo $this->Form->input("start_opendate",array("type"=>"text","class"=>"short","id"=>"startdate")); ?></p>
			<div id="calender_startdate" style="max-width:420px;margin:20px 0px"></div>
			<p class="mb5">募集締切日</p>
			<p><?php echo $this->Form->input("exit_opendate",array("type"=>"text","class"=>"short","error"=>false,"id"=>"exitdate")); ?></p>
			<div id="calender_exitdate" style="max-width:420px;margin:20px 0px"></div>
			<?php echo $this->Form->error("exit_opendate"); ?>
			<script type="text/javascript">
			$(function(){
				//休日設定
				var holidaydata=[
							[0,1,1],//元日(1月1日)
							[0,1,0,2,1],//成人の日(1月の２週目の月曜日)
							[0,2,11],//建国記念日(2月11日)
							[0,3,21],//春分の日(3月21日)
							[0,4,29],//昭和の日(4月29日)
							[0,5,3],//憲法記念日(5月3日)
							[0,5,4],//みどりの日(5月4日)
							[0,5,5],//こどもの日(5月5日)
							[0,7,0,3,1],//海の日(7月の3週目の月曜日)
							[0,9,21],//敬老の日(9月21日)
							[0,9,22],//国民の休日
							[0,9,23],//文化の日
							[0,10,0,2,1],//体育の日(10月の2週目の月曜日)
							[0,11,3],//文化の日(11月3日)
							[0,11,23],//勤労感謝の日(11月23日)
							[0,12,23],//天皇誕生日(12月23日)
						];
						set_calender({
							holiday:holidaydata,
							id:"calender_startdate",
							input:"startdate",
							open:"startdate",
							output:"startdate",
						});
						set_calender({
							holiday:holidaydata,
							id:"calender_exitdate",
							input:"exitdate",
							open:"exitdate",
							output:"exitdate",
						});

			});
			</script>
			
		</td>
	</tr>
	<tr>
		<th>予算(報酬額)</th>
		<td>
				<p class="mb5">下限金額：</p>
				<p class="mb5"><?php echo $this->Form->input("min_price",array("class"=>"short","error"=>false)); ?> 円</p>
				<p class="mb5">上限金額：</p>
				<p><?php echo $this->Form->input("max_price",array("class"=>"short","error"=>false)); ?> 円</p>
				<?php echo $this->Form->error("min_price"); ?>
		</td>
	</tr>
	</table>

	<h2>オプション情報</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>コラボ参加の種類</th>
		<td>
			<?php echo $this->Form->select("party_type",$party_status,array("class"=>"short","empty"=>false)); ?>
		</td>
	</tr>
	<tr>
		<th>納品形態</th>
		<td>
			<?php echo $this->Form->select("output_type",$output_status,array("class"=>"short","empty"=>false)); ?>
		</td>
	</tr>
	<tr>
		<th>参加表明の概要</th>
		<td colspan="3">
			<?php echo $this->Form->textarea("caption",array("class"=>"high")); ?>
		</td>
	</tr>
	</table>

	<div class="center mb20">
		<?php echo $this->Form->submit("参加情報を設定する",array("class"=>"short","div"=>false)); ?>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
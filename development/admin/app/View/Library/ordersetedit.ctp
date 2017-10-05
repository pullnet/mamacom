<?php echo $this->Html->script("pullcalender/calender.js"); ?>
<?php echo $this->Html->css("/js/pullcalender/calender.css"); ?>

<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>　＞　<?php echo $this->Html->link($result_content["Content"]["title"]."の詳細",array("controller"=>"library","action"=>"view",$result_content["Content"]["id"])); ?>
　＞　<?php echo $this->Html->link("受注設定一覧",array("controller"=>"library","action"=>"ordersetlist",$result_content["Content"]["id"])); ?>　＞　受注設定編集
</div>
<h1>受注設定編集</h1>
<div class="main_content">

	<?php echo $this->Form->create("Libraryorderset",array(
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
			<?php echo $this->Form->select("open_status",$open_status,array("empty"=>false,"class"=>"short","error"=>false)); ?>
			<?php echo $this->Form->error("open_status"); ?>
		</td>
	</tr>
	<?php
	if(isset($post))
	{
	?>
	<tr>
		<th>管理番号</th>
		<td>
			<?php echo $post["Libraryorderset"]["number"]; ?>
		</td>
	</tr>
	<?php
	}
	?>
	<tr>
		<th>受注タイトル</th>
		<td>
			<?php echo $this->Form->input("title",array("error"=>false)); ?>
			<?php echo $this->Form->error("title"); ?>
		</td>
	</tr>
	<tr>
		<th>カテゴリー</th>
		<td>
			<?php echo $this->Form->select("contentscategory_id",$contentscategory,array("class"=>"short","empty"=>false)); ?>
		</td>
	</tr>
	<tr>
		<th>発注可能個数</th>
		<td>
			<?php echo $this->Form->input("enable_count",array("class"=>"mini")); ?> 個
		</td>
	</tr>
	<tr>
		<th>受付期間</th>
		<td>
			<p class="mb5">開始日</p>
			<p class="mb5"><?php echo $this->Form->input("start_order_date",array("class"=>"short","error"=>false,"type"=>"text","id"=>"startdate")); ?></p>
			<div id="calender_startdate" style="max-width:420px;margin:20px 0px"></div>
			<p class="mb5">終了日</p>
			<p><?php echo $this->Form->input("exit_order_date",array("class"=>"short","error"=>false,"type"=>"text","id"=>"exitdate")); ?></p>
			<div id="calender_exitdate" style="max-width:420px;margin:20px 0px"></div>
			<?php echo $this->Form->error("start_order_date"); ?>
			<?php echo $this->Form->error("exit_order_date"); ?>


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
		<th>予定納期</th>
		<td>
			<?php echo $this->Form->text("enable_day",array("class"=>"short")); ?> 日
		</td>
	</tr>
	<tr>
		<th>販売価格</th>
		<td>
			<p class="mb5">最少価格</p>
			<p class="mb5"><?php echo $this->Form->input("price_min",array("class"=>"short","error"=>false)); ?> 円</p>
			<p class="mb5">最大価格</p>
			<p><?php echo $this->Form->input("price_max",array("class"=>"short")); ?> 円</p>
			<?php echo $this->Form->error("price_min"); ?>
		</td>
	</tr>
	</table>
	
	<h2>オプション情報</h2>
	<table cellspacing="0" cellpadding="0" class="mb20">
	<tr>
		<th>ライブラリ提供の種類</th>
		<td>
			<?php echo $this->Form->select("order_type",$order_type,array("empty"=>"--未選択--","class"=>"short","error"=>false,"required"=>false)); ?>
			<?php echo $this->Form->error("order_type"); ?>
		</td>
	</tr>
	<tr>
		<th>納品形態</th>
		<td>
			<?php echo $this->Form->select("output_type",$output_type,array("empty"=>"--未選択---","class"=>"short","error"=>false,"required"=>false)); ?>
			<?php echo $this->Form->error("output_type"); ?>
		</td>
	</tr>
	<tr>
		<th>その他備考・概要</th>
		<td>
			<?php echo $this->Form->textarea("caption",array("required"=>false,"class"=>"high","error"=>false)); ?>
			<?php echo $this->Form->error("caption"); ?>
		</td>
	</tr>
	</table>
	
	<div class="center mb20">
		<?php echo $this->Form->submit("受注設定を更新する",array("div"=>false,"class"=>"short")); ?>
	</div>
<?php echo $this->Form->end(); ?>
</div>

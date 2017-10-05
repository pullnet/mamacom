<h2 class="mb10">注文情報一覧</h2>


	<p>※<span style="background:#fcc;width:10px;height:10px;display:inline-block;"></span>部分....新規の注文情報</p>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th style="width:20px">No</th>
		<th style="width:140px">発注日/注文番号</th>
		<th style="width:200px">納品/振込依頼/振込完了日</th>
		<th style="width:200px">受注額/支払/ステータス</th>
		<th>発注内容</th>
		<th style="width:150px">発注者/受注者</th>
	</tr>
	<?php
	$count=0;
	foreach($result_order as $r_){
		$count++;

		//各日付の取得...
	?>
	<tr class="
		<?php
		if($r_["Order"]["order_status"]=="neworder"){
			echo "bg_pink";
		}
		else if($r_["Order"]["order_status"]=="transfer_complete"){
			echo "bg_gray";
		}
		?>">
		<td class="center"><?php echo $count; ?></td>
		<td><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["order_date"])); ?><br>
			<?php echo $this->Html->link(h($r_["Order"]["number"]),array("controller"=>"order","action"=>"detail",$r_["Order"]["id"]),array("class"=>"underline")); ?></td>
		</td>
		<td>
		<?php
		if(@$r_["Order"]["forward_date"]){
			echo "<p><span style='background:#cfc;'>納品</span>".date("Y-m-d H:i",strtotime($r_["Order"]["forward_date"]))."</p>";
		}
		if(@$r_["Order"]["claim_startdate"]){
			echo "<p><span style='background:#fcc;'>振込</span>".date("Y-m-d H:i",strtotime($r_["Order"]["claim_startdate"]))."</p>";
		}
		if(@$r_["Order"]["claim_exitdate"]){
			echo "<p><span style='background:#aaa'>振完</span>:".date("Y-m-d H:i",strtotime($r_["Order"]["claim_exitdate"]))."</p>";
		}

		if(@$r_["Order"]["claim_startdate"]){
			if(!@$r_["Order"]["claim_exitdate"]){
				if(date("d")<15){
					$claim_exitdate_plan=date("Y-m-t");
				}
				else
				{
					if(date("d")==31){
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 day"));
					}
					else
					{
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 month"));
					}
				}
			?>
			<p class="red"><span style="background:#c00;color:#fff">振予</span><?php echo date("Y-m-d",strtotime($claim_exitdate_plan)); ?><p>
			<?php
			}
		}
		?>
		</td>
		<td>
			￥<?php echo number_format($r_["Order"]["hope_price"]); ?><br>
			<?php
			if($r_["Order"]["payment"]==4){
				echo '<p style="color:#c00;">'.$payment[$r_["Order"]["payment"]]."</p>";
	;
			}
			else
			{
				echo $payment[$r_["Order"]["payment"]];

			}
			?><br>

			<p><?php echo $orderstatus[$r_["Order"]["order_status"]]; ?></p>
			<?php
			if($r_["Order"]["sendmail_status"]==1){
			?>
				<p class="red">メール未送信</p>
			<?php
			}
			?>

		</td>
		<td>
			<?php
			if($r_["Order"]["libraryorderset_id"]){
			?>
			<dl>
				<dt>発注ライブラリ名</dt>
				<dd style="margin-bottom:0px;"><?php echo h($r_["Contentbuffer"]["Content"]["title"]); ?><br>
				<?php echo h($r_["Contentbuffer"]["Libraryorderset"]["title"]); ?></dd>
			</dl>
			<?php
			}
			else if($r_["Order"]["collaboparty_id"]){
			?>
			<dl>
				<dt>参加コラボ名</dt>
				<dd style="margin-bottom:0px;"><?php echo h($r_["Contentbuffer"]["Content"]["title"]); ?><br>
				<?php echo h($r_["Contentbuffer"]["Collabopartyset"]["title"]); ?></dd>
			</dl>
			<?php
			}
			?>

		</td>
		<td>
			<?php
				echo h($r_["User"]["nickname"]);
			?>
/
			<?php
				echo h($r_["Inputuser"]["nickname"]);
			?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
	<div class="center">
		<?php echo $this->Html->link("もっと見る",array("controller"=>"order","action"=>"index"),array("class"=>"underline")); ?>
	</div>

	<h2>支払状況一覧</h2>
	<p class="mb10">※<span style="background:#f0f0f0;width:10px;height:10px;display:inline-block"></span>部分....すでに支払確認済みの受注情報</p>
	<table cellspacing="0" cellpadding="0" class="list mb20">
	<tr>
		<th style="width:20px">✓</th>
		<th style="width:140px">発注日/注文番号</th>
		<th style="width:150px">支払/ステータス</th>
		<th style="width:80px">請求金額</th>
		<th style="width:200px">納品日/振込日/支払日</th>
		<th>発注タイトル</th>
		<th style="width:150px">発注者/受注者</th>
	</tr>
	<?php
	$count=0;
	foreach($result_payment as $r_){
		$count++;


		$class="";
		if(@$r_["Order"]["payment_startdate"]){
			$class="background:#f0f0f0;";
		}
		if(@$r_["Order"]["payment_exitdate"]){
			$class="background:#d0d0d0;";
		}
	?>
	<tr style="<?php echo $class; ?>">
		<td class="center">
			<?php echo $count; ?>
		</td>
		<td>
			<?php echo date("Y-m-d H:i",strtotime($r_["Order"]["order_date"])); ?><br>
			<?php echo $this->Html->link(h($r_["Order"]["number"]),array("controller"=>"order","action"=>"detail",$r_["Order"]["id"]),array("class"=>"underline")); ?>
		</td>
		<td>
			<?php echo $payment[$r_["Order"]["payment"]]; ?><br>
			<?php
				if(!@$r_["Order"]["payment_startdate"] && !@$r_["Order"]["payment_exitdate"]){
					echo "未入金";
				}
				else if(@$r_["Order"]["payment_startdate"] && !@$r_["Order"]["payment_exitdate"]){
					echo "請求中";
				}
				else if(@$r_["Order"]["payment_startdate"] && @$r_["Order"]["payment_exitdate"]){
					echo "入金済み";
				}
			?>

		</td>
		<td>￥<?php echo number_format($r_["Order"]["hope_price"]*$r_["Order"]["order_count"]); ?></td>
		<td>
		<?php
		if(@$r_["Order"]["forward_date"]){
			echo "<p><span style='background:#cfc;'>納品</span>".date("Y-m-d",strtotime($r_["Order"]["forward_date"]))."</p>";
		}
		if(@$r_["Order"]["payment_startdate"]){
			echo "<p>請求".date("Y-m-d",strtotime($r_["Order"]["payment_startdate"]))."</p>";
		}
		if(@$r_["Order"]["payment_exitdate"]){
			echo "<p>支払".date("Y-m-d",strtotime($r_["Order"]["payment_exitdate"]))."</p>";
		}
		if(@$r_["Order"]["claim_startdate"]){
		?>
		<p><span style="background:#fcc;">振込</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["claim_startdate"])); ?></p>
			<?php
			if(!@$r_["Order"]["claim_exitdate"]){
				if(date("d")<15){
					$claim_exitdate_plan=date("Y-m-t");
				}
				else
				{
					if(date("d")==31){
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 day"));
					}
					else
					{
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 month"));
					}
				}
			?>
			<p class="red"><span style="background:#c00;color:#fff;">振予</span><?php echo date("Y-m-d",strtotime($claim_exitdate_plan)); ?></p>
			<?php
			}
		}
		if(@$r_["Order"]["claim_exitdate"]){
		?>
		<p><span style="background:#aaa">振完</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["claim_exitdate"])); ?></p>
		<?php
		}
		?>
		</td>
		<td>
			<p>請求先:<?php echo $r_["Outputuser"]["nickname"]; ?></p>
			<p>発注タイトル:<?php echo h($r_["Contentbuffer"]["Content"]["title"]); ?></p>
		</td>
		<td>
			<?php echo $r_["Outputuser"]["nickname"];; ?>/<?php echo $r_["Inputuser"]["nickname"];; ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

	<div class="center">
		<?php echo $this->Html->link("もっと見る",array("controller"=>"payment","action"=>"index"),array("class"=>"underline")); ?>
	</div>

	<h2>振込状況一覧</h2>
	<p class="mb10">※<span style="background:#e0e0e0;width:10px;height:10px;display:inline-block"></span>部分....すでに振込済みの受注情報</p>
	<table cellspacing="0" cellpadding="0" class="tables list mb30">
	<tr>
		<th style="width:20px">✓</th>
		<th style="width:140px">振込依頼日/注文番号</th>
		<th style="width:150px">振込金額/振込状況</th>
		<th style="width:200px">受注日／納品日／検品日</th>
		<th>注文内容</th>
		<th style="width:150px">振込先情報</th>
		<th style="width:150px">発注者/受注者</th>
	</tr>
	<?php
	$count=0;
	foreach($result_transfer as $r_){
		$cd_data=json_decode($r_["Contentbuffer"]["buffer"],true);

		$count++;
	?>
	<tr style="background:<?php if($r_["Order"]["order_status"]=="transfer_complete"){ echo "#e0e0e0";} ?>">
		<td class="center">
			<?php
			if($r_["Order"]["order_status"]=="transfer_request"){
			?>
			<label>
				<?php echo $this->Form->input("Order.check.".$count,array("type"=>"checkbox","class"=>"middle","value"=>$r_["Order"]["id"])); ?>
				<span style="margin-right:0px"></span>
			</label>
			<?php
			}
			?>
		</td>
		<td>
			<?php 
			if($r_["Order"]["claim_startdate"]){
				echo date("Y-m-d H:i",strtotime($r_["Order"]["claim_startdate"]));
			}
			?><br>
			<?php echo $this->Html->link(h($r_["Order"]["number"]),array("controller"=>"order","action"=>"detail",$r_["Order"]["id"]),array("class"=>"underline")); ?>
		</td>
		<td>
			<?php
			if($r_["Order"]["order_status"]=="transfer_complete"){
			?>
			<p class="h3"><?php echo "￥".number_format(($r_["Order"]["hope_price"]*$r_["Order"]["order_count"])*(1-$commission*0.01)); ?></p>
			<?php
			}
			else
			{
			?>
			<p class="h3 red"><?php echo "￥".number_format(($r_["Order"]["hope_price"]*$r_["Order"]["order_count"])*(1-$commission*0.01)); ?></p>
			<?php
			}
			?>
			<p>支払金額:<?php echo "￥".number_format($r_["Order"]["hope_price"]*$r_["Order"]["order_count"]); ?></p>
			<?php
			if($r_["Order"]["order_status"]=="transfer_request"){
				echo "<span class='red'>未振込</span>";
			}
			else if($r_["Order"]["order_status"]=="transfer_complete"){
				echo "振込済み";
			}
			?>
		</td>
		<td>
			<p><span style="background:#fcc;">受注</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["order_date"])); ?></p>
			<p><span style="background:#cfc;">納品</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["pre_forward_date"])); ?></p>
			<p><span style="background:#aef;">検品</span><?php echo date("Y-m-d H:i",strtotime($r_["Order"]["forward_date"])); ?></p>
			<?php
			if(!@$r_["Order"]["claim_exitdate"]){
				if(date("d")<15){
					$claim_exitdate_plan=date("Y-m-t");
				}
				else
				{
					if(date("d")==31){
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 day"));
					}
					else
					{
						$claim_exitdate_plan=date("Y-m-1",strtotime("+1 month"));
					}
				}
			?>
			<p class="red"><span style="background:#c00;color:#fff">振予</span><?php echo date("Y-m-d",strtotime($claim_exitdate_plan)); ?></p>
			<?php
			}
			?>

		</td>
		<td>
			<p>種類:
			<?php
			if($r_["Order"]["libraryorderset_id"]){
				echo "ライブラリ発注";
			}
			else if($r_["Order"]["collaboparty_id"]){
				echo "コラボ参加";
			}
			?>
			</p>
			<p><?php echo h($cd_data["Content"]["title"]); ?></p>
			<p><?php
			if($r_["Order"]["libraryorderset_id"]){
				echo h($cd_data["Libraryorderset"]["title"]);
			}
			else if($r_["Order"]["collaboparty_id"]){
				echo h($cd_data["Collabopartyset"]["title"]);
			}
			?>
			</p>
		</td>
		<td>
			<?php
			$paydata=json_decode($r_["Inputuser"]["paypool_json"],true);
			if(@$paydata["name"] && @$paydata["number"]){
			?>
			<p><strong>銀行名:</strong><?php echo h(@$paydata["name"]); ?></p>
			<p><strong>支店名:</strong><?php echo h(@$paydata["area"]); ?></p>
			<p><strong>口座種別:</strong><?php if(@$paydata["type"]==0){ echo "普通"; }else if($paydata["type"]==1){ echo "当座"; } ?></p>
			<p><strong>口座番号:</strong><?php echo h(@$paydata["number"]); ?></p>
			<p><strong>口座名義:</strong><?php echo h(@$paydata["user"]); ?></p>
			<?php
			}
			else
			{
			?>
				<p>振込先未設定</p>
			<?php
			}
			?>
		</td>
		<td>
			<?php echo $r_["Outputuser"]["nickname"]."/".$r_["Inputuser"]["nickname"];; ?>
		</td>
	</tr>
	<?php
	}
	?>
	</table>

	<div class="center">
		<?php echo $this->Html->link("もっと見る",array("controller"=>"transferrequest","action"=>"index"),array("class"=>"underline")); ?>
	</div>

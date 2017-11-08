<div class="two_colum">
	<div class="side">
		<div class="header_dmy"></div>
		<?php echo $this->Part_lib("sidenav_document"); ?>
	</div>
	<div class="main">
		<div class="header_dmy"></div>
		<div class="m10">
			<h1 class="mtitle mb20">database reference detail</h1>

			<table>
			<tr>
				<th class="middle">Table name</th>
				<td colspan="3" class="h4"><?php echo $params_table["name"]; ?></td>
			</tr>
			<tr>
				<th>title</th>
				<td><?php echo $params_table["title"]; ?></td>
				<th>Schema</th>
				<td><?php echo $params_table["Schema"]; ?></td>
			</tr>
			<tr>
				<th>create user</th>
				<td><?php echo nl2br($params_table["create_user"]); ?></td>
				<th>create date</th>
				<td><?php echo nl2br($params_table["create_date"]); ?></td>
			</tr>
			<tr>
				<th>caption</th>
				<td colspan="3"><?php echo nl2br($params_table["caption"]); ?></td>
			</tr>

			<tr>
				<th colspan="4">Table Colum</th>
			</tr>
			<tr>
				<td colspan="4">
					<style>
					#defcolum_view:checked~table tr.def_colum{
						display:none;
					}
					table tr.def_colum{
						background:#eef;
					}
					</style>
					<script type="text/javascript">
					$(function(){
						defcolum();
						$("#defcolum_view").on("change",function(){
							defcolum();


						});
						function defcolum(){
							if($("#defcolum_view:checked").val()){
								var counter=0;
								for(var uss=0;uss<$("#defcolum_view~table tr:not(.def_colum)").length;uss++){
									counter++;
									$("#defcolum_view~table tr:not(.def_colum) td:first-child").eq(uss).text(counter);
								}
							}
							else
							{
								var counter=0;
								for(var uss=0;uss<$("#defcolum_view~table tr").length;uss++){
									counter++;
									$("#defcolum_view~table tr td:first-child").eq(uss).text(counter);
								}

							}
						}
					});
					</script>
					<div class="mb10 no_printed">
						<label for="defcolum_view" class="buttons">default colum view</label>
					</div>

					<input type="checkbox" id="defcolum_view" class="hidden" checked>
					<div class="mb10">
						<p class="inline-block mr10">※<span class="bg_pink">　</span>....primary key</p>
						<p class="inline-block mr10">※<span style="background:#eef">　</span>....database default colum.</p>
						<p class="inline-block mr10">※AI....Auto Increment.</p>
						<p class="inline-block mr10">※PK....Primary Key.</p>
						<p class="inline-block mr10">※NN....Not Null.</p>
						<p class="inline-block mr10">※DV....Default Value.</p>
					</div>
					<table class="list">
					<tr>
						<th rowspan="2" class="w50">No</th>
						<th rowspan="2" class="w150">title</th>
						<th rowspan="2" class="w150">name</th>
						<th rowspan="2" class="w150">type</th>
						<th colspan="4" style="padding:2px 0px">option</th>
						<th rowspan="2">comment</th>
					</tr>
					<tr>
						<th class="w50" style="padding:2px 0px">PK</th>
						<th class="w50" style="padding:2px 0px">AI</th>
						<th class="w50" style="padding:2px 0px">NN</th>
						<th class="w50" style="padding:2px 0px">DV</th>
					</tr>
					<?php
					$count=0;
					foreach($params_table["Table"] as $table_name=>$p_){
						$count++;
						$def_colum=false;
						foreach($params_default[$dbname]["default"] as $table_name2=>$p0_){
							if($table_name2==$table_name){
								$def_colum=true;
								break;
							}
						}
					?>
					<tr class="<?php if(@$p_["primary_key"]){ echo "bg_pink"; } ?> <?php if($def_colum){ echo "def_colum"; } ?>">
						<td class="center"><?php echo $count; ?></td>
						<td><?php echo $p_["name"]; ?></td>
						<td><?php echo $table_name; ?></td>
						<td>
							<?php echo $p_["type"];
							if(@$p_["length"]){ echo "[".@$p_["length"]."]"; } ?>
						</td>
						<td class="center"><?php if(@$p_["primary_key"]){ echo "●"; } ?></td>
						<td class="center"><?php if(@$p_["auto_increment"]){ echo "●"; } ?></td>
						<td class="center"><?php if(@$p_["not_null"]){ echo "●"; } ?></td>
						<td><?php echo @$p_["default"]; ?></td>
						<td>
							<?php echo nl2br(h(@$p_["comment"])); ?>
						</td>
					</tr>
					<?php
					}
					?>

					</table>
				</td>
			</tr>
			</table>

			<div class="no_printed mt40">
				<h2>SQL code</h2>
				<div style="background:#444;padding:20px;padding-bottom:10px;" class="mb20"><p style="color:#fff" class="h4"><?php echo nl2br($sql_code); ?></p></div>
			</div>
		</div>
	</div>
</div>
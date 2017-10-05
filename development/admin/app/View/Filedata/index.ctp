<div class="bread"><?php echo $this->Html->link("管理TOP","/"); ?>＞ページ用画像・ファイル管理</div>
<h1>ページ用画像・ファイル管理</h1>
<div class="main_content">

<style>
.file_controlpanel{
	border:solid 1px #ccc;
	height:600px;
	overflow:auto;
}
.file_controlpanel table .goback td{
	padding-left:10px;
}
.file_controlpanel table tr th,
.file_controlpanel table tr td{
	border:none;
	padding:5px 0px;
	text-align:center;
	width:auto;
}
.file_controlpanel table tr th{
	text-align:center;
}
.file_controlpanel table tr td.left{
	text-align:left !important;
}
.file_controlpanel table tr th.micro{
	width:60px;
}
.file_controlpanel table tr th.mini{
	width:100px;
}
.file_controlpanel table tr th.short{
	width:170px;
}
.file_controlpanel table tr{
	cursor:pointer;
	border-bottom:dashed 1px #ccc;
}
.file_controlpanel .path{
	padding:5px;
}
.file_controlpanel .contextmenu{
	display:none;
	background:#fff;
	position:fixed;
	border:solid 1px #ccc;
	padding:7px;
}
.file_controlpanel .contextmenu p{
	padding:7px 10px;
}
.file_controlpanel .contextmenu hr{
	border:none;
	border-bottom:solid 1px #ccc;
}
</style>

<div class="file_controlpanel">
	<p class="path">PATH : <span class="url"></span></p>

	<div class="html"></div>
	<div class="contextmenu dir">
		<p><label for="dir_rename">ディレクトリ名を変更</label></p>
		<p><label for="dir_delete">ディレクトリを削除</label></p>
		<hr>
		<p><label for="dir_geturl">URLを取得</label></p>
	</div>
	<div class="contextmenu file">
		<p><label for="file_rename">ファイル名を変更</label></p>
		<p><label for="file_delete">ファイルを削除</label></p>
		<hr>
		<p><label for="file_geturl">URLを取得</label></p>
	</div>
	<div class="contextmenu other">
		<p><label for="dir_new">ディレクトリを作成</label></p>
		<p><label for="file_upload">ファイルをアップロード</label></p>
		<hr>
		<p><label class="dir_refresh">最新の情報に更新</label></p>
	</div>
</div>
</div>

<div id="url_domainurl" style="display:none"><?php echo $itemurl; ?></div>
<div id="url_directorypath" style="display:none">origin</div>
<div id="url_dir_view" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"dir_view")); ?></div>
<div id="url_dir_make" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"dir_make")); ?></div>
<div id="url_file_buffer" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"file_buffer")); ?></div>
<div id="url_file_upload" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"file_upload")); ?></div>
<div id="url_file_delete" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"file_delete")); ?></div>
<div id="url_dir_delete" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"dir_delete")); ?></div>
<div id="url_dir_rename" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"dir_rename")); ?></div>
<div id="url_file_rename" style="display:none"><?php echo $this->Html->url(array("controller"=>"filedata","action"=>"file_rename")); ?></div>

<form id="dir_new_form">
<div id="popup">
	<input type="checkbox" id="dir_new" class="checks">
	<label></label>
	<label for="dir_new" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				ディレクトリ新規追加
				<label for="dir_new" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<p>作成するディレクトリ名</p>
					<input type="text" name="data[directory_name]">
					<input type="hidden" name="data[path]" value="" class="hidden_dir_path">
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="dir_new" class="buttons backbtn clearbtn">キャンセル</label></li>
					<li class="f_right"><a class="buttons clearbtn" id="btn_dir_name">作成する</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//#popup-->
</form>

<form id="file_upload_form" enctype="multipart/form-data">
<div id="popup">
	<input type="checkbox" id="file_upload" class="checks">
	<label></label>
	<label for="file_upload" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				ファイルをアップロード
				<label for="file_upload" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<p>アップロード予定のファイル</p>
					<input type="file" name="data[uploadfile]" id="file_buffer" multiple="multiple">
					<input type="hidden" name="data[path]" value="" class="hidden_dir_path">
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="file_upload" class="buttons backbtn clearbtn">キャンセル</label></li>
					<li class="f_right"><a class="buttons clearbtn" id="btn_file_upload">アップロードする</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//#popup-->
</form>

<form id="file_delete_form" enctype="multipart/form-data">
<div id="popup">
	<input type="checkbox" id="file_delete" class="checks">
	<label></label>
	<label for="file_delete" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				ファイルを削除
				<label for="file_delete" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<p>選択したファイルを削除しますか？</p>
					<input type="hidden" name="data[path]" value="" class="hidden_file_path">
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="file_delete" class="buttons backbtn clearbtn">キャンセル</label></li>
					<li class="f_right"><a class="buttons clearbtn" id="btn_file_delete">削除する</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//#popup-->
</form>

<form id="dir_delete_form" enctype="multipart/form-data">
<div id="popup">
	<input type="checkbox" id="dir_delete" class="checks">
	<label></label>
	<label for="dir_delete" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				ディレクトリを削除
				<label for="dir_delete" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<p>選択したディレクトリを削除しますか？</p>
					<input type="hidden" name="data[path]" value="" class="hidden_dir_path_2">
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="dir_delete" class="buttons backbtn clearbtn">キャンセル</label></li>
					<li class="f_right"><a class="buttons clearbtn" id="btn_dir_delete">削除する</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//#popup-->
</form>
<form id="dir_rename_form" enctype="multipart/form-data">
<div id="popup">
	<input type="checkbox" id="dir_rename" class="checks">
	<label></label>
	<label for="dir_rename" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				ディレクトリ名を変更
				<label for="dir_rename" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<p>変更するディレクトリ名</p>
					<input type="text" name="data[after_directory]" class="hidden_dir_path_2">
					<input type="hidden" name="data[before_directory]" value="" class="hidden_dir_path_2">
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="dir_rename" class="buttons backbtn clearbtn">キャンセル</label></li>
					<li class="f_right"><a class="buttons clearbtn" id="btn_dir_rename">変更する</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//#popup-->
</form>

<form id="file_rename_form" enctype="multipart/form-data">
<div id="popup">
	<input type="checkbox" id="file_rename" class="checks">
	<label></label>
	<label for="file_rename" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				ファイル名を変更
				<label for="file_rename" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<p>変更するファイル名</p>
					<input type="text" name="data[after_file]" class="hidden_file_path">
					<input type="hidden" name="data[before_file]" value="" class="hidden_file_path">
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<ul class="float">
					<li><label for="file_rename" class="buttons backbtn clearbtn">キャンセル</label></li>
					<li class="f_right"><a class="buttons clearbtn" id="btn_file_rename">変更する</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!--//#popup-->
</form>

<div id="popup">
	<input type="checkbox" id="file_geturl" class="checks">
	<label></label>
	<label for="file_geturl" class="basejavar"></label>
	<div class="window table dialog">
		<div class="tr">
			<div class="hf head">
				ファイルパスの確認
				<label for="file_geturl" class="clear"></label>
			</div>
		</div>
		<div class="tr">
			<div class="mains">
				<div class="bs">
					<input type="text" disabled="false" id="input_disable_geturl">
				</div>
			</div>
		</div>
		<div class="tr">
			<div class="hf">
				<div class="center">
					<label for="file_geturl" class="buttons backbtn clearbtn">閉じる</label>
				</div>
			</div>
		</div>
	</div>
</div><!--//#popup-->
<script type="text/javascript">
$(function(){

	var m_enable=false;
	var select_cp=[];

	dir_refresh();
	function dir_refresh(){
		$(".hidden_dir_path").val($("#url_directorypath").text());
		$.ajax({
			url:$("#url_dir_view").text(),
			method:"POST",
			data:{
				dir:$("#url_directorypath").text(),
			},
			success:function(htmldata){
				$(".file_controlpanel .html").html(htmldata);
				$(".file_controlpanel .url").text($("#url_directorypath").text());
			},
		});
	}

	$("body").on("click",".file_controlpanel .dir",function(){
		var path=$(this).attr("data-path");
		$("#url_directorypath").text(path);

		dir_refresh();
	});
	$("body").on("click",".file_controlpanel .goback",function(){
		if($(this).attr("data-path")){
			var path=$(this).attr("data-path");
			$("#url_directorypath").text(path);
			dir_refresh();
		}
	});
	$("body").on("click",".file_controlpanel",function(){
		$(".file_controlpanel .contextmenu").css("display","");
	});
	$("body").on("contextmenu",".file_controlpanel",function(e){
		$(".file_controlpanel .contextmenu.dir").css("display","");
		$(".file_controlpanel .contextmenu.file").css("display","");
		$(".file_controlpanel .contextmenu.other").css({
			"display":"block",
			"left":e.pageX+"px",
			"top":e.pageY+"px",
		});
		return false;
	});
	$("body").on("contextmenu",".file_controlpanel .dir",function(e){
		$(".hidden_dir_path_2").val($(this).attr("data-path"));

		$(".file_controlpanel .contextmenu.other").css("display","");
		$(".file_controlpanel .contextmenu.file").css("display","");
		$(".file_controlpanel .contextmenu.dir").css({
			"display":"block",
			"left":e.pageX+"px",
			"top":e.pageY+"px",
		});
		return false;
	});
	$("body").on("contextmenu",".file_controlpanel .file",function(e){
		$(".hidden_file_path").val($(this).attr("data-path"));

		$(".file_controlpanel .contextmenu.other").css("display","");
		$(".file_controlpanel .contextmenu.dir").css("display","");
		$(".file_controlpanel .contextmenu.file").css({
			"display":"block",
			"left":e.pageX+"px",
			"top":e.pageY+"px",
		});
		return false;
	});
	//ディレクトリ内情報更新
	$("body").on("click",".dir_refresh",function(){
		dir_refresh();
	});
	//ディレクトリ新規追加
	$("body").on("click","#btn_dir_name",function(){
		$.ajax({
			url:$("#url_dir_make").text(),
			data:new FormData($("#dir_new_form").get(0)),
			method:"POST",
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){

				$("#dir_new").prop("checked",false);
				dir_refresh();
			},
		});
	});
	//ファイルアップロード(バッファ)
	$("body").on("change","#file_buffer",function(){
		$.ajax({
			url:$("#url_file_buffer").text(),
			data:new FormData($("#file_upload_form").get(0)),
			method:"POST",
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){


			},
		});
	});
	//ファイルアップロード
	$("body").on("click","#btn_file_upload",function(){
		$.ajax({
			url:$("#url_file_upload").text(),
			data:new FormData($("#file_upload_form").get(0)),
			method:"POST",
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){

				$("#file_upload").prop("checked",false);
				dir_refresh();
			},
		});
	});
	//ファイルを削除
	$("body").on("click","#btn_file_delete",function(){
		$.ajax({
			url:$("#url_file_delete").text(),
			data:new FormData($("#file_delete_form").get(0)),
			method:"POST",
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){

				$("#file_delete").prop("checked",false);
				dir_refresh();
			},
		});
	});
	//ディレクトリを削除
	$("body").on("click","#btn_dir_delete",function(){
		$.ajax({
			url:$("#url_dir_delete").text(),
			data:new FormData($("#dir_delete_form").get(0)),
			method:"POST",
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){

				$("#dir_delete").prop("checked",false);
				dir_refresh();
			},
		});
	});
	//ディレクトリ名を変更
	$("body").on("click","#btn_dir_rename",function(){
		$.ajax({
			url:$("#url_dir_rename").text(),
			data:new FormData($("#dir_rename_form").get(0)),
			method:"POST",
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){

				$("#dir_rename").prop("checked",false);
				dir_refresh();
			},
		});
	});
	//ファイル名を変更
	$("body").on("click","#btn_file_rename",function(){
		$.ajax({
			url:$("#url_file_rename").text(),
			data:new FormData($("#file_rename_form").get(0)),
			method:"POST",
			processData: false,
			contentType: false,
		        async: false,//同期させる
			success:function(data){

				$("#file_rename").prop("checked",false);
				dir_refresh();
			},
		});
	});
	//ファイルパスの確認
	$("body").on("change","#file_geturl",function(){
		$("#input_disable_geturl").val($("#url_domainurl").text()+$(".hidden_file_path").val());
	});


	$("body").on("mouseup",".file_controlpanel .file",function(){
		if(m_enable){
			m_enable=false;
		//	select_cp=[];
		}
		console.log(select_cp);
	});
	$("body").on("mousedown",".file_controlpanel .file",function(){
		m_enable=true;
		if(!m_enable){
			$(".file_controlpanel .file").attr("style","");
		}
	});
	$("body").on("mousemove",".file_controlpanel .file",function(){
		if(m_enable){
			$(this).attr("style","background:#ddd");
			var index=$(this).index();
			select_cp[index]=index;
		}
		return false;
	});
});
</script>
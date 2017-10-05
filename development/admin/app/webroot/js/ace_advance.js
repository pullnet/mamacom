function aceeditor(array){
	var editor=ace.edit(array["textarea"]);
	editor.setFontSize(15);
	if(array["mode"]==undefined){
		editor.getSession().setMode("ace/mode/html");
	}
	else if(array["mode"]=="css")
	{
		editor.getSession().setMode("ace/mode/css");
	}

	editor.getSession().setUseWrapMode(true);
	editor.getSession().setTabSize(5);
	editor.setValue($("#"+array["textdata"]).val(),-1);
	editor.setShowPrintMargin(false);
	$("#"+array["textarea"]).keyup(function(){
		$("#"+array["textdata"]).val(editor.getValue());
	});
	editor.setOptions({
		enableBasicAutocompletion: true,
		enableSnippets: true,
		enableLiveAutocompletion: true,
	});
	return editor;
}
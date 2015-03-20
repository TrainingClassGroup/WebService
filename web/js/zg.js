function SafeAjax(options) {
	$.ajax(options);
}

function copyCode(obj) {
	var code = "";
	obj.find(".myCodes").each(function(i, o) {
		code += $(o).text() + "\n";
	});
	obj.hide();
	obj.parent().find('.myCodeText').text(code).show().select();
	setTimeout(function(){
		$("body").click(function(){
			$(this).unbind('click');
			obj.show();
			obj.parent().find('.myCodeText').hide();
		});
	},500);
}


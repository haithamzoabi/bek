var editor;
var filemanager = LOCALS.controlDomainName+'/ckeditor/filemanager/';
var browser = filemanager + 'browser/new/file_browser/';
var connector = filemanager + 'connectors/php/connector.php';
var upload = filemanager + 'connectors/php/upload.php';

function createEditor(languageCode , id) {
    var editorElement= id || 'ckeditor';
	if (editor)
	editor.destroy();
// Replace the <textarea id="editor"> with an CKEditor
// instance, using default configurations.
    editor = CKEDITOR.replace( editorElement , {
	customConfig : this.config,	
	width: '880px',
	height: '400px',
	removePlugins: 'resize',	
	filebrowserBrowseUrl: browser ,
	filebrowserImageBrowseUrl: browser + '?Type=Image',
	filebrowserFlashBrowseUrl: browser + '?Type=Flash',
	filebrowserWindowWidth: 970,
	filebrowserWindowHeight: 600,
	//filebrowserUploadUrl : upload + '?type=Files',
    //filebrowserImageUploadUrl : upload + '?type=Images',
    //filebrowserFlashUploadUrl : upload + '?type=Flash'
    });
	return editor;
}






function open_uploader(txtinput, w, h) {
//window.open("uploadimg.php?txtimg="+txtinput,"","width=500,height=500,top=10,left=10");
    window.open("crop/crop.php?txtimg=" + txtinput + "&imgw=" + w + "&imgh=" + h, "", "width=700,height=550,top=10,left=10,scrollbars=yes,resizable=yes");
//window.open("upload_crop.php?txtimg="+txtinput+"&imgw="+w+"&imgh="+h,"","width=850,height=700,top=10,left=10,scrollbars=yes,resizable=yes");
}
function open_pic(pic) {
    window.open("../pics/" + pic, "", "width=500,height=500,top=10,left=10");
}


function open_printfile(filename, pageTitle) {
    window.open("print.php?filename=" + filename + '&pageTitle=' + pageTitle, "", "width=700,height=550,top=10,left=10,scrollbars=yes,resizable=yes");
}
function open_csvfile(filename) {
    window.open("convert2xl.php?filename=" + filename);
}

$(function() {
    fixHeight();
});


function fixHeight() {
    $('#mainBodyRow').css({height: 'auto'});
    var d = $(document).height();
    var b = $('body').height();
    var g = $('#mainBodyRow').height();
    var c = (d - b > 0) ? d - b + g : g;
    $('#mainBodyRow').css({height: c + 'px'});
}
$(window).resize(fixHeight);


function getURLParameter(name) {
    return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || ['', null])[1]);
}

function msgBox(success, data) {

    var msgBox = $('<div/>', {
	class: 'alertBox',
	title: data.msg,
	text: data.msg,
    });
    if (success === false) {
	msgBox.addClass('alertBoxError');
    }
    /*var xButton = $('<div/>', {
     class: 'alertBox_x',
     onClick : '$(".alertBox").fadeOut()'
     }).appendTo(msgBox);*/

    return msgBox.delay(4000).fadeOut('slow');

}


function open_uploader(txtinput) {
    window.open("uploadimg.php?txtimg=" + txtinput, "", "width=500,height=500,top=10,left=10");
}
function open_pic(pic) {
    window.open("../pics/" + pic, "", "width=500,height=500,top=10,left=10");
}


function check_delete(page , returnUrl) {
    var sid = getURLParameter('sid');
    var status = confirm(LOCALS.l_deleteMessageConfirm + '\nId: (' + sid + ') , page: (' + page + ')');
    if (status === true) {

		$.ajax({
			type: "POST",
			url: 'include/response.php',
			data: {
				type: 'delete',
				page: page,
				sid: sid
			},
			success: function(data) {
			$('form').prepend(msgBox(data.success, data));
			if (data.success === true) {
				document.location.replace(returnUrl);
			}
			},
			dataType: 'json'
		});

    }
    return false;
}




$(function() {

    $(":text,textarea").each(function() {
		$(this).addClass('txtbox');
    });
    $("select").each(function() {
		$(this).addClass('lstBox');
    });

});



function isEmpty(str) {
    return (!str || 0 === str.length);
}
function getFormFields(theFormId) {
    var fields = {};
    var emptyFields = 0;
    var fVal = '';
    $("#" + theFormId).find("input, textarea, select").each(function(index, row) {
	var inputType = this.tagName.toUpperCase() === "INPUT" && this.type.toUpperCase();
	var isSelectBox = this.tagName === "SELECT";
	fVal = $(this).val();
	if (inputType !== "BUTTON" && inputType !== "SUBMIT") {
	    fields[this.name] = fVal;
	}
	if (isSelectBox) {
	    fVal = $(this).find(":selected").val();
	    fields[this.name] = fVal;
	}
	if (isEmpty(fVal)) {
	    emptyFields++;
	    $(this).addClass('redBorder');
	} else {
	    $(this).removeClass('redBorder');
	}

    });
    return obj = {fields: fields, emptyFields: emptyFields};
}



function FUNC(){
	var me = this;
	this.configSelection = function(page , lstBoxId , selectedId){
		var me = this;
		$.ajax(LOCALS.controlDomainName +'/include/response.php', {
			type: 'POST',
			data: {
				type: 'get',
				page : page
			},
			success: function(data){
				me.addOptionToSelect (lstBoxId ,data.selectValues , selectedId);
			},
			dataType: 'json'
		});
	
	}
	
	this.addOptionToSelect = function (lstId ,selectValues , selectedId){
		$.each(selectValues, function(key, item) {
			var option = $("<option></option>").attr("value", item.value).text(item.text);
			if (item.value === selectedId){
				option.attr('selected','selected');
			}
			$('#'+lstId).append(option);
		});
	}
	
	this.sendFormData= function(formId , action , id, editor){
		
		this.formId = formId;
		this.action = action;
		$('#'+formId).submit(function() {
			var fields = me.getFormFields(formId);
			if (fields.emptyFields > 0) {
				var data = new Object();
				data.msg = LOCALS['l_fillEmptyFields'];
				$('form').prepend(msgBox(false, data));
				return false;
			}
			if (editor){
				fields.fields[editor.name] = editor.getData();
			}
			$.ajax({
				type: "POST",
				url: LOCALS.controlDomainName +'/include/response.php',
				data: {
					type: 'set',
					page: formId,
					action: action,
					sid : (action==='update')?id || getURLParameter('sid'):null,
					fields: fields.fields
				},
				success: me.sendSuccessCallBack,
				error : me.sendFailureCallBack,
				dataType: 'json'
			});
			
			
			return false;
		});
		
		
	}
	
	this.sendSuccessCallBack = function(data) {		
		if (data.success && me.action==='add') {			
			$('#'+me.formId).find("input[type=text], textarea, select").val("");
		}
		$('#'+me.formId).prepend(msgBox(data.success, data));
		
		
	}
	
	this.sendFailureCallBack = function(response){
		$('#'+me.formId).prepend(msgBox(false, {msg:LOCALS.requestFail} ) );
		console.log ('Error: your request has failed' , response , this);
	}
	
	this.ajaxIncludeFile = function(file,containerDivId){
		$('#'+containerDivId).empty();
		$.get(LOCALS.controlDomainName +'/includeThisFile.php', 
			{
				path: LOCALS.controlDomainName,
				file: file
			}, 
			function(data) {
				$('#'+containerDivId).html(data);
			}
		);
	}
	
	
	this.getFormFields = function (theFormId) {
		var fields = {};
		var emptyFields = 0;
		var fVal = '';
		$("#" + theFormId).find("input, textarea, select").each(function(index, row) {
			var inputType = this.tagName.toUpperCase() === "INPUT" && this.type.toUpperCase();
			var isSelectBox = this.tagName === "SELECT";
			fVal = $(this).val();
			if (inputType !== "BUTTON" && inputType !== "SUBMIT") {
				fields[this.name] = fVal;
			}
			if (isSelectBox) {
				fVal = $(this).find(":selected").val();
				fields[this.name] = fVal;
			}
			if (isEmpty(fVal)) {
				emptyFields++;
				$(this).addClass('redBorder');
			} else {
				$(this).removeClass('redBorder');
			}
			$(this).on('blur' , function(){
				$(this).removeClass('redBorder')
			});
		});
		return obj = {fields: fields, emptyFields: emptyFields};
	}

	this.fetchData = function(formId, callBack , id){
	
		var sid = id || getURLParameter('sid');
		var menu = getURLParameter('menu');
		if (sid) {
			$.ajax({
				type: "POST",
				url: LOCALS.controlDomainName+'/include/response.php',
				data: {
					type: 'get',
					page: formId,
					sid: sid
				},
				success: function(data) {
					var row = me.formData = data.row;
					$.each(row , function(key, value){
						$('#'+key,'#'+formId).val(value);
					});
					callBack(me.formData);
				},
				dataType: 'json'
			});
		}	
	}

}
var FUNC = new FUNC();





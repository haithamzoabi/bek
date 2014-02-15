/*
 config.toolbar = 'Full';
 
 config.toolbar_Full =
 [
 { name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
 { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
 { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
 { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',
 
 'HiddenField' ] },
 '/',
 { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
 { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-
 
 ','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
 { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
 { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
 '/',
 { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
 { name: 'colors', items : [ 'TextColor','BGColor' ] },
 { name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
 ];
 
 config.toolbar_Basic =
 [
 ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
 ];
 */


var editor;
function createEditor(languageCode) {
    if (editor)
	editor.destroy();
// Replace the <textarea id="editor"> with an CKEditor
// instance, using default configurations.
    editor = CKEDITOR.replace('ckeditor', {
	language: languageCode,
	skin: 'kama',
	width: '680px',
	removePlugins: 'resize',
	toolbar:
		[
		    {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
		    {name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']},
		    {name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak']},
		    '/',
		    {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
		    {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiRtl', 'BidiLtr']},
		    '/',
		    {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
		    {name: 'colors', items: ['TextColor', 'BGColor']},
		    {name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About']}
		]
    });
}
// At page startup, load the default language:
$(function() {
    if ($('#ckeditor').is(':visible')) {
	createEditor('ar');
    }

})






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


function check_delete() {
    var rowId = getURLParameter('rowId');
    var page = getURLParameter('page');
    var action = getURLParameter('action');
    var status = confirm(globalsVar.l_deleteMessageConfirm + '\nrowId: (' + rowId + ') , page: (' + page + ')');
    if (status === true) {

	$.ajax({
	    type: "POST",
	    url: 'include/response.php',
	    data: {
		type: 'delete',
		page: page,
		rowId: rowId
	    },
	    success: function(data) {
		$('form').prepend(msgBox(data.success, data));
		if (data.success === true) {
		    if (page === 'order_details') {
			document.location.replace('?page=orders');
		    } else {
			document.location.replace('?page=' + page + '&action=add');
		    }

		}
	    },
	    dataType: 'json'
	});

    }
    return false;
}
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


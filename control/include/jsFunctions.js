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
function createEditor( languageCode ){
if ( editor )editor.destroy();
// Replace the <textarea id="editor"> with an CKEditor
// instance, using default configurations.
editor = CKEDITOR.replace( 'ckeditor',{
language : languageCode,
skin : 'kama',
width : '680px',
removePlugins:'resize',
toolbar :
	[
    { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
    { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
    { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
	'/',
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiRtl','BidiLtr' ] },
	'/',
	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
	]
} );
}
// At page startup, load the default language:
$(function(){
  if ($('#ckeditor').is(':visible')){createEditor( 'ar' );}

})






function open_uploader(txtinput,w,h){
//window.open("uploadimg.php?txtimg="+txtinput,"","width=500,height=500,top=10,left=10");
window.open("crop/crop.php?txtimg="+txtinput+"&imgw="+w+"&imgh="+h,"","width=700,height=550,top=10,left=10,scrollbars=yes,resizable=yes");
//window.open("upload_crop.php?txtimg="+txtinput+"&imgw="+w+"&imgh="+h,"","width=850,height=700,top=10,left=10,scrollbars=yes,resizable=yes");
}
function open_pic(pic){
window.open("../pics/"+pic,"","width=500,height=500,top=10,left=10");
}


function open_printfile(filename,pageTitle){
window.open("print.php?filename="+filename+'&pageTitle='+pageTitle,"","width=700,height=550,top=10,left=10,scrollbars=yes,resizable=yes");
}
function open_csvfile(filename){
window.open("convert2xl.php?filename="+filename);
}



$(function(){

$(":text,textarea").each(function(){($(this).addClass('txtbox'));});
$("select").each(function(){
  $(this).css({height:'25px'});
});



fixHeight();
});

function fixHeight (){

	var mainId = '#mainWarpper';
	var contentId=  '#contentWrapper';
	$(contentId).css({height:'auto'});
	var d = $(document).height();
	var b = $('body').height();
	var g = $(contentId).height();
	var c = (d-b>0)? d-b+g : g ;
	console.log (d,b,g,c);
	$(contentId).css({height:c+'px'});
}
$(window).resize(fixHeight);


function getURLParameter(name) {
    return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||['',null])[1]);
}

function msgBox(success,data){
	
	var msgBox = $('<div/>', {
		class: 'alertBox',
		title:data.msg,
		text: data.msg,
	});
	if (success===false){
		msgBox.addClass('alertBoxError');
	}
	
	
	return msgBox.delay(4000).fadeOut('slow');

}

function open_uploader(txtinput){
	window.open("uploadimg.php?txtimg="+txtinput,"","width=500,height=500,top=10,left=10");
}
function open_pic(pic){
	window.open("../pics/"+pic,"","width=500,height=500,top=10,left=10");
}













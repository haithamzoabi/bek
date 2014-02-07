$(function(){
var browser_name =($.browser.msie || $.browser.mozilla ) ;
if (browser_name){

$("input[placeholder]").each(function(){
  var this_box = $(this);
$(this).val($(this).attr('placeholder')).css({color:'#999999'});
$(this).click(function(){
$(this).css({color:'#000000'});
if ( $(this).val()==$(this).attr('placeholder') ){
$(this).val('');
}
return false;
});

$('form').submit(function(){
 var this_val=  ( this_box.val() );
if ( this_val==this_box.attr('placeholder') ){
this_box.val('');
return true;
}
});

$(this).blur(function(){
 if ($(this).val()=='') {
$(this).val($(this).attr('placeholder')).css({color:'#999999'});;
 }
});

});

}});
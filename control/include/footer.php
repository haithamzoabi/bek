<? if ($setBodyContainerOn===true){?>
  
	</div> <?/*for .cell #content_s*/?>

    </div> <?/*for .row*/?>	    
</div> <?/*for .container*/?>  

<div  class="grad4 footer_s" >
    <div style="padding: 10px; overflow: hidden" >
	<span style=" font-style: italic; text-shadow:0px 1px 0px #000; font-size: 14px; color: #AAAAAA ">
	    <?= $l_websiteName . ' ' . $l_allrightsreserved ?> 2011
	</span>
    </div>
</div>

<script>

    $(function() {

	$(":text,textarea").each(function() {
	    ($(this).addClass('txtbox'));
	});
	$("select").each(function() {
	    $(this).css({height: '25px'});
	});

	var content_s_h = $('.content_s').height();
	var content_s_w = $('.content_s').width();
	var sidebar_s_h = $('.sidebar_s').height();
	var sidebar_s_w = $('.sidebar_s').width();
	var body_h = $('body').height();
	body_h = (body_h > 600) ? body_h : 600;
	var body_w = $('body').width();
	var doc_w = $(document).width();

    });

</script>

<?}?>

</body>
</html>
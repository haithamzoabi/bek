<div style=" overflow: hidden; padding: 5px; width: 100%; height: 100%;">



    <?
    foreach ($menu_array as $k => $v) {
	$todo_txt = (is_array($v[1]) and !empty($v[1])) ? $v[1][0][1] : $v[1];
	$menu_txt = $k;
	if ($todo_txt !== 'home' and (!empty($v[1]) and is_array($v[1]))) {
	    ?>

	    <div class="homebox" >
		<span class="caption homebox_title"><?= $v[0] ?></span>
		<a class="icon_link" href="<?= $controlDomainName . $v2[1] ?>?menu=<?= $menu_txt ?>">
		    <img src="<?= $controlDomainName ?>images/<?= $menu_icons[$menu_txt] ?>" width="48" height="48" alt="">
		</a>

		<? if (!empty($v[1]) and is_array($v[1])) { ?>
	    	<div class="homebox_subcats">
			<? foreach ($v[1] as $k2 => $v2) { ?>
			    <a href="<?= $controlDomainName . $v2[1] ?>?menu=<?= $menu_txt ?>"><?= $v2[0] ?></a>
			<? } ?>
	    	</div>
		<? } ?>

	    </div>
	<? } ?>
    <? } ?>

</div>

<script>
    $('.homebox').hover(function() {

	$('.homebox_subcats', this).animate({top: '35px'});

    }, function() {
	$('.homebox_subcats', this).animate({top: '161px'});

    });
</script>

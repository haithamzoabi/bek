<div class="company_section" >
    <div class="company_section_container" >
	<div class="logodiv" style=""></div>
	<span style=""><?= $l_company ?></span>
    </div>
</div>


<?
if (!empty($sub_menu_arr) and is_array($sub_menu_arr)) {
?>
    <div id="<?= $menu ?>_sb" class="side_bar_container">
        <div  onclick="sb_tgl('<?= $menu ?>_sb')" class="grad5 side_bar_title" >
    	<span class="sb_t" ><?= $m_title ?></span>
        </div>

        <ul class="sidebar_list">

	    <?
	    foreach ($sub_menu_arr as $k => $v) {
		global $menu, $page, $l_hide;
		$v1 = (strpos($v[1], '&')) ? (@strstr($v[1], '&', true)) : $v[1];
		?>
		<li <?= ($page == $v1) ? 'class="sel2"' : '' ?>><a href="?menu=<?= $menu ?>&page=<?= $v[1] ?>&lang=<?= $lang ?>"><?= $v[0] ?></a></li>

	    <? } ?>
        </ul>
    </div>
    <?
} else {
    ?>
    <div id="<?= $menu ?>_sb" class="side_bar_container">
        <div  onclick="sb_tgl('<?= $menu ?>_sb')" class="grad5 side_bar_title" >
    	<span class="sb_t" ><?= $m_title ?></span>
        </div>
    </div>
    <?
}
?>







<script>
    function sb_tgl(this_id) {


	var this_stat = $('#' + this_id + ' .side_bar_show_hide').html();
	$('#' + this_id + ' .sidebar_list').slideToggle();
	if (this_stat == 'SHOW') {
	    $('#' + this_id + ' .side_bar_show_hide').html('HIDE');
	} else {
	    $('#' + this_id + ' .side_bar_show_hide').html('SHOW');
	}
    }
    ;




</script>
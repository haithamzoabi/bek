<div class="container">

    <div class="tblcaption" style="height: 92px" >

	<div class="grad1" style="width: 100%; height: 60px; overflow: hidden; float: right ">

	    <div class="logtools" style="float: left; margin-left: 20px; line-height: 60px;">
		<a class="grad2 link_shortcut" href="logout.php"><?= $l_logout ?></a>
		<a class="grad2 link_shortcut imglink" data-dialog_id="dialog2" rel="dialogbox" target="_blank">
		    <img src="images/Zoom.png" width="17" height="17" alt="" style="display:  run-in; ">
		</a>
	    </div>

	    <div style="float: left; padding-left: 20px;">
		<?
		$today = date("d/m/Y");
		$day = date("D");
		?>
		<span class="date"><?= $l_days[$day] . "&nbsp;" . $today ?></span>
	    </div>


	    <div class="cms_title"  >
		<span><?= $_COOKIE['user_cookie'] ?></span>
		<a  href="./" > &nbsp;|&nbsp; <?= $l_systemctrl ?></a>
	    </div>


	</div>



	<div class="grad3" style="width: 100%; height: 30px; float: right  ">

	    <?
	    foreach ($menu_array as $k => $v) {
		$todo_txt = (is_array($v[1]) and !empty($v[1])) ? $v[1][0][1] : $v[1];
		$menu_txt = $k;
		if ($menu == $k) {
		    $sub_menu_arr = $v[1];
		    $m_title = $v[0];
		}
		?>
    	    <div class="menu_up <?= ($menu == ($menu_txt)) ? 'sel' : '' ?>" ><a  href="?menu=<?= $menu_txt ?>&page=<?= $todo_txt ?>"><?= $v[0] ?></a></div>
		<?
	    }
	    ?>

	</div>

	<div class="dialog_message" id="dialog2">
	    <div style="width:100%; height: 100%; overflow: auto;">
		<iframe frameborder="0" width="850" height="450" src="<?= $g_base_url ?>"></iframe>
	    </div>
	</div>

    </div>

    <div class="row">

	<div class="cell" id="sidebar_s" >
	    <? include("scripts/side_bar.php"); ?>
	</div>


	<div class="cell" id="content_s">
<?/*  these closures in include/footer.php ?>	  
	</div>

    </div>	    
</div>   
<?*/?>

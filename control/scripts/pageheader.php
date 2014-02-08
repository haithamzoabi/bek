<div class="container">

    <div class="tblcaption" style="height: 92px" >

	<div class="grad1" style="width: 100%; height: 60px; overflow: hidden; float: right ">

	    <div class="logtools" style="float: left; margin-left: 20px; line-height: 60px;">
		<a class="grad2 link_shortcut" href="<?=$controlDomainName.'/logout'?>"><?= $l_logout ?></a>
	    </div>

	    <div style="float: left; padding-left: 20px;">
		<?
		$today = date("d/m/Y");
		$day = date("D");
		?>
		<span class="date"><?= $l_days[$day] . "&nbsp;" . $today ?></span>
	    </div>
	    
	    <div class="cms_title"  >
		<span><?= $username ?></span>
		<a  href="./" > &nbsp;|&nbsp; <?= $l_systemctrl ?></a>
	    </div>

	</div>

	<div class="grad3" style="width: 100%; height: 30px; float: right  ">

	    <?
	    $menu = $_GET['menu'];
	    foreach ($menu_array as $index => $pageData) {
		$pageLink = (is_array($pageData[1]) and !empty($pageData[1])) ? $pageData[1][0][1] : $pageData[1];		
		if ($menu == $index ) {
		    $sub_menu_arr = $pageData[1];
		    $m_title = $pageData[0];
		}
		?>
    	    <div class="menu_up <?= ($menu == ($index)) ? 'sel' : '' ?>" ><a  href="<?= $controlDomainName.$pageLink?>/?menu=<?= $index ?>"><?= $pageData[0] ?></a></div>
		<?
	    }
	    ?>

	</div>
    </div>

    <div class="row" id="mainBodyRow">

	<div class="cell" id="sidebar_s" >
	    <? include("scripts/side_bar.php"); ?>
	</div>

	<div class="cell" id="content_s">
<?/*  these closures in include/footer.php ?>	  
	</div>

    </div>	    
</div>   
<?*/?>

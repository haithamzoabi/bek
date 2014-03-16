
<div id="mainWarpper"> <?/*closed in the footer*/?>


	<div class="top-bar-con">
		<div class="top-bar-inner"> 
		<div class="page_center">
			<div class="social">
				<a href="" class="facebook"></a>
				<a href="" class="youtube"></a>
			</div>		
		</div>
		</div>
	</div>

	<div id="header" class="<?=($getpage==$homepageGet)?'home':''?>">
	<div class="contWrapper">
	<a class="websiteName" href="<?=$domainName?>">
		<h1><?=$l_websiteName?></h1> 
		<h2>www.ebnalbe<span>k</span>.com</h2> 
	</a>
		
		<div class="slide-cont" id="slide-cont" >
				<div id="slide-cont-inner"></div>
		</div>
		<div class="slide-details" id="slide-details" ></div>
		
	</div>
	</div>
	
	<div class="main-menu-con" >
		<div id="menu" class="main-menu-inner">
			<ul>
			<?
				foreach ( getMenu() as $url=>$page ){ 
			?>
				<li class="<?=($GetPageVal==$url)?'selected':''?>" ><a href="<?=$domainName.$url?>"><?=$page?></a></li>				
			<?}?>
			</ul>
		</div>
		<div class="main-menu-line"></div>
		
	</div>
	
	<div id="contentWrapper">
		<div id="sidebar"></div>
		<div id="mainContent">
		
		<?
		if (file_exists ( $script_page ) ){
			include("$script_page");
		} else {
			include("scripts/noPage_page.php");
		}
		?>
		
		</div>
	</div>



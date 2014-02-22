<div class="home">

<?
	
	$q= "select * from vid_cats where v_status='1' order by v_order asc limit 10";
	$res= query($q);
	while ($row = $res->fetch_row() ){
	$categoryLink = $domainName."/video?Category=".$row[0];
?>
	
	<div class="adv600x90" style="float:right"></div>
	<div class="adv600x90" style="float:left"></div>

	<div class="category_main">
		<div class="title"><a href="<?=$categoryLink?>"><?=$row[1]?></a></div>
		<div class="items">
		
		<?
		$q2 = "select * from video where v_category='$row[0]' and v_status='1' order by v_id desc limit 3";
		$res2 = query ($q2);
		while ($row2 = $res2->fetch_row() ){
			$videoCode=  $row2[5];
			$videoLink  = $categoryLink."&vid=".$row2[0];
		?>		
			<div class="row">
				<a href="<?=$videoLink?>">
					<img alt="Thumbnail" src="http://i1.ytimg.com/vi/<?=$videoCode?>/mqdefault.jpg" width="390">
					<span><?=$row2[3]?> [<?=getDuration($videoCode)?>]</span>
				</a>
			</div>
		<?}?>
		</div>
	</div>

	
<?}?>	
	
	

	
	
	<div class="adv600x90" style="float:right;margin-bottom:10px"></div>
	<div class="adv600x90" style="float:left;margin-bottom:10px"></div>
	
</div>
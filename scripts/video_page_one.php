<?
$q= "select video.*,vid_cats.v_name from video,vid_cats where video.v_category=vid_cats.v_id and video.v_id='$videoId' limit 1";
$res= query($q);
$row = $res->fetch_row();
$breadCrumb = $row[8]." - ".$row[3];
$videoCode = $row[5];
?>
	<div class="category_main" style="height:auto">
		<div class="title" style="margin:0"><?=$breadCrumb?></div>
	</div>

	
<div class="videoSide" style="float:right; width :860px;min-height:800px; overflow:hidden; background:#ffffff;padding : 10px; border-radius:3px ">

	
	<div>
		<iframe width="853" height="480" src="//www.youtube.com/embed/<?=$videoCode?>" frameborder="0" allowfullscreen></iframe>
	</div>
	
	<div>
		<div class='shareaholic-canvas' data-app='share_buttons' data-app-id='5259388'></div>
	</div>
	

	<div style="padding-top:15px;font-size:1.3em">
		<?=nl2br($row[4])?>
	</div>

</div>
	
<div class="adsSide" style="" ></div>